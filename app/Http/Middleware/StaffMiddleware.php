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
        $roleName = strtolower(optional(Auth::user()->role)->name ?? '');

        if (Auth::check() && in_array($roleName, ['staff', 'admin'], true)) {
            return $next($request);
        }

        return redirect()->route('home');
    }
}
