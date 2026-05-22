@php
    $type = $type ?? ($movie->status === 'coming_soon' ? 'coming_soon' : 'now_showing');
    $isComingSoon = $type === 'coming_soon';
    $rating = $rating ?? '8.6';
    $status = $status ?? ($isComingSoon ? 'Sắp chiếu' : 'Đang chiếu');
    $genre = $genre ?? ($movie->genres?->pluck('name')->take(2)->join(', ') ?: 'Đang cập nhật');
    $duration = $duration ?? (($movie->duration ?? '--').' phút');
    $releaseDate = $release_date ?? ($movie->release_date ? \Carbon\Carbon::parse($movie->release_date)->format('d/m/Y') : 'Đang cập nhật');
    $poster = $poster ?? $movie->poster_url;
    $detailUrl = $movie->slug ? route('user.movies.show', $movie->slug) : route('user.movies.index');
    $bookingUrl = $detailUrl.'#showtimes';
    $cardBg = $isComingSoon
        ? 'bg-[linear-gradient(180deg,#131A2E_0%,#0B1020_100%)]'
        : 'bg-[linear-gradient(180deg,#111827_0%,#0B1020_100%)]';
    $cinemaGradient = 'from-pink-500 via-red-500 to-orange-500';
    $cinemaGlow = $isComingSoon
        ? 'hover:shadow-[0_20px_44px_rgba(255,77,109,0.14)]'
        : 'hover:shadow-[0_20px_44px_rgba(255,77,109,0.18)]';
    $badgeOpacity = $isComingSoon ? 'opacity-90' : '';
    $accentText = 'text-pink-400';
    $titleHover = 'hover:text-pink-400';
@endphp

<article class="group dark-surface flex h-full flex-col overflow-hidden rounded-3xl border border-white/[0.08] {{ $cardBg }} shadow-[0_10px_30px_rgba(0,0,0,0.35)] transition-all duration-300 ease-out hover:-translate-y-1.5 hover:border-orange-400/25 {{ $cinemaGlow }}">
    <a href="{{ $detailUrl }}" class="block">
        <div class="relative aspect-[2/3] overflow-hidden rounded-t-3xl bg-slate-950">
            @if($poster)
                <img src="{{ $poster }}" alt="{{ $movie->title }}" class="h-full w-full object-cover transition-transform duration-300 ease-out group-hover:scale-[1.03]" loading="lazy">
            @else
                <div class="flex h-full w-full flex-col items-center justify-center bg-[radial-gradient(circle_at_center,rgba(255,77,109,0.35)_0%,rgba(255,122,24,0.12)_30%,transparent_70%),linear-gradient(145deg,#172033,#070B16)] px-6 text-center text-white">
                    <div class="mb-4 rounded-full bg-white/10 p-5 text-pink-500 shadow-[0_0_32px_rgba(255,77,109,0.28)]">
                        <i class="ph-fill ph-film-slate text-4xl"></i>
                    </div>
                    <p class="text-lg font-black">MovieMate</p>
                    <p class="mt-2 line-clamp-2 text-sm text-slate-400">{{ $movie->title ?? 'Phim MovieMate' }}</p>
                </div>
            @endif

            <div class="absolute inset-0 bg-gradient-to-t from-[#0B1020]/70 via-transparent to-black/20"></div>

            <div class="absolute left-3 top-3 z-10">
                <span class="inline-flex items-center rounded-full bg-gradient-to-r {{ $cinemaGradient }} {{ $badgeOpacity }} px-3 py-1 text-xs font-semibold text-white shadow-lg shadow-pink-500/20">
                    {{ $status }}
                </span>
            </div>

            <div class="absolute right-3 top-3 z-10 flex flex-col items-end gap-2">
                <span class="inline-flex items-center gap-1 rounded-full border border-white/10 bg-black/70 px-3 py-1 text-xs font-semibold text-white backdrop-blur-md">
                    <i class="ph-fill ph-star text-yellow-400"></i>
                    {{ $rating }}
                </span>
                <span class="rounded-full border border-white/10 bg-black/60 px-3 py-1 text-xs font-bold text-white backdrop-blur-md">
                    {{ $movie->age_rating ?? 'P' }}
                </span>
            </div>
        </div>
    </a>

    <div class="flex flex-1 flex-col gap-y-3 p-5">
        <div class="min-h-0 flex-1">
            <h3 class="text-xl font-bold leading-snug text-white line-clamp-2">
                <a href="{{ $detailUrl }}" class="transition-colors {{ $titleHover }}">
                    {{ $movie->title ?? 'Phim MovieMate' }}
                </a>
            </h3>

            <p class="mt-2 line-clamp-1 text-sm font-medium text-gray-400">{{ $genre }}</p>

            <div class="mt-4 flex items-center justify-between gap-3 text-sm text-gray-400">
                <span class="inline-flex min-w-0 items-center gap-1.5">
                    <i class="ph ph-clock {{ $accentText }}"></i>
                    <span class="truncate">{{ $duration }}</span>
                </span>
                <span class="inline-flex min-w-0 items-center justify-end gap-1.5">
                    <i class="ph ph-calendar-blank {{ $accentText }}"></i>
                    <span class="truncate">{{ $releaseDate }}</span>
                </span>
            </div>
        </div>

        <div class="mt-2 grid grid-cols-2 gap-3">
            <a href="{{ $detailUrl }}" class="inline-flex h-11 items-center justify-center rounded-xl border border-white/10 bg-transparent px-3 text-sm font-bold text-white transition-all duration-300 hover:border-white/25 hover:bg-white/[0.07]">
                Chi tiết
            </a>
            <a href="{{ $bookingUrl }}" class="inline-flex h-11 items-center justify-center gap-2 rounded-xl bg-gradient-to-r {{ $cinemaGradient }} px-3 text-sm font-bold text-white shadow-lg shadow-pink-500/15 transition-all duration-300 hover:scale-[1.02] hover:brightness-110 hover:shadow-pink-500/30">
                <i class="ph-fill ph-ticket"></i>
                Đặt vé
            </a>
        </div>
    </div>
</article>
