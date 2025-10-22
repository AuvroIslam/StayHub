@extends('layouts.app')

@section('title', $property->title . ' - StayHub')

@section('content')
<!-- Property Images Gallery -->
<div class="container mx-auto px-4 py-8">
    <div class="grid grid-cols-4 gap-2 h-96">
        <!-- Main Image (Left Side - 2 columns, 2 rows) -->
        <div class="col-span-2 row-span-2">
            @php
                $mainImage = $property->getImageByIndex(1);
            @endphp
            @if($mainImage)
                @if(str_starts_with($mainImage, 'http'))
                    <img src="{{ $mainImage }}" 
                         alt="{{ $property->title }}" class="w-full h-full object-cover rounded-l-lg">
                @else
                    <img src="{{ asset('storage/' . $mainImage) }}" 
                         alt="{{ $property->title }}" class="w-full h-full object-cover rounded-l-lg">
                @endif
            @else
                <div class="w-full h-full bg-gray-200 flex items-center justify-center rounded-l-lg">
                    <i class="fas fa-home text-gray-400 text-4xl"></i>
                </div>
            @endif
        </div>
        
        <!-- Image 2 (Top Right) -->
        <div class="col-span-1">
            @php
                $image2 = $property->getImageByIndex(2);
            @endphp
            @if($image2)
                @if(str_starts_with($image2, 'http'))
                    <img src="{{ $image2 }}" 
                         alt="{{ $property->title }}" class="w-full h-full object-cover">
                @else
                    <img src="{{ asset('storage/' . $image2) }}" 
                         alt="{{ $property->title }}" class="w-full h-full object-cover">
                @endif
            @else
                <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                    <i class="fas fa-bed text-gray-400 text-2xl"></i>
                </div>
            @endif
        </div>
        
        <!-- Image 3 (Top Far Right) -->
        <div class="col-span-1">
            @php
                $image3 = $property->getImageByIndex(3);
            @endphp
            @if($image3)
                @if(str_starts_with($image3, 'http'))
                    <img src="{{ $image3 }}" 
                         alt="{{ $property->title }}" class="w-full h-full object-cover rounded-tr-lg">
                @else
                    <img src="{{ asset('storage/' . $image3) }}" 
                         alt="{{ $property->title }}" class="w-full h-full object-cover rounded-tr-lg">
                @endif
            @else
                <div class="w-full h-full bg-gray-200 flex items-center justify-center rounded-tr-lg">
                    <i class="fas fa-bath text-gray-400 text-2xl"></i>
                </div>
            @endif
        </div>
        
        <!-- Image 4 (Bottom Right) -->
        <div class="col-span-1">
            @php
                $image4 = $property->getImageByIndex(4);
            @endphp
            @if($image4)
                @if(str_starts_with($image4, 'http'))
                    <img src="{{ $image4 }}" 
                         alt="{{ $property->title }}" class="w-full h-full object-cover">
                @else
                    <img src="{{ asset('storage/' . $image4) }}" 
                         alt="{{ $property->title }}" class="w-full h-full object-cover">
                @endif
            @else
                <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                    <i class="fas fa-utensils text-gray-400 text-2xl"></i>
                </div>
            @endif
        </div>
        
        <!-- Image 5 (Bottom Far Right) -->
        <div class="col-span-1">
            @php
                $image5 = $property->getImageByIndex(5);
            @endphp
            @if($image5)
                @if(str_starts_with($image5, 'http'))
                    <img src="{{ $image5 }}" 
                         alt="{{ $property->title }}" class="w-full h-full object-cover rounded-br-lg">
                @else
                    <img src="{{ asset('storage/' . $image5) }}" 
                         alt="{{ $property->title }}" class="w-full h-full object-cover rounded-br-lg">
                @endif
            @else
                <div class="w-full h-full bg-gray-200 flex items-center justify-center rounded-br-lg">
                    <i class="fas fa-couch text-gray-400 text-2xl"></i>
                </div>
            @endif
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
            @if($property->owner)
            <div class="flex items-center mb-6">
                <img src="https://ui-avatars.com/api/?name={{ urlencode($property->owner->name) }}&size=64" 
                     alt="{{ $property->owner->name }}" class="w-16 h-16 rounded-full mr-4">
                <div>
                    <h3 class="font-semibold text-lg">Hosted by {{ $property->owner->name }}</h3>
                    <p class="text-gray-600">Property Owner • {{ ucfirst($property->owner->role) }}</p>
                </div>
            </div>
            @else
            <div class="flex items-center mb-6">
                <img src="https://ui-avatars.com/api/?name=Property%20Owner&size=64" 
                     alt="Property Owner" class="w-16 h-16 rounded-full mr-4">
                <div>
                    <h3 class="font-semibold text-lg">Hosted by Property Owner</h3>
                    <p class="text-gray-600">Property Owner</p>
                </div>
            </div>
            @endif
            
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
            
            <!-- Reviews -->
            @if($property->total_reviews > 0)
            <div class="mb-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold">
                        <i class="fas fa-star text-yellow-500"></i> {{ $property->average_rating }} • {{ $property->total_reviews }} {{ Str::plural('Review', $property->total_reviews) }}
                    </h2>
                </div>
                
                <!-- Review Stats -->
                <div class="grid grid-cols-2 gap-4 mb-6">
                    @php $reviewStats = $property->review_stats; @endphp
                    <div>
                        <div class="flex justify-between mb-2">
                            <span>Cleanliness</span>
                            <span class="font-semibold">{{ $reviewStats['cleanliness'] }}</span>
                        </div>
                        <div class="bg-gray-200 h-2 rounded-full">
                            <div class="bg-purple-600 h-2 rounded-full" style="width: {{ $reviewStats['cleanliness'] * 20 }}%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between mb-2">
                            <span>Communication</span>
                            <span class="font-semibold">{{ $reviewStats['communication'] }}</span>
                        </div>
                        <div class="bg-gray-200 h-2 rounded-full">
                            <div class="bg-purple-600 h-2 rounded-full" style="width: {{ $reviewStats['communication'] * 20 }}%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between mb-2">
                            <span>Check-in</span>
                            <span class="font-semibold">{{ $reviewStats['checkin'] }}</span>
                        </div>
                        <div class="bg-gray-200 h-2 rounded-full">
                            <div class="bg-purple-600 h-2 rounded-full" style="width: {{ $reviewStats['checkin'] * 20 }}%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between mb-2">
                            <span>Accuracy</span>
                            <span class="font-semibold">{{ $reviewStats['accuracy'] }}</span>
                        </div>
                        <div class="bg-gray-200 h-2 rounded-full">
                            <div class="bg-purple-600 h-2 rounded-full" style="width: {{ $reviewStats['accuracy'] * 20 }}%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between mb-2">
                            <span>Location</span>
                            <span class="font-semibold">{{ $reviewStats['location'] }}</span>
                        </div>
                        <div class="bg-gray-200 h-2 rounded-full">
                            <div class="bg-purple-600 h-2 rounded-full" style="width: {{ $reviewStats['location'] * 20 }}%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between mb-2">
                            <span>Value</span>
                            <span class="font-semibold">{{ $reviewStats['value'] }}</span>
                        </div>
                        <div class="bg-gray-200 h-2 rounded-full">
                            <div class="bg-purple-600 h-2 rounded-full" style="width: {{ $reviewStats['value'] * 20 }}%"></div>
                        </div>
                    </div>
                </div>
                
                <!-- Individual Reviews -->
                <div class="space-y-6">
                    @foreach($reviews as $review)
                    <div class="border-b pb-6 last:border-b-0">
                        <div class="flex items-start mb-3">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($review->customer->name) }}&size=48" 
                                 alt="{{ $review->customer->name }}" class="w-12 h-12 rounded-full mr-3">
                            <div>
                                <h4 class="font-semibold">{{ $review->customer->name }}</h4>
                                <p class="text-gray-600 text-sm">{{ $review->reviewed_at->format('F Y') }}</p>
                            </div>
                        </div>
                        <div class="flex items-center mb-2">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star {{ $i <= $review->rating ? 'text-yellow-500' : 'text-gray-300' }}"></i>
                            @endfor
                        </div>
                        <p class="text-gray-700">
                            {{ $review->review_comment }}
                        </p>
                    </div>
                    @endforeach
                </div>
                
                @if($property->total_reviews > 3)
                <button class="mt-6 border-2 border-gray-800 px-6 py-3 rounded-lg font-semibold hover:bg-gray-50">
                    Show All {{ $property->total_reviews }} Reviews
                </button>
                @endif
            </div>
            @else
            <div class="mb-6 text-center py-8">
                <i class="fas fa-star text-gray-300 text-4xl mb-4"></i>
                <h2 class="text-xl font-bold text-gray-600 mb-2">No Reviews Yet</h2>
                <p class="text-gray-500">Be the first to leave a review for this property!</p>
            </div>
            @endif
        </div>
        
        <!-- Right Column - Booking Card -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-xl p-6 sticky top-24">
                <div class="mb-4">
                    <div class="flex items-baseline">
                        <span class="text-3xl font-bold">${{ number_format($property->price_per_night, 0) }}</span>
                        <span class="text-gray-600 ml-2">per night</span>
                    </div>
                    @if($property->total_reviews > 0)
                    <div class="flex items-center mt-2">
                        <i class="fas fa-star text-yellow-500"></i>
                        <span class="ml-1 font-semibold">{{ $property->average_rating }}</span>
                        <span class="text-gray-500 ml-1">({{ $property->total_reviews }} {{ Str::plural('review', $property->total_reviews) }})</span>
                    </div>
                    @endif
                </div>
                
                @auth
                <form id="bookingForm" action="{{ route('bookings.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="property_id" value="{{ $property->id }}">
                    
                    <div class="border rounded-lg">
                        <div class="grid grid-cols-2 gap-2">
                            <div class="p-3 border-r">
                                <label class="block text-xs font-semibold mb-1">CHECK-IN</label>
                                <input type="date" id="check_in" name="check_in" class="w-full text-sm outline-none" 
                                       min="{{ date('Y-m-d') }}" onchange="updateDatesAndPricing()" onclick="showCalendar('check_in')" required readonly>
                            </div>
                            <div class="p-3">
                                <label class="block text-xs font-semibold mb-1">CHECKOUT</label>
                                <input type="date" id="check_out" name="check_out" class="w-full text-sm outline-none" 
                                       onchange="updateDatesAndPricing()" onclick="showCalendar('check_out')" required readonly>
                            </div>
                        </div>
                        
                        <!-- Custom Calendar -->
                        <div id="customCalendar" class="p-4 border-t hidden">
                            <div class="flex justify-between items-center mb-4">
                                <button type="button" onclick="changeMonth(-1)" class="p-2 hover:bg-gray-100 rounded">
                                    <i class="fas fa-chevron-left"></i>
                                </button>
                                <h3 id="monthYear" class="font-semibold"></h3>
                                <button type="button" onclick="changeMonth(1)" class="p-2 hover:bg-gray-100 rounded">
                                    <i class="fas fa-chevron-right"></i>
                                </button>
                            </div>
                            <div class="grid grid-cols-7 gap-1 text-center text-xs mb-2">
                                <div class="p-2 font-semibold text-gray-500">Sun</div>
                                <div class="p-2 font-semibold text-gray-500">Mon</div>
                                <div class="p-2 font-semibold text-gray-500">Tue</div>
                                <div class="p-2 font-semibold text-gray-500">Wed</div>
                                <div class="p-2 font-semibold text-gray-500">Thu</div>
                                <div class="p-2 font-semibold text-gray-500">Fri</div>
                                <div class="p-2 font-semibold text-gray-500">Sat</div>
                            </div>
                            <div id="calendarDays" class="grid grid-cols-7 gap-1 text-center text-sm">
                                <!-- Calendar days will be populated by JavaScript -->
                            </div>
                            <div class="mt-4 flex gap-2 text-xs">
                                <div class="flex items-center">
                                    <div class="w-3 h-3 bg-gray-200 rounded mr-1"></div>
                                    <span>Unavailable</span>
                                </div>
                                <div class="flex items-center">
                                    <div class="w-3 h-3 bg-purple-600 rounded mr-1"></div>
                                    <span>Selected</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="border rounded-lg p-3">
                        <label class="block text-xs font-semibold mb-1">GUESTS</label>
                        <select name="guests" class="w-full text-sm outline-none" required>
                            @for($i = 1; $i <= $property->max_guests; $i++)
                                <option value="{{ $i }}">{{ $i }} guest{{ $i > 1 ? 's' : '' }}</option>
                            @endfor
                        </select>
                    </div>
                    
                    <button type="button" onclick="showReservationModal()" class="w-full bg-purple-600 text-white py-3 rounded-lg hover:bg-purple-700 font-semibold">
                        Reserve
                    </button>
                @else
                <div class="space-y-4">
                    <div class="grid grid-cols-2 gap-2 border rounded-lg opacity-50">
                        <div class="p-3 border-r">
                            <label class="block text-xs font-semibold mb-1">CHECK-IN</label>
                            <input type="date" class="w-full text-sm outline-none" disabled>
                        </div>
                        <div class="p-3">
                            <label class="block text-xs font-semibold mb-1">CHECKOUT</label>
                            <input type="date" class="w-full text-sm outline-none" disabled>
                        </div>
                    </div>
                    
                    <div class="border rounded-lg p-3 opacity-50">
                        <label class="block text-xs font-semibold mb-1">GUESTS</label>
                        <select class="w-full text-sm outline-none" disabled>
                            <option>1 guest</option>
                        </select>
                    </div>
                    
                    <a href="{{ route('login') }}" class="block w-full bg-purple-600 text-white py-3 rounded-lg hover:bg-purple-700 font-semibold text-center">
                        Log in to Reserve
                    </a>
                </div>
                @endauth
                    
                @auth
                </form>
                @endauth
                    
                <p class="text-center text-sm text-gray-600">You won't be charged yet</p>
                    
                    <div id="pricingBreakdown" class="space-y-2 text-sm" style="display: none;">
                        <div class="flex justify-between">
                            <span class="underline" id="nightsCalculation">${{ number_format($property->price_per_night, 0) }} x 0 nights</span>
                            <span id="subtotal">$0</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="underline">Service fee</span>
                            <span id="serviceFee">$0</span>
                        </div>
                        @if($property->cleaning_fee)
                        <div class="flex justify-between">
                            <span class="underline">Cleaning fee</span>
                            <span>${{ number_format($property->cleaning_fee, 0) }}</span>
                        </div>
                        @endif
                        <hr>
                        <div class="flex justify-between font-semibold text-base">
                            <span>Total</span>
                            <span id="totalPrice">$0</span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Reservation Confirmation Modal -->
