@extends('layouts.user')

@section('title', 'Chọn ghế - MovieMate')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-10">
    <div class="mb-8">
        <div class="flex items-center justify-center sm:justify-start gap-2 sm:gap-4 text-xs sm:text-sm">
            <div class="flex items-center gap-2 text-brand-start font-semibold">
                <div class="w-8 h-8 rounded-full bg-brand-start text-white flex items-center justify-center font-bold text-xs">1</div>
                <span class="hidden sm:inline">Chọn phim & Suất</span>
            </div>
            <div class="h-px w-8 sm:w-12 bg-brand-start"></div>
            <div class="flex items-center gap-2 text-brand-start font-semibold">
                <div class="w-8 h-8 rounded-full bg-brand-start text-white flex items-center justify-center font-bold text-xs">2</div>
                <span>Chọn ghế</span>
            </div>
            <div class="h-px w-8 sm:w-12 border-t border-dashed app-border"></div>
            <div class="flex items-center gap-2 app-muted font-semibold">
                <div class="w-8 h-8 rounded-full app-card border app-border flex items-center justify-center font-bold text-xs">3</div>
                <span class="hidden sm:inline">Thanh toán</span>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8">
        <div class="lg:col-span-2 app-card border app-border rounded-3xl p-5 sm:p-6 overflow-hidden shadow-2xl shadow-black/20">
            <div class="text-center mb-8">
                <p class="text-brand-start text-sm font-bold uppercase tracking-[0.25em] mb-2">{{ $showtime->movie->title }}</p>
                <h1 class="text-xl md:text-2xl font-bold app-text mb-2">{{ $showtime->cinema->name }} - {{ $showtime->room->name }}</h1>
                <p class="app-muted text-sm">
                    {{ $showtime->show_date ? \Carbon\Carbon::parse($showtime->show_date)->format('d/m/Y') : 'Đang cập nhật' }}
                    -
                    {{ $showtime->show_time ? \Carbon\Carbon::parse($showtime->show_time)->format('H:i') : '--:--' }}
                </p>
            </div>

            <div class="relative mb-12 px-8 md:px-16">
                <div class="h-2 w-full bg-gradient-to-r from-brand-start to-brand-end rounded-t-[100%] shadow-[0_14px_36px_rgba(255,61,87,0.32)]"></div>
                <div class="absolute top-5 left-1/2 -translate-x-1/2 app-muted text-xs font-bold tracking-[0.35em] uppercase">Màn hình</div>
            </div>

            <form id="seatForm" action="{{ route('user.bookings.checkout', $showtime) }}" method="GET">
                @csrf
                <input type="hidden" name="showtime_id" value="{{ $showtime->id }}">
                <input type="hidden" name="selected_seats" id="selectedSeatsInput" value="">
                <input type="hidden" name="total_amount" id="totalAmountInput" value="">

                <div class="overflow-x-auto hide-scrollbar pb-4">
                    <div class="min-w-[560px] flex flex-col items-center gap-2.5">
                        @foreach($seatsByRow as $row => $rowSeats)
                            <div class="flex items-center gap-3">
                                <div class="w-5 text-center app-muted text-xs font-bold">{{ $row }}</div>
                                <div class="flex gap-1.5">
                                    @foreach($rowSeats as $seat)
                                        @php
                                            $isBooked = in_array($seat->id, $bookedSeatIds);
                                            $isMaintenance = $seat->status !== 'active';
                                            $isVip = $seat->type === 'vip';
                                            $price = $isVip ? ($showtime->vip_price ?? $showtime->price) : $showtime->price;
                                            if ($isBooked) {
                                                $seatClass = 'bg-dark-border border-dark-border text-dark-border/40 cursor-not-allowed opacity-40';
                                            } elseif ($isMaintenance) {
                                                $seatClass = 'bg-gray-300 border-gray-400 text-gray-600 cursor-not-allowed opacity-50';
                                            } elseif ($isVip) {
                                                $seatClass = 'bg-ai-start/10 border-ai-start/50 text-ai-start hover:bg-ai-start hover:text-white';
                                            } else {
                                                $seatClass = 'app-input border-[var(--border-color)] app-muted hover:border-brand-start hover:text-brand-start';
                                            }
                                        @endphp
                                        <button type="button"
                                            class="w-8 h-8 rounded-t-lg border transition-all text-[10px] font-bold {{ $seatClass }} {{ $seat->number == 6 ? 'mr-4' : '' }}"
                                            data-seat-id="{{ $seat->id }}"
                                            data-seat-code="{{ $seat->seat_code }}"
                                            data-seat-type="{{ $seat->type }}"
                                            data-price="{{ $price }}"
                                            {{ $isBooked || $isMaintenance ? 'disabled' : '' }}>
                                            {{ $seat->number }}
                                        </button>
                                    @endforeach
                                </div>
                                <div class="w-5 text-center app-muted text-xs font-bold">{{ $row }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="flex flex-wrap justify-center gap-4 md:gap-6 mt-8 pt-6 border-t app-border text-xs">
                    <div class="flex items-center gap-2 app-muted"><div class="w-6 h-6 rounded-t-lg app-input border app-border"></div> Ghế thường ({{ number_format($showtime->price,0,',','.') }}đ)</div>
                    <div class="flex items-center gap-2 app-muted"><div class="w-6 h-6 rounded-t-lg bg-ai-start/10 border border-ai-start/50"></div> Ghế VIP ({{ number_format($showtime->vip_price ?? $showtime->price,0,',','.') }}đ)</div>
                    <div class="flex items-center gap-2 app-muted"><div class="w-6 h-6 rounded-t-lg bg-brand-start border border-brand-start"></div> Đang chọn</div>
                    <div class="flex items-center gap-2 app-muted"><div class="w-6 h-6 rounded-t-lg bg-dark-border border border-dark-border opacity-40"></div> Đã đặt</div>
                </div>
            </form>
        </div>

        <aside class="lg:col-span-1">
            <div class="app-card border app-border rounded-3xl overflow-hidden sticky top-24 shadow-2xl shadow-black/20">
                <div class="p-5 sm:p-6">
                    <h2 class="text-xl font-bold app-text mb-4">Thông tin đặt vé</h2>
                    <ul class="space-y-3 text-sm">
                        <li class="flex justify-between gap-4"><span class="app-muted">Phim</span><span class="app-text font-semibold text-right">{{ $showtime->movie->title }}</span></li>
                        <li class="flex justify-between gap-4"><span class="app-muted">Rạp</span><span class="app-text font-semibold text-right">{{ $showtime->cinema->name }}</span></li>
                        <li class="flex justify-between gap-4"><span class="app-muted">Phòng</span><span class="app-text font-semibold text-right">{{ $showtime->room->name }}</span></li>
                        <li class="flex justify-between gap-4"><span class="app-muted">Ngày & Giờ</span><span class="app-text font-semibold text-right">{{ $showtime->show_date ? \Carbon\Carbon::parse($showtime->show_date)->format('d/m/Y') : 'Đang cập nhật' }} {{ $showtime->show_time ? \Carbon\Carbon::parse($showtime->show_time)->format('H:i') : '--:--' }}</span></li>
                        <li class="flex justify-between gap-4 border-t app-border pt-3 mt-3"><span class="app-muted">Ghế đã chọn</span><span id="selectedSeatsDisplay" class="app-text font-bold text-right">-</span></li>
                    </ul>

                    <div class="flex justify-between items-center my-5 pt-4 border-t app-border">
                        <span class="app-muted text-sm font-semibold">Tổng tiền:</span>
                        <span id="totalAmountDisplay" class="text-3xl font-extrabold text-brand-start">0đ</span>
                    </div>

                    <button type="submit" form="seatForm" class="w-full py-3.5 bg-gradient-to-r from-brand-start to-brand-end text-white rounded-2xl font-bold hover:shadow-lg hover:shadow-brand-start/30 transition-all">
                        Tiếp tục thanh toán
                    </button>
                </div>
            </div>
        </aside>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const seatButtons = document.querySelectorAll('button[data-seat-id]');
    const selectedSeats = new Map();
    const selectedSeatsInput = document.getElementById('selectedSeatsInput');
    const totalAmountInput = document.getElementById('totalAmountInput');
    const selectedSeatsDisplay = document.getElementById('selectedSeatsDisplay');
    const totalAmountDisplay = document.getElementById('totalAmountDisplay');

    function restoreSeatStyle(button) {
        button.classList.remove('bg-brand-start', 'border-brand-start', 'text-white', 'shadow-lg', 'shadow-brand-start/30');

        if (button.dataset.seatType === 'vip') {
            button.classList.add('bg-ai-start/10', 'border-ai-start/50', 'text-ai-start');
        } else {
            button.classList.add('app-input', 'border-[var(--border-color)]', 'app-muted');
        }
    }

    function applySelectedStyle(button) {
        button.classList.remove('app-input', 'border-[var(--border-color)]', 'app-muted', 'bg-ai-start/10', 'border-ai-start/50', 'text-ai-start');
        button.classList.add('bg-brand-start', 'border-brand-start', 'text-white', 'shadow-lg', 'shadow-brand-start/30');
    }

    function refreshSummary() {
        const selected = Array.from(selectedSeats.values());
        const total = selected.reduce((sum, seat) => sum + seat.price, 0);

        selectedSeatsInput.value = selected.map(seat => seat.id).join(',');
        totalAmountInput.value = total.toFixed(2);
        selectedSeatsDisplay.textContent = selected.length ? selected.map(seat => seat.code).join(', ') : '-';
        totalAmountDisplay.textContent = total.toLocaleString('vi-VN') + 'đ';
    }

    seatButtons.forEach(button => {
        button.addEventListener('click', function () {
            const seatId = this.dataset.seatId;

            if (selectedSeats.has(seatId)) {
                selectedSeats.delete(seatId);
                restoreSeatStyle(this);
            } else {
                selectedSeats.set(seatId, {
                    id: seatId,
                    code: this.dataset.seatCode,
                    type: this.dataset.seatType,
                    price: parseFloat(this.dataset.price)
                });
                applySelectedStyle(this);
            }

            refreshSummary();
        });
    });
});
</script>
@endsection
