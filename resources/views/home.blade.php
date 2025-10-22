@extends('layouts.app')

@section('title', 'StayHub - Find Your Perfect Stay')

@section('content')
<!-- Hero Section -->
<section class="hero-gradient text-white py-20">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto text-center">
            <h1 class="text-5xl md:text-6xl font-bold mb-6">Find Your Perfect Stay</h1>
            <p class="text-xl mb-8">Discover unique properties and experiences around the world</p>
            
            <!-- Search Form -->
            <div class="bg-white rounded-lg shadow-2xl p-6 text-gray-800">
                <form action="/search" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div class="col-span-1">
                        <label class="block text-sm font-medium mb-2 text-left">Location</label>
                        <input type="text" name="location" placeholder="Where to?" 
                               class="w-full px-4 py-3 border rounded-lg outline-none" style="border-color: #80A1BA; focus:ring-2; focus:ring-color: #80A1BA;">
                    </div>
                    
                    <div class="col-span-1">
                        <label class="block text-sm font-medium mb-2 text-left">Check-in</label>
                        <input type="date" name="check_in" 
                               class="w-full px-4 py-3 border rounded-lg outline-none" style="border-color: #80A1BA;">
                    </div>
                    
                    <div class="col-span-1">
                        <label class="block text-sm font-medium mb-2 text-left">Check-out</label>
                        <input type="date" name="check_out" 
                               class="w-full px-4 py-3 border rounded-lg outline-none" style="border-color: #80A1BA;">
                    </div>
                    
                    <div class="col-span-1">
                        <label class="block text-sm font-medium mb-2 text-left">Guests</label>
                        <select name="guests" class="w-full px-4 py-3 border rounded-lg outline-none" style="border-color: #80A1BA;">
                            <option value="1">1 Guest</option>
                            <option value="2">2 Guests</option>
                            <option value="3">3 Guests</option>
                            <option value="4">4 Guests</option>
                            <option value="5">5+ Guests</option>
                        </select>
                    </div>
                    
                    <div class="col-span-1 md:col-span-4">
                        <button type="submit" class="w-full text-white py-3 rounded-lg font-semibold text-lg" style="background-color: #91C4C3; transition: opacity 0.3s;" onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'">
                            <i class="fas fa-search mr-2"></i> Search Properties
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Property Types -->
<section class="py-16" style="background-color: #F5F5F0;">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-12">Browse by Property Type</h2>
        
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            <a href="/properties?type=apartment" class="group">
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover-scale property-card">
                    <div class="h-48 flex items-center justify-center" style="background: linear-gradient(135deg, #80A1BA 0%, #91C4C3 100%);">
                        <img src="{{ asset('images/real-estate.png') }}" alt="Apartments" class="w-24 h-24 object-contain">
                    </div>
                    <div class="p-4 text-center">
                        <h3 class="font-semibold text-lg">Apartments</h3>
                        <p class="text-gray-600 text-sm">Cozy urban living</p>
                    </div>
                </div>
            </a>
            
            <a href="/properties?type=house" class="group">
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover-scale property-card">
                    <div class="h-48 flex items-center justify-center" style="background: linear-gradient(135deg, #91C4C3 0%, #B4DEBD 100%);">
                        <img src="{{ asset('images/house.png') }}" alt="Houses" class="w-24 h-24 object-contain">
                    </div>
                    <div class="p-4 text-center">
                        <h3 class="font-semibold text-lg">Houses</h3>
                        <p class="text-gray-600 text-sm">Spacious family homes</p>
                    </div>
                </div>
            </a>
            
            <a href="/properties?type=villa" class="group">
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover-scale property-card">
                    <div class="h-48 flex items-center justify-center" style="background: linear-gradient(135deg, #B4DEBD 0%, #91C4C3 100%);">
                        <img src="{{ asset('images/home.png') }}" alt="Villas" class="w-24 h-24 object-contain">
                    </div>
                    <div class="p-4 text-center">
                        <h3 class="font-semibold text-lg">Villas</h3>
                        <p class="text-gray-600 text-sm">Luxury getaways</p>
                    </div>
                </div>
            </a>
            
            <a href="/properties?type=studio" class="group">
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover-scale property-card">
                    <div class="h-48 flex items-center justify-center" style="background: linear-gradient(135deg, #80A1BA 0%, #B4DEBD 100%);">
                        <img src="{{ asset('images/studio.png') }}" alt="Studios" class="w-24 h-24 object-contain">
                    </div>
                    <div class="p-4 text-center">
                        <h3 class="font-semibold text-lg">Studios</h3>
                        <p class="text-gray-600 text-sm">Compact & modern</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</section>

