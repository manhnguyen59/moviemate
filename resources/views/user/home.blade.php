@extends('layouts.user')

@section('title', 'MovieMate - Đặt vé xem phim thông minh cùng AI')
@section('meta_description', 'Nền tảng đặt vé xem phim trực tuyến hàng đầu, tích hợp AI gợi ý phim thông minh, chọn ghế trực quan và vé QR Code.')

@section('content')
    <!-- Hero Section -->
    <section class="relative min-h-[85vh] flex items-center">
        <!-- Background Banner -->
        <div class="absolute inset-0 z-0 overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-r from-[var(--bg-main)] via-[var(--bg-main)]/85 to-transparent z-10"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-[var(--bg-main)] via-transparent to-[var(--bg-main)]/60 z-10"></div>
            <img src="https://images.unsplash.com/photo-1536440136628-849c177e76a1?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80"
                 alt="Cinema Banner"
                 class="w-full h-full object-cover object-center opacity-40">
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-20 w-full py-20 lg:py-0">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

                <!-- Left: Text Content -->
                <div>
                    <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full app-card border app-border backdrop-blur-sm mb-6">
                        <i class="ph-fill ph-sparkle text-brand-start text-sm"></i>
                        <span class="text-sm font-medium app-muted">Trải nghiệm điện ảnh thế hệ mới</span>
                    </div>

                    <h1 class="text-4xl sm:text-5xl md:text-6xl font-bold app-text mb-5 leading-[1.1] tracking-tight">
                        Đặt vé xem phim<br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-start to-brand-end">thông minh cùng AI</span>
                    </h1>

                    <p class="text-base md:text-lg app-muted mb-8 max-w-xl leading-relaxed">
                        Khám phá hệ thống rạp chiếu hiện đại, chọn ghế trực quan và để AI tìm kiếm những bộ phim hoàn hảo nhất dành riêng cho bạn.
                    </p>

                    <div class="flex flex-wrap items-center gap-3">
                        <a href="{{ route('user.movies.index') }}" class="px-6 py-3 md:px-8 md:py-3.5 bg-gradient-to-r from-brand-start to-brand-end text-white rounded-full font-bold text-sm md:text-base hover:shadow-lg hover:shadow-brand-start/30 transition-all transform hover:-translate-y-0.5">
                            Đặt vé ngay
                        </a>
                        <a href="{{ route('user.ai.recommend') }}" class="px-6 py-3 md:px-8 md:py-3.5 app-card border app-border app-text rounded-full font-bold text-sm md:text-base hover:border-ai-start hover:text-ai-start transition-all flex items-center gap-2">
                            <i class="ph-fill ph-robot text-ai-start"></i> Hỏi AI gợi ý phim
                        </a>
                    </div>
                </div>

                <!-- Right: Floating AI Card (Desktop only) -->
                <div class="hidden lg:flex justify-end">
                    <div class="w-80 bg-[var(--card-bg)]/90 backdrop-blur-md border border-ai-start/30 rounded-2xl p-6 shadow-2xl shadow-ai-start/10">
                        <div class="flex items-center gap-3 mb-4 pb-4 border-b app-border">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-ai-start to-ai-end flex items-center justify-center flex-shrink-0">
                                <i class="ph-fill ph-sparkle text-white text-lg"></i>
                            </div>
                            <div>
                                <p class="text-sm font-bold app-text">AI Đề xuất hôm nay</p>
                                <p class="text-xs app-muted">Phù hợp với gu của bạn</p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <div class="w-20 h-28 rounded-lg overflow-hidden flex-shrink-0 bg-dark-border">
                                <img src="https://image.tmdb.org/t/p/w500/qJ2tW6WMUDux911r6m7haRef0WH.jpg" alt="Poster" class="w-full h-full object-cover">
                            </div>
                            <div>
                                <h4 class="font-bold app-text text-sm mb-1 line-clamp-2">Thanh Gươm Diệt Quỷ</h4>
                                <div class="flex items-center gap-1 text-xs text-warning mb-2">
                                    <i class="ph-fill ph-star"></i> 9.2
                                </div>
                                <p class="text-xs app-muted mb-3">Hành động · Hoạt hình · 115 phút</p>
                                <a href="{{ route('user.movies.show', 1) }}" class="text-xs text-brand-start hover:text-brand-end font-bold flex items-center gap-1">
                                    Đặt vé <i class="ph-bold ph-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- AI Search Bar Section -->
    <section class="max-w-5xl mx-auto px-4 sm:px-6 -mt-6 mb-16 relative z-30">
        <div class="app-card border border-ai-start/30 rounded-2xl p-3 md:p-4 shadow-2xl">
            <div class="flex flex-col sm:flex-row gap-3">
                <div class="flex-grow flex items-center gap-3 app-input rounded-xl px-4 py-3 border app-border focus-within:border-ai-start transition-colors">
                    <i class="ph ph-sparkle text-xl text-ai-start flex-shrink-0"></i>
                    <input type="text" placeholder="Ví dụ: Tôi thích phim hành động, muốn xem tối nay ở Hà Nội..." class="w-full bg-transparent border-none focus:outline-none app-text text-sm">
                </div>
                <a href="{{ route('user.ai.recommend') }}" class="px-6 py-3 bg-gradient-to-r from-ai-start to-ai-end text-white rounded-xl font-semibold flex items-center justify-center gap-2 hover:shadow-lg hover:shadow-ai-start/20 transition-all text-sm flex-shrink-0">
                    <i class="ph-fill ph-sparkle"></i> Gợi ý bằng AI
                </a>
            </div>
        </div>
    </section>

    <!-- Now Showing Section -->
    <section class="py-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-end justify-between mb-8">
            <div>
                <h2 class="text-2xl md:text-3xl font-bold app-text mb-1">Phim <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-start to-brand-end">Đang Chiếu</span></h2>
                <p class="app-muted text-sm">Những bom tấn không thể bỏ lỡ tại rạp</p>
            </div>
            <a href="{{ route('user.movies.index') }}" class="hidden md:flex items-center gap-1 text-brand-start hover:text-brand-end font-medium transition-colors text-sm">
                Xem tất cả <i class="ph-bold ph-arrow-right"></i>
            </a>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 md:gap-6">
            @php
                $movies = [
                    ['id' => 1, 'title' => 'Thanh Gươm Diệt Quỷ', 'genre' => 'Hoạt hình, Hành động', 'rating' => 9.2, 'poster' => 'https://image.tmdb.org/t/p/w500/qJ2tW6WMUDux911r6m7haRef0WH.jpg', 'age' => 'T13', 'time' => '115 phút'],
                    ['id' => 2, 'title' => 'Dune: Part Two', 'genre' => 'Khoa học viễn tưởng', 'rating' => 8.8, 'poster' => 'https://image.tmdb.org/t/p/w500/1pdfLvkbY9ohJlCjQH2JGjjcNsV.jpg', 'age' => 'T16', 'time' => '166 phút'],
                    ['id' => 3, 'title' => 'Lật Mặt 8', 'genre' => 'Hài, Gia đình', 'rating' => 8.5, 'poster' => 'https://image.tmdb.org/t/p/w500/xZNQic0r2D02VAvw5L2uQ6D2Hk4.jpg', 'age' => 'K', 'time' => '115 phút'],
                    ['id' => 4, 'title' => 'Godzilla x Kong', 'genre' => 'Hành động, Viễn tưởng', 'rating' => 7.9, 'poster' => 'https://image.tmdb.org/t/p/w500/tMefBSflR6PGQLvLuPE31clYe3D.jpg', 'age' => 'T13', 'time' => '115 phút'],
                ];
            @endphp

            @foreach($movies as $movie)
                <div class="group app-card border app-border rounded-2xl overflow-hidden hover:border-brand-start/60 transition-all hover:shadow-xl hover:shadow-brand-start/10 hover:-translate-y-1">
                    <!-- Poster Container – fixed aspect ratio -->
                    <div class="relative overflow-hidden" style="padding-top: 150%">
                        <img src="{{ $movie['poster'] }}"
                             alt="{{ $movie['title'] }}"
                             loading="lazy"
                             class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">

                        <!-- Badges -->
                        <div class="absolute top-2 left-2 bg-brand-start text-white text-[10px] font-bold px-2 py-0.5 rounded">
                            Đang chiếu
                        </div>
                        <div class="absolute top-2 right-2 bg-black/70 backdrop-blur text-warning text-[10px] font-bold px-1.5 py-0.5 rounded flex items-center gap-0.5">
                            <i class="ph-fill ph-star text-xs"></i> {{ $movie['rating'] }}
                        </div>

                        <!-- Hover Actions -->
                        <div class="absolute inset-0 bg-black/75 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col items-center justify-center gap-2 p-3">
                            <a href="{{ route('user.movies.show', $movie['id']) }}" class="w-full py-2 app-card border app-border text-center rounded-lg hover:bg-brand-start/20 transition-colors font-medium text-sm app-text">
                                Chi tiết
                            </a>
                            <a href="{{ route('user.bookings.selectSeat') }}" class="w-full py-2 bg-gradient-to-r from-brand-start to-brand-end text-white text-center rounded-lg font-medium text-sm">
                                Đặt vé ngay
                            </a>
                        </div>
                    </div>

                    <!-- Info -->
                    <div class="p-3 md:p-4">
                        <div class="flex items-center gap-2 mb-1.5 text-xs app-muted">
                            <span class="px-1.5 py-0.5 rounded border app-border app-text font-medium">{{ $movie['age'] }}</span>
                            <span>{{ $movie['time'] }}</span>
                        </div>
                        <h3 class="font-bold text-sm md:text-base app-text mb-0.5 line-clamp-1 group-hover:text-brand-start transition-colors">
                            <a href="{{ route('user.movies.show', $movie['id']) }}">{{ $movie['title'] }}</a>
                        </h3>
                        <p class="text-xs app-muted line-clamp-1">{{ $movie['genre'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-6 text-center md:hidden">
            <a href="{{ route('user.movies.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 border border-brand-start text-brand-start rounded-full font-medium text-sm hover:bg-brand-start hover:text-white transition-colors">
                Xem tất cả phim
            </a>
        </div>
    </section>

    <!-- Coming Soon Section -->
    <section class="py-12 app-secondary border-t app-border">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl md:text-3xl font-bold app-text mb-8 text-center">Phim <span class="text-transparent bg-clip-text bg-gradient-to-r from-ai-start to-ai-end">Sắp Chiếu</span></h2>

            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 md:gap-6">
                @php
                    $coming_movies = [
                        ['id' => 5, 'title' => 'Deadpool & Wolverine', 'genre' => 'Hành động, Hài', 'poster' => 'https://image.tmdb.org/t/p/w500/8cdWjvZQUExUUTzyp4t6EDMubfO.jpg', 'date' => '26/07/2026'],
                        ['id' => 6, 'title' => 'Joker: Folie à Deux', 'genre' => 'Tâm lý, Giật gân', 'poster' => 'https://image.tmdb.org/t/p/w500/1Xdd1rB9RoxBwF4oHIn7u9iHwIf.jpg', 'date' => '04/10/2026'],
                        ['id' => 7, 'title' => 'Conan Movie 27', 'genre' => 'Hoạt hình, Trinh thám', 'poster' => 'https://image.tmdb.org/t/p/w500/7P13C9E27xYhL18g10vV273s12z.jpg', 'date' => 'Tháng 8/2026'],
                        ['id' => 8, 'title' => 'Avatar 3', 'genre' => 'Khoa học viễn tưởng', 'poster' => 'https://image.tmdb.org/t/p/w500/t6HIqrNDIGGL9RVwwcbEEOz287P.jpg', 'date' => 'Sắp công bố'],
                    ];
                @endphp

                @foreach($coming_movies as $movie)
                    <div class="group">
                        <div class="relative rounded-2xl overflow-hidden mb-3" style="padding-top: 150%">
                            <img src="{{ $movie['poster'] }}"
                                 alt="{{ $movie['title'] }}"
                                 loading="lazy"
                                 class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 opacity-80 group-hover:opacity-100">
                            <div class="absolute top-2 left-2 bg-ai-start text-white text-[10px] font-bold px-2 py-0.5 rounded">
                                Sắp chiếu
                            </div>
                        </div>
                        <h3 class="font-bold text-sm md:text-base app-text mb-0.5 line-clamp-1">{{ $movie['title'] }}</h3>
                        <p class="text-xs app-muted mb-1">{{ $movie['genre'] }}</p>
                        <p class="text-xs text-ai-start font-medium flex items-center gap-1">
                            <i class="ph ph-calendar-blank"></i> {{ $movie['date'] }}
                        </p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Why Choose Us -->
    <section class="py-16 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-2xl md:text-3xl font-bold app-text mb-3">Vì sao chọn <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-start to-brand-end">MovieMate?</span></h2>
            <p class="app-muted max-w-xl mx-auto text-sm md:text-base">Nền tảng đặt vé hiện đại với nhiều tiện ích độc quyền.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="app-card border app-border p-6 md:p-8 rounded-3xl text-center hover:border-ai-start/50 transition-colors group">
                <div class="w-14 h-14 md:w-16 md:h-16 mx-auto bg-ai-start/20 rounded-2xl flex items-center justify-center mb-5 group-hover:bg-ai-start/30 transition-colors">
                    <i class="ph-fill ph-brain text-2xl md:text-3xl text-ai-start"></i>
                </div>
                <h3 class="text-lg md:text-xl font-bold app-text mb-2">AI Gợi Ý Chuẩn Gu</h3>
                <p class="app-muted text-sm leading-relaxed">Không biết xem gì? AI của chúng tôi sẽ phân tích sở thích và tìm ra bộ phim hoàn hảo dành riêng cho bạn.</p>
            </div>

            <div class="app-card border app-border p-6 md:p-8 rounded-3xl text-center hover:border-brand-start/50 transition-colors group">
                <div class="w-14 h-14 md:w-16 md:h-16 mx-auto bg-brand-start/20 rounded-2xl flex items-center justify-center mb-5 group-hover:bg-brand-start/30 transition-colors">
                    <i class="ph-fill ph-armchair text-2xl md:text-3xl text-brand-start"></i>
                </div>
                <h3 class="text-lg md:text-xl font-bold app-text mb-2">Chọn Ghế Trực Quan</h3>
                <p class="app-muted text-sm leading-relaxed">Trải nghiệm đặt ghế với giao diện trực quan, dễ dàng chọn được vị trí đẹp nhất trong rạp chiếu.</p>
            </div>

            <div class="app-card border app-border p-6 md:p-8 rounded-3xl text-center hover:border-success/50 transition-colors group">
                <div class="w-14 h-14 md:w-16 md:h-16 mx-auto bg-success/20 rounded-2xl flex items-center justify-center mb-5 group-hover:bg-success/30 transition-colors">
                    <i class="ph-fill ph-qr-code text-2xl md:text-3xl text-success"></i>
                </div>
                <h3 class="text-lg md:text-xl font-bold app-text mb-2">Vé QR Code Nhanh Chóng</h3>
                <p class="app-muted text-sm leading-relaxed">Không cần xếp hàng in vé, sử dụng mã QR trên điện thoại để vào rạp trực tiếp tiện lợi và nhanh chóng.</p>
            </div>
        </div>
    </section>
@endsection