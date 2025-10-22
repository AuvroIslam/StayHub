@extends('layouts.app')

@section('title', 'Owner Dashboard - StayHub')

@section('content')
<div class="min-h-screen" style="background-color: #F5F5F0;">
    <!-- Dashboard Header -->
    <div class="bg-white shadow-sm">
        <div class="container mx-auto px-4 py-6">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold">Property Owner Dashboard</h1>
                    <p class="text-gray-600">Manage your properties and bookings</p>
                </div>
                <a href="{{ route('properties.create') }}" class="text-white px-6 py-3 rounded-lg font-semibold" style="background-color: #80A1BA; transition: opacity 0.3s;" onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'">
                    <i class="fa-solid fa-plus mr-2"></i> Add New Property
                </a>
            </div>
        </div>
    </div>
    
    <div class="container mx-auto px-4 py-8">
        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                <i class="fas fa-check-circle mr-2"></i>
                {{ session('success') }}
            </div>
        @endif
        
        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                <i class="fas fa-exclamation-circle mr-2"></i>
                {{ session('error') }}
            </div>
        @endif
        
        <!-- Stats Overview -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-semibold">Total Properties</p>
                        <h3 class="text-3xl font-bold mt-2">{{ $properties->count() }}</h3>
                        @if($properties->count() > 0)
                        <p class="text-green-600 text-sm mt-1">
                            <i class="fa-solid fa-check-circle mr-1"></i> Active
                        </p>
                        @endif
                    </div>
                    <div class="p-4 rounded-full" style="background-color: rgba(180, 222, 189, 0.3);">
                        <i class="fa-solid fa-building text-2xl" style="color: #80A1BA;"></i>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-semibold">Active Bookings</p>
                        <h3 class="text-3xl font-bold mt-2">{{ $totalBookings }}</h3>
                        @if($totalBookings > 0)
                        <p class="text-green-600 text-sm mt-1">
                            <i class="fa-solid fa-calendar-check mr-1"></i> Total
                        </p>
                        @endif
                    </div>
                    <div class="p-4 rounded-full" style="background-color: rgba(145, 196, 195, 0.3);">
                        <i class="fa-solid fa-calendar-check text-2xl" style="color: #80A1BA;"></i>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-semibold">Total Earnings</p>
                        <h3 class="text-3xl font-bold mt-2">${{ number_format($totalEarnings, 0) }}</h3>
                        <p class="text-gray-500 text-sm mt-1">
                            <i class="fas fa-dollar-sign mr-1"></i> All time
                        </p>
                    </div>
                    <div class="p-4 rounded-full" style="background-color: rgba(180, 222, 189, 0.3);">
                        <i class="fas fa-dollar-sign text-2xl" style="color: #80A1BA;"></i>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-semibold">Properties Listed</p>
                        <h3 class="text-3xl font-bold mt-2">{{ $properties->count() }}</h3>
                        <p class="text-gray-500 text-sm mt-1">
                            <i class="fas fa-home mr-1"></i> Total
                        </p>
                    </div>
                    <div class="p-4 rounded-full" style="background-color: rgba(145, 196, 195, 0.3);">
                        <i class="fas fa-home text-2xl" style="color: #80A1BA;"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Recent Bookings -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold">Recent Bookings</h2>
                        <a href="/owner/bookings" class="font-semibold" style="color: #80A1BA; transition: opacity 0.3s;" onmouseover="this.style.opacity='0.8'" onmouseout="this.style.opacity='1'">
                            View All <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                    
                    @if($recentBookings->count() > 0)
                    <div class="space-y-4">
                        @foreach($recentBookings->take(3) as $booking)
                        <div class="border rounded-lg p-4 hover:bg-gray-50">
                            <div class="flex justify-between items-start">
                                <div class="flex-1">
                                    <h3 class="font-semibold text-lg">{{ $booking->property->title }}</h3>
                                    <p class="text-gray-600 text-sm mt-1">
                                        <i class="fas fa-user mr-1"></i> {{ $booking->customer->name }}
                                    </p>
                                    <p class="text-gray-600 text-sm">
                                        <i class="fas fa-calendar mr-1"></i> {{ $booking->check_in->format('M d') }} - {{ $booking->check_out->format('M d, Y') }}
                                    </p>
                                </div>
                                <div class="text-right">
                                    <span class="px-3 py-1 rounded-full text-sm font-semibold
                                        {{ $booking->status == 'confirmed' ? 'bg-green-100 text-green-600' : '' }}
                                        {{ $booking->status == 'pending' ? 'bg-yellow-100 text-yellow-600' : '' }}
                                        {{ $booking->status == 'completed' ? 'bg-blue-100 text-blue-600' : '' }}
                                        {{ $booking->status == 'cancelled' ? 'bg-red-100 text-red-600' : '' }}">
                                        {{ ucfirst($booking->status) }}
                                    </span>
                                    <p class="font-bold text-lg mt-2" style="color: #80A1BA;">${{ number_format($booking->total_price, 0) }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="text-center py-12">
                        <i class="fas fa-calendar-xmark text-6xl text-gray-300 mb-4"></i>
                        <p class="text-gray-600">No bookings yet</p>
                    </div>
                    @endif
                </div>
                
                <!-- My Properties -->
                <div class="bg-white rounded-lg shadow-md p-6 mt-8">
                    <div class="mb-6">
                        <h2 class="text-2xl font-bold">My Properties</h2>
                    </div>
                    
                    @if($properties->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($properties->take(4) as $property)
                        <div class="border rounded-lg overflow-hidden hover:shadow-lg transition">
                            @if($property->image)
                                @if(str_starts_with($property->image, 'http'))
                                    <img src="{{ $property->image }}" 
                                         alt="{{ $property->title }}" class="w-full h-40 object-cover">
                                @else
                                    <img src="{{ asset('storage/' . $property->image) }}" 
                                         alt="{{ $property->title }}" class="w-full h-40 object-cover">
                                @endif
                            @else
                                <div class="w-full h-40 bg-gray-300 flex items-center justify-center">
                                    <i class="fas fa-image text-gray-400 text-3xl"></i>
                                </div>
                            @endif
                            <div class="p-4">
                                <h3 class="font-semibold mb-2">{{ Str::limit($property->title, 25) }}</h3>
                                <p class="text-sm text-gray-600 mb-2">
                                    <i class="fas fa-map-marker-alt mr-1"></i> {{ $property->city }}, {{ $property->state }}
                                </p>
                                <div class="flex justify-between items-center">
                                    <span class="font-bold" style="color: #80A1BA;">${{ number_format($property->price_per_night, 0) }}/night</span>
                                    <div class="flex space-x-2">
                                        <a href="{{ route('properties.edit', $property) }}" 
                                           class="inline-flex items-center px-2 py-1 rounded text-sm font-medium transition-colors hover:bg-blue-100" 
                                           style="color: #80A1BA;"
                                           title="Edit Property">
                                            <i class="fas fa-edit mr-1"></i>
                                            <span class="hidden sm:inline">Edit</span>
                                        </a>
                                        <form action="{{ route('properties.destroy', $property) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this property? This action cannot be undone.')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                   class="inline-flex items-center px-3 py-2 text-sm font-medium text-red-600 hover:text-red-700 hover:bg-red-50 rounded-md transition-all duration-200"
                                                   title="Delete Property">
                                                <i class="fas fa-trash mr-1"></i>
                                                <span class="hidden sm:inline">Delete</span>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="text-center py-12">
                        <i class="fas fa-home text-6xl text-gray-300 mb-4"></i>
                        <p class="text-gray-600 mb-4">No properties listed yet</p>
                        <a href="{{ route('properties.create') }}" class="text-white px-6 py-3 rounded-lg inline-block" style="background-color: #80A1BA;">
                            <i class="fas fa-plus mr-2"></i> Add Your First Property
                        </a>
                    </div>
                    @endif
                </div>
            </div>
            
            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <!-- Quick Actions -->
                <div class="bg-white rounded-lg shadow-md p-6 mb-8">
                    <h2 class="text-xl font-bold mb-4">Quick Actions</h2>
                    <div class="space-y-3">
                        <a href="{{ route('properties.create') }}" 
                           class="block text-white text-center py-3 rounded-lg font-semibold" style="background-color: #80A1BA; transition: opacity 0.3s;" onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'">
                            <i class="fas fa-plus mr-2"></i> Add Property
                        </a>
                        <a href="/owner/bookings" 
                           class="block border-2 text-center py-3 rounded-lg font-semibold" style="border-color: #80A1BA; color: #80A1BA; transition: background 0.3s;" onmouseover="this.style.backgroundColor='rgba(180, 222, 189, 0.2)'" onmouseout="this.style.backgroundColor=''">
                            <i class="fas fa-calendar mr-2"></i> View Bookings
                        </a>
                        <a href="/profile" 
                           class="block border-2 border-gray-300 text-gray-700 text-center py-3 rounded-lg hover:bg-gray-50 font-semibold">
                            <i class="fas fa-user mr-2"></i> My Profile
                        </a>
                    </div>
                </div>
                
                <!-- Earnings Summary -->
                <div class="bg-white rounded-lg shadow-md p-6 mb-8">
                    <h2 class="text-xl font-bold mb-4">Earnings Summary</h2>
                    <div class="space-y-4">
                        <div>
                            <div class="flex justify-between mb-2">
                                <span class="text-gray-600">Total Earnings</span>
                                <span class="font-bold" style="color: #80A1BA;">${{ number_format($totalEarnings, 0) }}</span>
                            </div>
                            <div class="bg-gray-200 h-2 rounded-full">
                                <div class="h-2 rounded-full" style="width: {{ $totalEarnings > 0 ? '100' : '0' }}%; background-color: #80A1BA;"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between mb-2">
                                <span class="text-gray-600">Bookings</span>
                                <span class="font-bold">{{ $totalBookings }}</span>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between mb-2">
                                <span class="text-gray-600">Properties</span>
                                <span class="font-bold">{{ $totalProperties }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Property Status -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-bold mb-4">Property Status</h2>
                    @if($properties->count() > 0)
                    <div class="space-y-3">
                        @foreach($properties->take(3) as $property)
                        <div class="flex items-center justify-between p-3 rounded" style="background-color: rgba(180, 222, 189, 0.1);">
                            <div>
                                <h4 class="font-semibold text-sm">{{ Str::limit($property->title, 20) }}</h4>
                                <p class="text-xs text-gray-600">{{ $property->city }}, {{ $property->state }}</p>
                            </div>
                            <span class="px-2 py-1 rounded text-xs font-semibold" style="background-color: #B4DEBD; color: #2d5a3d;">
                                Active
                            </span>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="text-center py-8">
                        <i class="fas fa-home text-4xl text-gray-300 mb-2"></i>
                        <p class="text-gray-600 text-sm">No properties yet</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
