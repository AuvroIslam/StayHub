<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\BookingController;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes - Demonstrates MVC Architecture
|--------------------------------------------------------------------------
| All routes follow RESTful conventions and connect to Resource Controllers
| This demonstrates: Routing, Controllers, CRUD operations
*/

// ========== PUBLIC ROUTES ==========

// Homepage with featured properties
Route::get('/', [PropertyController::class, 'featured'])->name('home');

// Property Routes (READ operations are public)
Route::get('/properties', [PropertyController::class, 'index'])->name('properties.index');

// Redirect singular /property to plural /properties (common mistake fix)
Route::get('/property/{id}', function($id) {
    return redirect("/properties/{$id}", 301);
});

// Authentication Routes (Using Laravel's built-in authentication)
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// ========== AUTHENTICATED ROUTES (with Middleware) ==========
Route::middleware(['auth'])->group(function () {
    
    // Property Management (CREATE, UPDATE, DELETE - Owner/Admin only)
    Route::get('/properties/create', [PropertyController::class, 'create'])->name('properties.create');
    Route::post('/properties', [PropertyController::class, 'store'])->name('properties.store');
    Route::get('/properties/{property}/edit', [PropertyController::class, 'edit'])->name('properties.edit');
    Route::put('/properties/{property}', [PropertyController::class, 'update'])->name('properties.update');
    Route::delete('/properties/{property}', [PropertyController::class, 'destroy'])->name('properties.destroy');
    

    
    // Booking Resource Routes (Full CRUD)
    Route::resource('bookings', BookingController::class);
    Route::post('/bookings/{booking}/confirm', [BookingController::class, 'confirm'])->name('bookings.confirm');
    Route::post('/bookings/{booking}/complete', [BookingController::class, 'complete'])->name('bookings.complete');
    
    // Reviews feature removed as per simplified architecture
    
    // Dashboard Routes with Role-based Access
    Route::get('/owner/dashboard', [DashboardController::class, 'owner'])->name('owner.dashboard');
    Route::get('/owner/bookings', [BookingController::class, 'index'])->name('owner.bookings');
    Route::get('/customer/dashboard', [DashboardController::class, 'customer'])->name('customer.dashboard');
    Route::get('/admin/dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard');
    
    // Profile Routes
    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');

    Route::put('/profile', function (Request $request) {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        
        // Handle different form actions
        $action = $request->input('action', 'personal_info');
        
        if ($action === 'change_password') {
            // Handle password change
            $request->validate([
                'current_password' => 'required',
                'new_password' => 'required|min:8|confirmed',
            ]);
            
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->with('error', 'Current password is incorrect.');
            }
            
            $user->update([
                'password' => Hash::make($request->new_password)
            ]);
            
            return back()->with('success', 'Password updated successfully!');
        }
        
        if ($action === 'preferences') {
            // Handle preferences update (you can extend this based on your needs)
            return back()->with('success', 'Preferences updated successfully!');
        }
        
        // Handle personal info update
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'date_of_birth' => 'nullable|date',
            'bio' => 'nullable|string|max:1000',
        ]);
        
        $user->update($validated);
        
        return back()->with('success', 'Profile updated successfully!');
    })->name('profile.update');
    
    // Availability Check API
    Route::post('/api/check-availability', [BookingController::class, 'checkAvailability']);
});

// Property show route (must be last to not catch /properties/create)
Route::get('/properties/{property}', [PropertyController::class, 'show'])->name('properties.show');
