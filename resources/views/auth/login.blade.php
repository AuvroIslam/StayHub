@extends('layouts.app')

@section('title', 'Login - StayHub')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100 py-12 px-4">
    <div class="max-w-md w-full">
        <!-- Logo -->
        <div class="text-center mb-8">
            <a href="/" class="inline-flex items-center space-x-2">
                <i class="fa-solid fa-house-circle-check text-4xl text-purple-600"></i>
                <span class="text-3xl font-bold text-gray-800">StayHub</span>
            </a>
            <h2 class="mt-6 text-3xl font-bold text-gray-900">Welcome Back</h2>
            <p class="mt-2 text-gray-600">Sign in to your account</p>
        </div>

        <!-- Login Form -->
        <div class="bg-white rounded-lg shadow-md p-8">
            <form action="/login" method="POST">
                @csrf
                
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Email Address</label>
                    <input type="email" name="email" required 
                           class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-purple-600 outline-none"
                           placeholder="your@email.com">
                </div>
                
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Password</label>
                    <input type="password" name="password" required 
                           class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-purple-600 outline-none"
                           placeholder="Enter your password">
                </div>
                
                <div class="flex items-center justify-between mb-6">
                    <label class="flex items-center">
                        <input type="checkbox" name="remember" class="mr-2">
                        <span class="text-sm text-gray-600">Remember me</span>
                    </label>
                    <a href="/forgot-password" class="text-sm text-purple-600 hover:text-purple-700">
                        Forgot password?
                    </a>
                </div>
                
                <button type="submit" 
                        class="w-full bg-purple-600 text-white py-3 rounded-lg hover:bg-purple-700 font-semibold">
                    Sign In
                </button>
            </form>
            
            <!-- Divider -->
            <div class="relative my-6">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-300"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-2 bg-white text-gray-500">Or continue with</span>
                </div>
            </div>
            
            <!-- Social Login -->
            <div class="grid grid-cols-2 gap-4">
                <button class="flex items-center justify-center px-4 py-3 border rounded-lg hover:bg-gray-50">
                    <i class="fa-brands fa-google text-red-500 mr-2"></i>
                    <span class="font-semibold">Google</span>
                </button>
                <button class="flex items-center justify-center px-4 py-3 border rounded-lg hover:bg-gray-50">
                    <i class="fa-brands fa-facebook text-blue-600 mr-2"></i>
                    <span class="font-semibold">Facebook</span>
                </button>
            </div>
            
            <!-- Sign Up Link -->
            <p class="mt-6 text-center text-gray-600">
                Don't have an account? 
                <a href="/register" class="text-purple-600 hover:text-purple-700 font-semibold">
                    Sign up
                </a>
            </p>
        </div>
    </div>
</div>
@endsection