<div id="reservationModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50" style="display: none;">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg p-6 w-full max-w-md">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-bold">Confirm Reservation</h3>
                <button onclick="closeReservationModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <div class="space-y-4">
                <div>
                    <h4 class="font-semibold">{{ $property->title }}</h4>
                    <p class="text-gray-600">{{ $property->city }}, {{ $property->state }}</p>
                </div>
                
                <div class="border-t pt-4">
                    <div class="grid grid-cols-2 gap-4 text-sm">
                        <div>
                            <p class="text-gray-600">Check-in</p>
                            <p class="font-semibold" id="modalCheckIn">-</p>
                        </div>
                        <div>
                            <p class="text-gray-600">Check-out</p>
                            <p class="font-semibold" id="modalCheckOut">-</p>
                        </div>
                    </div>
                </div>
                
                <div class="border-t pt-4">
                    <div class="flex justify-between">
                        <span>Total</span>
                        <span class="font-bold" id="modalTotal">$0</span>
                    </div>
                </div>
            </div>
            
            <div class="flex gap-3 mt-6">
                <button onclick="confirmReservation()" 
                        class="flex-1 bg-purple-600 text-white py-2 px-4 rounded-lg hover:bg-purple-700 font-semibold">
                    Confirm Booking
                </button>
                <button onclick="closeReservationModal()" 
                        class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>

