@extends('layouts.user')

@section('title', 'Lịch sử đặt vé - MovieMate')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <div class="app-card border app-border rounded-2xl p-6 flex flex-col items-center text-center sticky top-24">
                    <div class="w-20 h-20 rounded-full overflow-hidden mb-3 border-2 border-brand-start/30">
                        <img src="https://ui-avatars.com/api/?name=Nguyen+Manh&background=FF3D57&color=fff&size=128" alt="Avatar" class="w-full h-full object-cover">
                    </div>
                    <h2 class="font-bold app-text mb-1">Nguyễn Mạnh</h2>
                    <p class="text-xs text-ai-start font-bold mb-5">Hạng Vàng ✦</p>

                    <div class="w-full space-y-1 text-left">
                        <a href="{{ route('user.profile') }}" class="flex items-center gap-3 px-4 py-2.5 app-muted hover:app-text hover:bg-brand-start/5 rounded-xl font-medium transition-colors text-sm">
                            <i class="ph ph-user text-lg"></i> Thông tin cá nhân
                        </a>
                        <a href="{{ route('user.bookings.history') }}" class="flex items-center gap-3 px-4 py-2.5 bg-brand-start/10 text-brand-start rounded-xl font-bold border border-brand-start/20 text-sm">
                            <i class="ph-fill ph-ticket text-lg"></i> Lịch sử đặt vé
                        </a>
                        <a href="#" class="flex items-center gap-3 px-4 py-2.5 app-muted hover:app-text hover:bg-brand-start/5 rounded-xl font-medium transition-colors text-sm">
                            <i class="ph ph-star text-lg"></i> Đánh giá của tôi
                        </a>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="lg:col-span-3">
                <div class="flex items-center justify-between mb-6">
                    <h1 class="text-2xl font-bold app-text">Lịch sử đặt vé</h1>

                    <div class="flex gap-2">
                        <button class="px-3 py-1.5 bg-brand-start text-white text-xs font-bold rounded-lg">Tất cả</button>
                        <button class="px-3 py-1.5 app-card border app-border app-muted hover:app-text text-xs font-medium rounded-lg transition-colors">Sắp chiếu</button>
                        <button class="px-3 py-1.5 app-card border app-border app-muted hover:app-text text-xs font-medium rounded-lg transition-colors">Đã xem</button>
                    </div>
                </div>

                <div class="space-y-5">

                    <!-- Ticket 1: Sắp chiếu -->
                    <div class="app-card border border-brand-start/30 rounded-2xl p-4 sm:p-6 hover:border-brand-start transition-colors relative overflow-hidden">
                        <div class="absolute top-0 right-0 bg-brand-start text-white text-[10px] font-bold px-3 py-1.5 rounded-bl-xl">
                            Sắp chiếu
                        </div>

                        <div class="flex flex-col sm:flex-row gap-5">
                            <!-- Poster -->
                            <div class="w-24 sm:w-28 flex-shrink-0">
                                <div class="poster-frame rounded-xl">
                                    <img src="https://image.tmdb.org/t/p/w500/qJ2tW6WMUDux911r6m7haRef0WH.jpg"
                                         alt="Poster">
                                </div>
                            </div>

                            <!-- Info -->
                            <div class="flex-grow min-w-0">
                                <h4 class="text-lg font-bold app-text mb-1 pr-16">Thanh Gươm Diệt Quỷ</h4>
                                <p class="app-muted text-xs mb-4">Mã vé: <span class="app-text font-mono font-bold">MMT-2026-0001</span></p>

                                <div class="grid grid-cols-2 gap-x-4 gap-y-3 text-xs mb-4">
                                    <div>
                                        <p class="app-muted mb-0.5">Thời gian</p>
                                        <p class="app-text font-medium">09:30 — 19/05/2026</p>
                                    </div>
                                    <div>
                                        <p class="app-muted mb-0.5">Ghế</p>
                                        <p class="text-brand-start font-bold text-sm">F7, F8</p>
                                    </div>
                                    <div>
                                        <p class="app-muted mb-0.5">Rạp</p>
                                        <p class="app-text font-medium">MovieMate Cầu Giấy</p>
                                    </div>
                                    <div>
                                        <p class="app-muted mb-0.5">Phòng</p>
                                        <p class="app-text font-medium">Phòng 3 (2D)</p>
                                    </div>
                                </div>

                                <div class="flex flex-wrap items-center justify-between gap-3 pt-4 border-t app-border">
                                    <div>
                                        <p class="text-xs app-muted mb-0.5">Tổng tiền</p>
                                        <p class="app-text font-bold text-lg">160.000đ</p>
                                    </div>
                                    <div class="flex gap-2">
                                        <button class="px-3 py-2 border app-border app-muted hover:app-text rounded-lg text-xs font-medium transition-colors">
                                            Hủy vé
                                        </button>
                                        <a href="{{ route('user.bookings.ticket') }}" class="px-4 py-2 bg-gradient-to-r from-brand-start to-brand-end text-white rounded-lg text-xs font-bold hover:shadow-lg transition-all hover:-translate-y-0.5">
                                            Xem vé QR
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Ticket 2: Đã xem -->
                    <div class="app-card border app-border rounded-2xl p-4 sm:p-6 transition-colors relative overflow-hidden opacity-75 hover:opacity-100">
                        <div class="absolute top-0 right-0 bg-dark-border text-text-sub text-[10px] font-bold px-3 py-1.5 rounded-bl-xl">
                            Đã xem
                        </div>

                        <div class="flex flex-col sm:flex-row gap-5">
                            <div class="w-24 sm:w-28 flex-shrink-0 grayscale-[50%]">
                                <div class="poster-frame rounded-xl">
                                    <img src="https://image.tmdb.org/t/p/w500/1pdfLvkbY9ohJlCjQH2JGjjcNsV.jpg"
                                         alt="Poster">
                                </div>
                            </div>

                            <div class="flex-grow min-w-0">
                                <h4 class="text-lg font-bold app-text mb-1 pr-16">Dune: Part Two</h4>
                                <p class="app-muted text-xs mb-4">Mã vé: <span class="app-text font-mono font-bold">MMT-2026-0002</span></p>

                                <div class="grid grid-cols-2 gap-x-4 gap-y-3 text-xs mb-4">
                                    <div>
                                        <p class="app-muted mb-0.5">Thời gian</p>
                                        <p class="app-text font-medium">20:00 — 10/05/2026</p>
                                    </div>
                                    <div>
                                        <p class="app-muted mb-0.5">Ghế</p>
                                        <p class="app-text font-bold text-sm">H10, H11</p>
                                    </div>
                                    <div>
                                        <p class="app-muted mb-0.5">Rạp</p>
                                        <p class="app-text font-medium">MovieMate Hà Đông</p>
                                    </div>
                                    <div>
                                        <p class="app-muted mb-0.5">Phòng</p>
                                        <p class="app-text font-medium">IMAX 01</p>
                                    </div>
                                </div>

                                <div class="flex flex-wrap items-center justify-between gap-3 pt-4 border-t app-border">
                                    <div>
                                        <p class="text-xs app-muted mb-0.5">Tổng tiền</p>
                                        <p class="app-text font-bold text-lg">200.000đ</p>
                                    </div>
                                    <div class="flex gap-2">
                                        <button class="px-3 py-2 border border-brand-start text-brand-start hover:bg-brand-start hover:text-white rounded-lg text-xs font-bold transition-colors">
                                            Viết đánh giá
                                        </button>
                                        <span class="px-3 py-2 app-secondary border app-border app-muted rounded-lg text-xs font-medium">Đã sử dụng</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
