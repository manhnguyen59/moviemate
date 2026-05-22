@extends('layouts.admin')

@section('title', 'Dashboard - MovieMate Admin')
@section('page-title', 'Tổng quan hệ thống')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-4 sm:gap-6 mb-8">
    <div class="app-card border app-border rounded-2xl p-5 relative overflow-hidden">
        <div class="w-10 h-10 rounded-xl bg-success/10 flex items-center justify-center text-success mb-4">
            <i class="ph-bold ph-currency-circle-dollar text-xl"></i>
        </div>
        <p class="app-muted text-xs font-bold uppercase tracking-wider mb-1">Tổng doanh thu</p>
        <h3 class="text-2xl font-bold app-text">{{ number_format($stats['total_revenue'], 0, ',', '.') }}đ</h3>
    </div>

    <div class="app-card border app-border rounded-2xl p-5">
        <div class="w-10 h-10 rounded-xl bg-brand-start/10 flex items-center justify-center text-brand-start mb-4">
            <i class="ph-bold ph-ticket text-xl"></i>
        </div>
        <p class="app-muted text-xs font-bold uppercase tracking-wider mb-1">Tổng vé đã bán</p>
        <h3 class="text-2xl font-bold app-text">{{ number_format($stats['tickets_sold']) }}</h3>
    </div>

    <div class="app-card border app-border rounded-2xl p-5">
        <div class="w-10 h-10 rounded-xl bg-ai-start/10 flex items-center justify-center text-ai-start mb-4">
            <i class="ph-bold ph-users text-xl"></i>
        </div>
        <p class="app-muted text-xs font-bold uppercase tracking-wider mb-1">Người dùng</p>
        <h3 class="text-2xl font-bold app-text">{{ number_format($stats['users']) }}</h3>
    </div>

    <div class="app-card border app-border rounded-2xl p-5">
        <div class="w-10 h-10 rounded-xl bg-warning/10 flex items-center justify-center text-warning mb-4">
            <i class="ph-bold ph-film-slate text-xl"></i>
        </div>
        <p class="app-muted text-xs font-bold uppercase tracking-wider mb-1">Phim đang chiếu</p>
        <h3 class="text-2xl font-bold app-text">{{ number_format($stats['now_showing_movies']) }}</h3>
    </div>

    <div class="app-card border app-border rounded-2xl p-5">
        <div class="w-10 h-10 rounded-xl bg-purple-500/10 flex items-center justify-center text-purple-400 mb-4">
            <i class="ph-bold ph-video-camera text-xl"></i>
        </div>
        <p class="app-muted text-xs font-bold uppercase tracking-wider mb-1">Suất chiếu hôm nay</p>
        <h3 class="text-2xl font-bold app-text">{{ number_format($stats['showtimes_today']) }}</h3>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
    <div class="lg:col-span-2 app-card border app-border rounded-2xl p-6">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h3 class="font-bold app-text text-lg">Doanh thu 7 ngày qua</h3>
                <p class="text-xs app-muted">Dựa trên bookings có payment_status paid</p>
            </div>
            <a href="{{ route('admin.analytics.revenue') }}" class="px-3 py-1.5 app-secondary border app-border text-xs app-text rounded-lg hover:border-brand-start transition-colors">
                Xem chi tiết
            </a>
        </div>

        <div class="h-64 flex items-end justify-between gap-2 sm:gap-4 relative">
            <div class="absolute inset-0 flex flex-col justify-between pointer-events-none">
                <div class="border-t app-border w-full h-0 opacity-60"></div>
                <div class="border-t app-border w-full h-0 opacity-60"></div>
                <div class="border-t app-border w-full h-0 opacity-60"></div>
                <div class="border-t app-border w-full h-0 opacity-60"></div>
            </div>

            @foreach($revenueByDay as $data)
                <div class="w-full flex flex-col items-center gap-2 relative z-10 group h-full justify-end">
                    <div class="absolute -top-10 app-secondary border app-border app-text text-xs py-1 px-2 rounded opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none whitespace-nowrap">
                        {{ number_format($data['revenue'], 0, ',', '.') }}đ
                    </div>
                    <div class="w-full max-w-[40px] bg-gradient-to-t from-brand-start/30 to-brand-start rounded-t-md" style="height: {{ $data['height'] }}%"></div>
                    <span class="text-xs app-muted">{{ $data['label'] }}</span>
                </div>
            @endforeach
        </div>
    </div>

    <div class="dark-surface bg-gradient-to-br from-[#1E1B4B] to-dark-main border border-ai-start/30 rounded-2xl p-6 relative overflow-hidden flex flex-col">
        <i class="ph-fill ph-sparkle absolute top-6 right-6 text-4xl text-ai-start/30"></i>
        <div class="flex items-center gap-3 mb-4">
            <div class="w-8 h-8 rounded-full bg-ai-start/20 flex items-center justify-center">
                <i class="ph-fill ph-magic-wand text-ai-start"></i>
            </div>
            <h3 class="font-bold text-white">MovieMate AI Insights</h3>
        </div>

        <div class="space-y-4 flex-grow">
            <div class="bg-dark-card/50 border border-dark-border rounded-xl p-4">
                <h4 class="text-sm font-bold text-white mb-1">Phim bán chạy nhất</h4>
                @if($topMovies->first())
                    <p class="text-xs text-text-sub leading-relaxed">
                        "{{ $topMovies->first()->title }}" đang dẫn đầu với {{ number_format($topMovies->first()->tickets_sold) }} vé đã bán trong kỳ gần đây.
                    </p>
                @else
                    <p class="text-xs text-text-sub leading-relaxed">Chưa có dữ liệu bán vé để phân tích.</p>
                @endif
            </div>
            <div class="bg-dark-card/50 border border-dark-border rounded-xl p-4">
                <h4 class="text-sm font-bold text-white mb-1">Tổng quan vận hành</h4>
                <p class="text-xs text-text-sub leading-relaxed">
                    Hôm nay có {{ number_format($stats['showtimes_today']) }} suất chiếu. Theo dõi vé paid và check-in để điều phối nhân sự soát vé.
                </p>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <div class="app-card border app-border rounded-2xl overflow-hidden">
        <div class="p-6 border-b app-border flex justify-between items-center app-secondary">
            <h3 class="font-bold app-text">Top phim bán chạy</h3>
            <a href="{{ route('admin.analytics.topMovies') }}" class="text-xs font-bold text-brand-start hover:app-text transition-colors uppercase tracking-wider">Xem tất cả</a>
        </div>

        <div class="divide-y divide-[var(--border-color)]">
            @forelse($topMovies as $index => $movie)
                <div class="p-4 flex items-center justify-between gap-4 hover:bg-white/5 transition-colors">
                    <div class="flex items-center gap-4 min-w-0">
                        <div class="w-8 text-center font-bold text-brand-start text-lg">#{{ $index + 1 }}</div>
                        <div class="min-w-0">
                            <h4 class="font-bold app-text text-sm mb-1 truncate">{{ $movie->title }}</h4>
                            <p class="text-xs app-muted">{{ number_format($movie->tickets_sold) }} vé bán ra</p>
                        </div>
                    </div>
                    <div class="text-right shrink-0">
                        <p class="font-bold app-text text-sm">{{ number_format($movie->revenue, 0, ',', '.') }}đ</p>
                        <p class="text-[10px] app-muted">{{ number_format($movie->bookings_count) }} đơn</p>
                    </div>
                </div>
            @empty
                <div class="p-6 text-center app-muted">Chưa có dữ liệu phim bán chạy.</div>
            @endforelse
        </div>
    </div>

    <div class="app-card border app-border rounded-2xl overflow-hidden">
        <div class="p-6 border-b app-border flex justify-between items-center app-secondary">
            <h3 class="font-bold app-text">Đơn đặt vé gần đây</h3>
            <a href="{{ route('admin.bookings.index') }}" class="text-xs font-bold text-brand-start hover:app-text transition-colors uppercase tracking-wider">Xem tất cả</a>
        </div>

        <div class="overflow-x-auto hide-scrollbar">
            <table class="w-full text-left border-collapse whitespace-nowrap">
                <thead>
                    <tr class="app-secondary text-[10px] uppercase tracking-wider app-muted border-b app-border">
                        <th class="p-4 font-bold">Mã vé</th>
                        <th class="p-4 font-bold">Khách hàng</th>
                        <th class="p-4 font-bold text-right">Tổng tiền</th>
                        <th class="p-4 font-bold text-center">Trạng thái</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[var(--border-color)] text-sm">
                    @forelse($recentBookings as $booking)
                        <tr class="hover:bg-white/5 transition-colors">
                            <td class="p-4 font-mono app-text font-bold">{{ $booking->booking_code }}</td>
                            <td class="p-4 app-text">{{ $booking->user->name ?? 'Khách' }}</td>
                            <td class="p-4 text-right font-semibold app-text">{{ number_format($booking->total_amount, 0, ',', '.') }}đ</td>
                            <td class="p-4 text-center">
                                <span class="inline-flex px-2 py-1 {{ $booking->payment_status === 'paid' ? 'bg-success/10 text-success' : 'bg-warning/10 text-warning' }} rounded text-[10px] font-bold uppercase tracking-wider">
                                    {{ $booking->payment_status === 'paid' ? 'Đã thanh toán' : $booking->payment_status }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="p-6 text-center app-muted">Chưa có đơn đặt vé.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