<script>
const propertyPricePerNight = {{ $property->price_per_night }};
const cleaningFee = {{ $property->cleaning_fee ?? 0 }};
const serviceFeeRate = 0.1;

// Unavailable date ranges
const unavailableDates = @json($unavailableDates);

let currentDate = new Date();
let selectedCheckIn = null;
let selectedCheckOut = null;
let selectingCheckIn = true;

function updateDatesAndPricing() {
    const checkIn = document.getElementById('check_in').value;
    const checkOut = document.getElementById('check_out').value;
    
    // Calculate pricing if both dates are selected
    if (checkIn && checkOut) {
        const startDate = new Date(checkIn);
        const endDate = new Date(checkOut);
        
        if (endDate > startDate) {
            const nights = Math.ceil((endDate - startDate) / (1000 * 60 * 60 * 24));
            const subtotal = propertyPricePerNight * nights;
            const serviceFee = Math.round(subtotal * serviceFeeRate);
            const total = subtotal + serviceFee + cleaningFee;
            
            // Update pricing display
            document.getElementById('nightsCalculation').textContent = `$${propertyPricePerNight.toLocaleString()} x ${nights} night${nights > 1 ? 's' : ''}`;
            document.getElementById('subtotal').textContent = `$${subtotal.toLocaleString()}`;
            document.getElementById('serviceFee').textContent = `$${serviceFee.toLocaleString()}`;
            document.getElementById('totalPrice').textContent = `$${total.toLocaleString()}`;
            document.getElementById('pricingBreakdown').style.display = 'block';
        } else {
            document.getElementById('pricingBreakdown').style.display = 'none';
        }
    }
}

