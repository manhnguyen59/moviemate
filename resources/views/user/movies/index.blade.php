@extends('layouts.user')

@section('title', 'Khám phá Phim - MovieMate')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

        <!-- Header & Search -->
        <div class="mb-8">
            <h1 class="text-3xl md:text-4xl font-bold app-text mb-6">Khám phá <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-start to-brand-end">Phim</span></h1>

            <div class="app-card border app-border p-4 rounded-2xl">
                <div class="flex flex-col md:flex-row gap-3">
                    <div class="flex-grow relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="ph ph-magnifying-glass app-muted text-lg"></i>
                        </div>
                        <input type="text" class="app-input w-full pl-11 pr-4 py-2.5 border app-border rounded-xl focus:outline-none focus:border-brand-start transition-colors text-sm" placeholder="Tìm kiếm tên phim, đạo diễn, diễn viên...">
                    </div>

                    <div class="flex flex-wrap gap-3">
                        <select class="app-input px-4 py-2.5 border app-border rounded-xl focus:outline-none focus:border-brand-start transition-colors appearance-none text-sm min-w-[140px]">
                            <option value="">Tất cả thể loại</option>
                            <option>Hành động</option>
                            <option>Hài hước</option>
                            <option>Kinh dị</option>
                            <option>Tình cảm</option>
                            <option>Hoạt hình</option>
                        </select>

                        <select class="app-input px-4 py-2.5 border app-border rounded-xl focus:outline-none focus:border-brand-start transition-colors appearance-none text-sm min-w-[130px]">
                            <option value="now-showing">Đang chiếu</option>
                            <option value="coming-soon">Sắp chiếu</option>
                        </select>

                        <button class="app-secondary border app-border hover:border-brand-start hover:text-brand-start rounded-xl font-medium transition-colors app-muted flex items-center gap-2 px-4 py-2.5 text-sm">
                            <i class="ph ph-sliders-horizontal"></i> Bộ lọc
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Movies Grid -->
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4 md:gap-6">
            @php
                $movies = [
                    ['id' => 1, 'title' => 'Thanh Gươm Diệt Quỷ', 'genre' => 'Hoạt hình, Hành động', 'rating' => 9.2, 'poster' => 'https://image.tmdb.org/t/p/w500/qJ2tW6WMUDux911r6m7haRef0WH.jpg', 'age' => 'T13', 'status' => 'now'],
                    ['id' => 2, 'title' => 'Avengers: Secret Wars', 'genre' => 'Hành động, Viễn tưởng', 'rating' => 8.8, 'poster' => 'https://image.tmdb.org/t/p/w500/RYMX2wcKCBAr24UyPD7xwmja8y.jpg', 'age' => 'T13', 'status' => 'now'],
                    ['id' => 3, 'title' => 'Lật Mặt 8', 'genre' => 'Hài, Gia đình', 'rating' => 8.5, 'poster' => 'https://image.tmdb.org/t/p/w500/xZNQic0r2D02VAvw5L2uQ6D2Hk4.jpg', 'age' => 'K', 'status' => 'now'],
                    ['id' => 4, 'title' => 'Doraemon Movie 43', 'genre' => 'Hoạt hình', 'rating' => 9.0, 'poster' => 'https://image.tmdb.org/t/p/w500/tK1zy5BsKkwk0a1aAto3M366t4j.jpg', 'age' => 'P', 'status' => 'now'],
                    ['id' => 5, 'title' => 'Conan Movie 27', 'genre' => 'Hoạt hình, Trinh thám', 'rating' => 8.9, 'poster' => 'https://image.tmdb.org/t/p/w500/7P13C9E27xYhL18g10vV273s12z.jpg', 'age' => 'T13', 'status' => 'coming'],
                    ['id' => 6, 'title' => 'Joker: Folie à Deux', 'genre' => 'Tâm lý, Giật gân', 'rating' => 0, 'poster' => 'https://image.tmdb.org/t/p/w500/1Xdd1rB9RoxBwF4oHIn7u9iHwIf.jpg', 'age' => 'T18', 'status' => 'coming'],
                    ['id' => 7, 'title' => 'Deadpool & Wolverine', 'genre' => 'Hành động, Hài', 'rating' => 8.7, 'poster' => 'https://image.tmdb.org/t/p/w500/8cdWjvZQUExUUTzyp4t6EDMubfO.jpg', 'age' => 'T18', 'status' => 'now'],
                    ['id' => 8, 'title' => 'Dune: Part Two', 'genre' => 'Khoa học viễn tưởng', 'rating' => 8.8, 'poster' => 'https://image.tmdb.org/t/p/w500/1pdfLvkbY9ohJlCjQH2JGjjcNsV.jpg', 'age' => 'T16', 'status' => 'now'],
                    ['id' => 9, 'title' => 'Godzilla x Kong', 'genre' => 'Hành động, Viễn tưởng', 'rating' => 7.9, 'poster' => 'https://image.tmdb.org/t/p/w500/tMefBSflR6PGQLvLuPE31clYe3D.jpg', 'age' => 'T13', 'status' => 'now'],
                    ['id' => 10, 'title' => 'Furiosa', 'genre' => 'Hành động', 'rating' => 8.1, 'poster' => 'https://image.tmdb.org/t/p/w500/iADOJ8Zymht2JPMoy3R7xceZprc.jpg', 'age' => 'T16', 'status' => 'now'],
                ];
            @endphp

            @foreach($movies as $movie)
                <div class="group app-card border app-border rounded-2xl overflow-hidden hover:border-brand-start/60 transition-all hover:shadow-xl hover:shadow-brand-start/10 hover:-translate-y-1">
                    <!-- Poster – fixed aspect ratio using padding-top trick -->
                    <div class="relative overflow-hidden" style="padding-top: 150%">
                        <img src="{{ $movie['poster'] }}" alt="{{ $movie['title'] }}"
                             loading="lazy"
                             class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">

                        @if($movie['status'] == 'now')
                            <div class="absolute top-2 left-2 bg-brand-start text-white text-[10px] uppercase font-bold px-1.5 py-0.5 rounded">Đang chiếu</div>
                        @else
                            <div class="absolute top-2 left-2 bg-ai-start text-white text-[10px] uppercase font-bold px-1.5 py-0.5 rounded">Sắp chiếu</div>
                        @endif

                        @if($movie['rating'] > 0)
                            <div class="absolute top-2 right-2 bg-black/70 backdrop-blur text-warning text-[10px] font-bold px-1.5 py-0.5 rounded flex items-center gap-0.5">
                                <i class="ph-fill ph-star text-xs"></i> {{ $movie['rating'] }}
                            </div>
                        @endif

                        <!-- Hover Actions -->
                        <div class="absolute inset-0 bg-black/75 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col items-center justify-center gap-2 p-3">
                            <a href="{{ route('user.movies.show', $movie['id']) }}" class="w-full py-2 app-card border app-border app-text text-center rounded-lg hover:bg-brand-start/20 transition-colors font-medium text-sm">
                                Chi tiết
                            </a>
                            @if($movie['status'] == 'now')
                            <a href="{{ route('user.bookings.selectSeat') }}" class="w-full py-2 bg-gradient-to-r from-brand-start to-brand-end text-white text-center rounded-lg font-medium text-sm">
                                Đặt vé ngay
                            </a>
                            @endif
                        </div>
                    </div>

                    <div class="p-3">
                        <div class="flex items-center gap-2 mb-1 text-[11px] app-muted">
                            <span class="px-1 py-0.5 rounded border app-border app-text font-medium">{{ $movie['age'] }}</span>
                            <span class="truncate">{{ $movie['genre'] }}</span>
                        </div>
                        <h3 class="font-bold text-sm app-text line-clamp-1 group-hover:text-brand-start transition-colors">
                            <a href="{{ route('user.movies.show', $movie['id']) }}">{{ $movie['title'] }}</a>
                        </h3>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-12 flex justify-center">
            <nav class="flex items-center gap-2">
                <a href="#" class="w-9 h-9 flex items-center justify-center rounded-xl border app-border app-muted hover:border-brand-start hover:text-brand-start transition-colors text-sm">
                    <i class="ph ph-caret-left"></i>
                </a>
                <a href="#" class="w-9 h-9 flex items-center justify-center rounded-xl bg-gradient-to-r from-brand-start to-brand-end text-white font-bold shadow-lg shadow-brand-start/20 text-sm">1</a>
                <a href="#" class="w-9 h-9 flex items-center justify-center rounded-xl border app-border app-muted hover:border-brand-start hover:text-brand-start transition-colors text-sm">2</a>
                <a href="#" class="w-9 h-9 flex items-center justify-center rounded-xl border app-border app-muted hover:border-brand-start hover:text-brand-start transition-colors text-sm">3</a>
                <span class="app-muted text-sm">...</span>
                <a href="#" class="w-9 h-9 flex items-center justify-center rounded-xl border app-border app-muted hover:border-brand-start hover:text-brand-start transition-colors text-sm">8</a>
                <a href="#" class="w-9 h-9 flex items-center justify-center rounded-xl border app-border app-muted hover:border-brand-start hover:text-brand-start transition-colors text-sm">
                    <i class="ph ph-caret-right"></i>
                </a>
            </nav>
        </div>
    </div>
@endsection