<!-- Featured Properties -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center mb-12">
            <h2 class="text-3xl font-bold">Featured Properties</h2>
            <a href="/properties" class="font-semibold" style="color: #80A1BA; transition: opacity 0.3s;" onmouseover="this.style.opacity='0.8'" onmouseout="this.style.opacity='1'">
                View All <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @forelse($properties as $property)
            <!-- Dynamic Property Card -->
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
                        <div class="w-full h-64 bg-gray-300 flex items-center justify-center">
                            <i class="fas fa-image text-gray-400 text-4xl"></i>
                        </div>
                    @endif
                    <span class="absolute top-4 left-4 text-white px-3 py-1 rounded-full text-sm font-semibold" style="background-color: #80A1BA;">
                        Featured
                    </span>
                </div>
                <div class="p-4">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="font-semibold text-lg">{{ Str::limit($property->title, 30) }}</h3>
                        <div class="flex items-center text-yellow-500">
                            <i class="fas fa-star"></i>
                            <span class="ml-1 text-gray-700 font-semibold">{{ number_format($property->rating ?? 4.8, 1) }}</span>
                        </div>
                    </div>
                    <p class="text-gray-600 text-sm mb-2">
                        <i class="fas fa-map-marker-alt mr-1"></i> {{ $property->city }}, {{ $property->state }}
                    </p>
                    <div class="flex items-center text-gray-600 text-sm mb-3 space-x-4">
                        <span><i class="fas fa-bed mr-1"></i> {{ $property->bedrooms }} Beds</span>
                        <span><i class="fas fa-bath mr-1"></i> {{ $property->bathrooms }} Baths</span>
                        <span><i class="fas fa-users mr-1"></i> {{ $property->max_guests }} Guests</span>
                    </div>
                    <div class="flex justify-between items-center border-t pt-3">
                        <div>
                            <span class="text-2xl font-bold" style="color: #80A1BA;">${{ number_format($property->price_per_night, 0) }}</span>
                            <span class="text-gray-600 text-sm">/night</span>
                        </div>
                        <a href="{{ route('properties.show', $property->id) }}" class="text-white px-4 py-2 rounded-lg" style="background-color: #80A1BA; transition: opacity 0.3s;" onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'">
                            View Details
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-3 text-center py-12">
                <i class="fas fa-home text-gray-400 text-6xl mb-4"></i>
                <p class="text-gray-600 text-xl">No featured properties available at the moment.</p>
                <a href="/properties" class="mt-4 inline-block text-white px-6 py-3 rounded-lg" style="background-color: #80A1BA; transition: opacity 0.3s;" onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'">
                    Browse All Properties
                </a>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Why Choose Us -->
<section class="py-16" style="background-color: #F5F5F0;">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-12">Why Choose StayHub?</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div class="text-center">
                <div class="w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4" style="background-color: rgba(180, 222, 189, 0.3);">
                    <i class="fas fa-shield-alt text-3xl" style="color: #80A1BA;"></i>
                </div>
                <h3 class="font-semibold text-xl mb-2">Secure Booking</h3>
                <p class="text-gray-600">Safe and secure payment processing</p>
            </div>
            
            <div class="text-center">
                <div class="w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4" style="background-color: rgba(145, 196, 195, 0.3);">
                    <i class="fas fa-headset text-3xl" style="color: #80A1BA;"></i>
                </div>
                <h3 class="font-semibold text-xl mb-2">24/7 Support</h3>
                <p class="text-gray-600">Round-the-clock customer service</p>
            </div>
            
            <div class="text-center">
                <div class="w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4" style="background-color: rgba(180, 222, 189, 0.3);">
                    <i class="fas fa-tags text-3xl" style="color: #80A1BA;"></i>
                </div>
                <h3 class="font-semibold text-xl mb-2">Best Prices</h3>
                <p class="text-gray-600">Competitive rates guaranteed</p>
            </div>
            
            <div class="text-center">
                <div class="w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4" style="background-color: rgba(145, 196, 195, 0.3);">
                    <i class="fas fa-star text-3xl" style="color: #80A1BA;"></i>
                </div>
                <h3 class="font-semibold text-xl mb-2">Verified Properties</h3>
                <p class="text-gray-600">All properties are verified</p>
            </div>
        </div>
    </div>
</section>

<!-- Become a Host CTA -->
<section class="py-16 text-white" style="background: linear-gradient(135deg, #80A1BA 0%, #91C4C3 100%);">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-4xl font-bold mb-4">Ready to Earn with Your Property?</h2>
        <p class="text-xl mb-8">Join thousands of property owners earning with StayHub</p>
        <a href="/register?role=owner" class="bg-white px-8 py-4 rounded-lg font-semibold text-lg inline-block" style="color: #80A1BA; transition: all 0.3s;" onmouseover="this.style.backgroundColor='#F5F5F0'" onmouseout="this.style.backgroundColor='white'">
            <i class="fas fa-plus-circle mr-2"></i> List Your Property
        </a>
    </div>
</section>
@endsection
