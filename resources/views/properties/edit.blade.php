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
                    <label for="property_type" class="block text-gray-700 font-medium mb-2">Property Type *</label>
                    <select 
                        id="property_type" 
                        name="property_type" 
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('property_type') border-red-500 @enderror"
                        required
                    >
                        <option value="">Select Property Type</option>
                        @foreach(['apartment' => 'Apartment', 'house' => 'House', 'villa' => 'Villa', 'studio' => 'Studio', 'condo' => 'Condo', 'other' => 'Other'] as $value => $label)
                            <option value="{{ $value }}" {{ old('property_type', $property->property_type) == $value ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                    @error('property_type')
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
            
            {{-- Image Upload Section --}}
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-gray-700 mb-4 border-b pb-2">Property Images</h2>
                <p class="text-gray-600 mb-4">Upload new images to replace existing ones (optional)</p>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    {{-- Main Image --}}
                    <div>
                        <label for="image" class="block text-gray-700 font-medium mb-2">Main Image</label>
                        @if($property->image)
                            <div class="mb-2">
                                <img src="{{ Storage::url($property->image) }}" alt="Current main image" class="w-full h-32 object-cover rounded-lg border">
                                <p class="text-sm text-gray-500 mt-1">Current main image</p>
                            </div>
                        @endif
                        <input type="file" id="image" name="image" accept="image/*" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 @error('image') border-red-500 @enderror">
                        @error('image')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Image 2 --}}
                    <div>
                        <label for="image_2" class="block text-gray-700 font-medium mb-2">Image 2</label>
                        @if($property->image_2)
                            <div class="mb-2">
                                <img src="{{ Storage::url($property->image_2) }}" alt="Current image 2" class="w-full h-32 object-cover rounded-lg border">
                                <p class="text-sm text-gray-500 mt-1">Current image 2</p>
                            </div>
                        @endif
                        <input type="file" id="image_2" name="image_2" accept="image/*" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 @error('image_2') border-red-500 @enderror">
                        @error('image_2')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Image 3 --}}
                    <div>
                        <label for="image_3" class="block text-gray-700 font-medium mb-2">Image 3</label>
                        @if($property->image_3)
                            <div class="mb-2">
                                <img src="{{ Storage::url($property->image_3) }}" alt="Current image 3" class="w-full h-32 object-cover rounded-lg border">
                                <p class="text-sm text-gray-500 mt-1">Current image 3</p>
                            </div>
                        @endif
                        <input type="file" id="image_3" name="image_3" accept="image/*" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 @error('image_3') border-red-500 @enderror">
                        @error('image_3')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Image 4 --}}
                    <div>
                        <label for="image_4" class="block text-gray-700 font-medium mb-2">Image 4</label>
                        @if($property->image_4)
                            <div class="mb-2">
                                <img src="{{ Storage::url($property->image_4) }}" alt="Current image 4" class="w-full h-32 object-cover rounded-lg border">
                                <p class="text-sm text-gray-500 mt-1">Current image 4</p>
                            </div>
                        @endif
                        <input type="file" id="image_4" name="image_4" accept="image/*" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 @error('image_4') border-red-500 @enderror">
                        @error('image_4')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Image 5 --}}
                    <div>
                        <label for="image_5" class="block text-gray-700 font-medium mb-2">Image 5</label>
                        @if($property->image_5)
                            <div class="mb-2">
                                <img src="{{ Storage::url($property->image_5) }}" alt="Current image 5" class="w-full h-32 object-cover rounded-lg border">
                                <p class="text-sm text-gray-500 mt-1">Current image 5</p>
                            </div>
                        @endif
                        <input type="file" id="image_5" name="image_5" accept="image/*" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 @error('image_5') border-red-500 @enderror">
                        @error('image_5')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
            
            {{-- Form Actions --}}
            <div class="flex justify-end space-x-4 mt-8">
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
        </form>
        
        {{-- Delete Button (Separate Form) --}}
        <div class="mt-6 pt-6 border-t border-gray-200">
            <form method="POST" action="{{ route('properties.destroy', $property) }}" onsubmit="return confirm('Are you sure you want to delete this property? This action cannot be undone.');">
                @csrf
                @method('DELETE')
                <button 
                    type="submit" 
                    class="px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition"
                >
                    <i class="fas fa-trash mr-2"></i>
                    Delete Property
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
