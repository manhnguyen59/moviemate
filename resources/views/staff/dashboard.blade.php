@extends('layouts.staff')

@section('title', 'Staff Dashboard - MovieMate')
@section('page-title', 'Staff Dashboard')

@section('content')
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="app-card border app-border rounded-2xl p-6">
        <div class="flex justify-between items-start mb-4">
            <div>
                <p class="app-muted text-sm font-medium mb-1">Vé bán hôm nay</p>
                <h3 class="text-3xl font-bold app-text">{{ number_format($stats['tickets_today']) }}</h3>
            </div>
            <div class="w-12 h-12 rounded-xl bg-ai-start/10 flex items-center justify-center">
                <i class="ph-fill ph-ticket text-2xl text-ai-start"></i>
            </div>
        </div>
    </div>

    <div class="app-card border app-border rounded-2xl p-6">
        <div class="flex justify-between items-start mb-4">
            <div>
                <p class="app-muted text-sm font-medium mb-1">Vé đã check-in</p>
                <h3 class="text-3xl font-bold app-text">{{ number_format($stats['checked_in_today']) }}</h3>
            </div>
            <div class="w-12 h-12 rounded-xl bg-success/10 flex items-center justify-center">
                <i class="ph-fill ph-check-circle text-2xl text-success"></i>
            </div>
        </div>
        <p class="text-xs app-muted">Tính theo ngày hôm nay</p>
    </div>

    <div class="app-card border app-border rounded-2xl p-6">
        <div class="flex justify-between items-start mb-4">
            <div>
                <p class="app-muted text-sm font-medium mb-1">Vé chưa sử dụng</p>
                <h3 class="text-3xl font-bold app-text">{{ number_format($stats['unused_paid']) }}</h3>
            </div>
            <div class="w-12 h-12 rounded-xl bg-warning/10 flex items-center justify-center">
                <i class="ph-fill ph-clock text-2xl text-warning"></i>
            </div>
        </div>
        <p class="text-xs app-muted">Trạng thái paid</p>
    </div>

    <div class="app-card border app-border rounded-2xl p-6">
        <div class="flex justify-between items-start mb-4">
            <div>
                <p class="app-muted text-sm font-medium mb-1">Suất chiếu hôm nay</p>
                <h3 class="text-3xl font-bold app-text">{{ number_format($stats['showtimes_today']) }}</h3>
            </div>
            <div class="w-12 h-12 rounded-xl bg-brand-start/10 flex items-center justify-center">
                <i class="ph-fill ph-video-camera text-2xl text-brand-start"></i>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
    <a href="{{ route('staff.tickets.check') }}" class="group bg-gradient-to-br from-dark-card to-dark-main border border-ai-start/30 rounded-2xl p-6 hover:border-ai-start transition-colors relative overflow-hidden">
        <i class="ph-fill ph-qr-code absolute -right-6 -bottom-6 text-9xl text-ai-start/10 transition-colors"></i>
        <div class="flex items-center gap-4 mb-2 relative z-10">
            <div class="w-12 h-12 rounded-xl bg-ai-start text-white flex items-center justify-center shadow-lg shadow-ai-start/30">
                <i class="ph-bold ph-scan text-2xl"></i>
            </div>
            <div>
                <h3 class="text-xl font-bold text-white">Kiểm tra vé</h3>
                <p class="text-text-sub text-sm">Nhập booking_code để soát vé khách hàng</p>
            </div>
        </div>
    </a>

    <a href="{{ route('staff.tickets.index') }}" class="group bg-gradient-to-br from-dark-card to-dark-main border border-brand-start/30 rounded-2xl p-6 hover:border-brand-start transition-colors relative overflow-hidden">
        <i class="ph-fill ph-ticket absolute -right-6 -bottom-6 text-9xl text-brand-start/10 transition-colors"></i>
        <div class="flex items-center gap-4 mb-2 relative z-10">
            <div class="w-12 h-12 rounded-xl bg-brand-start text-white flex items-center justify-center shadow-lg shadow-brand-start/30">
                <i class="ph-bold ph-list-checks text-2xl"></i>
            </div>
            <div>
                <h3 class="text-xl font-bold text-white">Danh sách vé</h3>
                <p class="text-text-sub text-sm">Theo dõi vé đã đặt, đã dùng và đã hủy</p>
            </div>
        </div>
    </a>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    <div class="app-card border app-border rounded-2xl overflow-hidden">
        <div class="p-6 border-b app-border flex justify-between items-center app-secondary">
            <h3 class="font-bold app-text text-lg">Suất chiếu hôm nay</h3>
        </div>

        <div class="divide-y divide-[var(--border-color)]">
            @forelse($upcomingShowtimes as $showtime)
                <div class="p-4 flex items-center justify-between gap-4 hover:bg-white/5 transition-colors">
                    <div class="min-w-0">
                        <h4 class="font-bold app-text mb-1 truncate">{{ $showtime->movie->title }}</h4>
                        <p class="text-xs app-muted">
                            {{ $showtime->cinema->name }} / {{ $showtime->room->name }}
                        </p>
                    </div>
                    <div class="text-right shrink-0">
                        <p class="font-bold text-ai-start text-lg mb-1">
                            {{ $showtime->show_time ? \Carbon\Carbon::parse($showtime->show_time)->format('H:i') : '--:--' }}
                        </p>
                        <span class="text-[10px] font-bold uppercase tracking-wider text-success bg-success/10 px-2 py-1 rounded">
                            {{ $showtime->status }}
                        </span>
                    </div>
                </div>
            @empty
                <div class="p-6 text-center app-muted">Chưa có suất chiếu hôm nay.</div>
            @endforelse
        </div>
    </div>

    <div class="app-card border app-border rounded-2xl overflow-hidden">
        <div class="p-6 border-b app-border flex justify-between items-center app-secondary">
            <h3 class="font-bold app-text text-lg">Check-in gần đây</h3>
            <a href="{{ route('staff.tickets.index', ['status' => 'used']) }}" class="text-sm font-medium text-ai-start hover:app-text transition-colors">Xem tất cả</a>
        </div>

        <div class="overflow-x-auto hide-scrollbar">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="app-secondary text-xs uppercase tracking-wider app-muted border-b app-border">
                        <th class="p-4 font-medium">Mã vé</th>
                        <th class="p-4 font-medium">Khách hàng</th>
                        <th class="p-4 font-medium">Phim</th>
                        <th class="p-4 font-medium text-right">Thời gian</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[var(--border-color)] text-sm">
                    @forelse($recentCheckIns as $booking)
                        <tr class="hover:bg-white/5 transition-colors">
                            <td class="p-4">
                                <span class="font-mono app-text app-secondary border app-border px-2 py-1 rounded text-xs">{{ $booking->booking_code }}</span>
                            </td>
                            <td class="p-4 app-text font-medium">{{ $booking->user->name ?? 'Khách' }}</td>
                            <td class="p-4 app-muted">{{ $booking->showtime?->movie?->title ?? 'Không rõ phim' }}</td>
                            <td class="p-4 text-right app-muted">
                                {{ $booking->used_at ? $booking->used_at->format('d/m/Y H:i') : '--' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="p-6 text-center app-muted">Chưa có vé nào được check-in.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
