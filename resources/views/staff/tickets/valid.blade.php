@extends('layouts.staff')

@section('title', 'Vé hợp lệ - MovieMate Staff')
@section('page-title', 'Kết quả kiểm tra vé')

@php
    $showtimeText = $booking->showtime?->show_date
        ? (($booking->showtime?->show_time ? \Carbon\Carbon::parse($booking->showtime->show_time)->format('H:i') . ' - ' : '') . \Carbon\Carbon::parse($booking->showtime->show_date)->format('d/m/Y'))
        : 'Đang cập nhật';
    $seatCodes = $booking->bookingSeats->pluck('seat.seat_code')->filter()->join(', ') ?: 'Chưa có ghế';
    $seatCount = $booking->bookingSeats->count();
@endphp

@section('content')
<div class="max-w-xl mx-auto">
    <div class="bg-success/10 border-2 border-success rounded-3xl p-8 text-center shadow-lg shadow-success/20 mb-6">
        <div class="w-20 h-20 bg-success text-white rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg shadow-success/40">
            <i class="ph-bold ph-check text-4xl"></i>
        </div>

        <h1 class="text-3xl font-bold text-success mb-2">Vé hợp lệ</h1>
        <p class="app-muted font-medium mb-6">Vé đã thanh toán và chưa được sử dụng.</p>

        <div class="app-card border app-border rounded-2xl p-6 text-left mb-8">
            <div class="border-b app-border pb-4 mb-4 flex justify-between items-center gap-4">
                <div>
                    <p class="text-xs app-muted uppercase tracking-wider mb-1">Mã đặt vé</p>
                    <p class="text-xl font-bold app-text font-mono">{{ $booking->booking_code }}</p>
                </div>
                <div class="px-3 py-1 bg-success/20 text-success text-xs font-bold rounded uppercase">
                    Chưa sử dụng
                </div>
            </div>

            <div class="space-y-4 text-sm">
                <div class="flex justify-between gap-4">
                    <span class="app-muted">Khách hàng</span>
                    <span class="app-text font-semibold text-right">{{ $booking->user->name ?? 'Khách' }}</span>
                </div>
                <div class="flex justify-between gap-4 items-start">
                    <span class="app-muted">Phim</span>
                    <span class="app-text font-bold text-right max-w-[60%]">{{ $booking->showtime?->movie?->title ?? 'Không rõ phim' }}</span>
                </div>
                <div class="flex justify-between gap-4">
                    <span class="app-muted">Rạp / Phòng</span>
                    <span class="app-text font-semibold text-right">{{ $booking->showtime?->cinema?->name ?? 'Không rõ rạp' }} / {{ $booking->showtime?->room?->name ?? 'Không rõ phòng' }}</span>
                </div>
                <div class="flex justify-between gap-4">
                    <span class="app-muted">Suất chiếu</span>
                    <span class="text-success font-bold text-right">{{ $showtimeText }}</span>
                </div>
                <div class="flex justify-between gap-4 pt-4 border-t app-border">
                    <span class="app-muted">Ghế</span>
                    <span class="text-2xl app-text font-bold text-right">{{ $seatCodes }}</span>
                </div>
                <div class="flex justify-between gap-4 pt-2">
                    <span class="app-muted">Tổng tiền</span>
                    <span class="app-text font-semibold text-right">{{ $seatCount }} vé - {{ number_format($booking->total_amount, 0, ',', '.') }}đ</span>
                </div>
            </div>
        </div>

        <div class="flex flex-col gap-3">
            <form method="POST" action="{{ route('staff.tickets.confirmUsed', $booking) }}">
                @csrf
                <button type="submit" class="w-full py-4 bg-success text-white rounded-2xl font-bold text-lg hover:bg-success/90 hover:shadow-lg hover:shadow-success/30 transition-all">
                    Xác nhận sử dụng vé
                </button>
            </form>
            <a href="{{ route('staff.tickets.check') }}" class="w-full py-3 app-secondary border app-border app-text rounded-2xl font-semibold hover:border-success transition-colors">
                Quay lại kiểm tra vé
            </a>
        </div>
    </div>
</div>
@endsection
