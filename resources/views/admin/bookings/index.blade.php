@extends('layouts.admin')

@section('title', 'Quản lý đơn đặt vé - MovieMate Admin')
@section('page-title', 'Quản lý đơn đặt vé')

@section('content')
<div class="admin-table-card">
    <form method="GET" class="p-5 border-b app-border space-y-3">
        <div class="flex flex-col md:flex-row gap-3">
            <input name="search" value="{{ request('search') }}" class="admin-input flex-1" placeholder="Tìm mã vé, tên, email hoặc SĐT...">
            <button class="admin-btn-primary"><i class="ph ph-magnifying-glass"></i> Tìm kiếm</button>
            <a href="{{ route('admin.bookings.index') }}" class="admin-btn-secondary">Đặt lại</a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3">
            <input type="date" name="date" value="{{ request('date') }}" class="admin-input">
            <select name="cinema_id" class="admin-input">
                <option value="">Tất cả rạp</option>
                @foreach($cinemas as $cinema)<option value="{{ $cinema->id }}" @selected((string)request('cinema_id') === (string)$cinema->id)>{{ $cinema->name }}</option>@endforeach
            </select>
            <select name="payment_status" class="admin-input">
                <option value="">Mọi trạng thái thanh toán</option>
                <option value="paid" @selected(request('payment_status') === 'paid')>Đã thanh toán</option>
                <option value="pending" @selected(request('payment_status') === 'pending')>Chờ thanh toán</option>
                <option value="failed" @selected(request('payment_status') === 'failed')>Thất bại</option>
                <option value="refunded" @selected(request('payment_status') === 'refunded')>Đã hoàn tiền</option>
            </select>
            <select name="ticket_status" class="admin-input">
                <option value="">Mọi tình trạng vé</option>
                <option value="unused" @selected(request('ticket_status') === 'unused')>Chưa sử dụng</option>
                <option value="used" @selected(request('ticket_status') === 'used')>Đã sử dụng</option>
            </select>
        </div>
    </form>

    <div class="overflow-x-auto">
        <table class="admin-table">
            <thead><tr><th>Mã vé / Ngày đặt</th><th>Khách hàng</th><th>Suất chiếu</th><th class="text-right">Tổng tiền</th><th class="text-center">Thanh toán</th><th class="text-center">Tình trạng vé</th><th></th></tr></thead>
            <tbody>
            @forelse($bookings as $booking)
                <tr>
                    <td><span class="font-mono text-brand-start font-bold block">{{ $booking->booking_code }}</span><span class="text-xs app-muted">{{ $booking->created_at->format('d/m/Y H:i') }}</span></td>
                    <td><span class="font-bold block">{{ $booking->user?->name ?? 'Khách đã xóa' }}</span><span class="text-xs app-muted">{{ $booking->user?->phone ?: $booking->user?->email }}</span></td>
                    <td><span class="font-semibold block max-w-52 truncate">{{ $booking->showtime?->movie?->title ?? 'Không còn dữ liệu phim' }}</span><span class="text-xs app-muted">{{ $booking->showtime?->show_date?->format('d/m/Y') }} {{ $booking->showtime?->show_time ? \Carbon\Carbon::parse($booking->showtime->show_time)->format('H:i') : '' }} · {{ $booking->showtime?->cinema?->name }}</span></td>
                    <td class="text-right font-bold">{{ number_format($booking->total_amount, 0, ',', '.') }}đ</td>
                    <td class="text-center">
                        @php
                            $paymentClass = match ($booking->payment_status) {
                                'paid' => 'text-success bg-success/10',
                                'pending' => 'text-warning bg-warning/10',
                                default => 'text-error bg-error/10',
                            };
                        @endphp
                        <span class="admin-badge {{ $paymentClass }}">{{ ['paid'=>'Đã TT','pending'=>'Chờ TT','failed'=>'Thất bại','refunded'=>'Đã hoàn'][$booking->payment_status] ?? $booking->payment_status }}</span>
                    </td>
                    <td class="text-center">
                        @if($booking->booking_status === 'used')<span class="app-muted text-xs"><i class="ph ph-check-circle"></i> Đã dùng</span>
                        @elseif($booking->payment_status === 'paid')<span class="text-brand-start text-xs font-bold"><i class="ph-fill ph-ticket"></i> Chưa dùng</span>
                        @else<span class="app-muted">—</span>@endif
                    </td>
                    <td class="text-right"><a href="{{ route('admin.bookings.show', $booking) }}" class="admin-btn-info admin-action-btn" title="Xem chi tiết" aria-label="Xem chi tiết" data-tooltip="Xem chi tiết"><i class="ph-bold ph-eye"></i></a></td>
                </tr>
            @empty
                <tr><td colspan="7" class="admin-empty">Không có đơn đặt vé phù hợp.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    @if($bookings->hasPages())<div class="p-4 border-t app-border">{{ $bookings->links() }}</div>@endif
</div>
@endsection
