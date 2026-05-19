<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\BookingSeat;
use App\Models\Seat;
use App\Models\Showtime;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class BookingController extends Controller
{
    /**
     * Show seat selection page for a given showtime.
     */
    public function selectSeat(Showtime $showtime)
    {
        $showtime->load(['movie', 'cinema', 'room']);

        if (! $this->isShowtimeAvailable($showtime)) {
            return ($showtime->movie?->slug
                ? redirect()->route('user.movies.show', $showtime->movie->slug)
                : redirect()->route('user.movies.index'))
                ->with('error', 'Suất chiếu này đã qua giờ hoặc không còn khả dụng.');
        }

        $seats = Seat::where('room_id', $showtime->room_id)
            ->orderBy('row')
            ->orderBy('number')
            ->get();

        $bookedSeatIds = $this->bookedSeatQuery($showtime)->pluck('seat_id')->toArray();

        $seatsByRow = $seats->groupBy('row');

        return view('user.bookings.select-seat', compact(
            'showtime',
            'seats',
            'seatsByRow',
            'bookedSeatIds'
        ));
    }

    /**
     * Show checkout page for selected seats.
     */
    public function checkout(Request $request, Showtime $showtime)
    {
        $showtime->load(['movie', 'cinema', 'room']);

        if (! $this->isShowtimeAvailable($showtime)) {
            return ($showtime->movie?->slug
                ? redirect()->route('user.movies.show', $showtime->movie->slug)
                : redirect()->route('user.movies.index'))
                ->with('error', 'Suất chiếu này đã qua giờ hoặc không còn khả dụng.');
        }

        $seatIds = $this->parseSeatIds($request->query('selected_seats', ''));

        if (empty($seatIds)) {
            return redirect()
                ->route('user.bookings.selectSeat', $showtime->id)
                ->with('error', 'Vui lòng chọn ít nhất một ghế.');
        }

        $seats = Seat::where('room_id', $showtime->room_id)
            ->whereIn('id', $seatIds)
            ->orderBy('row')
            ->orderBy('number')
            ->get();

        if ($seats->count() !== count($seatIds)) {
            return redirect()
                ->route('user.bookings.selectSeat', $showtime->id)
                ->with('error', 'Danh sách ghế không hợp lệ.');
        }

        if ($seats->contains(fn ($seat) => $seat->status !== 'active')) {
            return redirect()
                ->route('user.bookings.selectSeat', $showtime->id)
                ->with('error', 'Có ghế đang bảo trì hoặc không khả dụng.');
        }

        $bookedSeatIds = $this->bookedSeatQuery($showtime)
            ->whereIn('seat_id', $seatIds)
            ->pluck('seat_id')
            ->toArray();

        if (! empty($bookedSeatIds)) {
            return redirect()
                ->route('user.bookings.selectSeat', $showtime->id)
                ->with('error', 'Một số ghế bạn chọn đã được người khác đặt trước.');
        }

        $seatSummaries = $seats->map(function ($seat) use ($showtime) {
            $price = $seat->type === 'vip'
                ? ($showtime->vip_price ?? $showtime->price)
                : $showtime->price;

            return [
                'id' => $seat->id,
                'seat_code' => $seat->seat_code,
                'type' => $seat->type,
                'price' => (float) $price,
            ];
        });

        $totalAmount = $seatSummaries->sum('price');

        return view('user.bookings.checkout', [
            'showtime' => $showtime,
            'seats' => $seats,
            'seatSummaries' => $seatSummaries,
            'totalAmount' => $totalAmount,
            'user' => Auth::user(),
        ]);
    }

    /**
     * Store a booking with fake successful payment.
     *
     * @throws \Throwable
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'showtime_id' => ['required', 'integer', 'exists:showtimes,id'],
            'seat_ids' => ['required', 'array', 'min:1'],
            'seat_ids.*' => ['integer', 'distinct'],
            'payment_method' => ['required', 'in:fake,counter,vnpay'],
        ], [
            'seat_ids.required' => 'Vui lòng chọn ít nhất một ghế.',
            'seat_ids.array' => 'Dữ liệu ghế không hợp lệ.',
            'seat_ids.*.distinct' => 'Danh sách ghế bị trùng.',
        ]);

        try {
            $booking = DB::transaction(function () use ($validated) {
                $showtime = Showtime::with(['movie', 'cinema', 'room'])
                    ->lockForUpdate()
                    ->findOrFail($validated['showtime_id']);

                if (! $this->isShowtimeAvailable($showtime)) {
                    throw ValidationException::withMessages([
                        'showtime' => 'Suất chiếu này đã qua giờ hoặc không còn khả dụng.',
                    ]);
                }

                $seatIds = collect($validated['seat_ids'])
                    ->map(fn ($id) => (int) $id)
                    ->unique()
                    ->values()
                    ->all();

                $seats = Seat::where('room_id', $showtime->room_id)
                    ->whereIn('id', $seatIds)
                    ->lockForUpdate()
                    ->orderBy('row')
                    ->orderBy('number')
                    ->get();

                if ($seats->count() !== count($seatIds)) {
                    throw ValidationException::withMessages([
                        'seat_ids' => 'Ghế đã chọn không hợp lệ hoặc không thuộc phòng chiếu này.',
                    ]);
                }

                $maintenanceSeat = $seats->first(fn ($seat) => $seat->status !== 'active');
                if ($maintenanceSeat) {
                    throw ValidationException::withMessages([
                        'seat_ids' => 'Có ghế đang bảo trì, vui lòng chọn ghế khác.',
                    ]);
                }

                $alreadyBookedSeatIds = $this->bookedSeatQuery($showtime)
                    ->whereIn('seat_id', $seatIds)
                    ->lockForUpdate()
                    ->pluck('seat_id')
                    ->all();

                if (! empty($alreadyBookedSeatIds)) {
                    throw ValidationException::withMessages([
                        'seat_ids' => 'Một hoặc nhiều ghế đã bị người khác đặt trước. Vui lòng chọn lại.',
                    ]);
                }

                $seatPrices = [];
                $totalAmount = 0;

                foreach ($seats as $seat) {
                    $price = $seat->type === 'vip'
                        ? (float) ($showtime->vip_price ?? $showtime->price)
                        : (float) $showtime->price;

                    $seatPrices[$seat->id] = $price;
                    $totalAmount += $price;
                }

                $booking = Booking::create([
                    'user_id' => Auth::id(),
                    'showtime_id' => $showtime->id,
                    'booking_code' => $this->generateBookingCode(),
                    'total_amount' => $totalAmount,
                    'payment_status' => 'paid',
                    'booking_status' => 'paid',
                ]);

                foreach ($seats as $seat) {
                    BookingSeat::create([
                        'booking_id' => $booking->id,
                        'showtime_id' => $showtime->id,
                        'seat_id' => $seat->id,
                        'price' => $seatPrices[$seat->id],
                    ]);
                }

                $booking->payment()->create([
                    'payment_method' => $validated['payment_method'],
                    'amount' => $totalAmount,
                    'status' => 'success',
                    'transaction_code' => 'FAKE-'.now()->format('YmdHis').'-'.$booking->id,
                    'paid_at' => now(),
                ]);

                return $booking;
            });
        } catch (QueryException $exception) {
            if ($this->isDuplicateSeatConstraint($exception)) {
                return back()
                    ->withInput()
                    ->with('error', 'Một hoặc nhiều ghế đã bị người khác đặt trước. Vui lòng chọn lại ghế.');
            }

            throw $exception;
        }

        return redirect()->route('user.bookings.success', $booking);
    }

    /**
     * Show booking success page.
     */
    public function success(Booking $booking)
    {
        abort_unless($booking->user_id === Auth::id(), 403);

        $booking->load([
            'user',
            'payment',
            'showtime.movie',
            'showtime.cinema',
            'showtime.room',
            'bookingSeats.seat',
        ]);

        return view('user.bookings.success', compact('booking'));
    }

    /**
     * Parse seat ids from comma-separated query string.
     */
    /**
     * Show ticket (QR) for a booking owned by the user.
     */
    public function ticket(Booking $booking)
    {
        abort_unless($booking->user_id === Auth::id(), 403);

        $booking->load([
            'user',
            'payment',
            'showtime.movie',
            'showtime.cinema',
            'showtime.room',
            'bookingSeats.seat',
        ]);

        return view('user.bookings.ticket', compact('booking'));
    }

    /**
     * Show booking history for the authenticated user with optional status filter.
     */
    public function history(Request $request)
    {
        $query = Booking::where('user_id', Auth::id());

        if ($request->filled('status')) {
            $query->where('booking_status', $request->status);
        }

        $bookings = $query->with([
            'showtime.movie',
            'showtime.cinema',
            'showtime.room',
            'bookingSeats.seat',
            'payment',
        ])->orderBy('created_at', 'desc')->paginate(10);

        return view('user.bookings.history', compact('bookings', 'request'));
    }

    /**
     * Cancel a booking owned by the authenticated user.
     */
    public function cancel(Booking $booking)
    {
        abort_unless($booking->user_id === Auth::id(), 403);

        if ($booking->booking_status === 'used') {
            return back()->with('error', 'Ve da su dung nen khong the huy.');
        }

        if (! in_array($booking->booking_status, ['pending', 'paid'], true)) {
            return back()->with('error', 'Ve nay khong the huy.');
        }

        $booking->update([
            'booking_status' => 'cancelled',
            'payment_status' => $booking->payment_status === 'paid' ? 'refunded' : $booking->payment_status,
        ]);

        $booking->bookingSeats()->delete();

        return back()->with('success', 'Da huy ve thanh cong.');
    }

    protected function parseSeatIds(string $selectedSeats): array
    {
        return collect(explode(',', $selectedSeats))
            ->map(fn ($id) => trim($id))
            ->filter(fn ($id) => $id !== '' && ctype_digit($id))
            ->map(fn ($id) => (int) $id)
            ->unique()
            ->values()
            ->all();
    }

    protected function bookedSeatQuery(Showtime $showtime)
    {
        return BookingSeat::whereHas('booking', function ($query) {
            $query->whereNotIn('booking_status', ['cancelled', 'expired']);
        })->where(function ($query) use ($showtime) {
            $query->where('showtime_id', $showtime->id)
                ->orWhereHas('booking', function ($bookingQuery) use ($showtime) {
                    $bookingQuery->where('showtime_id', $showtime->id);
                });
        });
    }

    protected function isDuplicateSeatConstraint(QueryException $exception): bool
    {
        return str_contains($exception->getMessage(), 'booking_seats_showtime_id_seat_id_unique')
            || str_contains($exception->getMessage(), 'booking_seats.showtime_id, booking_seats.seat_id');
    }

    /**
     * Check whether a showtime can still be booked.
     */
    protected function isShowtimeAvailable(Showtime $showtime): bool
    {
        if ($showtime->status !== 'active') {
            return false;
        }

        if (! $showtime->show_date || ! $showtime->show_time) {
            return false;
        }

        $showDateTime = Carbon::parse(
            Carbon::parse($showtime->show_date)->format('Y-m-d').' '.$showtime->show_time,
            'Asia/Ho_Chi_Minh'
        );

        return $showDateTime->isFuture();
    }

    /**
     * Generate unique booking code with format MMT-YYYY-XXXX.
     */
    protected function generateBookingCode(): string
    {
        $year = now()->format('Y');

        do {
            $latestBooking = Booking::whereYear('created_at', $year)
                ->lockForUpdate()
                ->latest('id')
                ->first();

            $nextNumber = $latestBooking
                ? ((int) substr($latestBooking->booking_code, -4)) + 1
                : 1;

            $bookingCode = 'MMT-'.$year.'-'.str_pad((string) $nextNumber, 4, '0', STR_PAD_LEFT);
        } while (Booking::where('booking_code', $bookingCode)->exists());

        return $bookingCode;
    }
}
