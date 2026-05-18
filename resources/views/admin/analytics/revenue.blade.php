@extends('layouts.admin')

@section('title', 'Báo cáo doanh thu - MovieMate Admin')
@section('page-title', 'Báo cáo doanh thu')

@section('content')
    
    <!-- Filters -->
    <div class="bg-dark-card border border-dark-border rounded-2xl p-6 mb-6 flex flex-col md:flex-row gap-4 justify-between items-center relative z-20">
        <div class="flex gap-2 w-full md:w-auto">
            <button class="px-4 py-2 bg-brand-start text-white text-sm font-medium rounded-lg">Tuần này</button>
            <button class="px-4 py-2 bg-dark-main border border-dark-border text-text-sub hover:text-white transition-colors text-sm font-medium rounded-lg">Tháng này</button>
            <button class="px-4 py-2 bg-dark-main border border-dark-border text-text-sub hover:text-white transition-colors text-sm font-medium rounded-lg">Năm nay</button>
        </div>
        <div class="flex gap-4 w-full md:w-auto">
            <input type="date" value="2026-05-01" class="px-4 py-2 bg-dark-main border border-dark-border rounded-lg text-white text-sm focus:outline-none focus:border-brand-start [color-scheme:dark]">
            <span class="text-text-sub self-center">-</span>
            <input type="date" value="2026-05-19" class="px-4 py-2 bg-dark-main border border-dark-border rounded-lg text-white text-sm focus:outline-none focus:border-brand-start [color-scheme:dark]">
            <button class="px-4 py-2 bg-dark-main border border-dark-border text-white text-sm font-medium rounded-lg hover:border-brand-start transition-colors flex items-center gap-2">
                <i class="ph ph-export"></i> Xuất PDF
            </button>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        
        <div class="bg-dark-card border border-dark-border rounded-2xl p-6">
            <p class="text-text-sub text-sm font-medium mb-1">Tổng doanh thu</p>
            <h3 class="text-3xl font-bold text-white mb-2">450.5M</h3>
            <div class="flex items-center text-xs font-bold text-success">
                <i class="ph-bold ph-trend-up mr-1"></i> +15.3% so với kỳ trước
            </div>
        </div>

        <div class="bg-dark-card border border-dark-border rounded-2xl p-6">
            <p class="text-text-sub text-sm font-medium mb-1">Tổng vé bán ra</p>
            <h3 class="text-3xl font-bold text-white mb-2">4,250</h3>
            <div class="flex items-center text-xs font-bold text-success">
                <i class="ph-bold ph-trend-up mr-1"></i> +8.2% so với kỳ trước
            </div>
        </div>

        <div class="bg-dark-card border border-dark-border rounded-2xl p-6">
            <p class="text-text-sub text-sm font-medium mb-1">Giá vé trung bình</p>
            <h3 class="text-3xl font-bold text-white mb-2">106K</h3>
            <div class="flex items-center text-xs font-bold text-error">
                <i class="ph-bold ph-trend-down mr-1"></i> -2.1% so với kỳ trước
            </div>
        </div>

        <div class="bg-dark-card border border-dark-border rounded-2xl p-6">
            <p class="text-text-sub text-sm font-medium mb-1">Tỷ lệ hoàn hủy</p>
            <h3 class="text-3xl font-bold text-white mb-2">1.2%</h3>
            <div class="flex items-center text-xs font-medium text-text-sub">
                Tương đương 51 vé
            </div>
        </div>

    </div>

    <!-- Chart Area -->
    <div class="bg-dark-card border border-dark-border rounded-2xl p-6 mb-6">
        <h3 class="font-bold text-white text-lg mb-6">Biểu đồ doanh thu theo ngày</h3>
        
        <!-- CSS Line Chart Mock -->
        <div class="h-80 w-full relative">
            <!-- Grid lines -->
            <div class="absolute inset-0 flex flex-col justify-between pointer-events-none z-0">
                <div class="border-t border-dark-border/50 w-full h-0 flex items-center"><span class="absolute -left-12 text-[10px] text-text-sub w-10 text-right">100M</span></div>
                <div class="border-t border-dark-border/50 w-full h-0 flex items-center"><span class="absolute -left-12 text-[10px] text-text-sub w-10 text-right">75M</span></div>
                <div class="border-t border-dark-border/50 w-full h-0 flex items-center"><span class="absolute -left-12 text-[10px] text-text-sub w-10 text-right">50M</span></div>
                <div class="border-t border-dark-border/50 w-full h-0 flex items-center"><span class="absolute -left-12 text-[10px] text-text-sub w-10 text-right">25M</span></div>
                <div class="border-t border-dark-border/50 w-full h-0 flex items-center"><span class="absolute -left-12 text-[10px] text-text-sub w-10 text-right">0</span></div>
            </div>

            <!-- SVG Line -->
            <svg class="absolute inset-0 w-full h-full z-10" preserveAspectRatio="none" viewBox="0 0 100 100">
                <defs>
                    <linearGradient id="gradient" x1="0%" y1="0%" x2="0%" y2="100%">
                        <stop offset="0%" stop-color="#FF3D57" stop-opacity="0.3"></stop>
                        <stop offset="100%" stop-color="#FF3D57" stop-opacity="0"></stop>
                    </linearGradient>
                </defs>
                <path d="M0,80 L10,60 L20,65 L30,45 L40,55 L50,30 L60,35 L70,20 L80,25 L90,10 L100,5 L100,100 L0,100 Z" fill="url(#gradient)"></path>
                <polyline points="0,80 10,60 20,65 30,45 40,55 50,30 60,35 70,20 80,25 90,10 100,5" fill="none" stroke="#FF3D57" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></polyline>
            </svg>

            <!-- X-Axis Labels -->
            <div class="absolute -bottom-6 left-0 right-0 flex justify-between text-[10px] text-text-sub">
                <span>01/05</span>
                <span>04/05</span>
                <span>07/05</span>
                <span>10/05</span>
                <span>13/05</span>
                <span>16/05</span>
                <span>19/05</span>
            </div>
        </div>
    </div>

    <!-- Tables -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        
        <!-- Doanh thu theo rạp -->
        <div class="bg-dark-card border border-dark-border rounded-2xl overflow-hidden">
            <div class="p-6 border-b border-dark-border">
                <h3 class="font-bold text-white">Doanh thu theo Cụm rạp</h3>
            </div>
            
            <div class="p-6">
                <div class="space-y-6">
                    <div>
                        <div class="flex justify-between text-sm mb-2">
                            <span class="text-white font-bold">MovieMate Hà Nội</span>
                            <span class="text-white font-bold">250.5M</span>
                        </div>
                        <div class="w-full h-2 bg-dark-main rounded-full overflow-hidden">
                            <div class="h-full bg-brand-start rounded-full" style="width: 55%"></div>
                        </div>
                        <p class="text-[10px] text-text-sub mt-1 text-right">55% tổng doanh thu</p>
                    </div>

                    <div>
                        <div class="flex justify-between text-sm mb-2">
                            <span class="text-white font-bold">MovieMate Hồ Chí Minh</span>
                            <span class="text-white font-bold">120.2M</span>
                        </div>
                        <div class="w-full h-2 bg-dark-main rounded-full overflow-hidden">
                            <div class="h-full bg-brand-start rounded-full" style="width: 27%"></div>
                        </div>
                        <p class="text-[10px] text-text-sub mt-1 text-right">27% tổng doanh thu</p>
                    </div>

                    <div>
                        <div class="flex justify-between text-sm mb-2">
                            <span class="text-white font-bold">MovieMate Cầu Giấy</span>
                            <span class="text-white font-bold">50.0M</span>
                        </div>
                        <div class="w-full h-2 bg-dark-main rounded-full overflow-hidden">
                            <div class="h-full bg-brand-start rounded-full" style="width: 11%"></div>
                        </div>
                        <p class="text-[10px] text-text-sub mt-1 text-right">11% tổng doanh thu</p>
                    </div>

                    <div>
                        <div class="flex justify-between text-sm mb-2">
                            <span class="text-white font-bold">MovieMate Đà Nẵng</span>
                            <span class="text-white font-bold">29.8M</span>
                        </div>
                        <div class="w-full h-2 bg-dark-main rounded-full overflow-hidden">
                            <div class="h-full bg-brand-start rounded-full" style="width: 7%"></div>
                        </div>
                        <p class="text-[10px] text-text-sub mt-1 text-right">7% tổng doanh thu</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Phương thức thanh toán -->
        <div class="bg-dark-card border border-dark-border rounded-2xl overflow-hidden">
            <div class="p-6 border-b border-dark-border">
                <h3 class="font-bold text-white">Theo Phương thức thanh toán</h3>
            </div>
            
            <div class="p-6 flex flex-col justify-center h-[calc(100%-73px)]">
                
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-4 bg-dark-main border border-dark-border rounded-xl">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-blue-500/10 flex items-center justify-center text-blue-500">
                                <i class="ph-bold ph-qr-code text-xl"></i>
                            </div>
                            <div>
                                <p class="font-bold text-white text-sm">VNPAY</p>
                                <p class="text-xs text-text-sub">1,850 giao dịch</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="font-bold text-white">210.5M</p>
                            <p class="text-xs text-success">46.7%</p>
                        </div>
                    </div>

                    <div class="flex items-center justify-between p-4 bg-dark-main border border-dark-border rounded-xl">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-pink-500/10 flex items-center justify-center text-pink-500">
                                <i class="ph-bold ph-wallet text-xl"></i>
                            </div>
                            <div>
                                <p class="font-bold text-white text-sm">MoMo</p>
                                <p class="text-xs text-text-sub">1,420 giao dịch</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="font-bold text-white">150.0M</p>
                            <p class="text-xs text-success">33.3%</p>
                        </div>
                    </div>

                    <div class="flex items-center justify-between p-4 bg-dark-main border border-dark-border rounded-xl">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-brand-start/10 flex items-center justify-center text-brand-start">
                                <i class="ph-bold ph-credit-card text-xl"></i>
                            </div>
                            <div>
                                <p class="font-bold text-white text-sm">Thẻ ATM / Visa</p>
                                <p class="text-xs text-text-sub">980 giao dịch</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="font-bold text-white">90.0M</p>
                            <p class="text-xs text-success">20.0%</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

@endsection
