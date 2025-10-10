<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Property;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

/**
 * Resource Controller for Bookings implementing full CRUD operations
 * Demonstrates: Controllers, CRUD (Create, Read, Update, Delete), Form Validation
 */
class BookingController extends Controller
{
    /**
     * Display a listing of the resource (READ - Index).
     * Shows all bookings for the authenticated user.
     */
    public function index()
    {
        $user = Auth::user();
        
        if ($user->isOwner() || $user->isAdmin()) {
            // Owners see bookings for their properties
            $bookings = Booking::whereHas('property', function($query) use ($user) {
                if ($user->isOwner()) {
                    $query->where('user_id', $user->id);
                }
            })
            ->with(['property', 'customer', 'payment'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        } else {
            // Customers see their own bookings
            $bookings = Booking::where('user_id', $user->id)
                ->with(['property', 'payment'])
                ->orderBy('created_at', 'desc')
                ->paginate(15);
        }

        return view('bookings.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource (CREATE - Form).
     * Blade Directives Used: @csrf
     */
    public function create(Property $property)
    {
        // Authorization: Only customers can book
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to book a property.');
        }

        if (Auth::user()->isOwner() && $property->user_id === Auth::id()) {
            return back()->with('error', 'You cannot book your own property.');
        }

        return view('bookings.create', compact('property'));
    }

    /**
     * Store a newly created resource in storage (CREATE - Store).
     * Demonstrates: Form Validation, Mass Assignment, Flash Session Data, Business Logic
     */
    public function store(Request $request)
    {
        // Form Validation
        $validated = $request->validate([
            'property_id' => 'required|exists:properties,id',
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
            'guests' => 'required|integer|min:1',
        ]);

        $property = Property::findOrFail($validated['property_id']);

        // Additional validation
        if ($validated['guests'] > $property->max_guests) {
            return back()->with('error', "Maximum guests allowed: {$property->max_guests}");
        }

        // Check for overlapping bookings
        $hasOverlap = Booking::where('property_id', $property->id)
            ->whereIn('status', ['confirmed', 'pending'])
            ->where(function($query) use ($validated) {
                $query->whereBetween('check_in', [$validated['check_in'], $validated['check_out']])
                      ->orWhereBetween('check_out', [$validated['check_in'], $validated['check_out']])
                      ->orWhere(function($q) use ($validated) {
                          $q->where('check_in', '<=', $validated['check_in'])
                            ->where('check_out', '>=', $validated['check_out']);
                      });
            })
            ->exists();

        if ($hasOverlap) {
            return back()->with('error', 'Property is not available for selected dates.');
        }

        // Calculate pricing
        $checkIn = Carbon::parse($validated['check_in']);
        $checkOut = Carbon::parse($validated['check_out']);
        $nights = $checkIn->diffInDays($checkOut);
        
        $subtotal = $property->price_per_night * $nights;
        $cleaningFee = $property->cleaning_fee ?? 0;
        $serviceFee = $property->service_fee ?? 0;
        $totalPrice = $subtotal + $cleaningFee + $serviceFee;

        // Create booking using Mass Assignment
        $booking = Booking::create([
            'property_id' => $property->id,
            'user_id' => Auth::id(),
            'check_in' => $validated['check_in'],
            'check_out' => $validated['check_out'],
            'guests' => $validated['guests'],
            'total_price' => $totalPrice,
            'status' => 'pending',
        ]);

        // Flash Session Data
        return redirect()->route('bookings.show', $booking)
            ->with('success', 'Booking request created! Please proceed with payment.');
    }

    /**
     * Display the specified resource (READ - Show).
     */
    public function show(Booking $booking)
    {
        // Authorization: Only booking owner, property owner, or admin can view
        if (Auth::id() !== $booking->user_id && 
            Auth::id() !== $booking->property->user_id && 
            !Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        $booking->load(['property.images', 'property.owner', 'customer', 'payment']);

        return view('bookings.show', compact('booking'));
    }

    /**
     * Show the form for editing the specified resource (UPDATE - Edit Form).
     */
    public function edit(Booking $booking)
    {
        // Authorization: Only booking owner can edit (before confirmation)
        if (Auth::id() !== $booking->user_id) {
            abort(403, 'Unauthorized action.');
        }

        // Can only edit pending bookings
        if ($booking->status !== 'pending') {
            return back()->with('error', 'Cannot edit confirmed or completed bookings.');
        }

        $property = $booking->property;

        return view('bookings.edit', compact('booking', 'property'));
    }

    /**
     * Update the specified resource in storage (UPDATE - Update).
     * Demonstrates: @method('PUT'), Form Validation
     */
    public function update(Request $request, Booking $booking)
    {
        // Authorization
        if (Auth::id() !== $booking->user_id) {
            abort(403, 'Unauthorized action.');
        }

        // Can only update pending bookings
        if ($booking->status !== 'pending') {
            return back()->with('error', 'Cannot update confirmed or completed bookings.');
        }

        // Form Validation
        $validated = $request->validate([
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
            'guests' => 'required|integer|min:1|max:' . $booking->property->max_guests,
        ]);

        // Check for overlapping bookings (excluding current booking)
        $hasOverlap = Booking::where('property_id', $booking->property_id)
            ->where('id', '!=', $booking->id)
            ->whereIn('status', ['confirmed', 'pending'])
            ->where(function($query) use ($validated) {
                $query->whereBetween('check_in', [$validated['check_in'], $validated['check_out']])
                      ->orWhereBetween('check_out', [$validated['check_in'], $validated['check_out']])
                      ->orWhere(function($q) use ($validated) {
                          $q->where('check_in', '<=', $validated['check_in'])
                            ->where('check_out', '>=', $validated['check_out']);
                      });
            })
            ->exists();

        if ($hasOverlap) {
            return back()->with('error', 'Property is not available for selected dates.');
        }

        // Recalculate pricing
        $checkIn = Carbon::parse($validated['check_in']);
        $checkOut = Carbon::parse($validated['check_out']);
        $nights = $checkIn->diffInDays($checkOut);
        
        $subtotal = $booking->property->price_per_night * $nights;
        $cleaningFee = $booking->property->cleaning_fee ?? 0;
        $serviceFee = $booking->property->service_fee ?? 0;
        $totalPrice = $subtotal + $cleaningFee + $serviceFee;

        $validated['total_price'] = $totalPrice;

        // Update using Eloquent
        $booking->update($validated);

        return redirect()->route('bookings.show', $booking)
            ->with('success', 'Booking updated successfully!');
    }

    /**
     * Remove the specified resource from storage (DELETE).
     * Demonstrates: @method('DELETE'), Business Logic
     */
    public function destroy(Booking $booking)
    {
        // Authorization: Booking owner or property owner can cancel
        if (Auth::id() !== $booking->user_id && 
            Auth::id() !== $booking->property->user_id && 
            !Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        // Cannot delete completed bookings
        if ($booking->status === 'completed') {
            return back()->with('error', 'Cannot delete completed bookings.');
        }

        // If booking was paid, handle refund logic (simplified here)
        if ($booking->payment && $booking->payment->status === 'completed') {
            return back()->with('error', 'Please contact support to cancel paid bookings.');
        }

        // Update status instead of hard delete for record keeping
        $booking->update(['status' => 'cancelled']);

        return redirect()->route('bookings.index')
            ->with('success', 'Booking cancelled successfully.');
    }

    /**
     * Confirm a booking (for property owners).
     */
    public function confirm(Booking $booking)
    {
        // Authorization: Only property owner or admin can confirm
        if (Auth::id() !== $booking->property->user_id && !Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        if ($booking->status !== 'pending') {
            return back()->with('error', 'Only pending bookings can be confirmed.');
        }

        $booking->update(['status' => 'confirmed']);

        return back()->with('success', 'Booking confirmed successfully!');
    }

    /**
     * Complete a booking (automatic or manual).
     */
    public function complete(Booking $booking)
    {
        // Authorization
        if (Auth::id() !== $booking->property->user_id && !Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        if ($booking->status !== 'confirmed') {
            return back()->with('error', 'Only confirmed bookings can be completed.');
        }

        $booking->update(['status' => 'completed']);

        return back()->with('success', 'Booking completed successfully!');
    }
}
