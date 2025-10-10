@extends('layouts.app')

@section('title', 'Edit Property')

@section('content')
<div class="max-w-4xl mx-auto py-8 px-4">
    <div class="bg-white rounded-lg shadow-lg p-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Edit Property</h1>
        
        {{-- Display Validation Errors --}}
        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                <p class="font-bold">Please correct the following errors:</p>
                <ul class="list-disc list-inside mt-2">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        {{-- Property Edit Form (Demonstrates @csrf, @method('PUT'), Pre-filled values) --}}
        <form method="POST" action="{{ route('properties.update', $property) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            {{-- Basic Information Section --}}
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-gray-700 mb-4 border-b pb-2">Basic Information</h2>
                
                {{-- Property Title --}}
                <div class="mb-4">
                    <label for="title" class="block text-gray-700 font-medium mb-2">Property Title *</label>
                    <input 
                        type="text" 
                        id="title" 
                        name="title" 
                        value="{{ old('title', $property->title) }}"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('title') border-red-500 @enderror"
                        required
                    >
                    @error('title')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                {{-- Description --}}
                <div class="mb-4">
                    <label for="description" class="block text-gray-700 font-medium mb-2">Description *</label>
                    <textarea 
                        id="description" 
                        name="description" 
                        rows="6"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('description') border-red-500 @enderror"
                        required
                    >{{ old('description', $property->description) }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                {{-- Property Type --}}
                <div class="mb-4">
                    <label for="type" class="block text-gray-700 font-medium mb-2">Property Type *</label>
                    <select 
                        id="type" 
                        name="type" 
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('type') border-red-500 @enderror"
                        required
                    >
                        @foreach(['apartment' => 'Apartment', 'house' => 'House', 'villa' => 'Villa', 'studio' => 'Studio', 'condo' => 'Condo', 'other' => 'Other'] as $value => $label)
                            <option value="{{ $value }}" {{ old('type', $property->type) == $value ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                    @error('type')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                {{-- Status (Only for owners/admins) --}}
                <div class="mb-4">
                    <label for="status" class="block text-gray-700 font-medium mb-2">Status *</label>
                    <select 
                        id="status" 
                        name="status" 
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required
                    >
                        <option value="active" {{ old('status', $property->status) == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status', $property->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        <option value="pending" {{ old('status', $property->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                    </select>
                </div>
            </div>
            
            {{-- Location Section --}}
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-gray-700 mb-4 border-b pb-2">Location</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="md:col-span-2">
                        <label for="address" class="block text-gray-700 font-medium mb-2">Street Address *</label>
                        <input 
                            type="text" 
                            id="address" 
                            name="address" 
                            value="{{ old('address', $property->address) }}"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('address') border-red-500 @enderror"
                            required
                        >
                        @error('address')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="city" class="block text-gray-700 font-medium mb-2">City *</label>
                        <input 
                            type="text" 
                            id="city" 
                            name="city" 
                            value="{{ old('city', $property->city) }}"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('city') border-red-500 @enderror"
                            required
                        >
                        @error('city')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="state" class="block text-gray-700 font-medium mb-2">State/Province</label>
                        <input 
                            type="text" 
                            id="state" 
                            name="state" 
                            value="{{ old('state', $property->state) }}"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                    </div>
                    
                    <div>
                        <label for="country" class="block text-gray-700 font-medium mb-2">Country *</label>
                        <input 
                            type="text" 
                            id="country" 
                            name="country" 
                            value="{{ old('country', $property->country) }}"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('country') border-red-500 @enderror"
                            required
                        >
                        @error('country')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="zip_code" class="block text-gray-700 font-medium mb-2">ZIP/Postal Code</label>
                        <input 
                            type="text" 
                            id="zip_code" 
                            name="zip_code" 
                            value="{{ old('zip_code', $property->zip_code) }}"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                    </div>
                </div>
            </div>
            
            {{-- Property Details Section --}}
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-gray-700 mb-4 border-b pb-2">Property Details</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label for="bedrooms" class="block text-gray-700 font-medium mb-2">Bedrooms *</label>
                        <input 
                            type="number" 
                            id="bedrooms" 
                            name="bedrooms" 
                            value="{{ old('bedrooms', $property->bedrooms) }}"
                            min="1" 
                            max="20"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('bedrooms') border-red-500 @enderror"
                            required
                        >
                        @error('bedrooms')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="bathrooms" class="block text-gray-700 font-medium mb-2">Bathrooms *</label>
                        <input 
                            type="number" 
                            id="bathrooms" 
                            name="bathrooms" 
                            value="{{ old('bathrooms', $property->bathrooms) }}"
                            min="1" 
                            max="20"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('bathrooms') border-red-500 @enderror"
                            required
                        >
                        @error('bathrooms')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="max_guests" class="block text-gray-700 font-medium mb-2">Max Guests *</label>
                        <input 
                            type="number" 
                            id="max_guests" 
                            name="max_guests" 
                            value="{{ old('max_guests', $property->max_guests) }}"
                            min="1" 
                            max="50"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('max_guests') border-red-500 @enderror"
                            required
                        >
                        @error('max_guests')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
            
            {{-- Pricing Section --}}
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-gray-700 mb-4 border-b pb-2">Pricing</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label for="price_per_night" class="block text-gray-700 font-medium mb-2">Price per Night ($) *</label>
                        <input 
                            type="number" 
                            id="price_per_night" 
                            name="price_per_night" 
                            value="{{ old('price_per_night', $property->price_per_night) }}"
                            min="1" 
                            max="10000"
                            step="0.01"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('price_per_night') border-red-500 @enderror"
                            required
                        >
                        @error('price_per_night')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="cleaning_fee" class="block text-gray-700 font-medium mb-2">Cleaning Fee ($)</label>
                        <input 
                            type="number" 
                            id="cleaning_fee" 
                            name="cleaning_fee" 
                            value="{{ old('cleaning_fee', $property->cleaning_fee) }}"
                            min="0" 
                            max="1000"
                            step="0.01"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                    </div>
                    
                    <div>
                        <label for="service_fee" class="block text-gray-700 font-medium mb-2">Service Fee ($)</label>
                        <input 
                            type="number" 
                            id="service_fee" 
                            name="service_fee" 
                            value="{{ old('service_fee', $property->service_fee) }}"
                            min="0" 
                            max="1000"
                            step="0.01"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                    </div>
                </div>
            </div>
            
            {{-- Amenities Section --}}
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-gray-700 mb-4 border-b pb-2">Amenities</h2>
                
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    @foreach($amenities as $amenity)
                        <div class="flex items-center">
                            <input 
                                type="checkbox" 
                                id="amenity_{{ $amenity->id }}" 
                                name="amenities[]" 
                                value="{{ $amenity->id }}"
                                {{ in_array($amenity->id, old('amenities', $propertyAmenities)) ? 'checked' : '' }}
                                class="w-4 h-4 text-blue-600 focus:ring-2 focus:ring-blue-500"
                            >
                            <label for="amenity_{{ $amenity->id }}" class="ml-2 text-gray-700">
                                <i class="{{ $amenity->icon }} mr-1"></i> {{ $amenity->name }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
            
            {{-- Form Actions --}}
            <div class="flex justify-between items-center mt-8">
                {{-- Delete Button (Demonstrates @method('DELETE')) --}}
                <form method="POST" action="{{ route('properties.destroy', $property) }}" onsubmit="return confirm('Are you sure you want to delete this property?');">
                    @csrf
                    @method('DELETE')
                    <button 
                        type="submit" 
                        class="px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition"
                    >
                        Delete Property
                    </button>
                </form>
                
                <div class="flex space-x-4">
                    <a href="{{ route('properties.show', $property) }}" class="px-6 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition">
                        Cancel
                    </a>
                    <button 
                        type="submit" 
                        class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition"
                    >
                        Update Property
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
