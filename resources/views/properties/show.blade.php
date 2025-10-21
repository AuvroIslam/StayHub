@extends('layouts.app')

@section('title', $property->title . ' - StayHub')

@section('content')
<!-- Property Images Gallery -->
<div class="container mx-auto px-4 py-8">
    <div class="grid grid-cols-4 gap-2 h-96">
        <div class="col-span-2 row-span-2">
            @if($property->image)
                @if(str_starts_with($property->image, 'http'))
                    <img src="{{ $property->image }}" 
                         alt="{{ $property->title }}" class="w-full h-full object-cover rounded-l-lg">
                @else
                    <img src="{{ asset('storage/' . $property->image) }}" 
                         alt="{{ $property->title }}" class="w-full h-full object-cover rounded-l-lg">
                @endif
            @else
                <img src="https://images.unsplash.com/photo-1568605114967-8130f3a36994?w=800" 
                     alt="{{ $property->title }}" class="w-full h-full object-cover rounded-l-lg">
            @endif
        </div>
        <div class="col-span-1">
            <img src="https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?w=400" 
                 alt="Image 2" class="w-full h-full object-cover">
        </div>
        <div class="col-span-1">
            <img src="https://images.unsplash.com/photo-1560185127-6ed189bf02f4?w=400" 
                 alt="Image 3" class="w-full h-full object-cover rounded-tr-lg">
        </div>
        <div class="col-span-1">
            <img src="https://images.unsplash.com/photo-1556909172-54557c7e4fb7?w=400" 
                 alt="Image 4" class="w-full h-full object-cover">
        </div>
        <div class="col-span-1 relative">
            <img src="https://images.unsplash.com/photo-1556909212-d5b604d0c90d?w=400" 
                 alt="Image 5" class="w-full h-full object-cover rounded-br-lg">
            <button class="absolute inset-0 bg-black bg-opacity-50 rounded-br-lg flex items-center justify-center text-white font-semibold">
                <i class="fa-solid fa-images mr-2"></i> Show All Photos
            </button>
        </div>
    </div>
</div>

