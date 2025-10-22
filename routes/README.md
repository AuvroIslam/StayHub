# Routes Directory - StayHub URL Routing System

This directory contains all route definitions that map URLs to controllers and actions in the StayHub application.

## 📁 Directory Structure

```
routes/
├── web.php      # Web routes for browser-based interactions
└── console.php  # Artisan command routes
```

## 🎯 Purpose
Defines the URL structure and routing logic for the StayHub property rental platform, handling all user interactions and page navigation.

## 🌐 Route Files

### **web.php** - Main Web Routes
The primary routing file containing all HTTP routes for the StayHub application.

## 🔄 Route Structure Overview

### 📱 **Public Routes** (No Authentication Required)
```php
// Homepage and property browsing
Route::get('/', [PropertyController::class, 'featured'])->name('home');
Route::get('/properties', [PropertyController::class, 'index'])->name('properties.index');
Route::get('/properties/{property}', [PropertyController::class, 'show'])->name('properties.show');
```

**Features:**
- **Homepage**: Featured properties display
- **Property Listings**: Searchable and filterable property index
- **Property Details**: Individual property pages with 5-image galleries

### 🔐 **Authentication Routes**
```php
// Laravel Breeze authentication routes
Auth::routes(['verify' => true]);

// Custom registration with role selection
Route::get('/register', [RegisterController::class, 'showRegistrationForm']);
Route::post('/register', [RegisterController::class, 'register']);
```

**Authentication Features:**
- **Login/Logout**: Standard authentication flow
- **Registration**: Multi-role user registration (Customer, Owner, Admin)
- **Email Verification**: Account verification system
- **Password Reset**: Forgot/reset password functionality

### 👤 **Authenticated User Routes**
```php
Route::middleware(['auth', 'verified'])->group(function () {
    // Profile management
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
    
    // Booking system
    Route::resource('bookings', BookingController::class);
    Route::post('/bookings/{booking}/review', [BookingController::class, 'review'])->name('bookings.review');
});
```

**User Features:**
- **Profile Management**: Personal info, security settings, preferences
- **Password Updates**: Secure password change functionality
- **Booking Management**: Create, view, and manage reservations
- **Review System**: Post-stay rating and review submission

### 🏠 **Property Owner Routes**
```php
Route::middleware(['auth', 'verified', 'role:owner,admin'])->group(function () {
    // Property management
    Route::resource('properties', PropertyController::class)->except(['index', 'show']);
    
    // Owner dashboard
    Route::get('/owner/dashboard', [DashboardController::class, 'owner'])->name('owner.dashboard');
});
```

**Owner Features:**
- **Property Creation**: Add new properties with 5-image requirement
- **Property Management**: Edit, update, delete property listings
- **Owner Dashboard**: Property analytics, booking overview, earnings
- **Booking Management**: Handle incoming reservation requests

### 👥 **Customer Routes**
```php
Route::middleware(['auth', 'verified', 'role:customer,admin'])->group(function () {
    // Customer dashboard
    Route::get('/customer/dashboard', [DashboardController::class, 'customer'])->name('customer.dashboard');
    
    // Booking creation
    Route::get('/properties/{property}/book', [BookingController::class, 'create'])->name('bookings.create');
    Route::post('/properties/{property}/book', [BookingController::class, 'store'])->name('bookings.store');
});
```

**Customer Features:**
- **Customer Dashboard**: Booking history, account overview (no favorites)
- **Property Booking**: Create reservations with date selection
- **Booking History**: View past and upcoming stays
- **Review Submission**: Rate completed stays

### 🔧 **Admin Routes** (Future Implementation)
```php
Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    // Admin panel access to all features
    Route::get('/admin/dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard');
});
```

## 🛡️ Route Middleware

### **Authentication Middleware:**
- **`auth`**: Requires user login
- **`verified`**: Requires email verification
- **`guest`**: Only for non-authenticated users

### **Custom Role Middleware:**
```php
// Role-based access control
'role:owner,admin'     // Only owners and admins
'role:customer,admin'  // Only customers and admins
'role:admin'          // Admin-only access
```

