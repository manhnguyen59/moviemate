@extends('layouts.user')

@section('title', 'Thanh toán - MovieMate')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-10">
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

            <div class="flex justify-between items-center mt-5 pt-5 border-t app-border">
                <span class="app-muted text-sm font-semibold">Tổng tiền:</span>
                <span class="text-3xl font-extrabold text-brand-start">{{ number_format($totalAmount,0,',','.') }}đ</span>
            </div>
        </div>

        <form action="{{ route('user.bookings.store') }}" method="POST" class="app-card border app-border rounded-3xl p-6 shadow-2xl shadow-black/20">
            @csrf
            <input type="hidden" name="showtime_id" value="{{ $showtime->id }}">
            @foreach($seatSummaries as $seat)
                <input type="hidden" name="seat_ids[]" value="{{ $seat['id'] }}">
            @endforeach

            <h2 class="text-2xl font-bold app-text mb-5">Phương thức thanh toán</h2>

            <div class="space-y-3">
                <label class="flex items-center gap-3 p-4 app-input border border-brand-start rounded-2xl cursor-pointer hover:border-brand-start transition-colors">
                    <input type="radio" name="payment_method" value="fake" checked class="text-brand-start focus:ring-brand-start w-4 h-4">
                    <span class="app-text font-semibold">Thanh toán giả lập (đã thanh toán)</span>
                </label>

                <label class="flex items-center gap-3 p-4 app-input border app-border rounded-2xl cursor-pointer hover:border-brand-start transition-colors">
                    <input type="radio" name="payment_method" value="counter" class="text-brand-start focus:ring-brand-start w-4 h-4">
                    <span class="app-text font-semibold">Thanh toán tại quầy</span>
                </label>

                <label class="flex items-center gap-3 p-4 app-input border app-border rounded-2xl cursor-pointer hover:border-brand-start transition-colors">
                    <input type="radio" name="payment_method" value="vnpay" class="text-brand-start focus:ring-brand-start w-4 h-4">
                    <span class="app-text font-semibold">Thanh toán VNPay (giả lập)</span>
                </label>
            </div>

            <button type="submit" class="w-full mt-6 py-4 bg-gradient-to-r from-brand-start to-brand-end text-white rounded-2xl font-bold hover:shadow-lg hover:shadow-brand-start/30 transition-all">
                Xác nhận và thanh toán
            </button>
        </form>
    </div>
</div>
@endsection