<!-- Property Details -->
<div class="container mx-auto px-4 pb-16">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left Column - Property Info -->
        <div class="lg:col-span-2">
            <!-- Title and Location -->
            <div class="mb-6">
                <div class="flex justify-between items-start mb-2">
                    <div>
                        <h1 class="text-3xl font-bold mb-2">{{ $property->title }}</h1>
                        <p class="text-gray-600 flex items-center">
                            <i class="fa-solid fa-location-dot mr-2"></i> 
                            {{ $property->address }}, {{ $property->city }}, {{ $property->state }} {{ $property->zip_code }}
                        </p>
                    </div>
                    <button class="text-gray-600 hover:text-red-500">
                        <i class="fa-regular fa-heart text-2xl"></i>
                    </button>
                </div>
                <div class="flex items-center space-x-4 text-gray-700">
                    <div class="flex items-center">
                        <i class="fa-solid fa-star text-yellow-500 mr-1"></i>
                        <span class="font-semibold">4.8</span>
                        <span class="text-gray-500 ml-1">(124 reviews)</span>
                    </div>
                    <span>•</span>
                    <span><i class="fa-solid fa-bed mr-1"></i> {{ $property->bedrooms }} Bedroom{{ $property->bedrooms > 1 ? 's' : '' }}</span>
                    <span>•</span>
                    <span><i class="fa-solid fa-bath mr-1"></i> {{ $property->bathrooms }} Bathroom{{ $property->bathrooms > 1 ? 's' : '' }}</span>
                    <span>•</span>
                    <span><i class="fa-solid fa-users mr-1"></i> {{ $property->max_guests }} Guests</span>
                </div>
            </div>
            
            <hr class="my-6">
            
            <!-- Host Info -->
            <div class="flex items-center mb-6">
                <img src="https://ui-avatars.com/api/?name={{ urlencode($property->user->name) }}&size=64" 
                     alt="{{ $property->user->name }}" class="w-16 h-16 rounded-full mr-4">
                <div>
                    <h3 class="font-semibold text-lg">Hosted by {{ $property->user->name }}</h3>
                    <p class="text-gray-600">Property Owner • {{ ucfirst($property->user->role) }}</p>
                </div>
            </div>
            
            <hr class="my-6">
            
            <!-- Property Features -->
            <div class="mb-6">
                <h2 class="text-2xl font-bold mb-4">Property Features</h2>
                <div class="grid grid-cols-2 gap-4">
                    <div class="flex items-start">
                        <i class="fas fa-wifi text-purple-600 text-xl mt-1 mr-3"></i>
                        <div>
                            <h4 class="font-semibold">High-speed WiFi</h4>
                            <p class="text-gray-600 text-sm">Fast and reliable internet</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <i class="fas fa-parking text-purple-600 text-xl mt-1 mr-3"></i>
                        <div>
                            <h4 class="font-semibold">Free Parking</h4>
                            <p class="text-gray-600 text-sm">On-premises parking space</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <i class="fas fa-tv text-purple-600 text-xl mt-1 mr-3"></i>
                        <div>
                            <h4 class="font-semibold">Smart TV</h4>
                            <p class="text-gray-600 text-sm">Netflix, Prime Video</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <i class="fas fa-snowflake text-purple-600 text-xl mt-1 mr-3"></i>
                        <div>
                            <h4 class="font-semibold">Air Conditioning</h4>
                            <p class="text-gray-600 text-sm">Climate control</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <i class="fas fa-utensils text-purple-600 text-xl mt-1 mr-3"></i>
                        <div>
                            <h4 class="font-semibold">Full Kitchen</h4>
                            <p class="text-gray-600 text-sm">Fully equipped kitchen</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <i class="fas fa-dumbbell text-purple-600 text-xl mt-1 mr-3"></i>
                        <div>
                            <h4 class="font-semibold">Gym Access</h4>
                            <p class="text-gray-600 text-sm">Building gym available</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <hr class="my-6">
            
            <!-- Description -->
            <div class="mb-6">
                <h2 class="text-2xl font-bold mb-4">About This Place</h2>
                <p class="text-gray-700 leading-relaxed whitespace-pre-line">
                    {{ $property->description }}
                </p>
            </div>
            
            <hr class="my-6">
            
            <!-- Amenities -->
            <div class="mb-6">
                <h2 class="text-2xl font-bold mb-4">Amenities</h2>
                <div class="grid grid-cols-2 gap-4">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-green-500 mr-2"></i>
                        <span>WiFi</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-green-500 mr-2"></i>
                        <span>Kitchen</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-green-500 mr-2"></i>
                        <span>Washer & Dryer</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-green-500 mr-2"></i>
                        <span>Free Parking</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-green-500 mr-2"></i>
                        <span>Air Conditioning</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-green-500 mr-2"></i>
                        <span>Heating</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-green-500 mr-2"></i>
                        <span>TV</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-green-500 mr-2"></i>
                        <span>Gym Access</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-green-500 mr-2"></i>
                        <span>Elevator</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-green-500 mr-2"></i>
                        <span>24/7 Security</span>
                    </div>
                </div>
            </div>
            
            <hr class="my-6">
            
            <!-- Location -->
            <div class="mb-6">
                <h2 class="text-2xl font-bold mb-4">Location</h2>
                <div class="bg-gray-200 h-64 rounded-lg flex items-center justify-center">
                    <p class="text-gray-600">
                        <i class="fas fa-map-marked-alt text-4xl mb-2"></i><br>
                        Map will be displayed here
                    </p>
                </div>
                <p class="text-gray-700 mt-4">
                    Located in the heart of downtown, within walking distance to major attractions, 
                    restaurants, and shopping centers. Easy access to public transportation.
                </p>
            </div>
            
            <hr class="my-6">
            
            <!-- Reviews -->
            <div class="mb-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold">
                        <i class="fas fa-star text-yellow-500"></i> 4.8 • 124 Reviews
                    </h2>
                </div>
                
                <!-- Review Stats -->
                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div>
                        <div class="flex justify-between mb-2">
                            <span>Cleanliness</span>
                            <span class="font-semibold">4.9</span>
                        </div>
                        <div class="bg-gray-200 h-2 rounded-full">
                            <div class="bg-purple-600 h-2 rounded-full" style="width: 98%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between mb-2">
                            <span>Communication</span>
                            <span class="font-semibold">4.8</span>
                        </div>
                        <div class="bg-gray-200 h-2 rounded-full">
                            <div class="bg-purple-600 h-2 rounded-full" style="width: 96%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between mb-2">
                            <span>Check-in</span>
                            <span class="font-semibold">4.9</span>
                        </div>
                        <div class="bg-gray-200 h-2 rounded-full">
                            <div class="bg-purple-600 h-2 rounded-full" style="width: 98%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between mb-2">
                            <span>Accuracy</span>
                            <span class="font-semibold">4.7</span>
                        </div>
                        <div class="bg-gray-200 h-2 rounded-full">
                            <div class="bg-purple-600 h-2 rounded-full" style="width: 94%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between mb-2">
                            <span>Location</span>
                            <span class="font-semibold">5.0</span>
                        </div>
                        <div class="bg-gray-200 h-2 rounded-full">
                            <div class="bg-purple-600 h-2 rounded-full" style="width: 100%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between mb-2">
                            <span>Value</span>
                            <span class="font-semibold">4.6</span>
                        </div>
                        <div class="bg-gray-200 h-2 rounded-full">
                            <div class="bg-purple-600 h-2 rounded-full" style="width: 92%"></div>
                        </div>
                    </div>
                </div>
                
                <!-- Individual Reviews -->
                <div class="space-y-6">
                    <div class="border-b pb-6">
                        <div class="flex items-start mb-3">
                            <img src="https://ui-avatars.com/api/?name=Sarah+Smith&size=48" 
                                 alt="Reviewer" class="w-12 h-12 rounded-full mr-3">
                            <div>
                                <h4 class="font-semibold">Sarah Smith</h4>
                                <p class="text-gray-600 text-sm">March 2024</p>
                            </div>
                        </div>
                        <div class="flex items-center mb-2">
                            <i class="fas fa-star text-yellow-500"></i>
                            <i class="fas fa-star text-yellow-500"></i>
                            <i class="fas fa-star text-yellow-500"></i>
                            <i class="fas fa-star text-yellow-500"></i>
                            <i class="fas fa-star text-yellow-500"></i>
                        </div>
                        <p class="text-gray-700">
                            Amazing apartment! Everything was exactly as described. The location is perfect, 
                            right in the heart of downtown. John was a great host and very responsive. 
                            Would definitely stay here again!
                        </p>
                    </div>
                    
                    <div class="border-b pb-6">
                        <div class="flex items-start mb-3">
                            <img src="https://ui-avatars.com/api/?name=Mike+Johnson&size=48" 
                                 alt="Reviewer" class="w-12 h-12 rounded-full mr-3">
                            <div>
                                <h4 class="font-semibold">Mike Johnson</h4>
                                <p class="text-gray-600 text-sm">February 2024</p>
                            </div>
                        </div>
                        <div class="flex items-center mb-2">
                            <i class="fas fa-star text-yellow-500"></i>
                            <i class="fas fa-star text-yellow-500"></i>
                            <i class="fas fa-star text-yellow-500"></i>
                            <i class="fas fa-star text-yellow-500"></i>
                            <i class="fas fa-star text-gray-300"></i>
                        </div>
                        <p class="text-gray-700">
                            Great place for a business trip. Very clean and comfortable. 
                            The WiFi was fast and reliable. Only minor issue was some street noise, 
                            but nothing major. Overall highly recommend!
                        </p>
                    </div>
                    
                    <div>
                        <div class="flex items-start mb-3">
                            <img src="https://ui-avatars.com/api/?name=Emily+Davis&size=48" 
                                 alt="Reviewer" class="w-12 h-12 rounded-full mr-3">
                            <div>
                                <h4 class="font-semibold">Emily Davis</h4>
                                <p class="text-gray-600 text-sm">January 2024</p>
                            </div>
                        </div>
                        <div class="flex items-center mb-2">
                            <i class="fas fa-star text-yellow-500"></i>
                            <i class="fas fa-star text-yellow-500"></i>
                            <i class="fas fa-star text-yellow-500"></i>
                            <i class="fas fa-star text-yellow-500"></i>
                            <i class="fas fa-star text-yellow-500"></i>
                        </div>
                        <p class="text-gray-700">
                            Perfect apartment for our family vacation! Spacious, clean, and well-equipped. 
                            The kids loved the building's amenities. John was super helpful with recommendations. 
                            Can't wait to come back!
                        </p>
                    </div>
                </div>
                
                <button class="mt-6 border-2 border-gray-800 px-6 py-3 rounded-lg font-semibold hover:bg-gray-50">
                    Show All 124 Reviews
                </button>
            </div>
        </div>
        
        <!-- Right Column - Booking Card -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-xl p-6 sticky top-24">
                <div class="mb-4">
                    <div class="flex items-baseline">
                        <span class="text-3xl font-bold">${{ number_format($property->price_per_night, 0) }}</span>
                        <span class="text-gray-600 ml-2">per night</span>
                    </div>
                    <div class="flex items-center mt-2">
                        <i class="fas fa-star text-yellow-500"></i>
                        <span class="ml-1 font-semibold">4.8</span>
                        <span class="text-gray-500 ml-1">(124 reviews)</span>
                    </div>
                </div>
                
                <form action="/booking" method="POST" class="space-y-4">
                    <div class="grid grid-cols-2 gap-2 border rounded-lg">
                        <div class="p-3 border-r">
                            <label class="block text-xs font-semibold mb-1">CHECK-IN</label>
                            <input type="date" name="check_in" class="w-full text-sm outline-none">
                        </div>
                        <div class="p-3">
                            <label class="block text-xs font-semibold mb-1">CHECKOUT</label>
                            <input type="date" name="check_out" class="w-full text-sm outline-none">
                        </div>
                    </div>
                    
                    <div class="border rounded-lg p-3">
                        <label class="block text-xs font-semibold mb-1">GUESTS</label>
                        <select name="guests" class="w-full text-sm outline-none">
                            @for($i = 1; $i <= $property->max_guests; $i++)
                                <option value="{{ $i }}">{{ $i }} guest{{ $i > 1 ? 's' : '' }}</option>
                            @endfor
                        </select>
                    </div>
                    
                    <button type="submit" class="w-full bg-purple-600 text-white py-3 rounded-lg hover:bg-purple-700 font-semibold">
                        Reserve
                    </button>
                    
                    <p class="text-center text-sm text-gray-600">You won't be charged yet</p>
                    
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span class="underline">$120 x 5 nights</span>
                            <span>$600</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="underline">Service fee</span>
                            <span>$30</span>
                        </div>
                        <hr>
                        <div class="flex justify-between font-semibold text-base">
                            <span>Total</span>
                            <span>$630</span>
                        </div>
                    </div>
                </form>
                
                <div class="mt-6 text-center">
                    <button class="text-purple-600 hover:text-purple-700 font-semibold">
                        <i class="fas fa-flag mr-2"></i> Report this listing
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
