<?php

use Illuminate\Support\Facades\Route;

// Homepage
Route::get('/', function () {
    return view('home');
});

// Authentication Routes
Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/register', function () {
    return view('auth.register');
});

// Property Routes
Route::get('/properties', function () {
    return view('properties.index');
});

Route::get('/property/{id}', function ($id) {
    return view('properties.show');
});

Route::get('/search', function () {
    return view('properties.index');
});

// Owner Dashboard Routes
Route::get('/owner/dashboard', function () {
    return view('owner.dashboard');
});

Route::get('/owner/properties', function () {
    return view('owner.dashboard');
});

Route::get('/owner/bookings', function () {
    return view('owner.dashboard');
});

Route::get('/owner/earnings', function () {
    return view('owner.dashboard');
});

// Customer Dashboard Routes
Route::get('/customer/dashboard', function () {
    return view('customer.dashboard');
});

Route::get('/customer/bookings', function () {
    return view('customer.dashboard');
});

Route::get('/customer/favorites', function () {
    return view('customer.dashboard');
});

// Messages
Route::get('/messages', function () {
    return view('customer.dashboard');
});

// Profile
Route::get('/profile', function () {
    return view('customer.dashboard');
});
