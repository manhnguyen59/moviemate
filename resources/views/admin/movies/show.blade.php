@extends('layouts.admin')

@section('title', 'Chi tiết phim - MovieMate Admin')
@section('page-title', 'Chi tiết phim')

@section('content')
    <div class="max-w-6xl">
        
        <!-- Action Buttons -->
        <div class="flex justify-between items-center mb-6">
            <a href="{{ route('admin.movies.index') }}" class="flex items-center gap-2 text-text-sub hover:text-white transition-colors font-medium">
                <i class="ph-bold ph-arrow-left"></i> Quay lại
            </a>
            <div class="flex gap-3">
                <a href="{{ route('admin.ai.movieContent') }}" class="px-4 py-2 bg-ai-start/10 text-ai-start border border-ai-start/30 font-bold rounded-xl hover:bg-ai-start hover:text-white transition-colors flex items-center gap-2">
                    <i class="ph-bold ph-magic-wand"></i> AI Insight
                </a>
                <a href="{{ route('admin.movies.edit', 1) }}" class="px-4 py-2 bg-brand-start text-white font-bold rounded-xl hover:bg-brand-end transition-colors flex items-center gap-2">
                    <i class="ph-bold ph-pencil-simple"></i> Sửa phim
                </a>
            </div>
        </div>

        <!-- Movie Header Card -->
        <div class="bg-dark-card border border-dark-border rounded-3xl overflow-hidden mb-8 relative shadow-2xl">
            <!-- Cover/Backdrop -->
            <div class="h-64 md:h-80 w-full relative">
                <div class="absolute inset-0 bg-gradient-to-t from-dark-card via-dark-card/80 to-transparent z-10"></div>
                <img src="https://image.tmdb.org/t/p/original/bWIIWhZZCRM2WUbwZXpBfXbSjHw.jpg" class="w-full h-full object-cover object-top" alt="Backdrop">
            </div>

            <div class="px-6 md:px-10 pb-10 relative z-20 -mt-32 md:-mt-40 flex flex-col md:flex-row gap-8">
                <!-- Poster -->
                <div class="w-40 md:w-56 flex-shrink-0 mx-auto md:mx-0">
                    <img src="https://image.tmdb.org/t/p/w500/qJ2tW6WMUDux911r6m7haRef0WH.jpg" class="w-full rounded-2xl shadow-2xl shadow-black/50 border-4 border-dark-card" alt="Poster">
                </div>

                <!-- Info -->
                <div class="pt-0 md:pt-16 flex-grow text-center md:text-left">
                    <div class="inline-flex px-3 py-1 bg-success/20 text-success border border-success/30 rounded text-xs font-bold uppercase tracking-wider mb-3">
                        Đang chiếu
                    </div>
                    
                    <h1 class="text-3xl md:text-4xl font-bold text-white mb-2">Thanh Gươm Diệt Quỷ</h1>
                    <p class="text-text-sub text-lg mb-4">Kimetsu no Yaiba - To the Hashira Training</p>
                    
                    <div class="flex flex-wrap items-center justify-center md:justify-start gap-4 text-sm font-medium text-white mb-6">
                        <span class="flex items-center gap-1.5 px-3 py-1.5 bg-dark-main rounded-lg border border-dark-border">
                            <i class="ph-fill ph-clock text-brand-start"></i> 115 phút
                        </span>
                        <span class="flex items-center gap-1.5 px-3 py-1.5 bg-dark-main rounded-lg border border-dark-border">
                            <i class="ph-fill ph-warning-circle text-warning"></i> T13
                        </span>
                        <span class="flex items-center gap-1.5 px-3 py-1.5 bg-dark-main rounded-lg border border-dark-border">
                            <i class="ph-fill ph-calendar-blank text-ai-start"></i> 19/05/2026
                        </span>
                        <span class="flex items-center gap-1.5 px-3 py-1.5 bg-dark-main rounded-lg border border-dark-border">
                            <i class="ph-fill ph-globe-hemisphere-west text-blue-400"></i> Nhật Bản
                        </span>
                    </div>

                    <div class="flex flex-wrap gap-2 justify-center md:justify-start">
                        <span class="px-3 py-1 bg-dark-border text-text-sub rounded-full text-xs font-medium">Hành động</span>
                        <span class="px-3 py-1 bg-dark-border text-text-sub rounded-full text-xs font-medium">Hoạt hình</span>
                        <span class="px-3 py-1 bg-dark-border text-text-sub rounded-full text-xs font-medium">Kỳ ảo</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column: Details -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Mô tả -->
                <div class="bg-dark-card border border-dark-border rounded-2xl p-6 md:p-8">
                    <h3 class="text-xl font-bold text-white mb-4">Nội dung phim</h3>
                    <p class="text-text-sub leading-relaxed">
                        Tanjirou và những người bạn cùng với Luyến Trụ Kanroji Mitsuri và Hà Trụ Tokitou Muichirou phải đối mặt với Thượng Huyền Ngũ Gyokko và Thượng Huyền Tứ Hantengu trong một cuộc chiến sinh tử tại Làng Thợ Rèn. Đồng thời hé lộ quá trình luyện tập khắc nghiệt của các Trụ Cột nhằm chuẩn bị cho trận chiến cuối cùng với Kibutsuji Muzan.
                    </p>
                </div>

                <!-- Thống kê suất chiếu -->
                <div class="bg-dark-card border border-dark-border rounded-2xl p-6 md:p-8">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-bold text-white">Suất chiếu hôm nay</h3>
                        <a href="{{ route('admin.showtimes.index') }}" class="text-sm text-brand-start font-medium hover:text-white transition-colors">Xem tất cả suất chiếu</a>
                    </div>
                    
                    <div class="space-y-4">
                        <div class="bg-dark-main border border-dark-border rounded-xl p-4 flex items-center justify-between">
                            <div>
                                <h4 class="font-bold text-white">MovieMate Cầu Giấy</h4>
                                <p class="text-xs text-text-sub mt-1">12 suất chiếu</p>
                            </div>
                            <div class="flex gap-2">
                                <span class="px-3 py-1 bg-dark-card border border-brand-start text-brand-start rounded text-sm font-medium">09:30</span>
                                <span class="px-3 py-1 bg-dark-card border border-dark-border text-white rounded text-sm font-medium">11:45</span>
                                <span class="px-3 py-1 bg-dark-card border border-dark-border text-white rounded text-sm font-medium">14:00</span>
                            </div>
                        </div>
                        <div class="bg-dark-main border border-dark-border rounded-xl p-4 flex items-center justify-between">
                            <div>
                                <h4 class="font-bold text-white">MovieMate Hà Đông</h4>
                                <p class="text-xs text-text-sub mt-1">8 suất chiếu</p>
                            </div>
                            <div class="flex gap-2">
                                <span class="px-3 py-1 bg-dark-card border border-dark-border text-white rounded text-sm font-medium">10:15</span>
                                <span class="px-3 py-1 bg-dark-card border border-brand-start text-brand-start rounded text-sm font-medium">13:30</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Stats -->
            <div class="space-y-6">
                
                <div class="bg-dark-card border border-dark-border rounded-2xl p-6">
                    <h3 class="font-bold text-white mb-6 uppercase tracking-wider text-sm">Thống kê kinh doanh</h3>
                    
                    <div class="space-y-6">
                        <div>
                            <p class="text-xs text-text-sub mb-1">Tổng doanh thu</p>
                            <p class="text-2xl font-bold text-success">650.200.000đ</p>
                        </div>
                        <div>
                            <p class="text-xs text-text-sub mb-1">Số vé đã bán</p>
                            <p class="text-2xl font-bold text-white">6,120 vé</p>
                        </div>
                        <div>
                            <p class="text-xs text-text-sub mb-2">Tỷ lệ lấp đầy trung bình</p>
                            <div class="flex items-center gap-3">
                                <div class="w-full h-2 bg-dark-main rounded-full overflow-hidden">
                                    <div class="h-full bg-brand-start rounded-full" style="width: 82%"></div>
                                </div>
                                <span class="text-sm font-bold text-white">82%</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-dark-card border border-dark-border rounded-2xl p-6">
                    <h3 class="font-bold text-white mb-4 uppercase tracking-wider text-sm">Đánh giá trung bình</h3>
                    
                    <div class="flex items-center gap-4 mb-4">
                        <div class="text-4xl font-bold text-warning">4.8</div>
                        <div>
                            <div class="flex text-warning text-sm mb-1">
                                <i class="ph-fill ph-star"></i>
                                <i class="ph-fill ph-star"></i>
                                <i class="ph-fill ph-star"></i>
                                <i class="ph-fill ph-star"></i>
                                <i class="ph-fill ph-star-half"></i>
                            </div>
                            <p class="text-xs text-text-sub">Dựa trên 1,245 đánh giá</p>
                        </div>
                    </div>

                    <a href="{{ route('admin.reviews.index') }}" class="block text-center w-full py-2 bg-dark-main border border-dark-border rounded-lg text-sm text-white hover:border-brand-start transition-colors">
                        Xem tất cả đánh giá
                    </a>
                </div>

            </div>
        </div>

    </div>
@endsection
