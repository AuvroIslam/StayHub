@extends('layouts.app')

@section('content')
<div class="min-h-screen" style="background-color: #F5F5F0;">
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-4xl font-bold mb-2">Profile Settings</h1>
                <p class="text-gray-600">Manage your account information and preferences</p>
            </div>

            <div class="grid lg:grid-cols-3 gap-8">
                <!-- Profile Navigation -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="text-center mb-6">
                            <div class="w-24 h-24 bg-gray-200 rounded-full mx-auto mb-4 flex items-center justify-center">
                                <i class="fas fa-user text-3xl text-gray-400"></i>
                            </div>
                            <h3 class="font-bold text-lg">{{ Auth::user()->name }}</h3>
                            <p class="text-gray-600">{{ Auth::user()->email }}</p>
                            <span class="inline-block px-3 py-1 rounded-full text-xs font-medium mt-2" 
                                  style="background-color: #B4DEBD; color: #2d5016;">
                                {{ ucfirst(Auth::user()->role) }}
                            </span>
                        </div>
                        
                        <nav class="space-y-2">
                            <a href="#personal-info" class="profile-nav-link active block w-full text-left px-4 py-3 rounded-lg transition"
                               onclick="showSection('personal-info', this)">
                                <i class="fas fa-user mr-3"></i> Personal Information
                            </a>
                            <a href="#account-security" class="profile-nav-link block w-full text-left px-4 py-3 rounded-lg transition"
                               onclick="showSection('account-security', this)">
                                <i class="fas fa-shield-alt mr-3"></i> Account & Security
                            </a>
                            <a href="#preferences" class="profile-nav-link block w-full text-left px-4 py-3 rounded-lg transition"
                               onclick="showSection('preferences', this)">
                                <i class="fas fa-cog mr-3"></i> Preferences
                            </a>
                        </nav>
                    </div>
                </div>

                <!-- Profile Content -->
                <div class="lg:col-span-2">
                    <!-- Personal Information Section -->
                    <div id="personal-info" class="profile-section bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-2xl font-bold mb-6">Personal Information</h2>
                        
                        <form action="{{ route('profile.update') }}" method="POST" class="space-y-6">
                            @csrf
                            @method('PUT')
                            
                            <div class="grid md:grid-cols-2 gap-6">
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                                    <input type="text" id="name" name="name" value="{{ Auth::user()->name }}" 
                                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500"
                                           required>
                                </div>
                                
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                                    <input type="email" id="email" name="email" value="{{ Auth::user()->email }}" 
                                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500"
                                           required>
                                </div>
                            </div>
                            
                            <div class="grid md:grid-cols-2 gap-6">
                                <div>
                                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                                    <input type="tel" id="phone" name="phone" value="{{ Auth::user()->phone ?? '' }}" 
                                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500">
                                </div>
                                
                                <div>
                                    <label for="date_of_birth" class="block text-sm font-medium text-gray-700 mb-2">Date of Birth</label>
                                    <input type="date" id="date_of_birth" name="date_of_birth" value="{{ Auth::user()->date_of_birth ?? '' }}" 
                                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500">
                                </div>
                            </div>
                            
                            <div>
                                <label for="bio" class="block text-sm font-medium text-gray-700 mb-2">Bio</label>
                                <textarea id="bio" name="bio" rows="4" 
                                          class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500"
                                          placeholder="Tell us about yourself...">{{ Auth::user()->bio ?? '' }}</textarea>
                            </div>
                            
                            <div>
                                <button type="submit" 
                                        class="px-6 py-3 rounded-lg font-medium text-white transition"
                                        style="background-color: #80A1BA;"
                                        onmouseover="this.style.opacity='0.8'" 
                                        onmouseout="this.style.opacity='1'">
                                    Update Profile
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Account & Security Section -->
                    <div id="account-security" class="profile-section bg-white rounded-lg shadow-md p-6 hidden">
                        <h2 class="text-2xl font-bold mb-6">Account & Security</h2>
                        
                        <!-- Change Password -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold mb-4">Change Password</h3>
                            <form action="{{ route('profile.update') }}" method="POST" class="space-y-4">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="action" value="change_password">
                                
                                <div>
                                    <label for="current_password" class="block text-sm font-medium text-gray-700 mb-2">Current Password</label>
                                    <input type="password" id="current_password" name="current_password" 
                                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500"
                                           required>
                                </div>
                                
                                <div class="grid md:grid-cols-2 gap-4">
                                    <div>
                                        <label for="new_password" class="block text-sm font-medium text-gray-700 mb-2">New Password</label>
                                        <input type="password" id="new_password" name="new_password" 
                                               class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500"
                                               required>
                                    </div>
                                    
                                    <div>
                                        <label for="new_password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Confirm New Password</label>
                                        <input type="password" id="new_password_confirmation" name="new_password_confirmation" 
                                               class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500"
                                               required>
                                    </div>
                                </div>
                                
                                <button type="submit" 
                                        class="px-6 py-3 bg-red-600 text-white rounded-lg font-medium hover:bg-red-700 transition">
                                    Change Password
                                </button>
                            </form>
                        </div>
                        
                        <!-- Account Information -->
                        <div>
                            <h3 class="text-lg font-semibold mb-4">Account Information</h3>
                            <div class="space-y-3 text-sm">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Member since:</span>
                                    <span class="font-medium">{{ Auth::user()->created_at->format('F j, Y') }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Account type:</span>
                                    <span class="font-medium">{{ ucfirst(Auth::user()->role) }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Email verified:</span>
                                    <span class="font-medium">
                                        @if(Auth::user()->email_verified_at)
                                            <i class="fas fa-check-circle text-green-500"></i> Verified
                                        @else
                                            <i class="fas fa-times-circle text-red-500"></i> Not verified
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Preferences Section -->
                    <div id="preferences" class="profile-section bg-white rounded-lg shadow-md p-6 hidden">
                        <h2 class="text-2xl font-bold mb-6">Preferences</h2>
                        
                        <form action="{{ route('profile.update') }}" method="POST" class="space-y-6">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="action" value="preferences">
                            
                            <!-- Notification Preferences -->
                            <div>
                                <h3 class="text-lg font-semibold mb-4">Notifications</h3>
                                <div class="space-y-3">
                                    <label class="flex items-center">
                                        <input type="checkbox" name="notifications[email_bookings]" 
                                               class="rounded border-gray-300 text-purple-600 shadow-sm focus:border-purple-300 focus:ring focus:ring-purple-200 focus:ring-opacity-50">
                                        <span class="ml-2">Email notifications for new bookings</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="checkbox" name="notifications[email_reviews]" 
                                               class="rounded border-gray-300 text-purple-600 shadow-sm focus:border-purple-300 focus:ring focus:ring-purple-200 focus:ring-opacity-50">
                                        <span class="ml-2">Email notifications for reviews</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="checkbox" name="notifications[marketing]" 
                                               class="rounded border-gray-300 text-purple-600 shadow-sm focus:border-purple-300 focus:ring focus:ring-purple-200 focus:ring-opacity-50">
                                        <span class="ml-2">Marketing emails and promotions</span>
                                    </label>
                                </div>
                            </div>
                            
                            <!-- Currency Preference -->
                            <div>
                                <h3 class="text-lg font-semibold mb-4">Display Preferences</h3>
                                <div class="grid md:grid-cols-2 gap-6">
                                    <div>
                                        <label for="currency" class="block text-sm font-medium text-gray-700 mb-2">Preferred Currency</label>
                                        <select id="currency" name="currency" 
                                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500">
                                            <option value="USD">USD ($)</option>
                                            <option value="EUR">EUR (€)</option>
                                            <option value="GBP">GBP (£)</option>
                                            <option value="CAD">CAD (C$)</option>
                                        </select>
                                    </div>
                                    
                                    <div>
                                        <label for="language" class="block text-sm font-medium text-gray-700 mb-2">Language</label>
                                        <select id="language" name="language" 
                                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500">
                                            <option value="en">English</option>
                                            <option value="es">Español</option>
                                            <option value="fr">Français</option>
                                            <option value="de">Deutsch</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <button type="submit" 
                                    class="px-6 py-3 rounded-lg font-medium text-white transition"
                                    style="background-color: #80A1BA;"
                                    onmouseover="this.style.opacity='0.8'" 
                                    onmouseout="this.style.opacity='1'">
                                Save Preferences
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.profile-nav-link {
    color: #6b7280;
}

.profile-nav-link:hover, .profile-nav-link.active {
    background-color: #80A1BA;
    color: white;
}
</style>

<script>
function showSection(sectionId, linkElement) {
    // Hide all sections
    document.querySelectorAll('.profile-section').forEach(section => {
        section.classList.add('hidden');
    });
    
    // Remove active class from all nav links
    document.querySelectorAll('.profile-nav-link').forEach(link => {
        link.classList.remove('active');
    });
    
    // Show selected section
    document.getElementById(sectionId).classList.remove('hidden');
    
    // Add active class to clicked nav link
    linkElement.classList.add('active');
}

// Handle success messages
@if(session('success'))
    alert('{{ session('success') }}');
@endif

@if(session('error'))
    alert('{{ session('error') }}');
@endif
</script>
@endsection