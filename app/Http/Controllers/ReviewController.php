<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Resource Controller for Reviews implementing full CRUD operations
 * Demonstrates: Controllers, CRUD, Form Validation, Flash Messages
 */
class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reviews = Review::with(['property', 'user', 'booking'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('reviews.index', compact('reviews'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Booking $booking)
    {
        // Authorization: Only the booking customer can review
        if (Auth::id() !== $booking->user_id) {
            abort(403, 'You can only review your own bookings.');
        }

        // Can only review completed bookings
        if ($booking->status !== 'completed') {
            return back()->with('error', 'You can only review completed bookings.');
        }

        // Check if already reviewed
        if ($booking->review()->exists()) {
            return back()->with('error', 'You have already reviewed this booking.');
        }

        $property = $booking->property;

        return view('reviews.create', compact('booking', 'property'));
    }

    /**
     * Store a newly created resource in storage.
     * Demonstrates: Form Validation, Mass Assignment, Flash Session Data
     */
    public function store(Request $request)
    {
        // Form Validation with detailed rules
        $validated = $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'property_id' => 'required|exists:properties,id',
            'rating' => 'required|integer|min:1|max:5',
            'cleanliness_rating' => 'required|integer|min:1|max:5',
            'accuracy_rating' => 'required|integer|min:1|max:5',
            'checkin_rating' => 'required|integer|min:1|max:5',
            'communication_rating' => 'required|integer|min:1|max:5',
            'location_rating' => 'required|integer|min:1|max:5',
            'value_rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|min:20|max:1000',
        ]);

        $booking = Booking::findOrFail($validated['booking_id']);

        // Authorization check
        if (Auth::id() !== $booking->user_id) {
            abort(403, 'Unauthorized action.');
        }

        // Check if already reviewed
        if ($booking->review()->exists()) {
            return back()->with('error', 'You have already reviewed this booking.');
        }

        // Create review using Mass Assignment
        $validated['user_id'] = Auth::id();
        $review = Review::create($validated);

        // Flash Session Data
        return redirect()->route('properties.show', $review->property)
            ->with('success', 'Thank you for your review!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        $review->load(['property', 'user', 'booking']);

        return view('reviews.show', compact('review'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review)
    {
        // Authorization: Only review author can edit
        if (Auth::id() !== $review->user_id) {
            abort(403, 'You can only edit your own reviews.');
        }

        $property = $review->property;

        return view('reviews.edit', compact('review', 'property'));
    }

    /**
     * Update the specified resource in storage.
     * Demonstrates: @method('PUT'), Form Validation
     */
    public function update(Request $request, Review $review)
    {
        // Authorization
        if (Auth::id() !== $review->user_id) {
            abort(403, 'Unauthorized action.');
        }

        // Form Validation
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'cleanliness_rating' => 'required|integer|min:1|max:5',
            'accuracy_rating' => 'required|integer|min:1|max:5',
            'checkin_rating' => 'required|integer|min:1|max:5',
            'communication_rating' => 'required|integer|min:1|max:5',
            'location_rating' => 'required|integer|min:1|max:5',
            'value_rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|min:20|max:1000',
        ]);

        // Update using Eloquent
        $review->update($validated);

        return redirect()->route('properties.show', $review->property)
            ->with('success', 'Review updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     * Demonstrates: @method('DELETE')
     */
    public function destroy(Review $review)
    {
        // Authorization: Review author or admin can delete
        if (Auth::id() !== $review->user_id && !Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        $propertyId = $review->property_id;
        $review->delete();

        return redirect()->route('properties.show', $propertyId)
            ->with('success', 'Review deleted successfully.');
    }
}
