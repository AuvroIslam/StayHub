@extends('layouts.app')

@section('title', 'Owner Dashboard - StayHub')

@section('content')
<div class="bg-gray-100 min-h-screen">
    <!-- Dashboard Header -->
    <div class="bg-white shadow-sm">
        <div class="container mx-auto px-4 py-6">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold">Property Owner Dashboard</h1>
                    <p class="text-gray-600">Manage your properties and bookings</p>
                </div>
                <a href="{{ route('properties.create') }}" class="bg-purple-600 text-white px-6 py-3 rounded-lg hover:bg-purple-700 font-semibold">
                    <i class="fa-solid fa-plus mr-2"></i> Add New Property
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
                        <p class="text-gray-600 text-sm font-semibold">Total Properties</p>
                        <h3 class="text-3xl font-bold mt-2">12</h3>
                        <p class="text-green-600 text-sm mt-1">
                            <i class="fa-solid fa-arrow-up mr-1"></i> 2 new
                        </p>
                    </div>
                    <div class="bg-purple-100 p-4 rounded-full">
                        <i class="fa-solid fa-building text-2xl text-purple-600"></i>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-semibold">Active Bookings</p>
                        <h3 class="text-3xl font-bold mt-2">28</h3>
                        <p class="text-green-600 text-sm mt-1">
                            <i class="fa-solid fa-arrow-up mr-1"></i> 5 this week
                        </p>
                    </div>
                    <div class="bg-blue-100 p-4 rounded-full">
                        <i class="fa-solid fa-calendar-check text-2xl text-blue-600"></i>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-semibold">Monthly Earnings</p>
                        <h3 class="text-3xl font-bold mt-2">$8,450</h3>
                        <p class="text-green-600 text-sm mt-1">
                            <i class="fas fa-arrow-up mr-1"></i> 12% increase
                        </p>
                    </div>
                    <div class="bg-green-100 p-4 rounded-full">
                        <i class="fas fa-dollar-sign text-2xl text-green-600"></i>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-semibold">Average Rating</p>
                        <h3 class="text-3xl font-bold mt-2">4.8</h3>
                        <p class="text-yellow-500 text-sm mt-1">
                            <i class="fas fa-star mr-1"></i> 156 reviews
                        </p>
                    </div>
                    <div class="bg-yellow-100 p-4 rounded-full">
                        <i class="fas fa-star text-2xl text-yellow-600"></i>
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
                        <a href="/owner/bookings" class="text-purple-600 hover:text-purple-700 font-semibold">
                            View All <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                    
                    <div class="space-y-4">
                        <div class="border rounded-lg p-4 hover:bg-gray-50">
                            <div class="flex justify-between items-start">
                                <div class="flex-1">
                                    <h3 class="font-semibold text-lg">Modern Apartment in City Center</h3>
                                    <p class="text-gray-600 text-sm mt-1">
                                        <i class="fas fa-user mr-1"></i> Sarah Johnson
                                    </p>
                                    <p class="text-gray-600 text-sm">
                                        <i class="fas fa-calendar mr-1"></i> Dec 15 - Dec 20, 2024
                                    </p>
                                </div>
                                <div class="text-right">
                                    <span class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-sm font-semibold">
                                        Confirmed
                                    </span>
                                    <p class="font-bold text-lg mt-2">$600</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="border rounded-lg p-4 hover:bg-gray-50">
                            <div class="flex justify-between items-start">
                                <div class="flex-1">
                                    <h3 class="font-semibold text-lg">Luxury Beach Villa</h3>
                                    <p class="text-gray-600 text-sm mt-1">
                                        <i class="fas fa-user mr-1"></i> Mike Thompson
                                    </p>
                                    <p class="text-gray-600 text-sm">
                                        <i class="fas fa-calendar mr-1"></i> Dec 22 - Dec 28, 2024
                                    </p>
                                </div>
                                <div class="text-right">
                                    <span class="bg-yellow-100 text-yellow-600 px-3 py-1 rounded-full text-sm font-semibold">
                                        Pending
                                    </span>
                                    <p class="font-bold text-lg mt-2">$2,100</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="border rounded-lg p-4 hover:bg-gray-50">
                            <div class="flex justify-between items-start">
                                <div class="flex-1">
                                    <h3 class="font-semibold text-lg">Cozy Studio Downtown</h3>
                                    <p class="text-gray-600 text-sm mt-1">
                                        <i class="fas fa-user mr-1"></i> Emily Davis
                                    </p>
                                    <p class="text-gray-600 text-sm">
                                        <i class="fas fa-calendar mr-1"></i> Dec 18 - Dec 21, 2024
                                    </p>
                                </div>
                                <div class="text-right">
                                    <span class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-sm font-semibold">
                                        Confirmed
                                    </span>
                                    <p class="font-bold text-lg mt-2">$255</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- My Properties -->
                <div class="bg-white rounded-lg shadow-md p-6 mt-8">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold">My Properties</h2>
                        <a href="/owner/properties" class="text-purple-600 hover:text-purple-700 font-semibold">
                            View All <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="border rounded-lg overflow-hidden hover:shadow-lg transition">
                            <img src="https://images.unsplash.com/photo-1568605114967-8130f3a36994?w=300" 
                                 alt="Property" class="w-full h-40 object-cover">
                            <div class="p-4">
                                <h3 class="font-semibold mb-2">Modern Apartment</h3>
                                <p class="text-sm text-gray-600 mb-2">
                                    <i class="fas fa-map-marker-alt mr-1"></i> New York
                                </p>
                                <div class="flex justify-between items-center">
                                    <span class="text-purple-600 font-bold">$120/night</span>
                                    <div class="flex space-x-2">
                                        <button class="text-blue-600 hover:text-blue-700">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="text-red-600 hover:text-red-700">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="border rounded-lg overflow-hidden hover:shadow-lg transition">
                            <img src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?w=300" 
                                 alt="Property" class="w-full h-40 object-cover">
                            <div class="p-4">
                                <h3 class="font-semibold mb-2">Beach Villa</h3>
                                <p class="text-sm text-gray-600 mb-2">
                                    <i class="fas fa-map-marker-alt mr-1"></i> Miami
                                </p>
                                <div class="flex justify-between items-center">
                                    <span class="text-purple-600 font-bold">$350/night</span>
                                    <div class="flex space-x-2">
                                        <button class="text-blue-600 hover:text-blue-700">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="text-red-600 hover:text-red-700">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <!-- Quick Actions -->
                <div class="bg-white rounded-lg shadow-md p-6 mb-8">
                    <h2 class="text-xl font-bold mb-4">Quick Actions</h2>
                    <div class="space-y-3">
                        <a href="{{ route('properties.create') }}" 
                           class="block bg-purple-600 text-white text-center py-3 rounded-lg hover:bg-purple-700 font-semibold">
                            <i class="fas fa-plus mr-2"></i> Add Property
                        </a>
                        <a href="/owner/bookings" 
                           class="block border-2 border-purple-600 text-purple-600 text-center py-3 rounded-lg hover:bg-purple-50 font-semibold">
                            <i class="fas fa-calendar mr-2"></i> View Bookings
                        </a>
                        <a href="/owner/earnings" 
                           class="block border-2 border-gray-300 text-gray-700 text-center py-3 rounded-lg hover:bg-gray-50 font-semibold">
                            <i class="fas fa-chart-line mr-2"></i> Earnings Report
                        </a>
                    </div>
                </div>
                
                <!-- Earnings Overview -->
                <div class="bg-white rounded-lg shadow-md p-6 mb-8">
                    <h2 class="text-xl font-bold mb-4">Earnings Overview</h2>
                    <div class="space-y-4">
                        <div>
                            <div class="flex justify-between mb-2">
                                <span class="text-gray-600">This Month</span>
                                <span class="font-bold">$8,450</span>
                            </div>
                            <div class="bg-gray-200 h-2 rounded-full">
                                <div class="bg-purple-600 h-2 rounded-full" style="width: 85%"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between mb-2">
                                <span class="text-gray-600">Total Earnings</span>
                                <span class="font-bold">$52,380</span>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between mb-2">
                                <span class="text-gray-600">Pending Payout</span>
                                <span class="font-bold text-yellow-600">$2,150</span>
                            </div>
                        </div>
                        <button class="w-full bg-green-600 text-white py-2 rounded-lg hover:bg-green-700 font-semibold mt-4">
                            Request Payout
                        </button>
                    </div>
                </div>
                
                <!-- Recent Messages -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-bold">Messages</h2>
                        <span class="bg-red-500 text-white text-xs px-2 py-1 rounded-full">3</span>
                    </div>
                    <div class="space-y-3">
                        <div class="flex items-start hover:bg-gray-50 p-2 rounded cursor-pointer">
                            <img src="https://ui-avatars.com/api/?name=Sarah+J&size=40" 
                                 alt="User" class="w-10 h-10 rounded-full mr-3">
                            <div class="flex-1">
                                <h4 class="font-semibold text-sm">Sarah Johnson</h4>
                                <p class="text-xs text-gray-600">Question about check-in time</p>
                                <span class="text-xs text-gray-500">2 hours ago</span>
                            </div>
                        </div>
                        <div class="flex items-start hover:bg-gray-50 p-2 rounded cursor-pointer">
                            <img src="https://ui-avatars.com/api/?name=Mike+T&size=40" 
                                 alt="User" class="w-10 h-10 rounded-full mr-3">
                            <div class="flex-1">
                                <h4 class="font-semibold text-sm">Mike Thompson</h4>
                                <p class="text-xs text-gray-600">Thanks for the quick response!</p>
                                <span class="text-xs text-gray-500">5 hours ago</span>
                            </div>
                        </div>
                    </div>
                    <a href="/messages" class="block text-center text-purple-600 hover:text-purple-700 font-semibold mt-4">
                        View All Messages
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
