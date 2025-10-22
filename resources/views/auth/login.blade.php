@extends('layouts.app')

@section('title', 'Login - StayHub')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4" style="background-color: #F5F5F0;">
    <div class="max-w-md w-full">
        <!-- Logo -->
        <div class="text-center mb-8">
            <a href="/" class="inline-flex items-center space-x-2">
                <i class="fa-solid fa-house-circle-check text-4xl" style="color: #80A1BA;"></i>
                <span class="text-3xl font-bold text-gray-800">StayHub</span>
            </a>
            <h2 class="mt-6 text-3xl font-bold text-gray-900">Welcome Back</h2>
            <p class="mt-2 text-gray-600">Sign in to your account</p>
        </div>

        <!-- Login Form -->
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

            <form action="/login" method="POST">
                @csrf
                
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
                    <label class="block text-gray-700 font-semibold mb-2">Password</label>
                    <input type="password" name="password" required 
                           class="w-full px-4 py-3 border rounded-lg outline-none" style="border-color: #80A1BA;"
                           placeholder="Enter your password">
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                @if(session('error'))
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                        {{ session('error') }}
                    </div>
                @endif
                
                <div class="flex items-center justify-between mb-6">
                    <label class="flex items-center">
                        <input type="checkbox" name="remember" class="mr-2">
                        <span class="text-sm text-gray-600">Remember me</span>
                    </label>
                </div>
                
                <button type="submit" 
                        class="w-full text-white py-3 rounded-lg font-semibold" style="background-color: #80A1BA; transition: opacity 0.3s;" onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'">
                    Sign In
                </button>
            </form>
            
            <!-- Sign Up Link -->
            <p class="mt-6 text-center text-gray-600">
                Don't have an account? 
                <a href="/register" class="font-semibold" style="color: #80A1BA; transition: opacity 0.3s;" onmouseover="this.style.opacity='0.8'" onmouseout="this.style.opacity='1'">
                    Sign up
                </a>
            </p>
        </div>
    </div>
</div>
@endsection
