@extends('layouts.admin')

@section('title', 'Chi tiết đơn '.$booking->booking_code.' - MovieMate Admin')
@section('page-title', 'Chi tiết đơn đặt vé')

@section('content')
@php
    $showtime = $booking->showtime;
    $movie = $showtime?->movie;
    $seatSubtotal = $booking->bookingSeats->sum(fn($item) => (float)$item->price);
    $statusLabel = ['paid'=>'Đã thanh toán','pending'=>'Chờ thanh toán','failed'=>'Thanh toán thất bại','refunded'=>'Đã hoàn tiền'][$booking->payment_status] ?? $booking->payment_status;
    $statusClass = match($booking->payment_status) {'paid'=>'text-success bg-success/10 border-success/20','pending'=>'text-warning bg-warning/10 border-warning/20',default=>'text-error bg-error/10 border-error/20'};
@endphp
<div class="max-w-5xl space-y-6">
    <a href="{{ route('admin.bookings.index') }}" class="admin-btn-secondary"><i class="ph-bold ph-arrow-left"></i> Quay lại</a>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 admin-detail-card">
            <div class="flex flex-wrap justify-between gap-3 mb-6">
                <div><h2 class="text-lg font-bold">Mã đơn: <span class="font-mono text-brand-start">{{ $booking->booking_code }}</span></h2><p class="text-sm app-muted">Ngày đặt: {{ $booking->created_at->format('d/m/Y H:i') }}</p></div>
                <span class="admin-badge border {{ $statusClass }}">{{ $statusLabel }}</span>
            </div>

            <div class="flex flex-col sm:flex-row gap-5 py-6 border-y app-border border-dashed">
                <div class="w-24 shrink-0"><div class="poster-frame rounded-xl">@if($movie?->poster_url)<img src="{{ $movie->poster_url }}" alt="{{ $movie->title }}">@else<div class="admin-media-fallback">MovieMate</div>@endif</div></div>
                <div class="min-w-0">
                    <h3 class="text-xl font-bold mb-2">{{ $movie?->title ?? 'Không còn dữ liệu phim' }}</h3>
                    <p class="app-muted mb-4">{{ $showtime?->cinema?->name }} · {{ $showtime?->room?->name }}</p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div><p class="text-xs app-muted uppercase">Suất chiếu</p><p class="font-bold">{{ $showtime?->show_time ? \Carbon\Carbon::parse($showtime->show_time)->format('H:i') : '--:--' }} - {{ $showtime?->show_date?->format('d/m/Y') }}</p></div>
                        <div><p class="text-xs app-muted uppercase">Ghế đã chọn</p><p class="font-bold text-brand-start text-lg">{{ $booking->bookingSeats->pluck('seat.seat_code')->filter()->join(', ') ?: '—' }}</p></div>
                    </div>
                </div>
            </div>

            <div class="pt-6 space-y-3 text-sm">
                <h3 class="font-bold text-base mb-4">Chi tiết thanh toán</h3>
                <div class="flex justify-between app-muted"><span>Tiền ghế ({{ $booking->bookingSeats->count() }} ghế)</span><span>{{ number_format($seatSubtotal,0,',','.') }}đ</span></div>
                @if((float)$booking->discount_amount > 0)<div class="flex justify-between text-success"><span>Voucher {{ $booking->voucher_code }}</span><span>-{{ number_format($booking->discount_amount,0,',','.') }}đ</span></div>@endif
                @if((int)$booking->loyalty_points_redeemed > 0)<div class="flex justify-between text-ai-start"><span>{{ number_format($booking->loyalty_points_redeemed,0,',','.') }} điểm thành viên</span><span>-{{ number_format($booking->point_discount_amount,0,',','.') }}đ</span></div>@endif
                <div class="flex justify-between items-center pt-3 border-t app-border"><strong>Tổng cộng</strong><strong class="text-2xl text-brand-start">{{ number_format($booking->total_amount,0,',','.') }}đ</strong></div>
                <div class="app-input border app-border rounded-xl p-3 flex flex-wrap justify-between gap-2 text-xs"><span>Phương thức: <strong>{{ strtoupper($booking->payment?->payment_method ?? '—') }}</strong></span><span>Mã GD: <strong class="font-mono">{{ $booking->payment?->transaction_code ?? '—' }}</strong></span></div>
            </div>
        </div>

        <div class="space-y-6">
            <div class="admin-detail-card">
                <h3 class="font-bold mb-4">Thông tin khách hàng</h3>
                <p class="font-bold">{{ $booking->user?->name ?? 'Khách đã xóa' }}</p>
                <p class="text-xs text-ai-start mb-5">Hạng {{ $booking->user?->membership_tier ?? '—' }}</p>
                <div class="space-y-3 text-sm"><div><p class="text-xs app-muted">Số điện thoại</p><p>{{ $booking->user?->phone ?: '—' }}</p></div><div><p class="text-xs app-muted">Email</p><p class="safe-break">{{ $booking->user?->email ?: '—' }}</p></div><div><p class="text-xs app-muted">Số đơn đã đặt</p><p>{{ $bookingCount }} đơn</p></div></div>
            </div>
            <div class="admin-detail-card text-center">
                <h3 class="font-bold mb-4 text-left">Trạng thái sử dụng vé</h3>
                @if($booking->booking_status === 'used')<span class="admin-badge text-success bg-success/10"><i class="ph ph-check-circle"></i> Đã sử dụng</span><p class="text-xs app-muted mt-2">{{ $booking->used_at?->format('d/m/Y H:i') }}</p>
                @elseif($booking->payment_status === 'paid')<span class="admin-badge text-brand-start bg-brand-start/10"><i class="ph-fill ph-ticket"></i> Chưa sử dụng</span>
                @else<span class="admin-badge app-muted app-secondary">Vé chưa có hiệu lực</span>@endif
            </div>
        </div>
    </div>
</div>
@endsection
