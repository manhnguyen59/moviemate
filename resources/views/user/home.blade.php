@extends('layouts.app')

@section('title', 'Trang chủ - MovieMate')

@php
    $featuredMovie = $nowShowing->first() ?? $comingSoon->first();
    $featuredGenres = $featuredMovie?->genres?->pluck('name')->take(3)->join(', ') ?: 'Điện ảnh';
@endphp

@section('content')
<section class="cinema-surface relative overflow-hidden">
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-10 pb-12 md:pt-16 md:pb-16">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
            <div class="lg:col-span-7">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full border border-brand-start/30 bg-brand-start/10 text-brand-start text-sm font-bold mb-5">
                    <i class="ph-fill ph-film-strip"></i>
                    Rạp phim trực tuyến tích hợp AI
                </div>

                <h1 class="hero-title text-4xl sm:text-5xl lg:text-6xl font-extrabold app-text max-w-4xl">
                    Chọn phim hay, đặt ghế nhanh, vào rạp bằng vé QR.
                </h1>
                <p class="mt-5 text-base sm:text-lg app-muted leading-relaxed max-w-2xl">
                    MovieMate kết hợp lịch chiếu rõ ràng, chọn ghế trực quan và AI gợi ý phim để mỗi buổi xem đều dễ quyết định hơn.
                </p>

                @if($featuredMovie)
                    <div class="mt-7 cinema-card p-4 sm:p-5 max-w-2xl">
                        <p class="text-xs uppercase tracking-[0.22em] text-brand-start font-extrabold mb-2">Phim nổi bật</p>
                        <h2 class="text-2xl sm:text-3xl font-extrabold app-text">{{ $featuredMovie->title }}</h2>
                        <div class="mt-3 flex flex-wrap gap-2 text-xs">
                            <span class="px-3 py-1.5 rounded-full app-secondary border app-border app-text">{{ $featuredGenres }}</span>
                            <span class="px-3 py-1.5 rounded-full app-secondary border app-border app-text">{{ $featuredMovie->duration ?? '--' }} phút</span>
                            <span class="px-3 py-1.5 rounded-full bg-brand-start/10 border border-brand-start/30 text-brand-start font-bold">{{ $featuredMovie->age_rating ?? 'P' }}</span>
                            <span class="px-3 py-1.5 rounded-full app-secondary border app-border app-text"><i class="ph-fill ph-star text-brand-start"></i> 8.6</span>
                        </div>
                        <p class="mt-4 app-muted line-clamp-2">{{ $featuredMovie->description ?? 'Thông tin phim đang được cập nhật.' }}</p>
                    </div>
                @endif

                <div class="mt-8 flex flex-col sm:flex-row gap-3">
                    <a href="{{ $featuredMovie ? route('user.movies.show', $featuredMovie->slug) . '#showtimes' : route('user.movies.index') }}" class="btn-primary">
                        <i class="ph-fill ph-ticket"></i>
                        Đặt vé ngay
                    </a>
                    @if($featuredMovie)
                        <a href="{{ route('user.movies.show', $featuredMovie->slug) }}" class="btn-secondary">
                            <i class="ph ph-info"></i>
                            Xem chi tiết
                        </a>
                    @endif
                    <a href="{{ route('user.ai.recommend') }}" class="btn-secondary hover:!border-ai-start hover:!text-ai-start">
                        <i class="ph-fill ph-sparkle"></i>
                        AI gợi ý phim
                    </a>
                </div>
            </div>

            <div class="lg:col-span-5">
                <div class="relative max-w-sm mx-auto lg:max-w-md">
                    <div class="absolute -inset-5 rounded-[2rem] bg-gradient-to-br from-brand-start/30 via-ai-start/20 to-brand-end/20 blur-2xl"></div>
                    <div class="relative cinema-card p-4">
                        <div class="poster-frame rounded-2xl shadow-2xl shadow-black/30">
                            @if($featuredMovie?->poster)
                                <img src="{{ asset('storage/' . $featuredMovie->poster) }}" alt="{{ $featuredMovie->title }}">
                            @else
                                <div class="fallback-poster">
                                    <i class="ph-fill ph-film-slate"></i>
                                    <strong class="text-2xl">MovieMate</strong>
                                    <span>Poster phim sẽ hiển thị tại đây</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <form action="{{ route('user.ai.recommend.submit') }}" method="POST" class="mt-10 cinema-card p-3 sm:p-4 grid grid-cols-1 lg:grid-cols-[1fr_auto] gap-3">
            @csrf
            <input type="hidden" name="mood" value="chill">
            <input type="hidden" name="preferred_time" value="tonight">
            <input type="hidden" name="companion" value="friends">
            <label class="flex items-center gap-3 px-3 sm:px-4 py-2 app-input border app-border rounded-2xl">
                <i class="ph-fill ph-sparkle text-ai-start text-xl"></i>
                <span class="hidden md:inline app-text font-bold whitespace-nowrap">Bạn muốn xem phim gì hôm nay?</span>
                <input name="location" type="text" class="w-full bg-transparent app-text placeholder:text-text-sub/70 focus:outline-none py-2" placeholder="Ví dụ: Tôi thích phim hành động, muốn xem tối nay ở Hà Nội...">
            </label>
            <button class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-2xl bg-gradient-to-r from-ai-start to-ai-end text-white font-extrabold">
                <i class="ph-fill ph-magic-wand"></i>
                Gợi ý bằng AI
            </button>
        </form>
    </div>
