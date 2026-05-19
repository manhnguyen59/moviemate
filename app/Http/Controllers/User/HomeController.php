<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use App\Models\Showtime;

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

        $quickShowtimes = Showtime::with(['movie.genres', 'cinema', 'room'])
            ->where('status', 'active')
            ->whereDate('show_date', '>=', now('Asia/Ho_Chi_Minh')->toDateString())
            ->orderBy('show_date')
            ->orderBy('show_time')
            ->limit(10)
            ->get();

        return view('user.home', compact('nowShowing', 'comingSoon', 'quickShowtimes'));
    }
}
