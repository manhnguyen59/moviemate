@extends('layouts.user')

@section('title', 'Thanh Gươm Diệt Quỷ - MovieMate')

@section('content')
    <!-- Movie Hero Section -->
    <section class="relative min-h-[70vh] flex items-end pb-12 pt-32">
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-gradient-to-t from-dark-main via-dark-main/90 to-dark-main/30 z-10"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-dark-main via-dark-main/80 to-transparent z-10"></div>
            <!-- Cover image -->
            <img src="https://image.tmdb.org/t/p/original/9Hk9qFzSRFcPammFEEhbS0G0531.jpg" alt="Cover" class="w-full h-full object-cover opacity-30">
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-20 w-full">
            <div class="flex flex-col md:flex-row gap-8 lg:gap-12 items-end md:items-start">
                <!-- Poster -->
                <div class="w-48 md:w-64 lg:w-72 flex-shrink-0 mx-auto md:mx-0 -mt-32 md:mt-0 shadow-2xl shadow-black rounded-2xl overflow-hidden border-2 border-dark-border poster-frame">
                    <img src="https://image.tmdb.org/t/p/w500/qJ2tW6WMUDux911r6m7haRef0WH.jpg" alt="Poster">
                </div>

                <!-- Info -->
                <div class="flex-grow text-center md:text-left">
                    <div class="flex flex-wrap items-center justify-center md:justify-start gap-3 mb-4">
                        <span class="bg-brand-start text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider">Đang chiếu</span>
                        <span class="border border-dark-border text-white text-xs font-bold px-3 py-1 rounded-full">T13</span>
                        <span class="border border-dark-border text-white text-xs font-bold px-3 py-1 rounded-full">2D, IMAX 2D</span>
                    </div>

                    <h1 class="hero-title text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-2">Thanh Gươm Diệt Quỷ</h1>
                    <p class="text-lg text-text-sub mb-6">Demon Slayer: Kimetsu no Yaiba - To the Hashira Training</p>

                    <div class="flex flex-wrap items-center justify-center md:justify-start gap-6 text-sm text-text-sub mb-8">
                        <div class="flex items-center gap-2">
                            <i class="ph-fill ph-star text-warning text-xl"></i>
                            <span class="text-white font-bold text-lg">9.2</span>/10 (12.4k đánh giá)
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="ph ph-clock text-xl"></i> 120 phút
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="ph ph-calendar-blank text-xl"></i> Khởi chiếu: 23/02/2026
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="ph ph-globe-hemisphere-west text-xl"></i> Nhật Bản
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row sm:flex-wrap items-stretch sm:items-center justify-center md:justify-start gap-4">
                        <a href="#showtimes" class="px-8 py-3.5 bg-gradient-to-r from-brand-start to-brand-end text-white rounded-xl font-bold text-base sm:text-lg text-center hover:shadow-lg hover:shadow-brand-start/30 transition-all transform hover:-translate-y-1">
                            Đặt vé ngay
                        </a>
                        <button class="px-8 py-3.5 bg-dark-card border border-dark-border text-white rounded-xl font-bold text-base sm:text-lg hover:bg-dark-border transition-colors flex items-center justify-center gap-2">
                            <i class="ph-fill ph-play-circle text-2xl"></i> Xem trailer
                        </button>
                        <a href="{{ route('user.ai.chatbot') }}" class="px-6 py-3.5 border border-ai-start/50 text-ai-start rounded-xl font-bold hover:bg-ai-start hover:text-white transition-colors flex items-center justify-center gap-2">
                            <i class="ph-fill ph-robot"></i> Hỏi AI về phim này
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            
            <!-- Left Content: Plot & Cast -->
            <div class="lg:col-span-2 space-y-12">
                
                <!-- Nội dung phim -->
                <section>
                    <h2 class="text-2xl font-bold text-white mb-4 border-l-4 border-brand-start pl-4">Nội dung phim</h2>
                    <p class="text-text-sub leading-relaxed text-lg">
                        Bộ phim là sự kết hợp của tập 11 trong phần Làng Thợ Rèn với màn kết thúc trận chiến ác liệt chống lại Hantengu - Thượng Huyền Tứ và bước nhảy vọt của Nezuko trong việc chinh phục mặt trời. Đi cùng với đó là tập 1 của phần phim Huấn Luyện Trụ Cột, tập trung vào sự khởi đầu cho quá trình huấn luyện do các Trụ Cột tiến hành để chuẩn bị cho trận chiến cuối cùng đẫm máu với Muzan Kibutsuji.
                    </p>
                    <div class="mt-4 flex flex-wrap gap-2 text-sm">
                        <span class="px-3 py-1 bg-dark-card border border-dark-border rounded-lg text-text-sub">Hành động</span>
                        <span class="px-3 py-1 bg-dark-card border border-dark-border rounded-lg text-text-sub">Hoạt hình</span>
                        <span class="px-3 py-1 bg-dark-card border border-dark-border rounded-lg text-text-sub">Kỳ ảo</span>
                    </div>
                </section>

                <!-- Lịch chiếu -->
                <section id="showtimes" class="scroll-mt-24">
                    <h2 class="text-2xl font-bold text-white mb-6 border-l-4 border-brand-start pl-4">Lịch chiếu</h2>
                    
                    <!-- Date Picker -->
                    <div class="flex gap-4 overflow-x-auto pb-4 mb-6 hide-scrollbar">
                        <button class="flex-shrink-0 flex flex-col items-center justify-center w-16 h-20 rounded-xl bg-gradient-to-b from-brand-start to-brand-end text-white border border-transparent">
                            <span class="text-xs font-medium">Hôm nay</span>
                            <span class="text-2xl font-bold">18</span>
                            <span class="text-xs">Tháng 5</span>
                        </button>
                        <button class="flex-shrink-0 flex flex-col items-center justify-center w-16 h-20 rounded-xl bg-dark-card border border-dark-border text-text-sub hover:border-brand-start hover:text-white transition-colors">
                            <span class="text-xs font-medium">Thứ 3</span>
                            <span class="text-2xl font-bold">19</span>
                            <span class="text-xs">Tháng 5</span>
                        </button>
                        <button class="flex-shrink-0 flex flex-col items-center justify-center w-16 h-20 rounded-xl bg-dark-card border border-dark-border text-text-sub hover:border-brand-start hover:text-white transition-colors">
                            <span class="text-xs font-medium">Thứ 4</span>
                            <span class="text-2xl font-bold">20</span>
                            <span class="text-xs">Tháng 5</span>
                        </button>
                        <button class="flex-shrink-0 flex flex-col items-center justify-center w-16 h-20 rounded-xl bg-dark-card border border-dark-border text-text-sub hover:border-brand-start hover:text-white transition-colors">
                            <span class="text-xs font-medium">Thứ 5</span>
                            <span class="text-2xl font-bold">21</span>
                            <span class="text-xs">Tháng 5</span>
                        </button>
                    </div>

                    <!-- Cinema List -->
                    <div class="space-y-6">
                        <!-- Cinema 1 -->
                        <div class="bg-dark-card border border-dark-border rounded-2xl p-6">
                            <h3 class="text-xl font-bold text-white mb-1 flex flex-col sm:flex-row sm:items-center gap-2 safe-break">
                                MovieMate Cầu Giấy
                                <span class="text-xs px-2 py-0.5 bg-dark-border rounded text-text-sub font-normal">Cách bạn 2.5km</span>
                            </h3>
                            <p class="text-sm text-text-sub mb-4">Tầng 3, Indochina Plaza, 241 Xuân Thủy, Cầu Giấy, Hà Nội</p>
                            
                            <div class="mb-2 text-sm font-medium text-white">2D Phụ Đề Việt</div>
                            <div class="flex flex-wrap gap-3">
                                <a href="{{ route('user.bookings.selectSeat') }}" class="px-4 py-2 border border-dark-border rounded-lg text-white hover:border-brand-start hover:bg-brand-start/10 transition-colors">
                                    09:30
                                </a>
                                <a href="{{ route('user.bookings.selectSeat') }}" class="px-4 py-2 border border-dark-border rounded-lg text-white hover:border-brand-start hover:bg-brand-start/10 transition-colors">
                                    11:45
                                </a>
                                <a href="{{ route('user.bookings.selectSeat') }}" class="px-4 py-2 border border-dark-border rounded-lg text-white hover:border-brand-start hover:bg-brand-start/10 transition-colors">
                                    14:00
                                </a>
                                <a href="{{ route('user.bookings.selectSeat') }}" class="px-4 py-2 border border-dark-border rounded-lg text-white hover:border-brand-start hover:bg-brand-start/10 transition-colors">
                                    18:30
                                </a>
                            </div>
                        </div>

                        <!-- Cinema 2 -->
                        <div class="bg-dark-card border border-dark-border rounded-2xl p-6">
                            <h3 class="text-xl font-bold text-white mb-1 flex items-center gap-2">
                                MovieMate Hà Đông
                            </h3>
                            <p class="text-sm text-text-sub mb-4">Tầng 5, MAC Plaza, 10 Trần Phú, Hà Đông, Hà Nội</p>
                            
                            <div class="mb-2 text-sm font-medium text-white">2D Phụ Đề Việt</div>
                            <div class="flex flex-wrap gap-3">
                                <a href="{{ route('user.bookings.selectSeat') }}" class="px-4 py-2 border border-dark-border rounded-lg text-white hover:border-brand-start hover:bg-brand-start/10 transition-colors">
                                    10:00
                                </a>
                                <a href="{{ route('user.bookings.selectSeat') }}" class="px-4 py-2 border border-dark-border rounded-lg text-white hover:border-brand-start hover:bg-brand-start/10 transition-colors opacity-50 cursor-not-allowed" onclick="event.preventDefault()">
                                    13:15 (Hết vé)
                                </a>
                                <a href="{{ route('user.bookings.selectSeat') }}" class="px-4 py-2 border border-dark-border rounded-lg text-white hover:border-brand-start hover:bg-brand-start/10 transition-colors">
                                    20:45
                                </a>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <!-- Right Content: Info & Reviews -->
            <div class="space-y-8">
                <!-- Cast & Crew -->
                <div class="bg-dark-card border border-dark-border rounded-2xl p-6">
                    <h3 class="font-bold text-white mb-4">Thông tin thêm</h3>
                    <ul class="space-y-3 text-sm">
                        <li class="flex justify-between border-b border-dark-border pb-2">
                            <span class="text-text-sub">Đạo diễn</span>
                            <span class="text-white font-medium text-right">Haruo Sotozaki</span>
                        </li>
                        <li class="flex justify-between border-b border-dark-border pb-2">
                            <span class="text-text-sub">Diễn viên</span>
                            <span class="text-white font-medium text-right max-w-[60%]">Natsuki Hanae, Kengo Kawanishi, Akari Kito</span>
                        </li>
                        <li class="flex justify-between border-b border-dark-border pb-2">
                            <span class="text-text-sub">Ngôn ngữ</span>
                            <span class="text-white font-medium text-right">Tiếng Nhật (Phụ đề Tiếng Việt)</span>
                        </li>
                    </ul>
                </div>

                <!-- AI Insight -->
                <div class="bg-gradient-to-br from-dark-card to-[#1E1B4B] border border-ai-start/30 rounded-2xl p-6 relative overflow-hidden">
                    <i class="ph-fill ph-sparkle absolute -top-4 -right-4 text-6xl text-ai-start/20"></i>
                    <h3 class="font-bold text-white mb-2 flex items-center gap-2 text-ai-start">
                        <i class="ph-fill ph-magic-wand"></i> AI Insight
                    </h3>
                    <p class="text-sm text-text-sub leading-relaxed mb-4">
                        Dựa trên sở thích của bạn, AI đánh giá bạn có <strong class="text-success">95%</strong> khả năng sẽ thích bộ phim này. Đồ họa xuất sắc và cốt truyện cảm động là điểm nhấn lớn nhất.
                    </p>
                    <a href="{{ route('user.ai.recommend') }}" class="text-sm font-medium text-ai-start hover:text-white transition-colors">
                        Xem thêm gợi ý →
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
