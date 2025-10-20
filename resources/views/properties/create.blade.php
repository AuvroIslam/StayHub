@extends('layouts.app')@extends('layouts.app')



@section('title', 'Add New Property')@section('title', 'Create New Property')



@section('content')@section('content')

<div class="max-w-3xl mx-auto py-8 px-4"><div class="max-w-4xl mx-auto py-8 px-4">

    <div class="bg-white rounded-lg shadow-lg p-8">    <div class="bg-white rounded-lg shadow-lg p-8">

        <h1 class="text-3xl font-bold text-gray-800 mb-6">Add a New Property</h1>        <h1 class="text-3xl font-bold text-gray-800 mb-6">List a New Property</h1>

                

        @if($errors->any())        {{-- Display Validation Errors --}}

            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">        @if($errors->any())

                <p class="font-bold">Please fix the following errors:</p>            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">

                <ul class="list-disc list-inside mt-2">                <p class="font-bold">Please correct the following errors:</p>

                    @foreach($errors->all() as $error)                <ul class="list-disc list-inside mt-2">

                        <li>{{ $error }}</li>                    @foreach($errors->all() as $error)

                    @endforeach                        <li>{{ $error }}</li>

                </ul>                    @endforeach

            </div>                </ul>

        @endif            </div>

                @endif

        <form method="POST" action="{{ route('properties.store') }}" enctype="multipart/form-data">        

            @csrf        {{-- Property Create Form (Demonstrates @csrf, Form Validation, Blade Directives) --}}

                    <form method="POST" action="{{ route('properties.store') }}" enctype="multipart/form-data">

            <!-- Basic Information -->            @csrf

            <div class="mb-6">            

                <label for="title" class="block text-gray-700 font-medium mb-2">Property Title *</label>            {{-- Basic Information Section --}}

                <input             <div class="mb-8">

                    type="text"                 <h2 class="text-xl font-semibold text-gray-700 mb-4 border-b pb-2">Basic Information</h2>

                    id="title"                 

                    name="title"                 {{-- Property Title --}}

                    value="{{ old('title') }}"                <div class="mb-4">

                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 @error('title') border-red-500 @enderror"                    <label for="title" class="block text-gray-700 font-medium mb-2">Property Title *</label>

                    placeholder="e.g., Luxury Beachfront Villa"                    <input 

                    required                        type="text" 

                >                        id="title" 

                @error('title')                        name="title" 

                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>                        value="{{ old('title') }}"

                @enderror                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('title') border-red-500 @enderror"

            </div>                        placeholder="e.g., Luxury Beachfront Villa with Pool"

                                    required

            <div class="mb-6">                    >

                <label for="description" class="block text-gray-700 font-medium mb-2">Description *</label>                    @error('title')

                <textarea                         <p class="text-red-500 text-sm mt-1">{{ $message }}</p>

                    id="description"                     @enderror

                    name="description"                 </div>

                    rows="4"                

                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 @error('description') border-red-500 @enderror"                {{-- Description --}}

                    placeholder="Describe your property..."                <div class="mb-4">

                    required                    <label for="description" class="block text-gray-700 font-medium mb-2">Description *</label>

                >{{ old('description') }}</textarea>                    <textarea 

                @error('description')                        id="description" 

                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>                        name="description" 

                @enderror                        rows="6"

            </div>                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('description') border-red-500 @enderror"

                                    placeholder="Describe your property in detail (minimum 50 characters)..."

            <div class="mb-6">                        required

                <label for="property_type" class="block text-gray-700 font-medium mb-2">Property Type *</label>                    >{{ old('description') }}</textarea>

                <select                     @error('description')

                    id="property_type"                         <p class="text-red-500 text-sm mt-1">{{ $message }}</p>

                    name="property_type"                     @enderror

                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 @error('property_type') border-red-500 @enderror"                </div>

                    required                

                >                {{-- Property Type (Demonstrates @foreach loop) --}}

                    <option value="">Select Type</option>                <div class="mb-4">

                    <option value="apartment" {{ old('property_type') == 'apartment' ? 'selected' : '' }}>Apartment</option>                    <label for="type" class="block text-gray-700 font-medium mb-2">Property Type *</label>

                    <option value="house" {{ old('property_type') == 'house' ? 'selected' : '' }}>House</option>                    <select 

                    <option value="villa" {{ old('property_type') == 'villa' ? 'selected' : '' }}>Villa</option>                        id="type" 

                    <option value="condo" {{ old('property_type') == 'condo' ? 'selected' : '' }}>Condo</option>                        name="type" 

                </select>                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('type') border-red-500 @enderror"

                @error('property_type')                        required

                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>                    >

                @enderror                        <option value="">Select Property Type</option>

            </div>                        @foreach(['apartment' => 'Apartment', 'house' => 'House', 'villa' => 'Villa', 'studio' => 'Studio', 'condo' => 'Condo', 'other' => 'Other'] as $value => $label)

                                        <option value="{{ $value }}" {{ old('type') == $value ? 'selected' : '' }}>

            <!-- Location -->                                {{ $label }}

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">                            </option>

                <div>                        @endforeach

                    <label for="address" class="block text-gray-700 font-medium mb-2">Address *</label>                    </select>

                    <input                     @error('type')

                        type="text"                         <p class="text-red-500 text-sm mt-1">{{ $message }}</p>

                        id="address"                     @enderror

                        name="address"                 </div>

                        value="{{ old('address') }}"            </div>

                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 @error('address') border-red-500 @enderror"            

                        placeholder="123 Main Street"            {{-- Location Section --}}

                        required            <div class="mb-8">

                    >                <h2 class="text-xl font-semibold text-gray-700 mb-4 border-b pb-2">Location</h2>

                    @error('address')                

                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    @enderror                    {{-- Address --}}

                </div>                    <div class="md:col-span-2">

                                        <label for="address" class="block text-gray-700 font-medium mb-2">Street Address *</label>

                <div>                        <input 

                    <label for="city" class="block text-gray-700 font-medium mb-2">City *</label>                            type="text" 

                    <input                             id="address" 

                        type="text"                             name="address" 

                        id="city"                             value="{{ old('address') }}"

                        name="city"                             class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('address') border-red-500 @enderror"

                        value="{{ old('city') }}"                            placeholder="123 Main Street"

                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 @error('city') border-red-500 @enderror"                            required

                        placeholder="Miami"                        >

                        required                        @error('address')

                    >                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>

                    @error('city')                        @enderror

                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>                    </div>

                    @enderror                    

                </div>                    {{-- City --}}

            </div>                    <div>

                                    <label for="city" class="block text-gray-700 font-medium mb-2">City *</label>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">                        <input 

                <div>                            type="text" 

                    <label for="state" class="block text-gray-700 font-medium mb-2">State</label>                            id="city" 

                    <input                             name="city" 

                        type="text"                             value="{{ old('city') }}"

                        id="state"                             class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('city') border-red-500 @enderror"

                        name="state"                             placeholder="e.g., Miami"

                        value="{{ old('state') }}"                            required

                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500"                        >

                        placeholder="FL"                        @error('city')

                    >                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>

                </div>                        @enderror

                                    </div>

                <div>                    

                    <label for="zip_code" class="block text-gray-700 font-medium mb-2">ZIP Code</label>                    {{-- State --}}

                    <input                     <div>

                        type="text"                         <label for="state" class="block text-gray-700 font-medium mb-2">State/Province</label>

                        id="zip_code"                         <input 

                        name="zip_code"                             type="text" 

                        value="{{ old('zip_code') }}"                            id="state" 

                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500"                            name="state" 

                        placeholder="33139"                            value="{{ old('state') }}"

                    >                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"

                </div>                            placeholder="e.g., Florida"

            </div>                        >

                                </div>

            <!-- Property Details -->                    

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">                    {{-- Country --}}

                <div>                    <div>

                    <label for="bedrooms" class="block text-gray-700 font-medium mb-2">Bedrooms *</label>                        <label for="country" class="block text-gray-700 font-medium mb-2">Country *</label>

                    <input                         <input 

                        type="number"                             type="text" 

                        id="bedrooms"                             id="country" 

                        name="bedrooms"                             name="country" 

                        value="{{ old('bedrooms', 1) }}"                            value="{{ old('country') }}"

                        min="1"                             class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('country') border-red-500 @enderror"

                        max="20"                            placeholder="e.g., USA"

                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 @error('bedrooms') border-red-500 @enderror"                            required

                        required                        >

                    >                        @error('country')

                    @error('bedrooms')                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>

                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>                        @enderror

                    @enderror                    </div>

                </div>                    

                                    {{-- ZIP Code --}}

                <div>                    <div>

                    <label for="bathrooms" class="block text-gray-700 font-medium mb-2">Bathrooms *</label>                        <label for="zip_code" class="block text-gray-700 font-medium mb-2">ZIP/Postal Code</label>

                    <input                         <input 

                        type="number"                             type="text" 

                        id="bathrooms"                             id="zip_code" 

                        name="bathrooms"                             name="zip_code" 

                        value="{{ old('bathrooms', 1) }}"                            value="{{ old('zip_code') }}"

                        min="1"                             class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"

                        max="20"                            placeholder="e.g., 33139"

                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 @error('bathrooms') border-red-500 @enderror"                        >

                        required                    </div>

                    >                </div>

                    @error('bathrooms')            </div>

                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>            

                    @enderror            {{-- Property Details Section --}}

                </div>            <div class="mb-8">

                                <h2 class="text-xl font-semibold text-gray-700 mb-4 border-b pb-2">Property Details</h2>

                <div>                

                    <label for="max_guests" class="block text-gray-700 font-medium mb-2">Max Guests *</label>                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                    <input                     {{-- Bedrooms --}}

                        type="number"                     <div>

                        id="max_guests"                         <label for="bedrooms" class="block text-gray-700 font-medium mb-2">Bedrooms *</label>

                        name="max_guests"                         <input 

                        value="{{ old('max_guests', 2) }}"                            type="number" 

                        min="1"                             id="bedrooms" 

                        max="50"                            name="bedrooms" 

                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 @error('max_guests') border-red-500 @enderror"                            value="{{ old('bedrooms', 1) }}"

                        required                            min="1" 

                    >                            max="20"

                    @error('max_guests')                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('bedrooms') border-red-500 @enderror"

                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>                            required

                    @enderror                        >

                </div>                        @error('bedrooms')

            </div>                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>

                                    @enderror

            <!-- Pricing -->                    </div>

            <div class="mb-6">                    

                <label for="price_per_night" class="block text-gray-700 font-medium mb-2">Price per Night ($) *</label>                    {{-- Bathrooms --}}

                <input                     <div>

                    type="number"                         <label for="bathrooms" class="block text-gray-700 font-medium mb-2">Bathrooms *</label>

                    id="price_per_night"                         <input 

                    name="price_per_night"                             type="number" 

                    value="{{ old('price_per_night') }}"                            id="bathrooms" 

                    min="1"                             name="bathrooms" 

                    step="0.01"                            value="{{ old('bathrooms', 1) }}"

                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 @error('price_per_night') border-red-500 @enderror"                            min="1" 

                    placeholder="100.00"                            max="20"

                    required                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('bathrooms') border-red-500 @enderror"

                >                            required

                @error('price_per_night')                        >

                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>                        @error('bathrooms')

                @enderror                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>

            </div>                        @enderror

                                </div>

            <!-- Image Upload -->                    

            <div class="mb-6">                    {{-- Max Guests --}}

                <label for="image" class="block text-gray-700 font-medium mb-2">Property Image</label>                    <div>

                <input                         <label for="max_guests" class="block text-gray-700 font-medium mb-2">Max Guests *</label>

                    type="file"                         <input 

                    id="image"                             type="number" 

                    name="image"                             id="max_guests" 

                    accept="image/*"                            name="max_guests" 

                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500"                            value="{{ old('max_guests', 2) }}"

                >                            min="1" 

                <p class="text-gray-500 text-sm mt-1">Optional: Upload a property image (JPG, PNG)</p>                            max="50"

            </div>                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('max_guests') border-red-500 @enderror"

                                        required

            <!-- Form Actions -->                        >

            <div class="flex gap-4 mt-8">                        @error('max_guests')

                <button                             <p class="text-red-500 text-sm mt-1">{{ $message }}</p>

                    type="submit"                         @enderror

                    class="flex-1 bg-blue-600 text-white py-3 px-6 rounded-lg hover:bg-blue-700 font-semibold transition"                    </div>

                >                </div>

                    Create Property            </div>

                </button>            

                <a             {{-- Pricing Section --}}

                    href="{{ route('owner.dashboard') }}"             <div class="mb-8">

                    class="flex-1 bg-gray-500 text-white py-3 px-6 rounded-lg hover:bg-gray-600 font-semibold transition text-center"                <h2 class="text-xl font-semibold text-gray-700 mb-4 border-b pb-2">Pricing</h2>

                >                

                    Cancel                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                </a>                    {{-- Price Per Night --}}

            </div>                    <div>

        </form>                        <label for="price_per_night" class="block text-gray-700 font-medium mb-2">Price per Night ($) *</label>

    </div>                        <input 

