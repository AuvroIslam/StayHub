<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'StayHub - Find Your Perfect Stay')</title>
    
    <!-- Tailwind CSS CDN for quick setup -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome 6.5.1 - Latest version with more icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <!-- Custom CSS with New Color Palette -->
    <style>
        :root {
            --primary: #80A1BA;
            --secondary: #91C4C3;
            --accent: #B4DEBD;
            --background: #F5F5F0;
        }
        .hero-gradient {
            background: linear-gradient(135deg, #80A1BA 0%, #91C4C3 100%);
        }
        .hover-scale {
            transition: transform 0.3s ease;
        }
        .hover-scale:hover {
            transform: scale(1.05);
        }
        .property-card {
            transition: box-shadow 0.3s ease;
        }
        .property-card:hover {
            box-shadow: 0 10px 25px rgba(128, 161, 186, 0.3);
        }
        .btn-primary {
            background-color: #80A1BA;
        }
        .btn-primary:hover {
            background-color: #6a8ba8;
        }
        .text-primary {
            color: #80A1BA;
        }
        .bg-primary {
            background-color: #80A1BA;
        }
        .bg-secondary {
            background-color: #91C4C3;
        }
        .bg-accent {
            background-color: #B4DEBD;
        }
        .bg-cream {
            background-color: #F5F5F0;
        }
    </style>
    
    @yield('styles')
</head>
<body class="bg-cream">
    <!-- Navigation -->
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <!-- Logo -->
                <a href="/" class="flex items-center space-x-2">
                    <i class="fa-solid fa-house-circle-check text-3xl text-primary" style="color: #80A1BA;"></i>
                    <span class="text-2xl font-bold text-gray-800">StayHub</span>
                </a>
                
                <!-- Search Bar (Desktop) -->
                <div class="hidden md:flex flex-1 max-w-2xl mx-8">
                    <div class="w-full flex items-center bg-gray-100 rounded-full px-4 py-2 shadow-sm">
                        <input type="text" placeholder="Where are you going?" 
                               class="flex-1 bg-transparent outline-none px-2">
                        <div class="border-l pl-4">
                            <input type="date" class="bg-transparent outline-none text-sm">
                        </div>
                        <div class="border-l pl-4">
                            <input type="date" class="bg-transparent outline-none text-sm">
                        </div>
                        <button class="ml-4 px-6 py-2 rounded-full btn-primary text-white hover:opacity-90" style="background-color: #80A1BA;">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
                </div>
                
                <!-- Navigation Links -->
                <div class="flex items-center space-x-6">
                    <a href="/properties" class="text-gray-700 hover:text-primary font-medium" style="transition: color 0.3s;">
                        Browse Properties
                    </a>
                    
                    @guest
                        <a href="/login" class="text-gray-700 hover:text-primary font-medium" style="transition: color 0.3s;">
                            Login
                        </a>
                        <a href="/register" class="px-6 py-2 rounded-full text-white btn-primary hover:opacity-90" style="background-color: #80A1BA;">
                            Sign Up
                        </a>
                    @else
                        <div class="relative group">
                            <button class="flex items-center space-x-2 text-gray-700">
                                <i class="fa-solid fa-circle-user text-2xl" style="color: #80A1BA;"></i>
                                <span class="font-medium">{{ Auth::user()->name }}</span>
                                <i class="fa-solid fa-chevron-down text-sm"></i>
                            </button>
                            
                            <!-- Dropdown Menu -->
                            <div class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                                @if(Auth::user()->role == 'owner')
                                    <a href="/owner/dashboard" class="block px-4 py-2 text-gray-700 hover:bg-opacity-20" style="transition: background 0.3s;" onmouseover="this.style.backgroundColor='#B4DEBD'" onmouseout="this.style.backgroundColor=''">
                                        <i class="fa-solid fa-chart-line mr-2" style="color: #80A1BA;"></i> Dashboard
                                    </a>
                                    <a href="/owner/properties" class="block px-4 py-2 text-gray-700" style="transition: background 0.3s;" onmouseover="this.style.backgroundColor='#B4DEBD'" onmouseout="this.style.backgroundColor=''">
                                        <i class="fa-solid fa-building mr-2" style="color: #80A1BA;"></i> My Properties
                                    </a>
                                    <a href="/owner/bookings" class="block px-4 py-2 text-gray-700" style="transition: background 0.3s;" onmouseover="this.style.backgroundColor='#B4DEBD'" onmouseout="this.style.backgroundColor=''">
                                        <i class="fa-solid fa-calendar-check mr-2" style="color: #80A1BA;"></i> Bookings
                                    </a>
                                @else
                                    <a href="/customer/dashboard" class="block px-4 py-2 text-gray-700" style="transition: background 0.3s;" onmouseover="this.style.backgroundColor='#B4DEBD'" onmouseout="this.style.backgroundColor=''">
                                        <i class="fa-solid fa-chart-line mr-2" style="color: #80A1BA;"></i> Dashboard
                                    </a>
                                    <a href="/customer/bookings" class="block px-4 py-2 text-gray-700" style="transition: background 0.3s;" onmouseover="this.style.backgroundColor='#B4DEBD'" onmouseout="this.style.backgroundColor=''">
                                        <i class="fa-solid fa-calendar-days mr-2" style="color: #80A1BA;"></i> My Bookings
                                    </a>
                                    <a href="/customer/favorites" class="block px-4 py-2 text-gray-700" style="transition: background 0.3s;" onmouseover="this.style.backgroundColor='#B4DEBD'" onmouseout="this.style.backgroundColor=''">
                                        <i class="fa-solid fa-heart mr-2" style="color: #80A1BA;"></i> Favorites
                                    </a>
                                @endif
                                <a href="/messages" class="block px-4 py-2 text-gray-700" style="transition: background 0.3s;" onmouseover="this.style.backgroundColor='#B4DEBD'" onmouseout="this.style.backgroundColor=''">
                                    <i class="fa-solid fa-envelope mr-2" style="color: #80A1BA;"></i> Messages
                                </a>
                                <a href="/profile" class="block px-4 py-2 text-gray-700" style="transition: background 0.3s;" onmouseover="this.style.backgroundColor='#B4DEBD'" onmouseout="this.style.backgroundColor=''">
                                    <i class="fa-solid fa-user mr-2" style="color: #80A1BA;"></i> Profile
                                </a>
                                <hr class="my-2">
                                <form method="POST" action="/logout">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-red-600" style="transition: background 0.3s;" onmouseover="this.style.backgroundColor='#B4DEBD'" onmouseout="this.style.backgroundColor=''">
                                        <i class="fa-solid fa-right-from-bracket mr-2"></i> Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white mt-16">
        <div class="container mx-auto px-4 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- About -->
                <div>
                    <h3 class="text-xl font-bold mb-4">StayHub</h3>
                    <p class="text-gray-400">Find your perfect stay. Book unique properties around the world.</p>
                    <div class="flex space-x-4 mt-4">
                        <a href="#" class="text-gray-400 hover:text-white">
                            <i class="fab fa-facebook-f text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white">
                            <i class="fab fa-twitter text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white">
                            <i class="fab fa-instagram text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white">
                            <i class="fab fa-linkedin-in text-xl"></i>
                        </a>
                    </div>
                </div>
                
                <!-- Quick Links -->
                <div>
                    <h3 class="text-xl font-bold mb-4">Quick Links</h3>
                    <ul class="space-y-2">
                        <li><a href="/about" class="text-gray-400 hover:text-white">About Us</a></li>
                        <li><a href="/properties" class="text-gray-400 hover:text-white">Browse Properties</a></li>
                        <li><a href="/how-it-works" class="text-gray-400 hover:text-white">How It Works</a></li>
                        <li><a href="/contact" class="text-gray-400 hover:text-white">Contact Us</a></li>
                    </ul>
                </div>
                
                <!-- For Hosts -->
                <div>
                    <h3 class="text-xl font-bold mb-4">For Property Owners</h3>
                    <ul class="space-y-2">
                        <li><a href="/register?role=owner" class="text-gray-400 hover:text-white">List Your Property</a></li>
                        <li><a href="/owner/resources" class="text-gray-400 hover:text-white">Owner Resources</a></li>
                        <li><a href="/owner/help" class="text-gray-400 hover:text-white">Help Center</a></li>
                        <li><a href="/owner/community" class="text-gray-400 hover:text-white">Community Forum</a></li>
                    </ul>
                </div>
                
                <!-- Support -->
                <div>
                    <h3 class="text-xl font-bold mb-4">Support</h3>
                    <ul class="space-y-2">
                        <li><a href="/help" class="text-gray-400 hover:text-white">Help Center</a></li>
                        <li><a href="/safety" class="text-gray-400 hover:text-white">Safety Information</a></li>
                        <li><a href="/cancellation" class="text-gray-400 hover:text-white">Cancellation Policy</a></li>
                        <li><a href="/terms" class="text-gray-400 hover:text-white">Terms & Conditions</a></li>
                        <li><a href="/privacy" class="text-gray-400 hover:text-white">Privacy Policy</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; 2025 StayHub. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script>
        // Mobile menu toggle
        document.addEventListener('DOMContentLoaded', function() {
            // Add any custom JavaScript here
        });
    </script>
    
    @yield('scripts')
</body>
</html>
