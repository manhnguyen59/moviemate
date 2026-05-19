<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StaffMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && in_array(optional(Auth::user()->role)->name, ['Staff', 'Admin'], true)) {
            return $next($request);
        }

        return redirect()->route('home');
    }
}
