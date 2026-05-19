<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Showtime;
use App\Models\Seat;
use App\Models\BookingSeat;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Show seat selection page for a given showtime.
     */
    public function selectSeat(Showtime $showtime)
    {
        // Load relationships
        $showtime->load(['movie', 'cinema', 'room']);

        // Get all seats for this room, ordered by row and number
        $seats = Seat::where('room_id', $showtime->room_id)
            ->orderBy('row')
            ->orderBy('number')
            ->get();

        // Get booked seat IDs for this showtime (exclude cancelled bookings)
        $bookedSeatIds = BookingSeat::whereHas('booking', function ($q) use ($showtime) {
            $q->where('showtime_id', $showtime->id)
              ->where('booking_status', '!=', 'cancelled');
        })->pluck('seat_id')->toArray();

        // Group seats by row for display
        $seatsByRow = $seats->groupBy('row');

        return view('user.bookings.select-seat', compact(
            'showtime',
            'seats',
            'seatsByRow',
            'bookedSeatIds'
        ));
    }
}