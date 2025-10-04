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
                    <select name="type" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-purple-600 outline-none">
                        <option value="">All Types</option>
                        <option value="apartment">Apartment</option>
                        <option value="house">House</option>
                        <option value="villa">Villa</option>
                        <option value="studio">Studio</option>
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
                        <i class="fas fa-search mr-2"></i> Search
                    </button>
                    <button type="button" class="ml-4 text-gray-600 hover:text-gray-800">
                        <i class="fas fa-sliders-h mr-2"></i> More Filters
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Property Listings -->
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <p class="text-gray-600">Showing 150+ properties</p>
        <div class="flex items-center space-x-4">
            <label class="text-gray-600">Sort by:</label>
            <select class="px-4 py-2 border rounded-lg focus:ring-2 focus:ring-purple-600 outline-none">
                <option>Recommended</option>
                <option>Price: Low to High</option>
                <option>Price: High to Low</option>
                <option>Rating</option>
                <option>Newest</option>
            </select>
        </div>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Property Card 1 -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover-scale property-card">
            <div class="relative">
                <img src="https://images.unsplash.com/photo-1568605114967-8130f3a36994?w=500" 
                     alt="Property" class="w-full h-64 object-cover">
                <button class="absolute top-4 right-4 bg-white rounded-full p-2 hover:bg-red-500 hover:text-white transition">
                    <i class="far fa-heart"></i>
                </button>
                <span class="absolute top-4 left-4 bg-purple-600 text-white px-3 py-1 rounded-full text-sm font-semibold">
                    Featured
                </span>
            </div>
            <div class="p-4">
                <div class="flex justify-between items-start mb-2">
                    <h3 class="font-semibold text-lg">Modern Apartment</h3>
                    <div class="flex items-center text-yellow-500">
                        <i class="fas fa-star"></i>
                        <span class="ml-1 text-gray-700 font-semibold">4.8</span>
                    </div>
                </div>
                <p class="text-gray-600 text-sm mb-2">
                    <i class="fas fa-map-marker-alt mr-1"></i> New York, USA
                </p>
                <div class="flex items-center text-gray-600 text-sm mb-3 space-x-4">
                    <span><i class="fas fa-bed mr-1"></i> 2 Beds</span>
                    <span><i class="fas fa-bath mr-1"></i> 2 Baths</span>
                    <span><i class="fas fa-users mr-1"></i> 4 Guests</span>
                </div>
                <div class="flex justify-between items-center border-t pt-3">
                    <div>
                        <span class="text-2xl font-bold text-purple-600">$120</span>
                        <span class="text-gray-600 text-sm">/night</span>
                    </div>
                    <a href="/property/1" class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700">
                        View
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Property Card 2 -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover-scale property-card">
            <div class="relative">
                <img src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?w=500" 
                     alt="Property" class="w-full h-64 object-cover">
                <button class="absolute top-4 right-4 bg-white rounded-full p-2 hover:bg-red-500 hover:text-white transition">
                    <i class="far fa-heart"></i>
                </button>
            </div>
            <div class="p-4">
                <div class="flex justify-between items-start mb-2">
                    <h3 class="font-semibold text-lg">Luxury Beach Villa</h3>
                    <div class="flex items-center text-yellow-500">
                        <i class="fas fa-star"></i>
                        <span class="ml-1 text-gray-700 font-semibold">4.9</span>
                    </div>
                </div>
                <p class="text-gray-600 text-sm mb-2">
                    <i class="fas fa-map-marker-alt mr-1"></i> Miami, Florida
                </p>
                <div class="flex items-center text-gray-600 text-sm mb-3 space-x-4">
                    <span><i class="fas fa-bed mr-1"></i> 4 Beds</span>
                    <span><i class="fas fa-bath mr-1"></i> 3 Baths</span>
                    <span><i class="fas fa-users mr-1"></i> 8 Guests</span>
                </div>
                <div class="flex justify-between items-center border-t pt-3">
                    <div>
                        <span class="text-2xl font-bold text-purple-600">$350</span>
                        <span class="text-gray-600 text-sm">/night</span>
                    </div>
                    <a href="/property/2" class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700">
                        View
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Property Card 3 -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover-scale property-card">
            <div class="relative">
                <img src="https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?w=500" 
                     alt="Property" class="w-full h-64 object-cover">
                <button class="absolute top-4 right-4 bg-white rounded-full p-2 hover:bg-red-500 hover:text-white transition">
                    <i class="far fa-heart"></i>
                </button>
            </div>
            <div class="p-4">
                <div class="flex justify-between items-start mb-2">
                    <h3 class="font-semibold text-lg">Cozy Studio</h3>
                    <div class="flex items-center text-yellow-500">
                        <i class="fas fa-star"></i>
                        <span class="ml-1 text-gray-700 font-semibold">4.7</span>
                    </div>
                </div>
                <p class="text-gray-600 text-sm mb-2">
                    <i class="fas fa-map-marker-alt mr-1"></i> San Francisco, CA
                </p>
                <div class="flex items-center text-gray-600 text-sm mb-3 space-x-4">
                    <span><i class="fas fa-bed mr-1"></i> 1 Bed</span>
                    <span><i class="fas fa-bath mr-1"></i> 1 Bath</span>
                    <span><i class="fas fa-users mr-1"></i> 2 Guests</span>
                </div>
                <div class="flex justify-between items-center border-t pt-3">
                    <div>
                        <span class="text-2xl font-bold text-purple-600">$85</span>
                        <span class="text-gray-600 text-sm">/night</span>
                    </div>
                    <a href="/property/3" class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700">
                        View
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Property Card 4 -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover-scale property-card">
            <div class="relative">
                <img src="https://images.unsplash.com/photo-1564013799919-ab600027ffc6?w=500" 
                     alt="Property" class="w-full h-64 object-cover">
                <button class="absolute top-4 right-4 bg-white rounded-full p-2 hover:bg-red-500 hover:text-white transition">
                    <i class="far fa-heart"></i>
                </button>
            </div>
            <div class="p-4">
                <div class="flex justify-between items-start mb-2">
                    <h3 class="font-semibold text-lg">Family House</h3>
                    <div class="flex items-center text-yellow-500">
                        <i class="fas fa-star"></i>
                        <span class="ml-1 text-gray-700 font-semibold">4.6</span>
                    </div>
                </div>
                <p class="text-gray-600 text-sm mb-2">
                    <i class="fas fa-map-marker-alt mr-1"></i> Los Angeles, CA
                </p>
                <div class="flex items-center text-gray-600 text-sm mb-3 space-x-4">
                    <span><i class="fas fa-bed mr-1"></i> 3 Beds</span>
                    <span><i class="fas fa-bath mr-1"></i> 2 Baths</span>
                    <span><i class="fas fa-users mr-1"></i> 6 Guests</span>
                </div>
                <div class="flex justify-between items-center border-t pt-3">
                    <div>
                        <span class="text-2xl font-bold text-purple-600">$180</span>
                        <span class="text-gray-600 text-sm">/night</span>
                    </div>
                    <a href="/property/4" class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700">
                        View
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Property Card 5 -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover-scale property-card">
            <div class="relative">
                <img src="https://images.unsplash.com/photo-1493809842364-78817add7ffb?w=500" 
                     alt="Property" class="w-full h-64 object-cover">
                <button class="absolute top-4 right-4 bg-white rounded-full p-2 hover:bg-red-500 hover:text-white transition">
                    <i class="far fa-heart"></i>
                </button>
            </div>
            <div class="p-4">
                <div class="flex justify-between items-start mb-2">
                    <h3 class="font-semibold text-lg">Mountain Cabin</h3>
                    <div class="flex items-center text-yellow-500">
                        <i class="fas fa-star"></i>
                        <span class="ml-1 text-gray-700 font-semibold">4.9</span>
                    </div>
                </div>
                <p class="text-gray-600 text-sm mb-2">
                    <i class="fas fa-map-marker-alt mr-1"></i> Aspen, Colorado
                </p>
                <div class="flex items-center text-gray-600 text-sm mb-3 space-x-4">
                    <span><i class="fas fa-bed mr-1"></i> 3 Beds</span>
                    <span><i class="fas fa-bath mr-1"></i> 2 Baths</span>
                    <span><i class="fas fa-users mr-1"></i> 5 Guests</span>
                </div>
                <div class="flex justify-between items-center border-t pt-3">
                    <div>
                        <span class="text-2xl font-bold text-purple-600">$220</span>
                        <span class="text-gray-600 text-sm">/night</span>
                    </div>
                    <a href="/property/5" class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700">
                        View
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Property Card 6 -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover-scale property-card">
            <div class="relative">
                <img src="https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?w=500" 
                     alt="Property" class="w-full h-64 object-cover">
                <button class="absolute top-4 right-4 bg-white rounded-full p-2 hover:bg-red-500 hover:text-white transition">
                    <i class="far fa-heart"></i>
                </button>
                <span class="absolute top-4 left-4 bg-green-600 text-white px-3 py-1 rounded-full text-sm font-semibold">
                    New
                </span>
            </div>
            <div class="p-4">
                <div class="flex justify-between items-start mb-2">
                    <h3 class="font-semibold text-lg">Penthouse Suite</h3>
                    <div class="flex items-center text-yellow-500">
                        <i class="fas fa-star"></i>
                        <span class="ml-1 text-gray-700 font-semibold">5.0</span>
                    </div>
                </div>
                <p class="text-gray-600 text-sm mb-2">
                    <i class="fas fa-map-marker-alt mr-1"></i> Chicago, Illinois
                </p>
                <div class="flex items-center text-gray-600 text-sm mb-3 space-x-4">
                    <span><i class="fas fa-bed mr-1"></i> 2 Beds</span>
                    <span><i class="fas fa-bath mr-1"></i> 2 Baths</span>
                    <span><i class="fas fa-users mr-1"></i> 4 Guests</span>
                </div>
                <div class="flex justify-between items-center border-t pt-3">
                    <div>
                        <span class="text-2xl font-bold text-purple-600">$280</span>
                        <span class="text-gray-600 text-sm">/night</span>
                    </div>
                    <a href="/property/6" class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700">
                        View
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Pagination -->
    <div class="flex justify-center mt-12">
        <nav class="flex space-x-2">
            <button class="px-4 py-2 border rounded-lg hover:bg-gray-100">Previous</button>
            <button class="px-4 py-2 bg-purple-600 text-white rounded-lg">1</button>
            <button class="px-4 py-2 border rounded-lg hover:bg-gray-100">2</button>
            <button class="px-4 py-2 border rounded-lg hover:bg-gray-100">3</button>
            <button class="px-4 py-2 border rounded-lg hover:bg-gray-100">4</button>
            <button class="px-4 py-2 border rounded-lg hover:bg-gray-100">Next</button>
        </nav>
    </div>
</div>
@endsection
