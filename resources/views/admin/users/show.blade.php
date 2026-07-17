@extends('layouts.admin')
@section('title', 'Hồ sơ '.$user->name.' - MovieMate Admin')
@section('page-title', 'Hồ sơ người dùng')
@section('content')
<div class="max-w-6xl space-y-6">
    <a href="{{ route('admin.users.index') }}" class="admin-btn-secondary"><i class="ph-bold ph-arrow-left"></i> Quay lại</a>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="space-y-6">
            <div class="admin-detail-card text-center">
                <div class="w-24 h-24 rounded-full app-secondary mx-auto mb-4 flex items-center justify-center overflow-hidden">@if($user->avatar)<img src="{{ \App\Models\Movie::imageUrl($user->avatar) }}" class="w-full h-full object-cover">@else<i class="ph-bold ph-user text-4xl app-muted"></i>@endif</div>
                <h2 class="text-xl font-bold">{{ $user->name }}</h2><p class="app-muted text-sm">{{ $user->role?->name ?? '—' }}</p><span class="admin-badge mt-3 text-warning bg-warning/10"><i class="ph-fill ph-crown"></i> Hạng {{ $user->membership_tier }}</span>
                <div class="mt-6 pt-6 border-t app-border text-left space-y-3 text-sm"><div><p class="text-xs app-muted">Email</p><p class="safe-break">{{ $user->email }}</p></div><div><p class="text-xs app-muted">Số điện thoại</p><p>{{ $user->phone ?: '—' }}</p></div><div><p class="text-xs app-muted">Ngày tham gia</p><p>{{ $user->created_at->format('d/m/Y') }}</p></div><div><p class="text-xs app-muted">Trạng thái</p><span class="admin-badge {{ $user->status === 'active' ? 'text-success bg-success/10' : 'text-error bg-error/10' }}">{{ $user->status === 'active' ? 'Hoạt động' : 'Bị khóa' }}</span></div></div>
            </div>
            <div class="admin-detail-card"><h3 class="font-bold mb-4">Thống kê điểm</h3><p class="text-3xl font-bold text-brand-start text-center">{{ number_format($user->loyalty_points,0,',','.') }}</p><p class="text-xs app-muted text-center mb-5">Điểm khả dụng</p><div class="flex justify-between text-sm"><span class="app-muted">Tổng điểm đã tích</span><strong>{{ number_format($user->lifetime_loyalty_points,0,',','.') }}</strong></div><div class="flex justify-between text-sm mt-2"><span class="app-muted">Điểm đã sử dụng</span><strong>{{ number_format($stats['redeemed'],0,',','.') }}</strong></div></div>
        </div>
        <div class="lg:col-span-2 space-y-6">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-3">@foreach([['Tổng chi tiêu',number_format($stats['spent'],0,',','.').'đ'],['Vé đã mua',$stats['tickets']],['Đánh giá',$stats['reviews']],['Đơn đã hủy',$stats['cancelled']]] as $item)<div class="admin-detail-card !p-4 text-center"><p class="text-xs app-muted">{{ $item[0] }}</p><p class="font-bold text-lg mt-1">{{ $item[1] }}</p></div>@endforeach</div>
            <div class="admin-table-card"><div class="p-5 border-b app-border"><h3 class="font-bold">Đơn đặt vé gần đây</h3></div><div class="overflow-x-auto"><table class="admin-table"><thead><tr><th>Mã đơn</th><th>Phim</th><th>Ngày đặt</th><th class="text-right">Tổng tiền</th><th>Trạng thái</th></tr></thead><tbody>@forelse($user->bookings as $booking)<tr><td><a class="font-mono text-brand-start font-bold" href="{{ route('admin.bookings.show',$booking) }}">{{ $booking->booking_code }}</a></td><td>{{ $booking->showtime?->movie?->title ?? '—' }}</td><td>{{ $booking->created_at->format('d/m/Y H:i') }}</td><td class="text-right font-bold">{{ number_format($booking->total_amount,0,',','.') }}đ</td><td>{{ ['paid'=>'Đã thanh toán','pending'=>'Chờ thanh toán','failed'=>'Thất bại','refunded'=>'Đã hoàn'][$booking->payment_status] ?? $booking->payment_status }}</td></tr>@empty<tr><td colspan="5" class="admin-empty">Người dùng chưa có đơn vé.</td></tr>@endforelse</tbody></table></div></div>
            <div class="admin-table-card"><div class="p-5 border-b app-border"><h3 class="font-bold">Đánh giá gần đây</h3></div><div class="divide-y app-border">@forelse($user->reviews->take(5) as $review)<div class="p-5"><div class="flex justify-between gap-3"><strong>{{ $review->movie?->title ?? 'Phim đã xóa' }}</strong><span class="text-warning">{{ $review->rating }}/5 <i class="ph-fill ph-star"></i></span></div><p class="app-muted text-sm mt-2">{{ $review->comment }}</p></div>@empty<div class="admin-empty">Chưa có đánh giá.</div>@endforelse</div></div>
        </div>
    </div>
</div>
@endsection