### **Middleware Groups:**
```php
Route::middleware(['auth', 'verified'])->group(function () {
    // Routes requiring authenticated and verified users
});
```

## 🎨 Route Naming Convention

### **Resource Routes:**
```php
Route::resource('properties', PropertyController::class);
// Generates: properties.index, properties.show, properties.create, etc.

Route::resource('bookings', BookingController::class);
// Generates: bookings.index, bookings.show, bookings.create, etc.
```

### **Custom Named Routes:**
```php
Route::get('/owner/dashboard', [DashboardController::class, 'owner'])->name('owner.dashboard');
Route::get('/customer/dashboard', [DashboardController::class, 'customer'])->name('customer.dashboard');
Route::post('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
```

## 🔍 Route Parameters

### **Model Binding:**
```php
Route::get('/properties/{property}', [PropertyController::class, 'show']);
// Automatically injects Property model instance

Route::get('/bookings/{booking}', [BookingController::class, 'show']);
// Automatically injects Booking model instance
```

### **Route Constraints:**
```php
Route::get('/properties/{property}', [PropertyController::class, 'show'])
     ->where('property', '[0-9]+');
// Ensures property ID is numeric
```

## 🚀 Route Features Implemented

### **Property System:**
- ✅ **Property Browsing**: Public access to listings
- ✅ **Property Creation**: Owners can add properties (requires 5 images)
- ✅ **Property Management**: Full CRUD operations for owners
- ✅ **Image Gallery**: Support for multiple property images

### **Booking System:**
- ✅ **Reservation Creation**: Customers can book properties
- ✅ **Booking Management**: View and manage reservations
- ✅ **Review System**: Post-stay rating submission
- ✅ **Calendar Integration**: Date availability checking

### **User Management:**
- ✅ **Multi-role Authentication**: Customer, Owner, Admin roles
- ✅ **Profile System**: Complete profile management
- ✅ **Password Security**: Secure password update functionality
- ✅ **Email Verification**: Account verification requirement

### **Dashboard System:**
- ✅ **Role-specific Dashboards**: Different views for different user types
- ✅ **Analytics Integration**: Property performance, booking statistics
- ✅ **Navigation Adaptation**: Menu changes based on user role

## ❌ **Removed Features** (As Requested)
- ❌ **Favorites System**: All routes and functionality removed
- ❌ **Report Listing**: Report functionality removed from property pages

## 🔧 **console.php** - Artisan Commands
```php
// Custom artisan commands for maintenance
Artisan::command('stayhub:cleanup', function () {
    // Clean up expired bookings, temporary files, etc.
})->describe('Cleanup StayHub temporary data');
```

## 📋 URL Structure Examples

### **Public URLs:**
- `/` - Homepage with featured properties
- `/properties` - Browse all properties
- `/properties/5` - View specific property
- `/login` - User login
- `/register` - User registration

### **Authenticated URLs:**
- `/profile` - User profile management
- `/customer/dashboard` - Customer dashboard
- `/owner/dashboard` - Owner dashboard
- `/properties/create` - Add new property (owners only)
- `/properties/5/edit` - Edit property (owners only)
- `/properties/5/book` - Book property (customers only)

### **Booking URLs:**
- `/bookings` - View all bookings
- `/bookings/create` - Create new booking
- `/bookings/15` - View specific booking
- `/bookings/15/review` - Submit review for booking

## 🔧 Development Notes

### **Route Caching:**
```bash
# Cache routes for production performance
php artisan route:cache

# Clear route cache during development
php artisan route:clear

# View all routes
php artisan route:list
```

### **Route Model Binding:**
- Automatic model injection based on route parameters
- Eliminates need for manual model loading in controllers
- Built-in 404 handling for non-existent models

### **Security Considerations:**
- All authenticated routes require email verification
- Role-based middleware prevents unauthorized access
- CSRF protection enabled for all POST/PUT/DELETE routes
- Proper parameter validation and sanitization

### **Performance Optimization:**
- Route caching for production deployment
- Efficient middleware stacking to reduce overhead
- Grouped routes to minimize middleware duplication

This routing system provides a clean, secure, and efficient URL structure for the StayHub property rental platform while maintaining proper access controls and user experience flows.