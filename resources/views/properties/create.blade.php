@extends('layouts.app')

@section('title', 'Add New Property')

@section('content')
<div class="max-w-4xl mx-auto py-8 px-4">
    <div class="bg-white rounded-lg shadow-lg p-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Add a New Property</h1>

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                <p class="font-bold">Please fix the following errors:</p>
                <ul class="list-disc list-inside mt-2">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('properties.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-8">
                <h2 class="text-xl font-semibold text-gray-700 mb-4 border-b pb-2">Basic Information</h2>
                
                <div class="mb-4">
                    <label for="title" class="block text-gray-700 font-medium mb-2">Property Title *</label>
                    <input 
                        type="text" 
                        id="title" 
                        name="title" 
                        value="{{ old('title') }}"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('title') border-red-500 @enderror"
                        placeholder="e.g., Luxury Beachfront Villa with Pool"
                        required
                    >
                    @error('title')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-gray-700 font-medium mb-2">Description *</label>
                    <textarea 
                        id="description" 
                        name="description" 
                        rows="6"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('description') border-red-500 @enderror"
                        placeholder="Describe your property in detail (minimum 50 characters)..."
                        required
                    >{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="property_type" class="block text-gray-700 font-medium mb-2">Property Type *</label>
                    <select 
                        id="property_type" 
                        name="property_type" 
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('property_type') border-red-500 @enderror"
                        required
                    >
                        <option value="">Select Property Type</option>
                        <option value="apartment">Apartment</option>
                        <option value="house">House</option>
                        <option value="villa">Villa</option>
                        <option value="studio">Studio</option>
                        <option value="condo">Condo</option>
                        <option value="other">Other</option>
                    </select>
                    @error('property_type')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mb-8">
                <h2 class="text-xl font-semibold text-gray-700 mb-4 border-b pb-2">Location</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="md:col-span-2">
                        <label for="address" class="block text-gray-700 font-medium mb-2">Street Address *</label>
                        <input type="text" id="address" name="address" value="{{ old('address') }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="123 Main Street" required>
                    </div>

                    <div>
                        <label for="city" class="block text-gray-700 font-medium mb-2">City *</label>
                        <input type="text" id="city" name="city" value="{{ old('city') }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="e.g., Miami" required>
                    </div>

                    <div>
                        <label for="state" class="block text-gray-700 font-medium mb-2">State/Province *</label>
                        <input type="text" id="state" name="state" value="{{ old('state') }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="e.g., Florida" required>
                    </div>

                    <div>
                        <label for="country" class="block text-gray-700 font-medium mb-2">Country *</label>
                        <input type="text" id="country" name="country" value="{{ old('country') }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="e.g., USA" required>
                    </div>

                    <div>
                        <label for="zip_code" class="block text-gray-700 font-medium mb-2">ZIP/Postal Code</label>
                        <input type="text" id="zip_code" name="zip_code" value="{{ old('zip_code') }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="e.g., 33139">
                    </div>
                </div>
            </div>

            <div class="mb-8">
                <h2 class="text-xl font-semibold text-gray-700 mb-4 border-b pb-2">Property Details</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label for="bedrooms" class="block text-gray-700 font-medium mb-2">Bedrooms *</label>
                        <input type="number" id="bedrooms" name="bedrooms" value="{{ old('bedrooms', 1) }}" min="1" max="20" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>

                    <div>
                        <label for="bathrooms" class="block text-gray-700 font-medium mb-2">Bathrooms *</label>
                        <input type="number" id="bathrooms" name="bathrooms" value="{{ old('bathrooms', 1) }}" min="1" max="20" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>

                    <div>
                        <label for="max_guests" class="block text-gray-700 font-medium mb-2">Max Guests *</label>
                        <input type="number" id="max_guests" name="max_guests" value="{{ old('max_guests', 2) }}" min="1" max="50" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                </div>
            </div>

            <div class="mb-8">
                <h2 class="text-xl font-semibold text-gray-700 mb-4 border-b pb-2">Pricing</h2>
                <div>
                    <label for="price_per_night" class="block text-gray-700 font-medium mb-2">Price per Night ($) *</label>
                    <input type="number" id="price_per_night" name="price_per_night" value="{{ old('price_per_night') }}" min="1" max="10000" step="0.01" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="e.g., 150.00" required>
                </div>
            </div>

            <div class="mb-8">
                <h2 class="text-xl font-semibold text-gray-700 mb-4 border-b pb-2">Property Image</h2>
                <div>
                    <label for="image" class="block text-gray-700 font-medium mb-2">Upload Image</label>
                    <input type="file" id="image" name="image" accept="image/*" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                    <p class="text-gray-500 text-sm mt-1">Optional: Upload a property image (JPG, PNG, max 2MB)</p>
                </div>
            </div>

            <div class="flex gap-4 mt-8">
                <button type="submit" class="flex-1 bg-blue-600 text-white py-3 px-6 rounded-lg hover:bg-blue-700 font-semibold transition">Create Property</button>
                <a href="{{ route('owner.dashboard') }}" class="flex-1 bg-gray-500 text-white py-3 px-6 rounded-lg hover:bg-gray-600 font-semibold transition text-center">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
