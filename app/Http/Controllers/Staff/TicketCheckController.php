<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class TicketCheckController extends Controller
{
    public function show()
    {
        return view('staff.tickets.check');
    }

    public function index()
    {
        $bookings = Booking::with([
            'user',
            'showtime.movie',
            'showtime.cinema',
            'showtime.room',
            'bookingSeats.seat',
        ])
            ->latest()
            ->paginate(20);

        return view('staff.tickets.index', compact('bookings'));
    }

    public function check(Request $request)
    {
        $validated = $request->validate([
            'booking_code' => ['required', 'string', 'max:50'],
        ]);

        $bookingCode = strtoupper(trim($validated['booking_code']));
        $booking = Booking::with([
            'user',
            'showtime.movie',
            'showtime.cinema',
            'showtime.room',
            'bookingSeats.seat',
        ])
            ->where('booking_code', $bookingCode)
            ->first();

        if (! $booking || in_array($booking->booking_status, ['cancelled', 'expired'], true)) {
            return redirect()
                ->route('staff.tickets.notFound')
                ->with('booking_code', $bookingCode);
        }

        if ($booking->booking_status === 'used') {
            return redirect()->route('staff.tickets.used', $booking);
        }

        if ($booking->payment_status === 'paid' && $booking->booking_status === 'paid') {
            return redirect()->route('staff.tickets.valid', $booking);
        }

        return redirect()
            ->route('staff.tickets.notFound')
            ->with('booking_code', $bookingCode);
    }

    public function valid(?Booking $booking = null)
    {
        $booking?->load([
            'user',
            'showtime.movie',
            'showtime.cinema',
            'showtime.room',
            'bookingSeats.seat',
        ]);

        return view('staff.tickets.valid', compact('booking'));
    }

    public function used(?Booking $booking = null)
    {
        $booking?->load([
            'user',
            'showtime.movie',
            'showtime.cinema',
            'showtime.room',
            'bookingSeats.seat',
        ]);

        return view('staff.tickets.used', compact('booking'));
    }

    public function notFound()
    {
        $bookingCode = session('booking_code');

        return view('staff.tickets.not-found', compact('bookingCode'));
    }

    public function markUsed(Booking $booking)
    {
        $booking->load([
            'user',
            'showtime.movie',
            'showtime.cinema',
            'showtime.room',
            'bookingSeats.seat',
        ]);

        if ($booking->booking_status === 'used') {
            return redirect()->route('staff.tickets.used', $booking);
        }

        if ($booking->payment_status !== 'paid' || $booking->booking_status !== 'paid') {
            return redirect()
                ->route('staff.tickets.notFound')
                ->with('booking_code', $booking->booking_code);
        }

        $booking->update([
            'booking_status' => 'used',
            'used_at' => now(),
        ]);

        return redirect()->route('staff.tickets.used', $booking);
    }
}