function isDateUnavailable(date) {
    const dateStr = date.toISOString().split('T')[0];
    
    return unavailableDates.some(range => {
        return dateStr >= range.start && dateStr <= range.end;
    });
}

function isDateInPast(date) {
    const today = new Date();
    today.setHours(0, 0, 0, 0);
    return date < today;
}

function showCalendar(field) {
    selectingCheckIn = (field === 'check_in');
    document.getElementById('customCalendar').classList.remove('hidden');
    renderCalendar();
}

function hideCalendar() {
    document.getElementById('customCalendar').classList.add('hidden');
}

function formatDateForDisplay(dateStr) {
    if (!dateStr) return '';
    const date = new Date(dateStr);
    return date.toLocaleDateString('en-US', { 
        month: 'short', 
        day: 'numeric',
        year: 'numeric'
    });
}

function changeMonth(direction) {
    currentDate.setMonth(currentDate.getMonth() + direction);
    renderCalendar();
}

function renderCalendar() {
    const monthNames = ["January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"];
    
    document.getElementById('monthYear').textContent = 
        `${monthNames[currentDate.getMonth()]} ${currentDate.getFullYear()}`;
    
    const firstDay = new Date(currentDate.getFullYear(), currentDate.getMonth(), 1);
    const lastDay = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 0);
    const startDate = new Date(firstDay);
    startDate.setDate(startDate.getDate() - firstDay.getDay());
    
    const calendarDays = document.getElementById('calendarDays');
    calendarDays.innerHTML = '';
    
    for (let i = 0; i < 42; i++) {
        const date = new Date(startDate);
        date.setDate(startDate.getDate() + i);
        
        const dayElement = document.createElement('div');
        dayElement.className = 'p-2 cursor-pointer hover:bg-gray-100 rounded';
        dayElement.textContent = date.getDate();
        
        // Style different types of dates
        if (date.getMonth() !== currentDate.getMonth()) {
            dayElement.className += ' text-gray-300';
        } else if (isDateInPast(date)) {
            dayElement.className += ' text-gray-400 cursor-not-allowed';
        } else if (isDateUnavailable(date)) {
            dayElement.className += ' bg-gray-200 text-gray-500 cursor-not-allowed';
            dayElement.title = 'Already booked - unavailable';
        } else {
            dayElement.className += ' hover:bg-purple-100';
            
            // Check if date is selected or in range
            const dateStr = date.toISOString().split('T')[0];
            if (selectedCheckIn && dateStr === selectedCheckIn) {
                dayElement.className += ' bg-purple-600 text-white font-bold';
                dayElement.title = 'Check-in date';
            } else if (selectedCheckOut && dateStr === selectedCheckOut) {
                dayElement.className += ' bg-purple-600 text-white font-bold';
                dayElement.title = 'Check-out date';
            } else if (selectedCheckIn && selectedCheckOut && 
                       dateStr > selectedCheckIn && dateStr < selectedCheckOut) {
                dayElement.className += ' bg-purple-200 text-purple-800';
                dayElement.title = 'Selected range';
            }
            
            // Add click handler for available dates
            dayElement.addEventListener('click', () => selectDate(date));
        }
        
        calendarDays.appendChild(dayElement);
    }
}

