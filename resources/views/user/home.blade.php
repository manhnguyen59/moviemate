@extends('layouts.app')

@section('title', 'Trang chủ - MovieMate')

@php
    $featuredMovie = $nowShowing->first() ?? $comingSoon->first();
@endphp

@section('content')
<section class="relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-dark-main via-dark-main to-dark-sub"></div>
    <div class="absolute inset-0 opacity-35 bg-[radial-gradient(circle_at_18%_18%,rgba(255,61,87,0.25),transparent_34%),radial-gradient(circle_at_82%_12%,rgba(124,58,237,0.22),transparent_32%),radial-gradient(circle_at_50%_100%,rgba(255,122,24,0.14),transparent_35%)]"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
            <div class="lg:col-span-7">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full border border-brand-start/30 bg-brand-start/10 text-brand-start text-sm font-semibold mb-6">
                    <i class="ph-fill ph-fire"></i>
                    Rạp chiếu phim thông minh cùng AI
                </div>
                <h1 class="hero-title text-4xl sm:text-5xl lg:text-6xl font-extrabold app-text max-w-4xl">
                    Đặt vé nhanh, chọn phim hay, tận hưởng điện ảnh theo cách của bạn.
                </h1>
                <p class="mt-6 text-base sm:text-lg app-muted leading-relaxed max-w-2xl">
                    MovieMate kết hợp lịch chiếu, đặt ghế trực tuyến và AI gợi ý phim để mỗi buổi xem phim đều vừa ý hơn.
                </p>

                <div class="mt-8 flex flex-col sm:flex-row gap-3">
                    <a href="{{ route('user.movies.index') }}" class="inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-2xl bg-gradient-to-r from-brand-start to-brand-end text-white font-bold shadow-lg shadow-brand-start/25 transition-transform hover:-translate-y-0.5">
                        <i class="ph-fill ph-ticket"></i>
                        Đặt vé ngay
                    </a>
                    <a href="{{ route('user.ai.recommend') }}" class="inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-2xl app-card border app-border app-text font-bold hover:border-ai-start hover:text-ai-start transition-colors">
                        <i class="ph-fill ph-sparkle"></i>
                        AI gợi ý phim
                    </a>
                </div>

                <form action="{{ route('user.movies.index') }}" method="GET" class="mt-10 max-w-2xl app-card border app-border rounded-3xl p-2 flex flex-col sm:flex-row gap-2 shadow-2xl shadow-black/20">
                    <div class="flex-1 flex items-center gap-3 px-4">
                        <i class="ph ph-magnifying-glass app-muted text-xl"></i>
                        <input name="search" type="text" class="w-full bg-transparent app-text placeholder:text-text-sub/70 focus:outline-none py-3" placeholder="Tìm phim, thể loại hoặc lịch chiếu...">
                    </div>
                    <button class="px-6 py-3 rounded-2xl bg-gradient-to-r from-ai-start to-ai-end text-white font-bold">
                        Khám phá
                    </button>
                </form>
            </div>

            <div class="lg:col-span-5">
                <div class="relative max-w-sm mx-auto lg:max-w-none">
                    <div class="absolute -inset-4 rounded-[2rem] bg-gradient-to-br from-brand-start/25 to-ai-start/25 blur-2xl"></div>
                    <div class="relative app-card border app-border rounded-[2rem] p-4 shadow-2xl shadow-black/40">
                        <div class="poster-frame rounded-3xl">
                            @if($featuredMovie?->poster)
                                <img src="{{ asset('storage/' . $featuredMovie->poster) }}" alt="{{ $featuredMovie->title }}">
                            @else
                                <img src="{{ asset('images/placeholder.png') }}" alt="MovieMate">
                            @endif
                        </div>
                        <div class="pt-5">
                            <p class="text-xs uppercase tracking-[0.25em] text-brand-start font-bold mb-2">Phim nổi bật</p>
                            <h2 class="text-2xl font-bold app-text line-clamp-2">{{ $featuredMovie->title ?? 'MovieMate Cinema' }}</h2>
                            <p class="app-muted text-sm mt-2 line-clamp-2">{{ $featuredMovie->description ?? 'Khám phá những bộ phim đang chiếu và sắp chiếu mới nhất.' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
    <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-8">
        <div>
            <p class="text-brand-start text-sm font-bold uppercase tracking-[0.25em] mb-2">Now Showing</p>
            <h2 class="text-3xl font-bold app-text">Phim đang chiếu</h2>
        </div>
        <a href="{{ route('user.movies.index') }}" class="inline-flex items-center gap-2 app-muted hover:text-brand-start font-semibold">
            Xem tất cả <i class="ph ph-arrow-right"></i>
        </a>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6">
        @forelse($nowShowing->take(8) as $movie)
            @include('user.movies._card', ['movie' => $movie])
        @empty
            <div class="col-span-full app-card border app-border rounded-3xl p-8 app-muted text-center">
                Không có phim đang chiếu.
            </div>
        @endforelse
    </div>
</section>

<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">
    <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-8">
        <div>
            <p class="text-ai-start text-sm font-bold uppercase tracking-[0.25em] mb-2">Coming Soon</p>
            <h2 class="text-3xl font-bold app-text">Phim sắp chiếu</h2>
        </div>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6">
        @forelse($comingSoon->take(8) as $movie)
            @include('user.movies._card', ['movie' => $movie])
        @empty
            <div class="col-span-full app-card border app-border rounded-3xl p-8 app-muted text-center">
                Không có phim sắp chiếu.
            </div>
        @endforelse
    </div>
</section>
@endsection
