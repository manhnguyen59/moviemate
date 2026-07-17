<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\BookingSeat;
use App\Models\FoodItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Seat;
use App\Models\Showtime;
use App\Services\LoyaltyPointService;
use App\Services\PayosService;
use App\Services\SeatHoldService;
use App\Services\VoucherService;
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
        app(SeatHoldService::class)->expireStale($showtime->id);
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

        $bookedSeatIds = array_values(array_unique(array_merge(
            $this->bookedSeatQuery($showtime)->pluck('seat_id')->toArray(),
            app(SeatHoldService::class)->activeHeldSeatIds($showtime, Auth::id())
        )));

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
        app(SeatHoldService::class)->expireStale($showtime->id);
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

        $seatHoldExpiresAt = app(SeatHoldService::class)->holdSeats(Auth::user(), $showtime, $seatIds);

        $seatSummaries = $seats->map(function ($seat) use ($showtime) {
            $price = $showtime->priceForSeatType($seat->type);

            return [
                'id' => $seat->id,
                'seat_code' => $seat->seat_code,
                'type' => $seat->type,
                'price' => (float) $price,
            ];
        });

        $foods = FoodItem::where('active', true)->orderBy('name')->get();
        $foodQuantities = collect($request->query('foods', []))
            ->map(fn ($quantity) => min(10, max(0, (int) $quantity)))
            ->filter()
            ->all();
        $selectedFoods = $foods->filter(fn ($food) => isset($foodQuantities[$food->id]))
            ->map(fn ($food) => [
                'id' => $food->id,
                'name' => $food->name,
                'quantity' => $foodQuantities[$food->id],
                'price' => (float) $food->price,
                'total' => (float) $food->price * $foodQuantities[$food->id],
            ])->values();
        $seatSubtotalAmount = $seatSummaries->sum('price');
        $foodSubtotalAmount = $selectedFoods->sum('total');
        $subtotalAmount = $seatSubtotalAmount + $foodSubtotalAmount;
        $voucherCode = $request->query('voucher_code');
        $voucherSummary = app(VoucherService::class)->resolve($voucherCode, $subtotalAmount, Auth::id());
        $amountAfterVoucher = (float) $voucherSummary['total'];
        $requestedPoints = max(0, (int) $request->query('loyalty_points', 0));
        $maxRedeemablePoints = min((int) (Auth::user()->loyalty_points ?? 0), (int) floor($amountAfterVoucher / LoyaltyPointService::VALUE_PER_POINT));
        $redeemedPoints = min($requestedPoints, $maxRedeemablePoints);
        $pointDiscountAmount = $redeemedPoints * LoyaltyPointService::VALUE_PER_POINT;
        $totalAmount = max(0, $amountAfterVoucher - $pointDiscountAmount);

        return view('user.bookings.checkout', [
            'showtime' => $showtime,
            'seats' => $seats,
            'seatSummaries' => $seatSummaries,
            'foods' => $foods,
            'foodQuantities' => $foodQuantities,
            'selectedFoods' => $selectedFoods,
            'seatSubtotalAmount' => $seatSubtotalAmount,
            'foodSubtotalAmount' => $foodSubtotalAmount,
            'subtotalAmount' => $subtotalAmount,
            'totalAmount' => $totalAmount,
            'voucherSummary' => $voucherSummary,
            'voucherCode' => $voucherCode,
            'amountAfterVoucher' => $amountAfterVoucher,
            'maxRedeemablePoints' => $maxRedeemablePoints,
            'redeemedPoints' => $redeemedPoints,
            'pointDiscountAmount' => $pointDiscountAmount,
            'seatHoldExpiresAt' => $seatHoldExpiresAt,
            'user' => Auth::user(),
        ]);
    }

    /**
     * Store a pending booking and redirect to payOS QR payment.
     *
     * @throws \Throwable
     */
    public function store(Request $request)
    {
        app(SeatHoldService::class)->expireStale((int) $request->input('showtime_id'));
        $validated = $request->validate([
            'showtime_id' => ['required', 'integer', 'exists:showtimes,id'],
            'seat_ids' => ['required', 'array', 'min:1'],
            'seat_ids.*' => ['integer', 'distinct'],
            'payment_method' => ['nullable', 'in:payos'],
            'voucher_code' => ['nullable', 'string', 'max:50'],
            'loyalty_points' => ['nullable', 'integer', 'min:0'],
            'foods' => ['nullable', 'array'],
            'foods.*' => ['integer', 'min:1', 'max:10'],
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

                $user = \App\Models\User::whereKey(Auth::id())->lockForUpdate()->firstOrFail();
                $holdExpiresAt = app(SeatHoldService::class)->assertHeldBy($user, $showtime, $seatIds);

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
                    $price = $showtime->priceForSeatType($seat->type);

                    $seatPrices[$seat->id] = $price;
                    $totalAmount += $price;
                }

                $foodQuantities = collect($validated['foods'] ?? [])
                    ->mapWithKeys(fn ($quantity, $foodId) => [(int) $foodId => (int) $quantity])
                    ->filter(fn ($quantity) => $quantity > 0);
                $foods = FoodItem::where('active', true)
                    ->whereIn('id', $foodQuantities->keys())
                    ->lockForUpdate()
                    ->get();

                if ($foods->count() !== $foodQuantities->count()) {
                    throw ValidationException::withMessages(['foods' => 'Có món ăn không còn khả dụng.']);
                }

                $foodTotal = $foods->sum(fn ($food) => (float) $food->price * $foodQuantities[$food->id]);
                $totalAmount += $foodTotal;

                $subtotalAmount = $totalAmount;
                $voucherSummary = app(VoucherService::class)->resolve(
                    $validated['voucher_code'] ?? null,
                    $subtotalAmount,
                    $user->id,
                    true
                );
                $voucher = $voucherSummary['voucher'];
                $discountAmount = (float) $voucherSummary['discount'];
                $totalAmount = (float) $voucherSummary['total'];
                $requestedPoints = (int) ($validated['loyalty_points'] ?? 0);
                $maxRedeemablePoints = min((int) $user->loyalty_points, (int) floor($totalAmount / LoyaltyPointService::VALUE_PER_POINT));

                if ($requestedPoints > $maxRedeemablePoints) {
                    throw ValidationException::withMessages(['loyalty_points' => 'Số điểm muốn dùng vượt quá mức khả dụng.']);
                }

                $pointDiscountAmount = $requestedPoints * LoyaltyPointService::VALUE_PER_POINT;
                $totalAmount = max(0, $totalAmount - $pointDiscountAmount);
                $loyaltyPoints = app(LoyaltyPointService::class)->calculate($totalAmount);

                $booking = Booking::create([
                    'user_id' => Auth::id(),
                    'showtime_id' => $showtime->id,
                    'voucher_id' => $voucher?->id,
                    'booking_code' => $this->generateBookingCode(),
                    'total_amount' => $totalAmount,
                    'loyalty_points_earned' => $loyaltyPoints,
                    'loyalty_points_redeemed' => $requestedPoints,
                    'voucher_code' => $voucher?->code,
                    'discount_amount' => $discountAmount,
                    'point_discount_amount' => $pointDiscountAmount,
                    'payment_status' => 'pending',
                    'booking_status' => 'pending',
                    'hold_expires_at' => $holdExpiresAt,
                ]);

                if ($requestedPoints > 0) {
                    app(LoyaltyPointService::class)->redeemForBooking($user, $booking, $requestedPoints);
                }

                foreach ($seats as $seat) {
                    BookingSeat::create([
                        'booking_id' => $booking->id,
                        'showtime_id' => $showtime->id,
                        'seat_id' => $seat->id,
                        'price' => $seatPrices[$seat->id],
                    ]);
                }

                if ($foods->isNotEmpty()) {
                    $order = Order::create([
                        'booking_id' => $booking->id,
                        'user_id' => $user->id,
                        'customer_name' => $user->name,
                        'customer_phone' => $user->phone,
                        'customer_email' => $user->email,
                        'pickup_cinema_id' => $showtime->cinema_id,
                        'total_amount' => $foodTotal,
                        'status' => 'pending',
                    ]);

                    foreach ($foods as $food) {
                        $quantity = $foodQuantities[$food->id];
                        OrderItem::create([
                            'order_id' => $order->id,
                            'food_item_id' => $food->id,
                            'quantity' => $quantity,
                            'price' => $food->price,
                            'total' => (float) $food->price * $quantity,
                        ]);
                    }
                }

                app(SeatHoldService::class)->release($user, $showtime, $seatIds);

                $booking->payment()->create([
                    'payment_method' => 'payos',
                    'amount' => $totalAmount,
                    'status' => 'pending',
                    'transaction_code' => 'PAYOS-'.$booking->id,
                    'provider_order_code' => (string) $booking->id,
                    'paid_at' => null,
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

        if ((float) $booking->total_amount <= 0) {
            DB::transaction(function () use ($booking) {
                $lockedBooking = Booking::whereKey($booking->id)->lockForUpdate()->firstOrFail();
                $lockedBooking->update(['payment_status' => 'paid', 'booking_status' => 'paid']);
                $lockedBooking->payment()->update(['status' => 'success', 'paid_at' => now()]);
                $lockedBooking->foodOrder()->update(['status' => 'paid']);
                if ($lockedBooking->voucher_id) {
                    $lockedBooking->voucher()->increment('used_count');
                }
            });

            return redirect()->route('user.bookings.success', $booking)->with('success', 'Thanh toán hoàn tất bằng điểm thành viên.');
        }

        try {
            $paymentData = app(PayosService::class)->createPaymentLink($booking);

            $booking->payment()->update([
                'transaction_code' => $paymentData['paymentLinkId'] ?? 'PAYOS-'.$booking->id,
                'provider_order_code' => (string) ($paymentData['orderCode'] ?? $booking->id),
                'checkout_url' => $paymentData['checkoutUrl'] ?? null,
                'qr_code' => $paymentData['qrCode'] ?? null,
            ]);

            return redirect()->away($paymentData['checkoutUrl']);
        } catch (\Throwable $exception) {
            DB::transaction(function () use ($booking) {
                $booking = Booking::whereKey($booking->id)->lockForUpdate()->first();

                if (! $booking || $booking->payment_status === 'paid') {
                    return;
                }

                $booking->update([
                    'payment_status' => 'failed',
                    'booking_status' => 'cancelled',
                ]);

                $booking->payment?->update(['status' => 'failed']);
                $booking->foodOrder()->update(['status' => 'cancelled']);
                app(LoyaltyPointService::class)->restoreRedeemedPoints($booking);
                $booking->bookingSeats()->delete();
            });

            return redirect()
                ->route('user.bookings.history')
                ->with('error', 'Không tạo được QR thanh toán payOS: '.$exception->getMessage());
        }
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
            'foodOrder.items.food',
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
        app(SeatHoldService::class)->expireStale();
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

        DB::transaction(function () use ($booking) {
            $wasPaid = $booking->payment_status === 'paid';
            $paymentStatus = $wasPaid ? 'refunded' : 'failed';

            $booking->update([
                'booking_status' => 'cancelled',
                'payment_status' => $paymentStatus,
            ]);

            $booking->payment?->update([
                'status' => $wasPaid ? 'success' : 'failed',
            ]);
            $booking->foodOrder()->update(['status' => 'cancelled']);

            app(LoyaltyPointService::class)->reverseForCancelledBooking($booking);
            app(LoyaltyPointService::class)->restoreRedeemedPoints($booking);

            if ($wasPaid && $booking->voucher_id) {
                \App\Models\Voucher::whereKey($booking->voucher_id)
                    ->where('used_count', '>', 0)
                    ->decrement('used_count');
            }

            $booking->bookingSeats()->delete();
        });

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
            $query->whereIn('booking_status', ['paid', 'used'])
                ->orWhere(function ($query) {
                    $query->where('booking_status', 'pending')
                        ->where('payment_status', 'pending')
                        ->where('hold_expires_at', '>', now());
                });
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

        return now('Asia/Ho_Chi_Minh')->lt($showDateTime->copy()->addMinutes(30));
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
