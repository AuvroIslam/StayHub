<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\Amenity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Resource Controller for Properties implementing full CRUD operations
 * Demonstrates: Controllers, CRUD (Create, Read, Update, Delete), Form Validation
 */
class PropertyController extends Controller
{
    /**
     * Display a listing of the resource (READ - Index).
     * Blade Directive Used: @foreach
     */
    public function index(Request $request)
    {
        $query = Property::with(['owner', 'primaryImage', 'reviews'])
            ->active();

        // Apply filters if provided
        if ($request->filled('location')) {
            $query->where(function($q) use ($request) {
                $q->where('city', 'LIKE', '%' . $request->location . '%')
                  ->orWhere('country', 'LIKE', '%' . $request->location . '%')
                  ->orWhere('address', 'LIKE', '%' . $request->location . '%');
            });
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('price_range')) {
            $range = $request->price_range;
            if ($range === '0-50') {
                $query->whereBetween('price_per_night', [0, 50]);
            } elseif ($range === '50-100') {
                $query->whereBetween('price_per_night', [50, 100]);
            } elseif ($range === '100-200') {
                $query->whereBetween('price_per_night', [100, 200]);
            } elseif ($range === '200+') {
                $query->where('price_per_night', '>=', 200);
            }
        }

        // Sorting
        $sortBy = $request->get('sort_by', 'created_at');
        if ($sortBy === 'price_low') {
            $query->orderBy('price_per_night', 'asc');
        } elseif ($sortBy === 'price_high') {
            $query->orderBy('price_per_night', 'desc');
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $properties = $query->paginate(12);

        return view('properties.index', compact('properties'));
    }

    /**
     * Show the form for creating a new resource (CREATE - Form).
     * Blade Directives Used: @csrf, @foreach
     */
    public function create()
    {
        // Authorization: Only owners and admins can create properties
        if (!Auth::check() || (!Auth::user()->isOwner() && !Auth::user()->isAdmin())) {
            return redirect()->route('login')->with('error', 'You must be a property owner to list properties.');
        }

        $amenities = Amenity::all();
        
        return view('properties.create', compact('amenities'));
    }

    /**
     * Store a newly created resource in storage (CREATE - Store).
     * Demonstrates: Form Validation, Mass Assignment Protection ($fillable), Flash Session Data
     */
    public function store(Request $request)
    {
        // Form Validation
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|min:50',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'nullable|string|max:100',
            'country' => 'required|string|max:100',
            'zip_code' => 'nullable|string|max:20',
            'type' => 'required|in:apartment,house,villa,studio,condo,other',
            'bedrooms' => 'required|integer|min:1|max:20',
            'bathrooms' => 'required|integer|min:1|max:20',
            'max_guests' => 'required|integer|min:1|max:50',
            'price_per_night' => 'required|numeric|min:1|max:10000',
            'cleaning_fee' => 'nullable|numeric|min:0|max:1000',
            'service_fee' => 'nullable|numeric|min:0|max:1000',
            'amenities' => 'nullable|array',
            'amenities.*' => 'exists:amenities,id',
        ]);

        // Create property using Mass Assignment (protected by $fillable)
        $validated['user_id'] = Auth::id();
        $validated['status'] = 'active';
        
        $property = Property::create($validated);

        // Attach amenities if provided
        if ($request->has('amenities')) {
            $property->amenities()->attach($request->amenities);
        }

        // Flash Session Data for success message
        return redirect()->route('properties.show', $property)
            ->with('success', 'Property created successfully!');
    }

    /**
     * Display the specified resource (READ - Show).
     * Blade Directives Used: @if, @foreach, {{ }} for displaying data
     */
    public function show(Property $property)
    {
        // Eager load relationships to avoid N+1 queries
        $property->load([
            'owner', 
            'images', 
            'amenities', 
            'reviews.user',
            'bookings' => function($query) {
                $query->where('status', 'confirmed')
                      ->where('check_out', '>=', now());
            }
        ]);

        $averageRating = $property->averageRating();
        $reviewCount = $property->reviewCount();

        return view('properties.show', compact('property', 'averageRating', 'reviewCount'));
    }

    /**
     * Show the form for editing the specified resource (UPDATE - Edit Form).
     * Demonstrates: Authorization, Blade Directives (@if, @foreach)
     */
    public function edit(Property $property)
    {
        // Authorization: Only the owner or admin can edit
        if (Auth::id() !== $property->user_id && !Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        $amenities = Amenity::all();
        $propertyAmenities = $property->amenities->pluck('id')->toArray();
        
        return view('properties.edit', compact('property', 'amenities', 'propertyAmenities'));
    }

    /**
     * Update the specified resource in storage (UPDATE - Update).
     * Demonstrates: @method('PUT'), Form Validation, Flash Session Data
     */
    public function update(Request $request, Property $property)
    {
        // Authorization
        if (Auth::id() !== $property->user_id && !Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        // Form Validation
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|min:50',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'nullable|string|max:100',
            'country' => 'required|string|max:100',
            'zip_code' => 'nullable|string|max:20',
            'type' => 'required|in:apartment,house,villa,studio,condo,other',
            'bedrooms' => 'required|integer|min:1|max:20',
            'bathrooms' => 'required|integer|min:1|max:20',
            'max_guests' => 'required|integer|min:1|max:50',
            'price_per_night' => 'required|numeric|min:1|max:10000',
            'cleaning_fee' => 'nullable|numeric|min:0|max:1000',
            'service_fee' => 'nullable|numeric|min:0|max:1000',
            'status' => 'required|in:active,inactive,pending',
            'amenities' => 'nullable|array',
            'amenities.*' => 'exists:amenities,id',
        ]);

        // Update using Eloquent Model's update method
        $property->update($validated);

        // Sync amenities
        if ($request->has('amenities')) {
            $property->amenities()->sync($request->amenities);
        } else {
            $property->amenities()->detach();
        }

        // Flash Session Data
        return redirect()->route('properties.show', $property)
            ->with('success', 'Property updated successfully!');
    }

    /**
     * Remove the specified resource from storage (DELETE).
     * Demonstrates: @method('DELETE'), @csrf, Flash Session Data
     */
    public function destroy(Property $property)
    {
        // Authorization
        if (Auth::id() !== $property->user_id && !Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        // Check if there are any confirmed bookings
        $hasActiveBookings = $property->bookings()
            ->whereIn('status', ['confirmed', 'pending'])
            ->where('check_out', '>=', now())
            ->exists();

        if ($hasActiveBookings) {
            return back()->with('error', 'Cannot delete property with active bookings.');
        }

        // Delete using Eloquent Model's delete method
        $property->delete();

        // Flash Session Data
        return redirect()->route('owner.dashboard')
            ->with('success', 'Property deleted successfully!');
    }

    /**
     * Show featured properties on homepage.
     */
    public function featured()
    {
        $properties = Property::featured()
            ->with(['owner', 'primaryImage', 'reviews'])
            ->take(6)
            ->get();

        return view('home', compact('properties'));
    }

    /**
     * Toggle favorite status for a property.
     */
    public function toggleFavorite(Property $property)
    {
        $user = Auth::user();
        
        if ($user->favorites()->where('property_id', $property->id)->exists()) {
            $user->favorites()->detach($property->id);
            $message = 'Removed from favorites';
        } else {
            $user->favorites()->attach($property->id);
            $message = 'Added to favorites';
        }

        return back()->with('success', $message);
    }
}
