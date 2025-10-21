@extends('layouts.app')

@section('title', 'My Dashboard - StayHub')

@section('content')
<div class="bg-gray-100 min-h-screen">
    <!-- Dashboard Header -->
    <div class="bg-white shadow-sm">
        <div class="container mx-auto px-4 py-6">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold">My Dashboard</h1>
                    <p class="text-gray-600">Manage your bookings and favorites</p>
                </div>
                <a href="/properties" class="bg-purple-600 text-white px-6 py-3 rounded-lg hover:bg-purple-700 font-semibold">
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
                        <h3 class="text-3xl font-bold mt-2">3</h3>
                        <p class="text-purple-600 text-sm mt-1">Next: Dec 15</p>
                    </div>
                    <div class="bg-purple-100 p-4 rounded-full">
                        <i class="fa-solid fa-suitcase text-2xl text-purple-600"></i>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-semibold">Total Bookings</p>
                        <h3 class="text-3xl font-bold mt-2">15</h3>
                        <p class="text-green-600 text-sm mt-1">
                            <i class="fa-solid fa-arrow-up mr-1"></i> 3 this year
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
                        <p class="text-gray-600 text-sm font-semibold">Favorite Properties</p>
                        <h3 class="text-3xl font-bold mt-2">8</h3>
                        <p class="text-red-600 text-sm mt-1">
                            <i class="fas fa-heart mr-1"></i> Saved
                        </p>
                    </div>
                    <div class="bg-red-100 p-4 rounded-full">
                        <i class="fas fa-heart text-2xl text-red-600"></i>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-semibold">Total Spent</p>
                        <h3 class="text-3xl font-bold mt-2">$4,250</h3>
                        <p class="text-gray-500 text-sm mt-1">This year</p>
                    </div>
                    <div class="bg-green-100 p-4 rounded-full">
                        <i class="fas fa-dollar-sign text-2xl text-green-600"></i>
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
                        <a href="/customer/bookings" class="text-purple-600 hover:text-purple-700 font-semibold">
                            View All <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                    
                    <div class="space-y-4">
                        <div class="border rounded-lg overflow-hidden hover:shadow-lg transition">
                            <div class="flex">
                                <img src="https://images.unsplash.com/photo-1568605114967-8130f3a36994?w=200" 
                                     alt="Property" class="w-32 h-32 object-cover">
                                <div class="flex-1 p-4">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h3 class="font-semibold text-lg">Modern Apartment</h3>
                                            <p class="text-gray-600 text-sm">
                                                <i class="fas fa-map-marker-alt mr-1"></i> New York, USA
                                            </p>
                                            <p class="text-gray-600 text-sm mt-1">
                                                <i class="fas fa-calendar mr-1"></i> Dec 15 - Dec 20, 2024
                                            </p>
                                            <p class="text-gray-600 text-sm">
                                                <i class="fas fa-users mr-1"></i> 2 Guests
                                            </p>
                                        </div>
                                        <div class="text-right">
                                            <span class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-sm font-semibold">
                                                Confirmed
                                            </span>
                                            <p class="font-bold text-lg mt-2">$600</p>
                                        </div>
                                    </div>
                                    <div class="flex space-x-2 mt-3">
                                        <button class="flex-1 bg-purple-600 text-white py-2 rounded-lg hover:bg-purple-700 text-sm font-semibold">
                                            View Details
                                        </button>
                                        <button class="border border-gray-300 px-4 py-2 rounded-lg hover:bg-gray-50 text-sm">
                                            <i class="fas fa-envelope"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="border rounded-lg overflow-hidden hover:shadow-lg transition">
                            <div class="flex">
                                <img src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?w=200" 
                                     alt="Property" class="w-32 h-32 object-cover">
                                <div class="flex-1 p-4">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h3 class="font-semibold text-lg">Beach Villa</h3>
                                            <p class="text-gray-600 text-sm">
                                                <i class="fas fa-map-marker-alt mr-1"></i> Miami, Florida
                                            </p>
                                            <p class="text-gray-600 text-sm mt-1">
                                                <i class="fas fa-calendar mr-1"></i> Dec 28 - Jan 2, 2025
                                            </p>
                                            <p class="text-gray-600 text-sm">
                                                <i class="fas fa-users mr-1"></i> 4 Guests
                                            </p>
                                        </div>
                                        <div class="text-right">
                                            <span class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-sm font-semibold">
                                                Confirmed
                                            </span>
                                            <p class="font-bold text-lg mt-2">$1,750</p>
                                        </div>
                                    </div>
                                    <div class="flex space-x-2 mt-3">
                                        <button class="flex-1 bg-purple-600 text-white py-2 rounded-lg hover:bg-purple-700 text-sm font-semibold">
                                            View Details
                                        </button>
                                        <button class="border border-gray-300 px-4 py-2 rounded-lg hover:bg-gray-50 text-sm">
                                            <i class="fas fa-envelope"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Past Bookings -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold">Past Trips</h2>
                        <a href="/customer/bookings?filter=past" class="text-purple-600 hover:text-purple-700 font-semibold">
                            View All <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                    
                    <div class="space-y-4">
                        <div class="border rounded-lg overflow-hidden hover:shadow-lg transition">
                            <div class="flex">
                                <img src="https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?w=200" 
                                     alt="Property" class="w-32 h-32 object-cover">
                                <div class="flex-1 p-4">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h3 class="font-semibold text-lg">Cozy Studio</h3>
                                            <p class="text-gray-600 text-sm">
                                                <i class="fas fa-map-marker-alt mr-1"></i> San Francisco, CA
                                            </p>
                                            <p class="text-gray-600 text-sm mt-1">
                                                <i class="fas fa-calendar mr-1"></i> Oct 10 - Oct 14, 2024
                                            </p>
                                            <div class="flex items-center mt-2">
                                                <div class="flex text-yellow-500">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                </div>
                                                <span class="text-sm text-gray-600 ml-2">You rated 5.0</span>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <span class="bg-gray-100 text-gray-600 px-3 py-1 rounded-full text-sm font-semibold">
                                                Completed
                                            </span>
                                            <p class="font-bold text-lg mt-2">$340</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <!-- Profile Card -->
                <div class="bg-white rounded-lg shadow-md p-6 mb-8">
                    <div class="text-center">
                        <img src="https://ui-avatars.com/api/?name=John+Doe&size=100" 
                             alt="Profile" class="w-24 h-24 rounded-full mx-auto mb-4">
                        <h3 class="text-xl font-bold">John Doe</h3>
                        <p class="text-gray-600">john.doe@email.com</p>
                        <div class="flex items-center justify-center mt-3">
                            <i class="fas fa-star text-yellow-500"></i>
                            <span class="ml-2 font-semibold">4.9 Guest Rating</span>
                        </div>
                        <a href="/profile" class="block mt-4 border-2 border-purple-600 text-purple-600 py-2 rounded-lg hover:bg-purple-50 font-semibold">
                            Edit Profile
                        </a>
                    </div>
                </div>
                
                <!-- Favorite Properties -->
                <div class="bg-white rounded-lg shadow-md p-6 mb-8">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-bold">Favorites</h2>
                        <a href="/customer/favorites" class="text-purple-600 hover:text-purple-700 text-sm font-semibold">
                            View All
                        </a>
                    </div>
                    
                    <div class="space-y-3">
                        <div class="border rounded-lg overflow-hidden hover:shadow-md transition cursor-pointer">
                            <img src="https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?w=300" 
                                 alt="Favorite" class="w-full h-32 object-cover">
                            <div class="p-3">
                                <h4 class="font-semibold text-sm">Penthouse Suite</h4>
                                <p class="text-xs text-gray-600">Chicago, Illinois</p>
                                <div class="flex justify-between items-center mt-2">
                                    <span class="text-purple-600 font-bold text-sm">$280/night</span>
                                    <button class="text-red-500 hover:text-red-600">
                                        <i class="fas fa-heart"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="border rounded-lg overflow-hidden hover:shadow-md transition cursor-pointer">
                            <img src="https://images.unsplash.com/photo-1493809842364-78817add7ffb?w=300" 
                                 alt="Favorite" class="w-full h-32 object-cover">
                            <div class="p-3">
                                <h4 class="font-semibold text-sm">Mountain Cabin</h4>
                                <p class="text-xs text-gray-600">Aspen, Colorado</p>
                                <div class="flex justify-between items-center mt-2">
                                    <span class="text-purple-600 font-bold text-sm">$220/night</span>
                                    <button class="text-red-500 hover:text-red-600">
                                        <i class="fas fa-heart"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Quick Links -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-bold mb-4">Quick Links</h2>
                    <div class="space-y-2">
                        <a href="/customer/bookings" 
                           class="flex items-center p-3 rounded-lg hover:bg-gray-50 text-gray-700">
                            <i class="fas fa-calendar-check w-8"></i>
                            <span>My Bookings</span>
                        </a>
                        <a href="/customer/favorites" 
                           class="flex items-center p-3 rounded-lg hover:bg-gray-50 text-gray-700">
                            <i class="fas fa-heart w-8"></i>
                            <span>Favorites</span>
                        </a>
                        <a href="/messages" 
                           class="flex items-center p-3 rounded-lg hover:bg-gray-50 text-gray-700">
                            <i class="fas fa-envelope w-8"></i>
                            <span>Messages</span>
                            <span class="ml-auto bg-red-500 text-white text-xs px-2 py-1 rounded-full">2</span>
                        </a>
                        <a href="/profile" 
                           class="flex items-center p-3 rounded-lg hover:bg-gray-50 text-gray-700">
                            <i class="fas fa-user w-8"></i>
                            <span>Profile Settings</span>
                        </a>
                        <a href="/help" 
                           class="flex items-center p-3 rounded-lg hover:bg-gray-50 text-gray-700">
                            <i class="fas fa-question-circle w-8"></i>
                            <span>Help Center</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
