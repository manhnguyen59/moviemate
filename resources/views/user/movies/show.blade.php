@extends('layouts.user')

@section('title', $movie->title . ' - MovieMate')

@php
    $poster = $movie->poster ? asset('storage/' . $movie->poster) : null;
    $cover = $movie->cover_image ? asset('storage/' . $movie->cover_image) : $poster;
    $genresText = $movie->genres->pluck('name')->join(', ') ?: 'Đang cập nhật';
    $showtimesByDate = $showtimes->groupBy(fn ($showtime) => \Carbon\Carbon::parse($showtime->show_date)->format('Y-m-d'));
@endphp

@section('content')
<div class="cinema-surface relative overflow-hidden">
    <div class="absolute inset-x-0 top-0 h-[28rem] opacity-40">
        @if($cover)
            <img src="{{ $cover }}" alt="{{ $movie->title }}" class="w-full h-full object-cover blur-sm scale-105">
            <div class="absolute inset-0 bg-gradient-to-b from-dark-main/60 via-dark-main/80 to-dark-main"></div>
        @else
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_18%_18%,rgba(255,61,87,0.28),transparent_34%),radial-gradient(circle_at_82%_12%,rgba(124,58,237,0.22),transparent_32%)]"></div>
        @endif
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 md:py-14">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-start">
            <div class="lg:col-span-4">
                <div class="poster-frame rounded-3xl cinema-card overflow-hidden shadow-2xl shadow-black/30">
                    @if($poster)
                        <img src="{{ $poster }}" alt="{{ $movie->title }}">
                    @else
                        <div class="fallback-poster">
                            <i class="ph-fill ph-film-slate"></i>
                            <strong class="text-2xl">MovieMate</strong>
                            <span>{{ $movie->title }}</span>
                        </div>
                    @endif
                </div>
            </div>

            <div class="lg:col-span-8 pt-2 lg:pt-8">
                <div class="flex flex-wrap items-center gap-3 mb-5">
                    <span class="{{ $movie->status === 'now_showing' ? 'bg-brand-start' : 'bg-ai-start' }} text-white text-xs font-extrabold px-3 py-1.5 rounded-full uppercase tracking-wider">
                        {{ $movie->status === 'now_showing' ? 'Đang chiếu' : 'Sắp chiếu' }}
                    </span>
                    @if($movie->age_rating)
                        <span class="border app-border app-text text-xs font-extrabold px-3 py-1.5 rounded-full">{{ $movie->age_rating }}</span>
                    @endif
                    <span class="border app-border app-text text-xs font-extrabold px-3 py-1.5 rounded-full">
                        <i class="ph-fill ph-star text-brand-start"></i> 8.6
                    </span>
                </div>

                <h1 class="hero-title text-4xl md:text-6xl font-extrabold app-text mb-6">{{ $movie->title }}</h1>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-7">
                    <div class="cinema-card p-4">
                        <p class="text-xs app-muted mb-1">Thể loại</p>
                        <p class="app-text font-bold line-clamp-1">{{ $genresText }}</p>
                    </div>
                    <div class="cinema-card p-4">
                        <p class="text-xs app-muted mb-1">Thời lượng</p>
                        <p class="app-text font-bold">{{ $movie->duration ?? '--' }} phút</p>
                    </div>
                    <div class="cinema-card p-4">
                        <p class="text-xs app-muted mb-1">Quốc gia</p>
                        <p class="app-text font-bold">{{ $movie->country ?? 'Đang cập nhật' }}</p>
                    </div>
                    <div class="cinema-card p-4">
                        <p class="text-xs app-muted mb-1">Khởi chiếu</p>
                        <p class="app-text font-bold">{{ $movie->release_date ? \Carbon\Carbon::parse($movie->release_date)->format('d/m/Y') : 'Chưa xác định' }}</p>
                    </div>
                </div>

                <div class="cinema-card p-5 sm:p-6 mb-6">
                    <h2 class="text-xl font-extrabold app-text mb-3 border-l-4 border-brand-start pl-3">Nội dung phim</h2>
                    <p class="app-muted leading-relaxed">{{ $movie->description ?? 'Nội dung phim đang được cập nhật.' }}</p>
                </div>

                <div class="flex flex-wrap gap-3">
                    <a href="#showtimes" class="btn-primary">
                        <i class="ph-fill ph-ticket"></i> Xem lịch chiếu
                    </a>
                    @if($movie->trailer_url)
                        <a href="{{ $movie->trailer_url }}" target="_blank" class="btn-secondary">
                            <i class="ph-fill ph-play-circle text-xl"></i> Xem trailer
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <section id="showtimes" class="mt-14">
            <div class="flex items-center gap-3 mb-6">
                <span class="w-1 h-8 rounded-full bg-gradient-to-b from-brand-start to-brand-end"></span>
                <div>
                    <h2 class="text-2xl md:text-3xl font-extrabold app-text">Lịch chiếu</h2>
                    <p class="app-muted text-sm mt-1">Chọn ngày, rạp và giờ chiếu phù hợp để đặt vé.</p>
                </div>
            </div>

            @if($showtimes->isEmpty())
                <div class="cinema-card p-8 app-muted">Hiện chưa có suất chiếu khả dụng.</div>
            @else
                <div class="space-y-5">
                    @foreach($showtimesByDate as $date => $items)
                        <div class="cinema-card p-5">
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-4">
                                <div>
                                    <p class="text-brand-start text-sm font-extrabold uppercase tracking-wider">{{ \Carbon\Carbon::parse($date)->translatedFormat('l') }}</p>
                                    <h3 class="text-xl font-extrabold app-text">{{ \Carbon\Carbon::parse($date)->format('d/m/Y') }}</h3>
                                </div>
                                <span class="app-muted text-sm">{{ $items->count() }} suất chiếu</span>
                            </div>

                            <div class="space-y-4">
                                @foreach($items->groupBy('cinema_id') as $cinemaShowtimes)
                                    @php $first = $cinemaShowtimes->first(); @endphp
                                    <div class="app-secondary border app-border rounded-2xl p-4">
                                        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">
                                            <div>
                                                <h4 class="app-text font-extrabold">{{ $first->cinema->name }}</h4>
                                                <p class="app-muted text-sm">{{ $first->room->name }} · Giá thường {{ number_format($first->price, 0, ',', '.') }}đ · VIP {{ number_format($first->vip_price ?? $first->price, 0, ',', '.') }}đ</p>
                                            </div>
                                            <div class="flex flex-wrap gap-2">
                                                @foreach($cinemaShowtimes as $show)
                                                    <a href="{{ route('user.bookings.selectSeat', $show->id) }}" class="px-4 py-2 rounded-xl bg-brand-start/10 border border-brand-start/30 text-brand-start font-extrabold hover:bg-brand-start hover:text-white transition-colors">
                                                        {{ \Carbon\Carbon::parse($show->show_time)->format('H:i') }}
                                                    </a>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </section>
    </div>
</div>
@endsection
