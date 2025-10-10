<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

/**
 * Login Controller - Handles user authentication
 * Demonstrates: Authentication, CSRF Protection, Form Validation, Flash Session Messages
 */
class LoginController extends Controller
{
    /**
     * Show the login form.
     * Blade Directives Used: @csrf
     */
    public function showLoginForm()
    {
        if (Auth::check()) {
            return $this->redirectToDashboard();
        }

        return view('auth.login');
    }

    /**
     * Handle login request.
     * Demonstrates: Form Validation, CSRF Protection (automatic), Flash Session Data
     */
    public function login(Request $request)
    {
        // Form Validation
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        $remember = $request->has('remember');

        // Attempt authentication
        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate(); // Security: Prevent session fixation

            // Flash Session Data for success message
            session()->flash('success', 'Welcome back, ' . Auth::user()->name . '!');

            // Redirect based on user role
            return $this->redirectToDashboard();
        }

        // Flash Session Data for error message
        return back()
            ->withErrors(['email' => 'The provided credentials do not match our records.'])
            ->withInput($request->except('password'));
    }

    /**
     * Handle logout request.
     * Demonstrates: @csrf, @method('POST')
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken(); // Security: CSRF token regeneration

        // Flash Session Data
        session()->flash('success', 'You have been logged out successfully.');

        return redirect()->route('home');
    }

    /**
     * Redirect to appropriate dashboard based on user role.
     */
    protected function redirectToDashboard()
    {
        $user = Auth::user();

        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->isOwner()) {
            return redirect()->route('owner.dashboard');
        } else {
            return redirect()->route('customer.dashboard');
        }
    }
}
