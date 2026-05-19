@extends('layouts.user')

@section('title', 'Vé của tôi - MovieMate')

@section('content')
<div class="min-h-[80vh] py-12 px-4 sm:px-6 lg:px-8 flex justify-center items-start">
    <div class="w-full max-w-md">
        <div class="flex items-center justify-between mb-6 px-1">
            <a href="{{ route('user.bookings.history') }}" class="app-muted hover:app-text transition-colors flex items-center gap-2">
                <i class="ph-bold ph-arrow-left"></i> Lịch sử
            </a>
            <button class="app-muted hover:app-text transition-colors flex items-center gap-2" onclick="window.print()">
                <i class="ph-bold ph-download-simple"></i> Lưu vé
            </button>
        </div>

        <div class="bg-white rounded-3xl overflow-hidden shadow-2xl relative">
            <div class="bg-gradient-to-r from-brand-start to-brand-end p-6 text-center relative overflow-hidden">
                <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>
                <div class="relative z-10">
                    <i class="ph-fill ph-film-strip text-4xl text-white/85 mb-2"></i>
                    <h1 class="text-2xl font-bold text-white tracking-widest uppercase">MovieMate Ticket</h1>
                </div>
            </div>

            <div class="p-8 text-center bg-white border-b-2 border-dashed border-gray-200 relative">
                <div class="absolute -bottom-4 -left-4 w-8 h-8 bg-dark-main rounded-full"></div>
                <div class="absolute -bottom-4 -right-4 w-8 h-8 bg-dark-main rounded-full"></div>

                <div class="inline-block p-4 border-4 border-gray-100 rounded-2xl mb-4">
                    <img
                        src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data={{ urlencode($booking->booking_code) }}"
                        alt="QR Code {{ $booking->booking_code }}"
                        class="w-[200px] h-[200px]"
                    >
                </div>
                <p class="text-gray-500 text-sm font-medium">Mã quét vé tại cổng rạp</p>
                <p class="text-2xl font-bold text-gray-900 font-mono mt-1 tracking-widest">{{ $booking->booking_code }}</p>
            </div>

            <div class="p-8 bg-white text-gray-900">
                <div class="text-center mb-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-1">{{ $booking->showtime->movie->title }}</h2>
                    <p class="text-gray-500 font-medium">
                        {{ ucfirst($booking->showtime->room->room_type) }} {{ $booking->showtime->movie->age_rating ?? '' }}
                    </p>
                </div>

                <div class="grid grid-cols-2 gap-y-6 gap-x-4 mb-6">
                    <div>
                        <p class="text-xs text-gray-400 uppercase tracking-wider mb-1">Ngày chiếu</p>
                        <p class="font-bold text-gray-900">{{ $booking->showtime?->show_date ? \Carbon\Carbon::parse($booking->showtime->show_date)->format('d/m/Y') : 'Đang cập nhật' }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-xs text-gray-400 uppercase tracking-wider mb-1">Giờ chiếu</p>
                        <p class="font-bold text-brand-start">{{ $booking->showtime?->show_time ? \Carbon\Carbon::parse($booking->showtime->show_time)->format('H:i') : '--:--' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 uppercase tracking-wider mb-1">Rạp</p>
                        <p class="font-bold text-gray-900">{{ $booking->showtime->cinema->name }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-xs text-gray-400 uppercase tracking-wider mb-1">Phòng chiếu</p>
                        <p class="font-bold text-gray-900">{{ $booking->showtime->room->name }}</p>
                    </div>
                </div>

                <div class="bg-gray-50 rounded-2xl p-4 flex justify-between items-center mb-6">
                    <div>
                        <p class="text-xs text-gray-400 uppercase tracking-wider mb-1">Ghế ngồi</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $booking->bookingSeats->pluck('seat.seat_code')->join(', ') }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-xs text-gray-400 uppercase tracking-wider mb-1">Tổng tiền</p>
                        <p class="text-lg font-bold text-gray-900">{{ number_format($booking->total_amount,0,',','.') }}đ</p>
                    </div>
                </div>

                <div class="text-center flex justify-center">
                    @php
                        $statusMap = [
                            'paid' => ['label' => 'Chưa sử dụng', 'class' => 'bg-green-100 text-green-700 border-green-200'],
                            'used' => ['label' => 'Đã sử dụng', 'class' => 'bg-blue-100 text-blue-700 border-blue-200'],
                            'cancelled' => ['label' => 'Đã hủy', 'class' => 'bg-red-100 text-red-700 border-red-200'],
                            'expired' => ['label' => 'Hết hạn', 'class' => 'bg-gray-100 text-gray-700 border-gray-200'],
                        ];
                        $status = $statusMap[$booking->booking_status] ?? $statusMap['paid'];
                    @endphp
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full {{ $status['class'] }} text-sm font-bold border">
                        <i class="ph-fill ph-check-circle"></i> {{ $status['label'] }}
                    </span>
                </div>
            </div>
        </div>

        <div class="mt-6 text-center text-xs app-muted space-y-2">
            <p>Vui lòng xuất trình mã QR này cho nhân viên soát vé tại rạp.</p>
            <p>Nên đến rạp trước 15 phút để đảm bảo trải nghiệm tốt nhất.</p>
        </div>
    </div>
</div>
@endsection
