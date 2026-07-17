@extends('layouts.user')

@section('title', 'Thanh toán - MovieMate')

@php
    $loyaltyPoints = app(\App\Services\LoyaltyPointService::class)->calculate($totalAmount);
    $subtotalAmount = $subtotalAmount ?? $totalAmount;
    $voucherSummary = $voucherSummary ?? ['voucher' => null, 'code' => null, 'discount' => 0, 'total' => $totalAmount];
    $selectedSeatQuery = collect($seatSummaries)->pluck('id')->join(',');
@endphp

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-10">
    <div class="mb-5">
        <a href="{{ route('user.bookings.selectSeat', $showtime) }}"
           class="inline-flex items-center gap-2 px-4 py-2 rounded-2xl app-secondary border app-border app-text text-sm font-bold hover:border-brand-start hover:text-brand-start transition-colors">
            <i class="ph ph-arrow-left"></i>
            Quay lại chọn ghế
        </a>
    </div>

    <div class="mb-8">
        <div class="flex items-center justify-center sm:justify-start gap-2 sm:gap-4 text-xs sm:text-sm">
            <div class="flex items-center gap-2 text-brand-start font-semibold">
                <div class="w-8 h-8 rounded-full bg-brand-start text-white flex items-center justify-center font-bold text-xs"><i class="ph-bold ph-check"></i></div>
                <span class="hidden sm:inline">Chọn phim & Suất</span>
            </div>
            <div class="h-px w-8 sm:w-12 bg-brand-start"></div>
            <div class="flex items-center gap-2 text-brand-start font-semibold">
                <div class="w-8 h-8 rounded-full bg-brand-start text-white flex items-center justify-center font-bold text-xs"><i class="ph-bold ph-check"></i></div>
                <span class="hidden sm:inline">Chọn ghế</span>
            </div>
            <div class="h-px w-8 sm:w-12 bg-brand-start"></div>
            <div class="flex items-center gap-2 text-brand-start font-semibold">
                <div class="w-8 h-8 rounded-full bg-brand-start text-white flex items-center justify-center font-bold text-xs">3</div>
                <span>Thanh toán</span>
            </div>
        </div>
    </div>

    <div class="mb-6 rounded-2xl border border-warning/30 bg-warning/10 px-4 py-3 flex items-center justify-between gap-4">
        <div>
            <p class="app-text font-bold"><i class="ph-fill ph-clock text-warning"></i> Ghế đang được giữ cho bạn</p>
            <p class="text-xs app-muted mt-1">Hoàn tất xác nhận trước khi hết thời gian, nếu không ghế sẽ tự động được mở lại.</p>
        </div>
        <span id="checkout-hold-countdown" data-expires-at="{{ $seatHoldExpiresAt->toIso8601String() }}" class="text-2xl font-extrabold text-warning font-mono">07:00</span>
    </div>

    <form id="voucherPreviewForm" method="GET" action="{{ route('user.bookings.checkout', $showtime) }}">
        <input type="hidden" name="selected_seats" value="{{ $selectedSeatQuery }}">
    </form>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-8">
        <div class="app-card border app-border rounded-3xl p-6 shadow-2xl shadow-black/20">
            <h1 class="text-2xl font-bold app-text mb-5">Thông tin đặt vé</h1>

            <ul class="space-y-3 text-sm">
                <li class="flex justify-between gap-4"><span class="app-muted">Phim</span><span class="app-text font-semibold text-right">{{ $showtime->movie->title }}</span></li>
                <li class="flex justify-between gap-4"><span class="app-muted">Rạp</span><span class="app-text font-semibold text-right">{{ $showtime->cinema->name }}</span></li>
                <li class="flex justify-between gap-4"><span class="app-muted">Phòng</span><span class="app-text font-semibold text-right">{{ $showtime->room->name }}</span></li>
                <li class="flex justify-between gap-4"><span class="app-muted">Ngày & Giờ</span><span class="app-text font-semibold text-right">{{ $showtime->show_date ? \Carbon\Carbon::parse($showtime->show_date)->format('d/m/Y') : 'Đang cập nhật' }} {{ $showtime->show_time ? \Carbon\Carbon::parse($showtime->show_time)->format('H:i') : '--:--' }}</span></li>
            </ul>

            <h2 class="text-lg font-bold app-text mt-6 mb-3">Ghế đã chọn</h2>
            <ul class="space-y-2 text-sm app-muted">
                @foreach($seatSummaries as $seat)
                    <li class="flex justify-between gap-3 rounded-xl app-input border app-border px-3 py-2">
                        <span class="font-semibold app-text">{{ $seat['seat_code'] }} ({{ strtoupper($seat['type']) }})</span>
                        <span>{{ number_format($seat['price'],0,',','.') }}đ</span>
                    </li>
                @endforeach
            </ul>

            <div class="mt-6 pt-5 border-t app-border">
                <div class="flex items-center justify-between gap-3 mb-3">
                    <div>
                        <h2 class="text-lg font-bold app-text">Chọn đồ ăn</h2>
                        <p class="text-xs app-muted mt-1">Đồ ăn sẽ được nhận tại {{ $showtime->cinema->name }} và thanh toán chung với vé.</p>
                    </div>
                    <button form="voucherPreviewForm" type="submit" class="px-3 py-2 rounded-xl bg-brand-start text-white text-xs font-bold">Cập nhật</button>
                </div>
                <div class="space-y-2 max-h-72 overflow-y-auto pr-1">
                    @forelse($foods as $food)
                        <label class="flex items-center gap-3 rounded-xl app-input border app-border p-3">
                            @if($food->image)
                                <img src="{{ asset('storage/'.$food->image) }}" alt="{{ $food->name }}" class="w-12 h-12 rounded-xl object-cover">
                            @endif
                            <span class="min-w-0 flex-1">
                                <span class="block app-text font-semibold truncate">{{ $food->name }}</span>
                                <span class="text-xs text-brand-start font-bold">{{ number_format($food->price,0,',','.') }}đ</span>
                            </span>
                            <input form="voucherPreviewForm" type="number" name="foods[{{ $food->id }}]" value="{{ $foodQuantities[$food->id] ?? 0 }}" min="0" max="10" class="w-16 app-input border app-border rounded-lg px-2 py-2 text-center">
                        </label>
                    @empty
                        <p class="app-muted text-sm">Rạp chưa có món ăn đang bán.</p>
                    @endforelse
                </div>
            </div>

            <div class="flex justify-between items-center mt-5 pt-5 border-t app-border">
                <span class="app-muted text-sm font-semibold">Tổng vé và đồ ăn:</span>
                <span class="text-3xl font-extrabold text-brand-start">{{ number_format($totalAmount,0,',','.') }}đ</span>
            </div>

            @if(($voucherSummary['discount'] ?? 0) > 0)
                <div class="mt-3 rounded-2xl border border-success/30 bg-success/10 px-4 py-3">
                    <div class="flex justify-between gap-4 text-sm">
                        <span class="app-muted">Tạm tính</span>
                        <span class="app-text font-bold">{{ number_format($subtotalAmount,0,',','.') }}đ</span>
                    </div>
                    <div class="flex justify-between gap-4 text-sm mt-2">
                        <span class="app-muted">Voucher {{ $voucherSummary['code'] }}</span>
                        <span class="text-success font-bold">-{{ number_format($voucherSummary['discount'],0,',','.') }}đ</span>
                    </div>
                </div>
            @endif

            @if(($pointDiscountAmount ?? 0) > 0)
                <div class="mt-3 flex justify-between gap-4 rounded-2xl border border-ai-start/30 bg-ai-start/10 px-4 py-3 text-sm">
                    <span class="app-muted">Dùng {{ number_format($redeemedPoints, 0, ',', '.') }} điểm</span>
                    <span class="text-ai-start font-bold">-{{ number_format($pointDiscountAmount, 0, ',', '.') }}đ</span>
                </div>
            @endif

            <div class="mt-4 rounded-2xl border border-ai-start/30 bg-ai-start/10 px-4 py-3 flex items-center justify-between gap-4">
                <div>
                    <p class="text-xs app-muted">Điểm thành viên dự kiến</p>
                    <p class="app-text font-bold">+{{ number_format($loyaltyPoints, 0, ',', '.') }} điểm</p>
                </div>
                <div class="text-right">
                    <p class="text-xs app-muted">Điểm hiện có</p>
                    <p class="text-ai-start font-bold">{{ number_format($user->loyalty_points ?? 0, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>

        <form action="{{ route('user.bookings.store') }}" method="POST" class="app-card border app-border rounded-3xl p-6 shadow-2xl shadow-black/20">
            @csrf
            <input type="hidden" name="showtime_id" value="{{ $showtime->id }}">
            @foreach($seatSummaries as $seat)
                <input type="hidden" name="seat_ids[]" value="{{ $seat['id'] }}">
            @endforeach
            @foreach($selectedFoods as $food)
                <input type="hidden" name="foods[{{ $food['id'] }}]" value="{{ $food['quantity'] }}">
            @endforeach
            <input type="hidden" name="payment_method" value="payos">
            @if($voucherSummary['code'])
                <input type="hidden" name="voucher_code" value="{{ $voucherSummary['code'] }}">
            @endif
            <input type="hidden" name="loyalty_points" value="{{ $redeemedPoints ?? 0 }}">

            <h2 class="text-2xl font-bold app-text mb-5">Phương thức thanh toán</h2>

            <div class="mb-5 rounded-2xl app-input border app-border p-4">
                <label for="voucher_code" class="block text-sm font-bold app-text mb-2">Mã voucher</label>
                <div class="flex flex-col sm:flex-row gap-2">
                    <input id="voucher_code" form="voucherPreviewForm" type="text" name="voucher_code" value="{{ old('voucher_code', $voucherSummary['code'] ?? $voucherCode ?? '') }}" class="app-input border app-border rounded-xl px-4 py-2.5 text-sm flex-1" placeholder="Nhập mã giảm giá">
                    <button form="voucherPreviewForm" type="submit" class="px-4 py-2.5 rounded-xl bg-brand-start text-white text-sm font-bold">Áp dụng</button>
                </div>
                @if(($voucherSummary['discount'] ?? 0) > 0)
                    <p class="mt-2 text-xs font-semibold text-success">Đã giảm {{ number_format($voucherSummary['discount'],0,',','.') }}đ.</p>
                @endif
                @error('voucher_code')
                    <p class="mt-2 text-xs font-semibold text-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-5 rounded-2xl app-input border app-border p-4">
                <label for="loyalty_points" class="block text-sm font-bold app-text mb-2">Dùng điểm thành viên</label>
                <div class="flex flex-col sm:flex-row gap-2">
                    <input id="loyalty_points" form="voucherPreviewForm" type="number" name="loyalty_points"
                           value="{{ old('loyalty_points', $redeemedPoints ?? 0) }}" min="0" max="{{ $maxRedeemablePoints ?? 0 }}" step="1"
                           class="app-input border app-border rounded-xl px-4 py-2.5 text-sm flex-1">
                    <button form="voucherPreviewForm" type="submit" class="px-4 py-2.5 rounded-xl bg-ai-start text-white text-sm font-bold">Áp dụng điểm</button>
                </div>
                <p class="mt-2 text-xs app-muted">1 điểm = {{ number_format(\App\Services\LoyaltyPointService::VALUE_PER_POINT, 0, ',', '.') }}đ. Có thể dùng tối đa {{ number_format($maxRedeemablePoints ?? 0, 0, ',', '.') }} điểm cho đơn này.</p>
                @error('loyalty_points')
                    <p class="mt-2 text-xs font-semibold text-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-3">
                <div class="flex items-start gap-3 p-4 app-input border border-brand-start rounded-2xl">
                    <div class="w-10 h-10 rounded-xl bg-brand-start/10 text-brand-start flex items-center justify-center shrink-0">
                        <i class="ph-fill ph-qr-code text-2xl"></i>
                    </div>
                    <div>
                        <p class="app-text font-bold">QR chuyển khoản ngân hàng qua payOS</p>
                        <p class="app-muted text-sm mt-1">Sau khi xác nhận, hệ thống sẽ chuyển sang cổng payOS để tạo mã QR. Vé chỉ được kích hoạt khi payOS báo thanh toán thành công.</p>
                    </div>
                </div>
            </div>

            <button type="submit" class="w-full mt-6 py-4 bg-gradient-to-r from-brand-start to-brand-end text-white rounded-2xl font-bold hover:shadow-lg hover:shadow-brand-start/30 transition-all">
                Xác nhận và thanh toán
            </button>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    (() => {
        const countdown = document.getElementById('checkout-hold-countdown');
        if (!countdown) return;
        const expiresAt = new Date(countdown.dataset.expiresAt).getTime();
        const timer = window.setInterval(() => {
            const remaining = Math.max(0, expiresAt - Date.now());
            const seconds = Math.ceil(remaining / 1000);
            countdown.textContent = `${String(Math.floor(seconds / 60)).padStart(2, '0')}:${String(seconds % 60).padStart(2, '0')}`;
            if (remaining === 0) {
                window.clearInterval(timer);
                alert('Thời gian giữ ghế đã hết. Vui lòng chọn ghế lại.');
                window.location.href = @json(route('user.bookings.selectSeat', $showtime));
            }
        }, 250);
    })();
</script>
@endpush
