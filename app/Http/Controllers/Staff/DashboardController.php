<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Showtime;

class DashboardController extends Controller
{
    public function index()
    {
        $today = now('Asia/Ho_Chi_Minh')->toDateString();

        $stats = [
            'tickets_today' => Booking::whereDate('created_at', $today)->count(),
            'checked_in_today' => Booking::where('booking_status', 'used')
                ->whereDate('used_at', $today)
                ->count(),
            'unused_paid' => Booking::where('booking_status', 'paid')->count(),
            'showtimes_today' => Showtime::whereDate('show_date', $today)->count(),
        ];

        $upcomingShowtimes = Showtime::with(['movie', 'cinema', 'room'])
            ->whereDate('show_date', $today)
            ->orderBy('show_time')
            ->limit(5)
            ->get();

        $recentCheckIns = Booking::with(['user', 'showtime.movie', 'showtime.room'])
            ->where('booking_status', 'used')
            ->latest('used_at')
            ->limit(8)
            ->get();

        return view('staff.dashboard', compact('stats', 'upcomingShowtimes', 'recentCheckIns'));
    }
}