function selectDate(date) {
    if (isDateInPast(date) || isDateUnavailable(date)) {
        return;
    }
    
    const dateStr = date.toISOString().split('T')[0];
    
    if (selectingCheckIn) {
        selectedCheckIn = dateStr;
        selectedCheckOut = null;
        document.getElementById('check_in').value = dateStr;
        document.getElementById('check_out').value = '';
        
        // Update input display
        const checkInInput = document.getElementById('check_in');
        checkInInput.style.color = 'black';
        checkInInput.style.fontWeight = 'bold';
        
        selectingCheckIn = false;
    } else {
        if (selectedCheckIn && dateStr <= selectedCheckIn) {
            // If checkout is before or same as checkin, reset and select as checkin
            selectedCheckIn = dateStr;
            selectedCheckOut = null;
            document.getElementById('check_in').value = dateStr;
            document.getElementById('check_out').value = '';
            
            // Update input display
            const checkInInput = document.getElementById('check_in');
            checkInInput.style.color = 'black';
            checkInInput.style.fontWeight = 'bold';
            
            selectingCheckIn = false;
        } else {
            // Check if there are any unavailable dates between check-in and check-out
            const checkInDate = new Date(selectedCheckIn);
            const checkOutDate = new Date(dateStr);
            let hasUnavailableInBetween = false;
            
            for (let d = new Date(checkInDate); d < checkOutDate; d.setDate(d.getDate() + 1)) {
                if (isDateUnavailable(d)) {
                    hasUnavailableInBetween = true;
                    break;
                }
            }
            
            if (hasUnavailableInBetween) {
                alert('There are unavailable dates in your selected range. Please choose different dates.');
                return;
            }
            
            selectedCheckOut = dateStr;
            document.getElementById('check_out').value = dateStr;
            
            // Update input display
            const checkOutInput = document.getElementById('check_out');
            checkOutInput.style.color = 'black';
            checkOutInput.style.fontWeight = 'bold';
            
            hideCalendar();
        }
    }
    
    renderCalendar();
    updateDatesAndPricing();
}

