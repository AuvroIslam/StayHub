@extends('layouts.app')

@section('title', 'Browse Properties - StayHub')

@section('content')
<!-- Page Header -->
<div class="bg-gray-100 py-8">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold mb-4">Find Your Perfect Stay</h1>
        
        <!-- Filters -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <form action="/properties" method="GET" class="grid grid-cols-1 md:grid-cols-5 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-2">Location</label>
                    <input type="text" name="location" placeholder="Where to?" 
                           class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-purple-600 outline-none">
                </div>
                
                <div>
                    <label class="block text-sm font-medium mb-2">Check-in</label>
                    <input type="date" name="check_in" 
                           class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-purple-600 outline-none">
                </div>
                
                <div>
                    <label class="block text-sm font-medium mb-2">Check-out</label>
                    <input type="date" name="check_out" 
                           class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-purple-600 outline-none">
                </div>
                
                <div>
                    <label class="block text-sm font-medium mb-2">Property Type</label>
                    <select name="property_type" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-purple-600 outline-none">
                        <option value="">All Types</option>
                        <option value="apartment" {{ request('property_type') == 'apartment' ? 'selected' : '' }}>Apartment</option>
                        <option value="house" {{ request('property_type') == 'house' ? 'selected' : '' }}>House</option>
                        <option value="villa" {{ request('property_type') == 'villa' ? 'selected' : '' }}>Villa</option>
                        <option value="condo" {{ request('property_type') == 'condo' ? 'selected' : '' }}>Condo</option>
                    </select>
                </div>
                
                <div>
                    <label class="block text-sm font-medium mb-2">Price Range</label>
                    <select name="price_range" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-purple-600 outline-none">
                        <option value="">Any Price</option>
                        <option value="0-50">$0 - $50</option>
                        <option value="50-100">$50 - $100</option>
                        <option value="100-200">$100 - $200</option>
                        <option value="200+">$200+</option>
                    </select>
                </div>
                
                <div class="md:col-span-5">
                    <button type="submit" class="bg-purple-600 text-white px-6 py-2 rounded-lg hover:bg-purple-700">
                        <i class="fa-solid fa-magnifying-glass mr-2"></i> Search
                    </button>
                    <button type="button" class="ml-4 text-gray-600 hover:text-gray-800">
                        <i class="fa-solid fa-sliders mr-2"></i> More Filters
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Property Listings -->
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <p class="text-gray-600">Showing {{ $properties->count() }} of {{ $properties->total() }} properties</p>
        <div class="flex items-center space-x-4">
            <label class="text-gray-600">Sort by:</label>
            <form method="GET" action="{{ route('properties.index') }}" id="sortForm">
                @foreach(request()->except('sort_by') as $key => $value)
                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                @endforeach
                <select name="sort_by" onchange="document.getElementById('sortForm').submit()" 
                        class="px-4 py-2 border rounded-lg focus:ring-2 focus:ring-purple-600 outline-none">
                    <option value="created_at" {{ request('sort_by') == 'created_at' ? 'selected' : '' }}>Newest</option>
                    <option value="price_low" {{ request('sort_by') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                    <option value="price_high" {{ request('sort_by') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                </select>
            </form>
        </div>
    </div>
    
    @if($properties->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($properties as $property)
            <!-- Property Card -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover-scale property-card">
                <div class="relative">
                    @if($property->image)
                        @if(str_starts_with($property->image, 'http'))
                            <img src="{{ $property->image }}" 
                                 alt="{{ $property->title }}" class="w-full h-64 object-cover">
                        @else
                            <img src="{{ asset('storage/' . $property->image) }}" 
                                 alt="{{ $property->title }}" class="w-full h-64 object-cover">
                        @endif
                    @else
                        <img src="https://images.unsplash.com/photo-1568605114967-8130f3a36994?w=500" 
                             alt="{{ $property->title }}" class="w-full h-64 object-cover">
                    @endif
                    <button class="absolute top-4 right-4 bg-white rounded-full p-2 hover:bg-red-500 hover:text-white transition">
                        <i class="fa-regular fa-heart"></i>
                    </button>
                </div>
                <div class="p-4">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="font-semibold text-lg">{{ $property->title }}</h3>
                    </div>
                    <p class="text-gray-600 text-sm mb-2">
                        <i class="fa-solid fa-location-dot mr-1"></i> {{ $property->city }}{{ $property->state ? ', ' . $property->state : '' }}
                    </p>
                    <div class="flex items-center text-gray-600 text-sm mb-3 space-x-4">
                        <span><i class="fa-solid fa-bed mr-1"></i> {{ $property->bedrooms }} Beds</span>
                        <span><i class="fa-solid fa-bath mr-1"></i> {{ $property->bathrooms }} Baths</span>
                        <span><i class="fa-solid fa-users mr-1"></i> {{ $property->max_guests }} Guests</span>
                    </div>
                    <div class="flex justify-between items-center border-t pt-3">
                        <div>
                            <span class="text-2xl font-bold text-purple-600">${{ number_format($property->price_per_night, 0) }}</span>
                            <span class="text-gray-600 text-sm">/night</span>
                        </div>
                        <a href="{{ route('properties.show', $property) }}" class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700">
                            View
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-12">
            <i class="fa-solid fa-house-circle-xmark text-6xl text-gray-300 mb-4"></i>
            <h3 class="text-xl font-semibold text-gray-600 mb-2">No Properties Found</h3>
            <p class="text-gray-500">Try adjusting your filters or search criteria.</p>
        </div>
    @endif
    
    <!-- Pagination -->
    <div class="flex justify-center mt-12">
        {{ $properties->links() }}
    </div>
</div>
@endsection
