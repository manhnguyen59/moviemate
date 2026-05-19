@php
    $releaseDate = $movie->release_date ? \Carbon\Carbon::parse($movie->release_date)->format('d/m/Y') : 'Đang cập nhật';
    $isNowShowing = $movie->status === 'now_showing';
@endphp

<article class="movie-card group app-card border app-border rounded-3xl overflow-hidden transition-all duration-300 hover:-translate-y-1 hover:border-brand-start/60 hover:shadow-2xl hover:shadow-brand-start/10">
    <a href="{{ route('user.movies.show', $movie->slug) }}" class="block">
        <div class="poster-frame">
            @if($movie->poster)
                <img src="{{ asset('storage/' . $movie->poster) }}" alt="{{ $movie->title }}">
            @else
                <img src="{{ asset('images/placeholder.png') }}" alt="{{ $movie->title ?? 'Phim MovieMate' }}">
            @endif
            <div class="absolute inset-x-0 bottom-0 p-3 bg-gradient-to-t from-black/85 to-transparent">
                <span class="inline-flex items-center rounded-full px-2.5 py-1 text-[11px] font-bold text-white {{ $isNowShowing ? 'bg-brand-start' : 'bg-ai-start' }}">
                    {{ $isNowShowing ? 'Đang chiếu' : 'Sắp chiếu' }}
                </span>
            </div>
        </div>
    </a>
    <div class="p-4">
        <h3 class="app-text font-bold text-sm sm:text-base line-clamp-2 min-h-[2.75rem]">
            <a href="{{ route('user.movies.show', $movie->slug) }}" class="hover:text-brand-start transition-colors">
                {{ $movie->title ?? 'Chưa có tên phim' }}
            </a>
        </h3>
        <div class="mt-3 flex items-center justify-between gap-3 app-muted text-xs">
            <span class="inline-flex items-center gap-1"><i class="ph ph-clock"></i>{{ $movie->duration ?? '--' }} phút</span>
            <span class="inline-flex items-center gap-1"><i class="ph ph-calendar-blank"></i>{{ $releaseDate }}</span>
        </div>
        <div class="mt-4 grid grid-cols-2 gap-2">
            <a href="{{ route('user.movies.show', $movie->slug) }}" class="inline-flex items-center justify-center px-3 py-2 rounded-xl border app-border app-text text-xs font-bold hover:border-brand-start hover:text-brand-start transition-colors">
                Chi tiết
            </a>
            <a href="{{ route('user.movies.show', $movie->slug) }}#showtimes" class="inline-flex items-center justify-center px-3 py-2 rounded-xl bg-gradient-to-r from-brand-start to-brand-end text-white text-xs font-bold">
                Đặt vé
            </a>
        </div>
    </div>
</article>
