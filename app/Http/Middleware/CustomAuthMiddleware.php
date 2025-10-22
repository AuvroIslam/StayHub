<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomAuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            // Custom redirect - you can change this to any page!
            return redirect('/custom-login-page')->with('error', 'Please log in first.');
        }

        return $next($request);
    }
}