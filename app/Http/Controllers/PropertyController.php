<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

/**
 * Resource Controller for Properties implementing full CRUD operations
 * Demonstrates: Controllers, CRUD (Create, Read, Update, Delete), Form Validation
 */
class PropertyController extends Controller
{
    /**
     * Display a listing of the resource (READ - Index).
     */
    public function index(Request $request)
    {
        $query = Property::with('owner')->active();

        // Apply filters if provided
        if ($request->filled('location')) {
            $query->where(function($q) use ($request) {
                $q->where('city', 'LIKE', '%' . $request->location . '%')
                  ->orWhere('address', 'LIKE', '%' . $request->location . '%');
            });
        }

        if ($request->filled('property_type')) {
            $query->where('property_type', $request->property_type);
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
     */
    public function create()
    {
        // Authorization: Only owners and admins can create properties
        if (!Auth::check() || !in_array(Auth::user()->role, ['owner', 'admin'])) {
            return redirect()->route('login')->with('error', 'You must be a property owner to list properties.');
        }
        
        return view('properties.create');
    }

    /**
     * Store a newly created resource in storage (CREATE - Store).
     */
    public function store(Request $request)
    {
        // Form Validation
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|min:20',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'nullable|string|max:100',
            'zip_code' => 'nullable|string|max:20',
            'property_type' => 'required|in:apartment,house,villa,condo',
            'bedrooms' => 'required|integer|min:1|max:20',
            'bathrooms' => 'required|integer|min:1|max:20',
            'max_guests' => 'required|integer|min:1|max:50',
            'price_per_night' => 'required|numeric|min:1|max:10000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Create property
        $validated['user_id'] = Auth::id();
        $validated['status'] = 'active';
        
        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('properties', 'public');
            $validated['image'] = $imagePath;
        }
        
        $property = Property::create($validated);

        // Redirect to owner dashboard
        return redirect()->route('owner.dashboard')
            ->with('success', 'Property created successfully!');
    }

    /**
     * Display the specified resource (READ - Show).
     */
    public function show(Property $property)
    {
        // Load relationships
        $property->load([
            'owner', 
            'bookings' => function($query) {
                $query->where('status', 'confirmed')
                      ->where('check_out', '>=', now());
            }
        ]);

        return view('properties.show', compact('property'));
    }

    /**
     * Show the form for editing the specified resource (UPDATE - Edit Form).
     */
    public function edit(Property $property)
    {
        // Authorization: Only the owner or admin can edit
        if (Auth::id() !== $property->user_id && (!Auth::check() || Auth::user()->role !== 'admin')) {
            abort(403, 'Unauthorized action.');
        }
        
        return view('properties.edit', compact('property'));
    }

    /**
     * Update the specified resource in storage (UPDATE - Update).
     */
    public function update(Request $request, Property $property)
    {
        // Authorization
        if (Auth::id() !== $property->user_id && (!Auth::check() || Auth::user()->role !== 'admin')) {
            abort(403, 'Unauthorized action.');
        }

        // Form Validation
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|min:20',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'nullable|string|max:100',
            'zip_code' => 'nullable|string|max:20',
            'property_type' => 'required|in:apartment,house,villa,condo',
            'bedrooms' => 'required|integer|min:1|max:20',
            'bathrooms' => 'required|integer|min:1|max:20',
            'max_guests' => 'required|integer|min:1|max:50',
            'price_per_night' => 'required|numeric|min:1|max:10000',
            'status' => 'required|in:active,inactive',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($property->image && \Storage::disk('public')->exists($property->image)) {
                \Storage::disk('public')->delete($property->image);
            }
            $imagePath = $request->file('image')->store('properties', 'public');
            $validated['image'] = $imagePath;
        }

        // Update property
        $property->update($validated);

        // Redirect to owner dashboard
        return redirect()->route('owner.dashboard')
            ->with('success', 'Property updated successfully!');
    }

    /**
     * Remove the specified resource from storage (DELETE).
     */
    public function destroy(Property $property)
    {
        // Authorization
        if (Auth::id() !== $property->user_id && (!Auth::check() || Auth::user()->role !== 'admin')) {
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

        // Delete image if exists
        if ($property->image && \Storage::disk('public')->exists($property->image)) {
            \Storage::disk('public')->delete($property->image);
        }

        // Delete property
        $property->delete();

        // Redirect
        return redirect()->route('owner.dashboard')
            ->with('success', 'Property deleted successfully!');
    }

    /**
     * Show featured properties on homepage.
     */
    public function featured()
    {
        $properties = Property::active()
            ->with('owner')
            ->latest()
            ->take(6)
            ->get();

        return view('home', compact('properties'));
    }
}
