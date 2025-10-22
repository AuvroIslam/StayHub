@extends('layouts.app')

@section('content')
<div class="min-h-screen" style="background-color: #F5F5F0;">
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
            <!-- Header -->
            <div class="mb-8">
                <div class="flex items-center mb-4">
                    <a href="{{ route('bookings.index') }}" class="text-gray-600 hover:text-gray-800 mr-4">
                        <i class="fas fa-arrow-left"></i> Back to Bookings
                    </a>
                </div>
                <h1 class="text-3xl font-bold">Booking Details</h1>
            </div>

            <!-- Booking Card -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="md:flex">
                    <!-- Property Image -->
                    <div class="md:w-1/3">
                        @if($booking->property->image)
                            @if(str_starts_with($booking->property->image, 'http'))
                                <img src="{{ $booking->property->image }}" 
                                     alt="{{ $booking->property->title }}" 
                                     class="w-full h-64 md:h-full object-cover">
                            @else
                                <img src="{{ asset('storage/' . $booking->property->image) }}" 
                                     alt="{{ $booking->property->title }}" 
                                     class="w-full h-64 md:h-full object-cover">
                            @endif
                        @else
                            <div class="w-full h-64 md:h-full bg-gray-200 flex items-center justify-center">
                                <i class="fas fa-home text-4xl text-gray-400"></i>
                            </div>
                        @endif
                    </div>

                    <!-- Booking Details -->
                    <div class="md:w-2/3 p-8">
                        <div class="flex justify-between items-start mb-6">
                            <div>
                                <h2 class="text-2xl font-bold mb-2">{{ $booking->property->title }}</h2>
                                <p class="text-gray-600 mb-1">
                                    <i class="fas fa-map-marker-alt mr-1"></i>
                                    {{ $booking->property->city }}, {{ $booking->property->state }}
                                </p>
                            </div>
                            
                            <!-- Status Badge -->
                            @php
                                $statusColor = match($booking->status) {
                                    'confirmed' => 'bg-green-100 text-green-800',
                                    'pending' => 'bg-yellow-100 text-yellow-800',
                                    'cancelled' => 'bg-red-100 text-red-800',
                                    'completed' => 'bg-blue-100 text-blue-800',
                                    default => 'bg-gray-100 text-gray-800'
                                };
                            @endphp
                            <span class="px-4 py-2 rounded-full text-sm font-medium {{ $statusColor }}">
                                {{ ucfirst($booking->status) }}
                            </span>
                        </div>

                        <!-- Trip Details -->
                        <div class="grid md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <h3 class="font-semibold text-lg mb-4">Trip Details</h3>
                                <div class="space-y-3">
                                    <div>
                                        <p class="text-sm text-gray-500">Check-in</p>
                                        <p class="font-semibold">{{ $booking->check_in->format('l, F j, Y') }}</p>
                                        <p class="text-sm text-gray-500">3:00 PM</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Check-out</p>
                                        <p class="font-semibold">{{ $booking->check_out->format('l, F j, Y') }}</p>
                                        <p class="text-sm text-gray-500">11:00 AM</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Guests</p>
                                        <p class="font-semibold">{{ $booking->guests }} {{ Str::plural('guest', $booking->guests) }}</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div>
                                <h3 class="font-semibold text-lg mb-4">Booking Information</h3>
                                <div class="space-y-3">
                                    <div>
                                        <p class="text-sm text-gray-500">Booking ID</p>
                                        <p class="font-semibold">#{{ $booking->id }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Booked on</p>
                                        <p class="font-semibold">{{ $booking->created_at->format('F j, Y') }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Duration</p>
                                        <p class="font-semibold">{{ $booking->check_in->diffInDays($booking->check_out) }} {{ Str::plural('night', $booking->check_in->diffInDays($booking->check_out)) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Price Breakdown -->
                        <div class="border-t pt-6">
                            <h3 class="font-semibold text-lg mb-4">Price Details</h3>
                            @php
                                $nights = $booking->check_in->diffInDays($booking->check_out);
                                $pricePerNight = $booking->property->price_per_night;
                                $subtotal = $pricePerNight * $nights;
                                $serviceFee = round($subtotal * 0.1);
                                $cleaningFee = $booking->property->cleaning_fee ?? 0;
                            @endphp
                            <div class="space-y-2 text-sm">
                                <div class="flex justify-between">
                                    <span>${{ number_format($pricePerNight, 0) }} x {{ $nights }} {{ Str::plural('night', $nights) }}</span>
                                    <span>${{ number_format($subtotal, 0) }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>Service fee</span>
                                    <span>${{ number_format($serviceFee, 0) }}</span>
                                </div>
                                @if($cleaningFee > 0)
                                <div class="flex justify-between">
                                    <span>Cleaning fee</span>
                                    <span>${{ number_format($cleaningFee, 0) }}</span>
                                </div>
                                @endif
                                <hr class="my-2">
                                <div class="flex justify-between font-semibold text-base">
                                    <span>Total</span>
                                    <span>${{ number_format($booking->total_price, 0) }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="flex gap-3 mt-6">
                            <a href="{{ route('properties.show', $booking->property) }}" 
                               class="px-4 py-2 rounded-lg font-medium transition text-white"
                               style="background-color: #80A1BA;"
                               onmouseover="this.style.opacity='0.8'" 
                               onmouseout="this.style.opacity='1'">
                                View Property
                            </a>
                            
                            @if($booking->status === 'pending')
                                <form action="{{ route('bookings.destroy', $booking) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            onclick="return confirm('Are you sure you want to cancel this booking?')"
                                            class="px-4 py-2 bg-red-500 text-white rounded-lg font-medium hover:bg-red-600 transition">
                                        Cancel Booking
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection