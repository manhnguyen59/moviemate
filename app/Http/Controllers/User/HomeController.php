<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Movie;

class HomeController extends Controller
{
    /**
     * Show the home page with now showing and coming soon movies.
     */
    public function index()
    {
        $nowShowing = Movie::where('status', 'now_showing')
            ->orderByDesc('created_at')
            ->get();

        $comingSoon = Movie::where('status', 'coming_soon')
            ->orderBy('release_date')
            ->get();

        return view('user.home', compact('nowShowing', 'comingSoon'));
    }
}