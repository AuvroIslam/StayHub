@extends('layouts.app')

@section('title', 'My Dashboard - StayHub')

@section('content')
<div class="min-h-screen" style="background-color: #F5F5F0;">
    <!-- Dashboard Header -->
    <div class="bg-white shadow-sm">
        <div class="container mx-auto px-4 py-6">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold">My Dashboard</h1>
                    <p class="text-gray-600">Manage your bookings and reservations</p>
                </div>
                <a href="/properties" class="text-white px-6 py-3 rounded-lg font-semibold" style="background-color: #80A1BA; transition: opacity 0.3s;" onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'">
                    <i class="fa-solid fa-magnifying-glass mr-2"></i> Browse Properties
                </a>
            </div>
        </div>
    </div>
    
    <div class="container mx-auto px-4 py-8">
        <!-- Stats Overview -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-semibold">Upcoming Trips</p>
                        <h3 class="text-3xl font-bold mt-2">{{ $upcomingBookings->count() }}</h3>
                        @if($upcomingBookings->first())
                            <p class="text-sm mt-1" style="color: #80A1BA;">Next: {{ $upcomingBookings->first()->check_in->format('M d') }}</p>
                        @else
                            <p class="text-gray-400 text-sm mt-1">No upcoming trips</p>
                        @endif
                    </div>
                    <div class="p-4 rounded-full" style="background-color: rgba(128, 161, 186, 0.2);">
                        <i class="fa-solid fa-suitcase text-2xl" style="color: #80A1BA;"></i>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-semibold">Total Bookings</p>
                        <h3 class="text-3xl font-bold mt-2">{{ $totalBookings }}</h3>
                        <p class="text-green-600 text-sm mt-1">
                            <i class="fa-solid fa-calendar-check mr-1"></i> All time
                        </p>
                    </div>
                    <div class="p-4 rounded-full" style="background-color: rgba(145, 196, 195, 0.2);">
                        <i class="fa-solid fa-calendar-check text-2xl" style="color: #91C4C3;"></i>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-semibold">Pending Bookings</p>
                        <h3 class="text-3xl font-bold mt-2">{{ $pendingBookings->count() }}</h3>
                        <p class="text-orange-600 text-sm mt-1">
                            <i class="fas fa-clock mr-1"></i> Awaiting
                        </p>
                    </div>
                    <div class="p-4 rounded-full" style="background-color: rgba(180, 222, 189, 0.2);">
                        <i class="fas fa-clock text-2xl" style="color: #B4DEBD;"></i>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-semibold">Total Spent</p>
                        <h3 class="text-3xl font-bold mt-2">${{ number_format($totalSpent, 0) }}</h3>
                        <p class="text-gray-500 text-sm mt-1">All time</p>
                    </div>
                    <div class="p-4 rounded-full" style="background-color: rgba(180, 222, 189, 0.3);">
                        <i class="fas fa-dollar-sign text-2xl" style="color: #80A1BA;"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                <!-- Upcoming Bookings -->
                <div class="bg-white rounded-lg shadow-md p-6 mb-8">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold">Upcoming Trips</h2>
                        <a href="/bookings" class="font-semibold" style="color: #80A1BA; transition: opacity 0.3s;" onmouseover="this.style.opacity='0.8'" onmouseout="this.style.opacity='1'">
                            View All <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                    
                    @if($upcomingBookings->count() > 0)
                        <div class="space-y-4">
                            @foreach($upcomingBookings->take(2) as $booking)
                            <div class="border rounded-lg overflow-hidden hover:shadow-lg transition">
                                <div class="flex">
                                    @if($booking->property->image)
                                        @if(str_starts_with($booking->property->image, 'http'))
                                            <img src="{{ $booking->property->image }}" 
                                                 alt="{{ $booking->property->title }}" class="w-32 h-32 object-cover">
                                        @else
                                            <img src="{{ asset('storage/' . $booking->property->image) }}" 
                                                 alt="{{ $booking->property->title }}" class="w-32 h-32 object-cover">
                                        @endif
                                    @else
                                        <div class="w-32 h-32 bg-gray-200 flex items-center justify-center">
                                            <i class="fas fa-home text-gray-400 text-3xl"></i>
                                        </div>
                                    @endif
                                    <div class="flex-1 p-4">
                                        <div class="flex justify-between items-start">
                                            <div>
                                                <h3 class="font-semibold text-lg">{{ $booking->property->title }}</h3>
                                                <p class="text-gray-600 text-sm">
                                                    <i class="fas fa-map-marker-alt mr-1"></i> {{ $booking->property->city }}, {{ $booking->property->state }}
                                                </p>
                                                <p class="text-gray-600 text-sm mt-1">
                                                    <i class="fas fa-calendar mr-1"></i> {{ $booking->check_in->format('M d') }} - {{ $booking->check_out->format('M d, Y') }}
                                                </p>
                                                <p class="text-gray-600 text-sm">
                                                    <i class="fas fa-users mr-1"></i> {{ $booking->guests }} Guests
                                                </p>
                                            </div>
                                            <div class="text-right">
                                                <span class="px-3 py-1 rounded-full text-sm font-semibold" style="background-color: rgba(180, 222, 189, 0.3); color: #2d7a4d;">
                                                    {{ ucfirst($booking->status) }}
                                                </span>
                                                <p class="font-bold text-lg mt-2">${{ number_format($booking->total_price, 0) }}</p>
                                            </div>
                                        </div>
                                        <div class="flex space-x-2 mt-3">
                                            <a href="{{ route('properties.show', $booking->property->id) }}" class="flex-1 text-white py-2 rounded-lg text-sm font-semibold text-center" style="background-color: #80A1BA; transition: opacity 0.3s;" onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'">
                                                View Details
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <i class="fas fa-calendar-times text-gray-300 text-5xl mb-3"></i>
                            <p class="text-gray-500 text-lg">No upcoming trips</p>
                            <a href="/properties" class="mt-4 inline-block text-white px-6 py-2 rounded-lg" style="background-color: #80A1BA;">
                                Browse Properties
                            </a>
                        </div>
                    @endif
                </div>

                <!-- Past Trips -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold">Past Trips</h2>
                        <a href="/bookings" class="font-semibold" style="color: #80A1BA; transition: opacity 0.3s;" onmouseover="this.style.opacity='0.8'" onmouseout="this.style.opacity='1'">
                            View All <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                    
                    @if($pastBookings->count() > 0)
                        <div class="space-y-4">
                            @foreach($pastBookings->take(2) as $booking)
                            <div class="border rounded-lg overflow-hidden">
                                <div class="flex">
                                    @if($booking->property->image)
                                        @if(str_starts_with($booking->property->image, 'http'))
                                            <img src="{{ $booking->property->image }}" 
                                                 alt="{{ $booking->property->title }}" class="w-24 h-24 object-cover">
                                        @else
                                            <img src="{{ asset('storage/' . $booking->property->image) }}" 
                                                 alt="{{ $booking->property->title }}" class="w-24 h-24 object-cover">
                                        @endif
                                    @else
                                        <div class="w-24 h-24 bg-gray-200 flex items-center justify-center">
                                            <i class="fas fa-home text-gray-400 text-2xl"></i>
                                        </div>
                                    @endif
                                    <div class="flex-1 p-3">
                                        <div class="flex justify-between items-start">
                                            <div>
                                                <h3 class="font-semibold">{{ $booking->property->title }}</h3>
                                                <p class="text-gray-600 text-sm">
                                                    <i class="fas fa-map-marker-alt mr-1"></i> {{ $booking->property->city }}, {{ $booking->property->state }}
                                                </p>
                                                <p class="text-gray-600 text-sm">
                                                    <i class="fas fa-calendar mr-1"></i> {{ $booking->check_in->format('M d') }} - {{ $booking->check_out->format('M d, Y') }}
                                                </p>
                                            </div>
                                            <span class="px-2 py-1 rounded text-xs font-semibold" style="background-color: rgba(128, 161, 186, 0.2); color: #80A1BA;">
                                                {{ ucfirst($booking->status) }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-6">
                            <i class="fas fa-history text-gray-300 text-4xl mb-2"></i>
                            <p class="text-gray-500">No past trips yet</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <!-- User Profile Card -->
                <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                    <div class="text-center">
                        <div class="w-24 h-24 rounded-full mx-auto mb-4 flex items-center justify-center text-3xl font-bold text-white" style="background: linear-gradient(135deg, #80A1BA 0%, #91C4C3 100%);">
                            {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                        </div>
                        <h3 class="font-bold text-xl">{{ Auth::user()->name }}</h3>
                        <p class="text-gray-600 text-sm">{{ Auth::user()->email }}</p>
                        @if(Auth::user()->phone)
                            <p class="text-gray-600 text-sm mt-1">
                                <i class="fas fa-phone mr-1"></i> {{ Auth::user()->phone }}
                            </p>
                        @endif
                        <div class="mt-4">
                            <a href="/profile" class="w-full block border-2 text-center py-2 rounded-lg font-semibold" style="border-color: #80A1BA; color: #80A1BA; transition: all 0.3s;" onmouseover="this.style.backgroundColor='#80A1BA'; this.style.color='white'" onmouseout="this.style.backgroundColor=''; this.style.color='#80A1BA'">
                                Edit Profile
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="font-bold text-lg mb-4">Quick Actions</h3>
                    <div class="space-y-3">
                        <a href="/properties" class="block text-gray-700 hover:bg-gray-50 p-3 rounded-lg transition">
                            <i class="fas fa-search mr-2" style="color: #80A1BA;"></i>
                            Browse Properties
                        </a>
                        <a href="/bookings" class="block text-gray-700 hover:bg-gray-50 p-3 rounded-lg transition">
                            <i class="fas fa-calendar-check mr-2" style="color: #91C4C3;"></i>
                            My Bookings
                        </a>
                        <a href="/messages" class="block text-gray-700 hover:bg-gray-50 p-3 rounded-lg transition">
                            <i class="fas fa-envelope mr-2" style="color: #80A1BA;"></i>
                            Messages
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
