@extends('layouts.user')

@section('title', 'Chọn Ghế - MovieMate')

@section('content')
    <div class="min-h-screen py-8 app-bg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Progress Steps -->
            <div class="mb-8">
                <div class="flex items-center justify-center sm:justify-start gap-2 sm:gap-4 text-xs sm:text-sm">
                    <div class="flex items-center gap-2 text-brand-start font-medium">
                        <div class="w-7 h-7 rounded-full bg-brand-start text-white flex items-center justify-center font-bold text-xs">1</div>
                        <span class="hidden sm:inline">Chọn phim & Suất</span>
                    </div>
                    <div class="h-px w-8 sm:w-12 bg-brand-start"></div>
                    <div class="flex items-center gap-2 text-brand-start font-medium">
                        <div class="w-7 h-7 rounded-full bg-brand-start text-white flex items-center justify-center font-bold text-xs">2</div>
                        <span>Chọn ghế</span>
                    </div>
                    <div class="h-px w-8 sm:w-12 app-border border-t border-dashed"></div>
                    <div class="flex items-center gap-2 app-muted font-medium">
                        <div class="w-7 h-7 rounded-full app-card border app-border flex items-center justify-center font-bold text-xs">3</div>
                        <span class="hidden sm:inline">Thanh toán</span>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8">

                <!-- Left: Seat Map -->
                <div class="lg:col-span-2 app-card border app-border rounded-2xl p-6 overflow-hidden">

                    <div class="text-center mb-10">
                        <h2 class="text-lg md:text-xl font-bold app-text mb-1">MovieMate Cầu Giấy - Phòng chiếu số 3</h2>
                        <p class="app-muted text-sm">Thứ 3, 19/05/2026 — 09:30 — 2D Phụ Đề Việt</p>
                    </div>

                    <!-- Screen -->
                    <div class="relative mb-14 px-8 md:px-16">
                        <div class="h-2 w-full bg-brand-start/50 rounded-t-[100%] shadow-[0_10px_30px_rgba(255,61,87,0.25)]"></div>
                        <div class="absolute top-5 left-1/2 -translate-x-1/2 app-muted text-xs font-medium tracking-[0.3em] uppercase">Màn hình</div>
                    </div>

                    <!-- Seats -->
                    <div class="overflow-x-auto hide-scrollbar pb-4">
                        <div class="min-w-[560px] flex flex-col items-center gap-2.5">
                            @php
                                $rows = ['A','B','C','D','E','F','G','H'];
                            @endphp

                            @foreach($rows as $row)
                                <div class="flex items-center gap-3">
                                    <div class="w-5 text-center app-muted text-xs font-bold">{{ $row }}</div>
                                    <div class="flex gap-1.5">
                                        @for($i = 1; $i <= 12; $i++)
                                            @php
                                                $status = 'normal';
                                                if(in_array($row, ['E','F','G'])) $status = 'vip';
                                                if($row == 'D' && in_array($i, [5,6])) $status = 'booked';
                                                if($row == 'F' && in_array($i, [7,8])) $status = 'selected';
                                                if($row == 'B' && $i == 10) $status = 'booked';
                                                if($row == 'C' && in_array($i, [3,4,11])) $status = 'booked';
                                            @endphp

                                            <button class="w-8 h-8 rounded-t-lg border transition-all text-[10px] font-bold
                                                {{ $status == 'normal'   ? 'app-input border-[var(--border-color)] app-muted hover:border-brand-start hover:text-brand-start' : '' }}
                                                {{ $status == 'vip'      ? 'bg-ai-start/10 border-ai-start/50 text-ai-start hover:bg-ai-start hover:text-white' : '' }}
                                                {{ $status == 'selected' ? 'bg-brand-start border-brand-start text-white shadow-lg shadow-brand-start/30' : '' }}
                                                {{ $status == 'booked'   ? 'bg-dark-border border-dark-border text-dark-border/40 cursor-not-allowed opacity-40' : '' }}
                                                {{ $i == 6 ? 'mr-4' : '' }}"
                                                {{ $status == 'booked' ? 'disabled' : '' }}>
                                                @if($status != 'booked'){{ $i }}@endif
                                            </button>
                                        @endfor
                                    </div>
                                    <div class="w-5 text-center app-muted text-xs font-bold">{{ $row }}</div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Legend -->
                    <div class="flex flex-wrap justify-center gap-4 md:gap-6 mt-8 pt-6 border-t app-border text-xs">
                        <div class="flex items-center gap-2 app-muted">
                            <div class="w-6 h-6 rounded-t-lg app-input border app-border"></div> Ghế thường (60.000đ)
                        </div>
                        <div class="flex items-center gap-2 app-muted">
                            <div class="w-6 h-6 rounded-t-lg bg-ai-start/10 border border-ai-start/50"></div> Ghế VIP (80.000đ)
                        </div>
                        <div class="flex items-center gap-2 app-muted">
                            <div class="w-6 h-6 rounded-t-lg bg-brand-start border border-brand-start"></div> Đang chọn
                        </div>
                        <div class="flex items-center gap-2 app-muted">
                            <div class="w-6 h-6 rounded-t-lg bg-dark-border border border-dark-border opacity-40"></div> Đã đặt
                        </div>
                    </div>
                </div>

                <!-- Right: Summary Sticky -->
                <div class="lg:col-span-1">
                    <div class="app-card border app-border rounded-2xl overflow-hidden sticky top-24 shadow-2xl shadow-black/20">
                        <div class="relative h-44">
                            <img src="https://image.tmdb.org/t/p/w500/qJ2tW6WMUDux911r6m7haRef0WH.jpg" alt="Cover" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-[var(--card-bg)] via-[var(--card-bg)]/50 to-transparent"></div>
                            <div class="absolute bottom-3 left-5 right-5">
                                <h3 class="text-lg font-bold text-white mb-0.5">Thanh Gươm Diệt Quỷ</h3>
                                <p class="text-xs app-muted">2D Phụ Đề Việt · T13</p>
                            </div>
                        </div>

                        <div class="p-5">
                            <ul class="space-y-3 mb-5 text-sm">
                                <li class="flex justify-between">
                                    <span class="app-muted">Rạp</span>
                                    <span class="app-text font-medium text-right">MovieMate Cầu Giấy</span>
                                </li>
                                <li class="flex justify-between">
                                    <span class="app-muted">Phòng chiếu</span>
                                    <span class="app-text font-medium text-right">Phòng 3</span>
                                </li>
                                <li class="flex justify-between">
                                    <span class="app-muted">Suất chiếu</span>
                                    <span class="text-brand-start font-bold text-right">09:30 · Thứ 3, 19/05</span>
                                </li>
                                <li class="flex justify-between border-t app-border pt-3 mt-3">
                                    <span class="app-muted">Ghế đã chọn</span>
                                    <span class="app-text font-bold text-lg">F7, F8</span>
                                </li>
                            </ul>

                            <div class="flex justify-between items-center mb-5 pt-4 border-t app-border">
                                <span class="app-muted text-sm font-medium">Tổng tiền:</span>
                                <span class="text-3xl font-bold text-brand-start">160.000đ</span>
                            </div>

                            <a href="{{ route('user.bookings.checkout') }}" class="block w-full py-3.5 bg-gradient-to-r from-brand-start to-brand-end text-white text-center rounded-xl font-bold text-base hover:shadow-lg hover:shadow-brand-start/30 transition-all transform hover:-translate-y-0.5">
                                Tiếp tục thanh toán
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection