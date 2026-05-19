@extends('layouts.admin')

@section('title', 'Báo cáo doanh thu - MovieMate Admin')
@section('page-title', 'Báo cáo doanh thu')

@section('content')
<form method="GET" action="{{ route('admin.analytics.revenue') }}" class="app-card border app-border rounded-2xl p-6 mb-6 flex flex-col md:flex-row gap-4 justify-between items-center">
    <div>
        <h2 class="font-bold app-text text-lg">Khoảng thời gian</h2>
        <p class="text-xs app-muted">Dữ liệu dựa trên bookings có payment_status paid.</p>
    </div>
    <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">
        <input type="date" name="start_date" value="{{ $startDate->format('Y-m-d') }}" class="px-4 py-2 app-input border app-border rounded-lg app-text text-sm focus:outline-none focus:border-brand-start">
        <input type="date" name="end_date" value="{{ $endDate->format('Y-m-d') }}" class="px-4 py-2 app-input border app-border rounded-lg app-text text-sm focus:outline-none focus:border-brand-start">
        <button class="px-5 py-2 bg-brand-start text-white text-sm font-bold rounded-lg hover:bg-brand-end transition-colors">
            Lọc
        </button>
    </div>
</form>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
    <div class="app-card border app-border rounded-2xl p-6">
        <p class="app-muted text-sm font-medium mb-1">Tổng doanh thu</p>
        <h3 class="text-3xl font-bold app-text mb-2">{{ number_format($summary['totalRevenue'], 0, ',', '.') }}đ</h3>
    </div>

    <div class="app-card border app-border rounded-2xl p-6">
        <p class="app-muted text-sm font-medium mb-1">Tổng vé bán ra</p>
        <h3 class="text-3xl font-bold app-text mb-2">{{ number_format($summary['ticketsSold']) }}</h3>
    </div>

    <div class="app-card border app-border rounded-2xl p-6">
        <p class="app-muted text-sm font-medium mb-1">Giá vé trung bình</p>
        <h3 class="text-3xl font-bold app-text mb-2">{{ number_format($summary['averageTicketPrice'], 0, ',', '.') }}đ</h3>
    </div>

    <div class="app-card border app-border rounded-2xl p-6">
        <p class="app-muted text-sm font-medium mb-1">Tỷ lệ hoàn hủy</p>
        <h3 class="text-3xl font-bold app-text mb-2">{{ number_format($summary['cancelRate'], 1) }}%</h3>
        <p class="text-xs app-muted">{{ number_format($summary['cancelledBookings']) }} đơn đã hủy</p>
    </div>
</div>

<div class="app-card border app-border rounded-2xl p-6 mb-6">
    <h3 class="font-bold app-text text-lg mb-6">Doanh thu theo ngày</h3>

    <div class="h-80 flex items-end justify-between gap-2 sm:gap-3 relative">
        <div class="absolute inset-0 flex flex-col justify-between pointer-events-none">
            <div class="border-t app-border w-full h-0 opacity-60"></div>
            <div class="border-t app-border w-full h-0 opacity-60"></div>
            <div class="border-t app-border w-full h-0 opacity-60"></div>
            <div class="border-t app-border w-full h-0 opacity-60"></div>
        </div>

        @foreach($revenueByDay as $day)
            <div class="w-full min-w-8 flex flex-col items-center gap-2 relative z-10 group h-full justify-end">
                <div class="absolute -top-12 app-secondary border app-border app-text text-xs py-1 px-2 rounded opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none whitespace-nowrap">
                    {{ number_format($day['revenue'], 0, ',', '.') }}đ · {{ $day['bookings_count'] }} đơn
                </div>
                <div class="w-full max-w-[36px] bg-gradient-to-t from-brand-start/30 to-brand-start rounded-t-md" style="height: {{ $day['height'] }}%"></div>
                <span class="text-[10px] app-muted">{{ $day['label'] }}</span>
            </div>
        @endforeach
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <div class="app-card border app-border rounded-2xl overflow-hidden">
        <div class="p-6 border-b app-border">
            <h3 class="font-bold app-text">Doanh thu theo cụm rạp</h3>
        </div>

        <div class="p-6">
            <div class="space-y-6">
                @forelse($revenueByCinema as $cinema)
                    @php
                        $percent = $summary['totalRevenue'] > 0 ? ($cinema->revenue / $summary['totalRevenue']) * 100 : 0;
                    @endphp
                    <div>
                        <div class="flex justify-between gap-4 text-sm mb-2">
                            <span class="app-text font-bold">{{ $cinema->name }}</span>
                            <span class="app-text font-bold">{{ number_format($cinema->revenue, 0, ',', '.') }}đ</span>
                        </div>
                        <div class="w-full h-2 app-secondary rounded-full overflow-hidden">
                            <div class="h-full bg-brand-start rounded-full" style="width: {{ min(100, $percent) }}%"></div>
                        </div>
                        <p class="text-[10px] app-muted mt-1 text-right">{{ number_format($percent, 1) }}% tổng doanh thu · {{ number_format($cinema->bookings_count) }} đơn</p>
                    </div>
                @empty
                    <p class="app-muted text-center">Chưa có doanh thu theo rạp trong kỳ này.</p>
                @endforelse
            </div>
        </div>
    </div>

    <div class="app-card border app-border rounded-2xl overflow-hidden">
        <div class="p-6 border-b app-border">
            <h3 class="font-bold app-text">Theo phương thức thanh toán</h3>
        </div>

        <div class="p-6">
            <div class="space-y-4">
                @forelse($paymentMethods as $method)
                    <div class="flex items-center justify-between gap-4 p-4 app-secondary border app-border rounded-xl">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-ai-start/10 flex items-center justify-center text-ai-start">
                                <i class="ph-bold ph-credit-card text-xl"></i>
                            </div>
                            <div>
                                <p class="font-bold app-text text-sm uppercase">{{ $method->payment_method }}</p>
                                <p class="text-xs app-muted">{{ number_format($method->transactions_count) }} giao dịch</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="font-bold app-text">{{ number_format($method->revenue, 0, ',', '.') }}đ</p>
                            <p class="text-xs text-success">{{ number_format($method->percent, 1) }}%</p>
                        </div>
                    </div>
                @empty
                    <p class="app-muted text-center">Chưa có dữ liệu thanh toán trong kỳ này.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