</div>                            type="number" 

@endsection                            id="price_per_night" 

                            name="price_per_night" 
                            value="{{ old('price_per_night') }}"
                            min="1" 
                            max="10000"
                            step="0.01"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('price_per_night') border-red-500 @enderror"
                            placeholder="e.g., 150.00"
                            required
                        >
                        @error('price_per_night')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    {{-- Cleaning Fee --}}
                    <div>
                        <label for="cleaning_fee" class="block text-gray-700 font-medium mb-2">Cleaning Fee ($)</label>
                        <input 
                            type="number" 
                            id="cleaning_fee" 
                            name="cleaning_fee" 
                            value="{{ old('cleaning_fee', 0) }}"
                            min="0" 
                            max="1000"
                            step="0.01"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="e.g., 50.00"
                        >
                    </div>
                    
                    {{-- Service Fee --}}
                    <div>
                        <label for="service_fee" class="block text-gray-700 font-medium mb-2">Service Fee ($)</label>
                        <input 
                            type="number" 
                            id="service_fee" 
                            name="service_fee" 
                            value="{{ old('service_fee', 0) }}"
                            min="0" 
                            max="1000"
                            step="0.01"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="e.g., 25.00"
                        >
                    </div>
                </div>
            </div>
            
            {{-- Amenities Section (Demonstrates @foreach with checkboxes) --}}
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-gray-700 mb-4 border-b pb-2">Amenities</h2>
                
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    @if(isset($amenities) && count($amenities) > 0)
                        @foreach($amenities as $amenity)
                            <div class="flex items-center">
                                <input 
                                    type="checkbox" 
                                    id="amenity_{{ $amenity->id }}" 
                                    name="amenities[]" 
                                    value="{{ $amenity->id }}"
                                    {{ in_array($amenity->id, old('amenities', [])) ? 'checked' : '' }}
                                    class="w-4 h-4 text-blue-600 focus:ring-2 focus:ring-blue-500"
                                >
                                <label for="amenity_{{ $amenity->id }}" class="ml-2 text-gray-700">
                                    <i class="{{ $amenity->icon }} mr-1"></i> {{ $amenity->name }}
                                </label>
                            </div>
                        @endforeach
                    @else
                        <p class="text-gray-500">No amenities available</p>
                    @endif
                </div>
            </div>
            
            {{-- Form Actions --}}
            <div class="flex justify-end space-x-4 mt-8">
                <a href="{{ route('owner.dashboard') }}" class="px-6 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition">
                    Cancel
                </a>
                <button 
                    type="submit" 
                    class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition"
                >
                    Create Property
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
