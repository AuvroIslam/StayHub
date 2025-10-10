<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ReviewController;
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
Route::get('/properties/{property}', [PropertyController::class, 'show'])->name('properties.show');

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
    
    // Favorite toggle
    Route::post('/properties/{property}/favorite', [PropertyController::class, 'toggleFavorite'])->name('properties.favorite');
    
    // Booking Resource Routes (Full CRUD)
    Route::resource('bookings', BookingController::class);
    Route::post('/bookings/{booking}/confirm', [BookingController::class, 'confirm'])->name('bookings.confirm');
    Route::post('/bookings/{booking}/complete', [BookingController::class, 'complete'])->name('bookings.complete');
    
    // Review Resource Routes (Full CRUD)
    Route::get('/bookings/{booking}/review', [ReviewController::class, 'create'])->name('reviews.create');
    Route::resource('reviews', ReviewController::class)->except(['create']);
    
    // Dashboard Routes with Role-based Access
    Route::get('/owner/dashboard', [DashboardController::class, 'owner'])->name('owner.dashboard');
    Route::get('/customer/dashboard', [DashboardController::class, 'customer'])->name('customer.dashboard');
    Route::get('/admin/dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard');
    
    // Profile Routes
    Route::get('/profile', function () {
        return view('profile.edit');
    })->name('profile.edit');
    
    Route::put('/profile', function () {
        // Profile update logic here
    })->name('profile.update');
});
