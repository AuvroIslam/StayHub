<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Property;
use App\Models\Booking;

/**
 * Dashboard Controller for Owner and Customer dashboards
 * Demonstrates: Controllers, Eloquent Queries, Blade Templates
 */
class DashboardController extends Controller
{
    /**
     * Show the owner dashboard.
     * Displays properties, bookings, earnings, and statistics.
     */
    public function owner()
    {
        $user = Auth::user();

        // Authorization
        if ($user->role !== 'owner' && $user->role !== 'admin') {
            abort(403, 'Access denied. Owner privileges required.');
        }

        // Get owner's properties with related data
        $properties = Property::where('user_id', $user->id)
            ->withCount('bookings')
            ->get();

        // Get recent bookings for owner's properties
        $recentBookings = Booking::whereHas('property', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })
        ->with(['property', 'customer'])
        ->orderBy('created_at', 'desc')
        ->take(10)
        ->get();

        // Calculate statistics
        $totalProperties = $properties->count();
        $activeProperties = $properties->where('status', 'active')->count();
        
        $totalBookings = Booking::whereHas('property', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })->count();

        $confirmedBookings = Booking::whereHas('property', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })
        ->where('status', 'confirmed')
        ->count();

        $pendingBookings = Booking::whereHas('property', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })
        ->where('status', 'pending')
        ->count();

        // Calculate total earnings
        $totalEarnings = Booking::whereHas('property', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })
        ->whereIn('status', ['confirmed', 'completed'])
        ->sum('total_price');

        return view('owner.dashboard', compact(
            'properties',
            'recentBookings',
            'totalProperties',
            'activeProperties',
            'totalBookings',
            'confirmedBookings',
            'pendingBookings',
            'totalEarnings'
        ));
    }

    /**
     * Show the customer dashboard.
     * Displays bookings, favorites, and user activity.
     */
    public function customer()
    {
        $user = Auth::user();

        // Authorization
        if ($user->role !== 'customer' && $user->role !== 'admin') {
            abort(403, 'Access denied. Customer account required.');
        }

        // Get customer's bookings
        $bookings = Booking::where('user_id', $user->id)
            ->with('property')
            ->orderBy('created_at', 'desc')
            ->get();

        // Separate bookings by status
        $upcomingBookings = $bookings->where('status', 'confirmed')
            ->where('check_in', '>=', now())
            ->sortBy('check_in');

        $pastBookings = $bookings->whereIn('status', ['completed', 'cancelled'])
            ->sortByDesc('check_out');

        $pendingBookings = $bookings->where('status', 'pending');

        // Statistics
        $totalBookings = $bookings->count();
        $totalSpent = $bookings->whereIn('status', ['confirmed', 'completed'])
            ->sum('total_price');

        return view('customer.dashboard', compact(
            'upcomingBookings',
            'pastBookings',
            'pendingBookings',
            'totalBookings',
            'totalSpent'
        ));
    }

    /**
     * Admin dashboard.
     */
    public function admin()
    {
        $user = Auth::user();

        // Authorization
        if ($user->role !== 'admin') {
            abort(403, 'Access denied. Admin privileges required.');
        }

        // Overall statistics
        $totalUsers = \App\Models\User::count();
        $totalOwners = \App\Models\User::where('role', 'owner')->count();
        $totalCustomers = \App\Models\User::where('role', 'customer')->count();

        $totalProperties = Property::count();
        $activeProperties = Property::where('status', 'active')->count();
        $pendingProperties = Property::where('status', 'pending')->count();

        $totalBookings = Booking::count();
        $confirmedBookings = Booking::where('status', 'confirmed')->count();
        $pendingBookings = Booking::where('status', 'pending')->count();
        $completedBookings = Booking::where('status', 'completed')->count();

        $totalRevenue = Booking::whereIn('status', ['confirmed', 'completed'])->sum('total_price');

        // Recent activity
        $recentProperties = Property::with('owner')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $recentBookings = Booking::with(['property', 'customer'])
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalOwners',
            'totalCustomers',
            'totalProperties',
            'activeProperties',
            'pendingProperties',
            'totalBookings',
            'confirmedBookings',
            'pendingBookings',
            'completedBookings',
            'totalRevenue',
            'recentProperties',
            'recentBookings'
        ));
    }
}