</section>

<section id="showtimes" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-7">
        <div>
            <p class="text-brand-start text-sm font-extrabold uppercase tracking-[0.22em] mb-2">Lịch chiếu nhanh</p>
            <h2 class="text-3xl font-extrabold app-text">Suất chiếu gần nhất</h2>
        </div>
        <a href="{{ route('user.movies.index') }}#showtimes" class="btn-secondary !py-2.5">Xem tất cả phim</a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @forelse(($quickShowtimes ?? collect())->take(6) as $showtime)
            <article class="cinema-card p-4 flex gap-4">
                <div class="w-16 h-24 rounded-xl overflow-hidden shrink-0 poster-frame">
                    @if($showtime->movie?->poster)
                        <img src="{{ asset('storage/' . $showtime->movie->poster) }}" alt="{{ $showtime->movie->title }}">
                    @else
                        <div class="fallback-poster !gap-1"><i class="ph-fill ph-film-slate !text-xl"></i></div>
                    @endif
                </div>
                <div class="min-w-0 flex-1">
                    <h3 class="font-extrabold app-text line-clamp-1">{{ $showtime->movie->title }}</h3>
                    <p class="text-xs app-muted mt-1">{{ $showtime->cinema->name }} · {{ $showtime->room->name }}</p>
                    <div class="mt-3 flex flex-wrap gap-2">
                        <span class="px-3 py-1.5 rounded-full bg-brand-start/10 border border-brand-start/30 text-brand-start text-xs font-extrabold">
                            {{ \Carbon\Carbon::parse($showtime->show_date)->format('d/m') }} · {{ \Carbon\Carbon::parse($showtime->show_time)->format('H:i') }}
                        </span>
                        <span class="px-3 py-1.5 rounded-full app-secondary border app-border app-text text-xs font-bold">
                            {{ number_format($showtime->price, 0, ',', '.') }}đ
                        </span>
                    </div>
                    <a href="{{ route('user.movies.show', $showtime->movie->slug) }}#showtimes" class="mt-3 inline-flex text-sm font-bold text-brand-start hover:text-brand-end">Đặt vé</a>
                </div>
            </article>
        @empty
            <div class="col-span-full cinema-card p-8 text-center app-muted">Hiện chưa có lịch chiếu khả dụng.</div>
        @endforelse
    </div>
</section>

<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-8">
        <div>
            <p class="text-brand-start text-sm font-extrabold uppercase tracking-[0.22em] mb-2">Now Showing</p>
            <h2 class="text-3xl font-extrabold app-text">Phim đang chiếu</h2>
        </div>
        <a href="{{ route('user.movies.index', ['status' => 'now_showing']) }}" class="inline-flex items-center gap-2 app-muted hover:text-brand-start font-bold">
            Xem tất cả <i class="ph ph-arrow-right"></i>
        </a>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6">
        @forelse($nowShowing->take(8) as $movie)
            @include('user.movies._card', ['movie' => $movie])
        @empty
            <div class="col-span-full cinema-card p-8 app-muted text-center">Không có phim đang chiếu.</div>
        @endforelse
    </div>
</section>

@include('user.partials.showtime-section')

<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-8">
        <div>
            <p class="text-ai-start text-sm font-extrabold uppercase tracking-[0.22em] mb-2">Coming Soon</p>
            <h2 class="text-3xl font-extrabold app-text">Phim sắp chiếu</h2>
        </div>
        <a href="{{ route('user.movies.index', ['status' => 'coming_soon']) }}" class="inline-flex items-center gap-2 app-muted hover:text-ai-start font-bold">
            Xem tất cả <i class="ph ph-arrow-right"></i>
        </a>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6">
        @forelse($comingSoon->take(8) as $movie)
            @include('user.movies._card', ['movie' => $movie])
        @empty
            <div class="col-span-full cinema-card p-8 app-muted text-center">Không có phim sắp chiếu.</div>
        @endforelse
    </div>
</section>

<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        @foreach([
            ['ph-sparkle', 'AI gợi ý phim', 'Chọn phim theo tâm trạng, thể loại và lịch rảnh.'],
            ['ph-armchair', 'Chọn ghế trực quan', 'Sơ đồ ghế rõ ràng, phân biệt ghế thường và VIP.'],
            ['ph-qr-code', 'Vé QR tiện lợi', 'Dùng mã QR để soát vé nhanh tại rạp.'],
            ['ph-lightning', 'Đặt vé nhanh', 'Luồng đặt vé gọn, dễ thao tác trên mọi thiết bị.'],
        ] as $feature)
            <div class="cinema-card p-5">
                <div class="w-11 h-11 rounded-2xl bg-brand-start/10 text-brand-start flex items-center justify-center mb-4">
                    <i class="ph-fill {{ $feature[0] }} text-2xl"></i>
                </div>
                <h3 class="app-text font-extrabold mb-2">{{ $feature[1] }}</h3>
                <p class="app-muted text-sm leading-relaxed">{{ $feature[2] }}</p>
            </div>
        @endforeach
    </div>
</section>
@endsection
