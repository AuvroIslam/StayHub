<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Property;
use App\Models\Booking;
use App\Models\Review;
use App\Models\Message;

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
        if (!$user->isOwner() && !$user->isAdmin()) {
            abort(403, 'Access denied. Owner privileges required.');
        }

        // Get owner's properties with related data
        $properties = Property::where('user_id', $user->id)
            ->withCount(['bookings', 'reviews'])
            ->with('primaryImage')
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

        // Get recent reviews
        $recentReviews = Review::whereHas('property', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })
        ->with(['user', 'property'])
        ->orderBy('created_at', 'desc')
        ->take(5)
        ->get();

        // Get unread messages
        $unreadMessages = Message::where('receiver_id', $user->id)
            ->where('is_read', false)
            ->count();

        return view('owner.dashboard', compact(
            'properties',
            'recentBookings',
            'totalProperties',
            'activeProperties',
            'totalBookings',
            'confirmedBookings',
            'pendingBookings',
            'totalEarnings',
            'recentReviews',
            'unreadMessages'
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
        if (!$user->isCustomer() && !$user->isAdmin()) {
            abort(403, 'Access denied. Customer account required.');
        }

        // Get customer's bookings
        $bookings = Booking::where('user_id', $user->id)
            ->with(['property.primaryImage', 'payment'])
            ->orderBy('created_at', 'desc')
            ->get();

        // Separate bookings by status
        $upcomingBookings = $bookings->where('status', 'confirmed')
            ->where('check_in', '>=', now())
            ->sortBy('check_in');

        $pastBookings = $bookings->whereIn('status', ['completed', 'cancelled'])
            ->sortByDesc('check_out');

        $pendingBookings = $bookings->where('status', 'pending');

        // Get favorites
        $favorites = $user->favorites()
            ->with(['primaryImage', 'owner'])
            ->get();

        // Get user's reviews
        $reviews = Review::where('user_id', $user->id)
            ->with('property')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Statistics
        $totalBookings = $bookings->count();
        $totalSpent = $bookings->whereIn('status', ['confirmed', 'completed'])
            ->sum('total_price');

        // Get unread messages
        $unreadMessages = Message::where('receiver_id', $user->id)
            ->where('is_read', false)
            ->count();

        return view('customer.dashboard', compact(
            'upcomingBookings',
            'pastBookings',
            'pendingBookings',
            'favorites',
            'reviews',
            'totalBookings',
            'totalSpent',
            'unreadMessages'
        ));
    }

    /**
     * Admin dashboard.
     */
    public function admin()
    {
        $user = Auth::user();

        // Authorization
        if (!$user->isAdmin()) {
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
        $recentProperties = Property::with(['owner', 'primaryImage'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $recentBookings = Booking::with(['property', 'customer'])
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        $recentReviews = Review::with(['user', 'property'])
            ->orderBy('created_at', 'desc')
            ->take(5)
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
            'recentBookings',
            'recentReviews'
        ));
    }
}
