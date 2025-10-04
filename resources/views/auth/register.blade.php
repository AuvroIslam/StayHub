@extends('layouts.app')

@section('title', 'Register - StayHub')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100 py-12 px-4">
    <div class="max-w-2xl w-full">
        <!-- Logo -->
        <div class="text-center mb-8">
            <a href="/" class="inline-flex items-center space-x-2">
                <i class="fas fa-home text-4xl text-purple-600"></i>
                <span class="text-3xl font-bold text-gray-800">StayHub</span>
            </a>
            <h2 class="mt-6 text-3xl font-bold text-gray-900">Create Your Account</h2>
            <p class="mt-2 text-gray-600">Join thousands of users on StayHub</p>
        </div>

        <!-- Registration Form -->
        <div class="bg-white rounded-lg shadow-md p-8">
            <!-- Role Selection -->
            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-3">I want to:</label>
                <div class="grid grid-cols-2 gap-4">
                    <label class="relative">
                        <input type="radio" name="role" value="customer" class="peer sr-only" checked>
                        <div class="border-2 rounded-lg p-4 cursor-pointer peer-checked:border-purple-600 peer-checked:bg-purple-50 hover:border-purple-400">
                            <div class="flex flex-col items-center">
                                <i class="fas fa-user text-3xl text-purple-600 mb-2"></i>
                                <h3 class="font-semibold">Book Properties</h3>
                                <p class="text-sm text-gray-600 text-center">Find and book amazing places</p>
                            </div>
                        </div>
                    </label>
                    
                    <label class="relative">
                        <input type="radio" name="role" value="owner" class="peer sr-only">
                        <div class="border-2 rounded-lg p-4 cursor-pointer peer-checked:border-purple-600 peer-checked:bg-purple-50 hover:border-purple-400">
                            <div class="flex flex-col items-center">
                                <i class="fas fa-building text-3xl text-purple-600 mb-2"></i>
                                <h3 class="font-semibold">List Properties</h3>
                                <p class="text-sm text-gray-600 text-center">Rent out your property</p>
                            </div>
                        </div>
                    </label>
                </div>
            </div>
            
            <form action="/register" method="POST">
                @csrf
                
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">First Name</label>
                        <input type="text" name="first_name" required 
                               class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-purple-600 outline-none"
                               placeholder="John">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Last Name</label>
                        <input type="text" name="last_name" required 
                               class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-purple-600 outline-none"
                               placeholder="Doe">
                    </div>
                </div>
                
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Email Address</label>
                    <input type="email" name="email" required 
                           class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-purple-600 outline-none"
                           placeholder="your@email.com">
                </div>
                
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Phone Number</label>
                    <input type="tel" name="phone" required 
                           class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-purple-600 outline-none"
                           placeholder="+1 (555) 123-4567">
                </div>
                
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Password</label>
                        <input type="password" name="password" required 
                               class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-purple-600 outline-none"
                               placeholder="Min. 8 characters">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Confirm Password</label>
                        <input type="password" name="password_confirmation" required 
                               class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-purple-600 outline-none"
                               placeholder="Confirm password">
                    </div>
                </div>
                
                <div class="mb-6">
                    <label class="flex items-start">
                        <input type="checkbox" name="terms" required class="mt-1 mr-2">
                        <span class="text-sm text-gray-600">
                            I agree to the 
                            <a href="/terms" class="text-purple-600 hover:text-purple-700">Terms of Service</a> 
                            and 
                            <a href="/privacy" class="text-purple-600 hover:text-purple-700">Privacy Policy</a>
                        </span>
                    </label>
                </div>
                
                <button type="submit" 
                        class="w-full bg-purple-600 text-white py-3 rounded-lg hover:bg-purple-700 font-semibold">
                    Create Account
                </button>
            </form>
            
            <!-- Divider -->
            <div class="relative my-6">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-300"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-2 bg-white text-gray-500">Or sign up with</span>
                </div>
            </div>
            
            <!-- Social Registration -->
            <div class="grid grid-cols-2 gap-4">
                <button class="flex items-center justify-center px-4 py-3 border rounded-lg hover:bg-gray-50">
                    <i class="fab fa-google text-red-500 mr-2"></i>
                    <span class="font-semibold">Google</span>
                </button>
                <button class="flex items-center justify-center px-4 py-3 border rounded-lg hover:bg-gray-50">
                    <i class="fab fa-facebook text-blue-600 mr-2"></i>
                    <span class="font-semibold">Facebook</span>
                </button>
            </div>
            
            <!-- Login Link -->
            <p class="mt-6 text-center text-gray-600">
                Already have an account? 
                <a href="/login" class="text-purple-600 hover:text-purple-700 font-semibold">
                    Sign in
                </a>
            </p>
        </div>
    </div>
</div>
@endsection
