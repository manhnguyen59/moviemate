@extends('layouts.app')

@section('title', 'Danh sách phim - MovieMate')

@section('content')
<section class="relative overflow-hidden py-12 md:py-16">
    <div class="absolute inset-0 bg-gradient-to-br from-dark-main via-dark-main to-dark-sub"></div>
    <div class="absolute inset-0 opacity-35 bg-[radial-gradient(circle_at_15%_20%,rgba(255,61,87,0.22),transparent_32%),radial-gradient(circle_at_85%_10%,rgba(124,58,237,0.20),transparent_28%)]"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <p class="text-brand-start text-sm font-bold uppercase tracking-[0.25em] mb-3">MovieMate Cinema</p>
        <h1 class="hero-title text-4xl md:text-5xl font-extrabold app-text mb-4">Danh sách phim</h1>
        <p class="app-muted max-w-2xl">Tìm phim đang chiếu, phim sắp chiếu và chọn suất phù hợp cho buổi xem tiếp theo.</p>

        <form method="GET" action="{{ route('user.movies.index') }}" class="mt-8 app-card border app-border rounded-3xl p-3 grid grid-cols-1 md:grid-cols-[1fr_220px_auto] gap-3 shadow-2xl shadow-black/20">
            <label class="flex items-center gap-3 px-4 py-3 app-input border app-border rounded-2xl">
                <i class="ph ph-magnifying-glass app-muted text-xl"></i>
                <input type="text" name="search" placeholder="Tìm kiếm tiêu đề..." value="{{ request('search') }}" class="w-full bg-transparent app-text placeholder:text-text-sub/70 focus:outline-none">
            </label>
            <select name="genre_id" class="app-input border app-border rounded-2xl px-4 py-3 focus:outline-none focus:border-brand-start">
                <option value="">Tất cả thể loại</option>
                @foreach(\App\Models\Genre::orderBy('name')->get() as $genre)
                    <option value="{{ $genre->id }}" {{ request('genre_id') == $genre->id ? 'selected' : '' }}>
                        {{ $genre->name }}
                    </option>
                @endforeach
            </select>
            <button type="submit" class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-2xl bg-gradient-to-r from-brand-start to-brand-end text-white font-bold">
                <i class="ph ph-sliders-horizontal"></i>
                Lọc
            </button>
        </form>
    </div>
</section>

<section id="showtimes" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-8">
        <div>
            <h2 class="text-3xl font-bold app-text">Phim đang chiếu và sắp chiếu</h2>
            <p class="app-muted mt-2">{{ $movies->total() }} phim phù hợp với bộ lọc hiện tại.</p>
        </div>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6">
        @forelse($movies as $movie)
            @include('user.movies._card', ['movie' => $movie])
        @empty
            <div class="col-span-full app-card border app-border rounded-3xl p-10 text-center">
                <div class="w-16 h-16 rounded-2xl bg-brand-start/10 text-brand-start flex items-center justify-center mx-auto mb-4">
                    <i class="ph ph-film-slate text-3xl"></i>
                </div>
                <h3 class="text-xl font-bold app-text mb-2">Không có phim nào</h3>
                <p class="app-muted">Hãy thử đổi từ khóa tìm kiếm hoặc bộ lọc thể loại.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $movies->links() }}
    </div>
</section>
@endsection
