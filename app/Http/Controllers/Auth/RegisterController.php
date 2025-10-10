<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/**
 * Register Controller - Handles user registration
 * Demonstrates: Form Validation, Mass Assignment Protection, Password Hashing, Flash Messages
 */
class RegisterController extends Controller
{
    /**
     * Show the registration form.
     * Blade Directives Used: @csrf, @error
     */
    public function showRegistrationForm()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }

        return view('auth.register');
    }

    /**
     * Handle registration request.
     * Demonstrates: Form Validation, Mass Assignment ($fillable), Password Hashing, Flash Session Data
     */
    public function register(Request $request)
    {
        // Form Validation with detailed rules
        $validated = $request->validate([
            'name' => 'required|string|max:255|min:2',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:customer,owner',
            'phone' => 'nullable|string|max:20',
        ], [
            // Custom validation messages
            'name.required' => 'Please enter your full name.',
            'email.required' => 'Email address is required.',
            'email.unique' => 'This email is already registered.',
            'password.min' => 'Password must be at least 8 characters.',
            'password.confirmed' => 'Password confirmation does not match.',
            'role.required' => 'Please select account type (Customer or Property Owner).',
        ]);

        // Create user using Mass Assignment (protected by $fillable in User model)
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']), // Password hashing for security
            'role' => $validated['role'],
            'phone' => $validated['phone'] ?? null,
        ]);

        // Automatically login the user after registration
        Auth::login($user);

        // Flash Session Data for success message
        session()->flash('success', 'Registration successful! Welcome to StayHub, ' . $user->name . '!');

        // Redirect based on role
        if ($user->isOwner()) {
            return redirect()->route('owner.dashboard')
                ->with('info', 'Complete your profile to start listing properties.');
        } else {
            return redirect()->route('customer.dashboard')
                ->with('info', 'Start exploring amazing properties!');
        }
    }
}