// Close calendar when clicking outside
document.addEventListener('click', function(event) {
    const calendar = document.getElementById('customCalendar');
    const checkInInput = document.getElementById('check_in');
    const checkOutInput = document.getElementById('check_out');
    
    if (!calendar.contains(event.target) && 
        !checkInInput.contains(event.target) && 
        !checkOutInput.contains(event.target)) {
        hideCalendar();
    }
});

function showReservationModal() {
    const checkIn = document.getElementById('check_in').value;
    const checkOut = document.getElementById('check_out').value;
    
    if (!checkIn || !checkOut) {
        alert('Please select both check-in and check-out dates.');
        return;
    }
    
    const startDate = new Date(checkIn);
    const endDate = new Date(checkOut);
    
    if (endDate <= startDate) {
        alert('Check-out date must be after check-in date.');
        return;
    }
    
    // Update modal content
    document.getElementById('modalCheckIn').textContent = startDate.toLocaleDateString('en-US', { 
        weekday: 'short', year: 'numeric', month: 'short', day: 'numeric' 
    });
    document.getElementById('modalCheckOut').textContent = endDate.toLocaleDateString('en-US', { 
        weekday: 'short', year: 'numeric', month: 'short', day: 'numeric' 
    });
    document.getElementById('modalTotal').textContent = document.getElementById('totalPrice').textContent;
    
    // Show modal
    const modal = document.getElementById('reservationModal');
    modal.classList.remove('hidden');
    modal.style.display = 'flex';
}

function closeReservationModal() {
    const modal = document.getElementById('reservationModal');
    modal.classList.add('hidden');
    modal.style.display = 'none';
}

function confirmReservation() {
    // Check availability before submitting
    checkAvailability().then(available => {
        if (available) {
            document.getElementById('bookingForm').submit();
        } else {
            alert('Sorry, this property is not available for the selected dates. Please choose different dates.');
            closeReservationModal();
        }
    });
}

async function checkAvailability() {
    const checkIn = document.getElementById('check_in').value;
    const checkOut = document.getElementById('check_out').value;
    const propertyId = {{ $property->id }};
    
    try {
        const response = await fetch('/api/check-availability', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                property_id: propertyId,
                check_in: checkIn,
                check_out: checkOut
            })
        });
        
        const data = await response.json();
        return data.available;
    } catch (error) {
        console.error('Error checking availability:', error);
        return true; // Allow booking if check fails
    }
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    // Set current month to today or next month if today is near end of month
    const today = new Date();
    currentDate = new Date(today.getFullYear(), today.getMonth(), 1);
    
    // Initialize selected dates from inputs if any
    const checkInValue = document.getElementById('check_in').value;
    const checkOutValue = document.getElementById('check_out').value;
    
    if (checkInValue) {
        selectedCheckIn = checkInValue;
    }
    if (checkOutValue) {
        selectedCheckOut = checkOutValue;
    }
    
    // Initial pricing calculation
    updateDatesAndPricing();
});
</script>
@endsection
