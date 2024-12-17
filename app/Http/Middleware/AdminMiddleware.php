<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        // Check if the user is authenticated as an admin
        if (!Auth::guard('admin')->check()) {
            // Redirect to the login page with an error message
            return redirect('/admin/login')->withErrors(['User' => 'You do not have access to this area.']);
        }

        return $next($request);
    }
}
