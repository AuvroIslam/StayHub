@extends('layouts.app')

@section('title', 'Register - StayHub')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4" style="background-color: #F5F5F0;">
    <div class="max-w-2xl w-full">
        <!-- Logo -->
        <div class="text-center mb-8">
            <a href="/" class="inline-flex items-center space-x-2">
                <i class="fa-solid fa-house-circle-check text-4xl" style="color: #80A1BA;"></i>
                <span class="text-3xl font-bold text-gray-800">StayHub</span>
            </a>
            <h2 class="mt-6 text-3xl font-bold text-gray-900">Create Your Account</h2>
            <p class="mt-2 text-gray-600">Join thousands of users on StayHub</p>
        </div>

        <!-- Registration Form -->
        <div class="bg-white rounded-lg shadow-md p-8">
            @if ($errors->any())
                <div class="mb-4 p-4 rounded-lg" style="background-color: rgba(239, 68, 68, 0.1); border: 1px solid #EF4444;">
                    <ul class="list-disc list-inside text-red-600">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="/register" method="POST" id="registerForm">
                @csrf
                
                <!-- Role Selection -->
                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-3">I want to:</label>
                    <div class="grid grid-cols-2 gap-4">
                        <label class="relative cursor-pointer">
                            <input type="radio" name="role" value="customer" class="peer sr-only" checked>
                            <div class="border-2 rounded-lg p-4 transition-all peer-checked:border-opacity-100 peer-checked:shadow-lg" style="border-color: #B4DEBD;" 
                                 onmouseover="this.style.borderColor='#80A1BA'" 
                                 onmouseout="if(!this.previousElementSibling.checked) this.style.borderColor='#B4DEBD'">
                                <div class="flex flex-col items-center">
                                    <i class="fa-solid fa-user-tie text-3xl mb-2" style="color: #80A1BA;"></i>
                                    <h3 class="font-semibold">Book Properties</h3>
                                    <p class="text-sm text-gray-600 text-center">Find and book amazing places</p>
                                </div>
                            </div>
                        </label>
                        
                        <label class="relative cursor-pointer">
                            <input type="radio" name="role" value="owner" class="peer sr-only">
                            <div class="border-2 rounded-lg p-4 transition-all peer-checked:border-opacity-100 peer-checked:shadow-lg" style="border-color: #B4DEBD;" 
                                 onmouseover="this.style.borderColor='#80A1BA'" 
                                 onmouseout="if(!this.previousElementSibling.checked) this.style.borderColor='#B4DEBD'">
                                <div class="flex flex-col items-center">
                                    <i class="fa-solid fa-house-user text-3xl mb-2" style="color: #80A1BA;"></i>
                                    <h3 class="font-semibold">List Properties</h3>
                                    <p class="text-sm text-gray-600 text-center">Rent out your property</p>
                                </div>
                            </div>
                        </label>
                    </div>
                </div>
                
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Full Name</label>
                    <input type="text" name="name" required value="{{ old('name') }}"
                           class="w-full px-4 py-3 border rounded-lg outline-none" style="border-color: #80A1BA;"
                           placeholder="John Doe">
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Email Address</label>
                    <input type="email" name="email" required value="{{ old('email') }}"
                           class="w-full px-4 py-3 border rounded-lg outline-none" style="border-color: #80A1BA;"
                           placeholder="your@email.com">
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Phone Number (Optional)</label>
                    <input type="tel" name="phone" value="{{ old('phone') }}"
                           class="w-full px-4 py-3 border rounded-lg outline-none" style="border-color: #80A1BA;"
                           placeholder="+1 (555) 123-4567">
                    @error('phone')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Password</label>
                        <input type="password" name="password" required 
                               class="w-full px-4 py-3 border rounded-lg outline-none" style="border-color: #80A1BA;"
                               placeholder="Min. 8 characters">
                        @error('password')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Confirm Password</label>
                        <input type="password" name="password_confirmation" required 
                               class="w-full px-4 py-3 border rounded-lg outline-none" style="border-color: #80A1BA;"
                               placeholder="Confirm password">
                    </div>
                </div>
                
                <button type="submit" 
                        class="w-full text-white py-3 rounded-lg font-semibold" style="background-color: #80A1BA; transition: opacity 0.3s;" onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'">
                    Create Account
                </button>
            </form>
            
            <!-- Login Link -->
            <p class="mt-6 text-center text-gray-600">
                Already have an account? 
                <a href="/login" class="font-semibold" style="color: #80A1BA; transition: opacity 0.3s;" onmouseover="this.style.opacity='0.8'" onmouseout="this.style.opacity='1'">
                    Sign in
                </a>
            </p>
        </div>
    </div>
</div>

<script>
    // Handle role selection visual feedback
    document.addEventListener('DOMContentLoaded', function() {
        const roleLabels = document.querySelectorAll('input[name="role"]');
        
        roleLabels.forEach(radio => {
            radio.addEventListener('change', function() {
                // Reset all borders
                document.querySelectorAll('input[name="role"]').forEach(r => {
                    const card = r.nextElementSibling;
                    if (!r.checked) {
                        card.style.borderColor = '#B4DEBD';
                        card.style.backgroundColor = '';
                    } else {
                        card.style.borderColor = '#80A1BA';
                        card.style.backgroundColor = 'rgba(128, 161, 186, 0.05)';
                    }
                });
            });
        });
        
        // Set initial state for checked radio
        const checkedRadio = document.querySelector('input[name="role"]:checked');
        if (checkedRadio) {
            checkedRadio.nextElementSibling.style.borderColor = '#80A1BA';
            checkedRadio.nextElementSibling.style.backgroundColor = 'rgba(128, 161, 186, 0.05)';
        }
    });
</script>
@endsection
