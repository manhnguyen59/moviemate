@extends('layouts.admin')

@section('title', 'Phim bán chạy - MovieMate Admin')
@section('page-title', 'Báo cáo phim bán chạy')

@section('content')
<form method="GET" action="{{ route('admin.analytics.topMovies') }}" class="app-card border app-border rounded-2xl p-6 mb-6 flex flex-col lg:flex-row gap-4 justify-between items-center">
    <div>
        <h2 class="font-bold app-text text-lg">Bộ lọc báo cáo</h2>
        <p class="text-xs app-muted">Top phim dựa trên số ghế đã bán từ bookings đã thanh toán.</p>
    </div>
    <div class="flex flex-col sm:flex-row gap-3 w-full lg:w-auto">
        <input type="date" name="start_date" value="{{ $startDate->format('Y-m-d') }}" class="px-4 py-2 app-input border app-border rounded-lg app-text text-sm focus:outline-none focus:border-brand-start">
        <input type="date" name="end_date" value="{{ $endDate->format('Y-m-d') }}" class="px-4 py-2 app-input border app-border rounded-lg app-text text-sm focus:outline-none focus:border-brand-start">
        <select name="cinema_id" class="px-4 py-2 app-input border app-border rounded-lg app-text text-sm focus:outline-none focus:border-brand-start">
            <option value="">Tất cả rạp</option>
            @foreach($cinemas as $cinema)
                <option value="{{ $cinema->id }}" {{ (int) $cinemaId === $cinema->id ? 'selected' : '' }}>{{ $cinema->name }}</option>
            @endforeach
        </select>
        <button class="px-5 py-2 bg-brand-start text-white text-sm font-bold rounded-lg hover:bg-brand-end transition-colors">
            Lọc
        </button>
    </div>
</form>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
    <div class="app-card border app-border rounded-2xl p-6">
        <p class="app-muted text-sm font-medium mb-1">Tổng vé trong bảng</p>
        <h3 class="text-3xl font-bold app-text">{{ number_format($totalTickets) }}</h3>
    </div>
    <div class="app-card border app-border rounded-2xl p-6">
        <p class="app-muted text-sm font-medium mb-1">Doanh thu trong bảng</p>
        <h3 class="text-3xl font-bold app-text">{{ number_format($totalRevenue, 0, ',', '.') }}đ</h3>
    </div>
</div>

<div class="app-card border app-border rounded-2xl overflow-hidden shadow-lg mb-8">
    <div class="overflow-x-auto hide-scrollbar">
        <table class="w-full text-left border-collapse whitespace-nowrap">
            <thead>
                <tr class="app-secondary text-xs uppercase tracking-wider app-muted border-b app-border">
                    <th class="p-4 font-medium w-16 text-center">Top</th>
                    <th class="p-4 font-medium">Phim</th>
                    <th class="p-4 font-medium text-right">Doanh thu</th>
                    <th class="p-4 font-medium text-center">Vé bán ra</th>
                    <th class="p-4 font-medium text-center">Số đơn</th>
                    <th class="p-4 font-medium text-center">Trạng thái</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-[var(--border-color)] text-sm">
                @forelse($topMovies as $movie)
                    @php
                        $rank = ($topMovies->currentPage() - 1) * $topMovies->perPage() + $loop->iteration;
                        $poster = \App\Models\Movie::imageUrl($movie->poster ?? null);
                    @endphp
                    <tr class="hover:bg-white/5 transition-colors">
                        <td class="p-4 text-center">
                            <span class="{{ $rank === 1 ? 'text-2xl text-brand-start' : 'text-lg app-muted' }} font-black">#{{ $rank }}</span>
                        </td>
                        <td class="p-4">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-14 rounded overflow-hidden shrink-0 border app-border">
                                    @if($poster)
                                        <img src="{{ $poster }}" alt="{{ $movie->title }}" class="w-full h-full object-cover" loading="lazy">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center bg-slate-900 text-white text-[10px] font-bold">
                                            MM
                                        </div>
                                    @endif
                                </div>
                                <a href="{{ route('admin.movies.show', $movie->id) }}" class="font-bold app-text hover:text-brand-start transition-colors block max-w-xs truncate">
                                    {{ $movie->title }}
                                </a>
                            </div>
                        </td>
                        <td class="p-4 text-right">
                            <span class="font-bold app-text">{{ number_format($movie->revenue, 0, ',', '.') }}đ</span>
                        </td>
                        <td class="p-4 text-center">
                            <span class="app-text">{{ number_format($movie->tickets_sold) }}</span>
                        </td>
                        <td class="p-4 text-center">
                            <span class="app-text">{{ number_format($movie->bookings_count) }}</span>
                        </td>
                        <td class="p-4 text-center">
                            <span class="inline-flex px-2 py-1 rounded text-[10px] font-bold uppercase tracking-wider {{ $movie->status === 'now_showing' ? 'bg-success/10 text-success' : 'bg-warning/10 text-warning' }}">
                                {{ $movie->status === 'now_showing' ? 'Đang chiếu' : $movie->status }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="p-8 text-center app-muted">Chưa có dữ liệu phim bán chạy trong kỳ này.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="p-4 border-t app-border app-secondary">
        {{ $topMovies->links() }}
    </div>
</div>

<div class="bg-gradient-to-br from-[#1E1B4B] to-dark-main border border-ai-start/30 rounded-2xl p-6">
    <h3 class="font-bold text-white mb-4 flex items-center gap-2">
        <i class="ph-fill ph-lightbulb text-warning"></i> Gợi ý vận hành
    </h3>
    @if($topMovies->count())
        <p class="text-sm text-text-sub leading-relaxed">
            Phim đứng đầu hiện là <strong class="text-white">{{ $topMovies->getCollection()->first()->title }}</strong> với
            <strong class="text-white">{{ number_format($topMovies->getCollection()->first()->tickets_sold) }}</strong> vé.
            Có thể ưu tiên khung giờ đẹp hoặc phòng lớn hơn nếu nhu cầu tiếp tục tăng.
        </p>
    @else
        <p class="text-sm text-text-sub leading-relaxed">Chưa có dữ liệu paid booking để đưa ra gợi ý.</p>
    @endif
</div>
@endsection
