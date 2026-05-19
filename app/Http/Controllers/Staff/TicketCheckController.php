<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class TicketCheckController extends Controller
{
    protected array $relations = [
        'user',
        'showtime.movie',
        'showtime.cinema',
        'showtime.room',
        'bookingSeats.seat',
    ];

    public function show()
    {
        return view('staff.tickets.check');
    }

    public function index(Request $request)
    {
        $query = Booking::with($this->relations)->latest();

        if ($request->filled('status')) {
            $query->where('booking_status', $request->status);
        }

        if ($request->filled('search')) {
            $search = trim($request->search);

            $query->where(function ($q) use ($search) {
                $q->where('booking_code', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($userQuery) use ($search) {
                        $userQuery->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%")
                            ->orWhere('phone', 'like', "%{$search}%");
                    })
                    ->orWhereHas('showtime.movie', function ($movieQuery) use ($search) {
                        $movieQuery->where('title', 'like', "%{$search}%");
                    });
            });
        }

        $bookings = $query->paginate(20)->withQueryString();

        $counts = [
            'all' => Booking::count(),
            'paid' => Booking::where('booking_status', 'paid')->count(),
            'used' => Booking::where('booking_status', 'used')->count(),
            'cancelled' => Booking::where('booking_status', 'cancelled')->count(),
            'expired' => Booking::where('booking_status', 'expired')->count(),
        ];

        return view('staff.tickets.index', compact('bookings', 'counts'));
    }

    public function check(Request $request)
    {
        $validated = $request->validate([
            'booking_code' => ['required', 'string', 'max:50'],
        ], [
            'booking_code.required' => 'Vui lòng nhập mã vé.',
        ]);

        $bookingCode = strtoupper(trim($validated['booking_code']));

        $booking = Booking::with($this->relations)
            ->where('booking_code', $bookingCode)
            ->first();

        if (! $booking || in_array($booking->booking_status, ['cancelled', 'expired'], true)) {
            return redirect()
                ->route('staff.tickets.notFound')
                ->with('booking_code', $bookingCode)
                ->with('error', 'Không tìm thấy vé hợp lệ.');
        }

        if ($booking->booking_status === 'used') {
            return redirect()
                ->route('staff.tickets.used', $booking)
                ->with('error', 'Vé đã được sử dụng trước đó.');
        }

        if ($booking->booking_status === 'paid') {
            return redirect()
                ->route('staff.tickets.valid', $booking)
                ->with('success', 'Vé hợp lệ. Vui lòng xác nhận trước khi cho khách vào rạp.');
        }

        return redirect()
            ->route('staff.tickets.notFound')
            ->with('booking_code', $bookingCode)
            ->with('error', 'Trạng thái vé không hợp lệ để sử dụng.');
    }

    public function valid(Booking $booking)
    {
        $booking->load($this->relations);

        if ($booking->booking_status === 'used') {
            return redirect()
                ->route('staff.tickets.used', $booking)
                ->with('error', 'Vé đã được sử dụng trước đó.');
        }

        if ($booking->booking_status !== 'paid') {
            return redirect()
                ->route('staff.tickets.notFound')
                ->with('booking_code', $booking->booking_code)
                ->with('error', 'Vé không còn hợp lệ.');
        }

        return view('staff.tickets.valid', compact('booking'));
    }

    public function used(Booking $booking)
    {
        $booking->load($this->relations);

        return view('staff.tickets.used', compact('booking'));
    }

    public function notFound()
    {
        $bookingCode = session('booking_code');

        return view('staff.tickets.not-found', compact('bookingCode'));
    }

    public function confirmUsed(Booking $booking)
    {
        $booking->load($this->relations);

        if ($booking->booking_status === 'used') {
            return redirect()
                ->route('staff.tickets.used', $booking)
                ->with('error', 'Vé đã được sử dụng trước đó, không thể dùng lại.');
        }

        if ($booking->booking_status !== 'paid') {
            return redirect()
                ->route('staff.tickets.notFound')
                ->with('booking_code', $booking->booking_code)
                ->with('error', 'Chỉ vé đã thanh toán và chưa sử dụng mới được xác nhận.');
        }

        $booking->forceFill([
            'booking_status' => 'used',
            'used_at' => now(),
        ])->save();

        return redirect()
            ->route('staff.tickets.used', $booking)
            ->with('success', 'Đã xác nhận sử dụng vé thành công.');
    }
}
