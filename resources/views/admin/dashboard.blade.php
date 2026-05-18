@extends('layouts.admin')

@section('title', 'Dashboard - MovieMate Admin')
@section('page-title', 'Tổng quan hệ thống')

@section('content')
    
    <!-- Stat Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-4 sm:gap-6 mb-8">
        
        <div class="bg-dark-card border border-dark-border rounded-2xl p-5 relative overflow-hidden group">
            <div class="absolute top-0 right-0 w-16 h-16 bg-success/5 rounded-bl-full -z-0 transition-transform group-hover:scale-150"></div>
            <div class="flex justify-between items-start relative z-10 mb-4">
                <div class="w-10 h-10 rounded-xl bg-success/10 flex items-center justify-center text-success">
                    <i class="ph-bold ph-currency-circle-dollar text-xl"></i>
                </div>
            </div>
            <p class="text-text-sub text-xs font-bold uppercase tracking-wider mb-1">Tổng doanh thu</p>
            <h3 class="text-2xl font-bold text-white mb-2">128.5M <span class="text-xs font-medium text-text-sub">VNĐ</span></h3>
            <div class="flex items-center text-xs font-bold text-success">
                <i class="ph-bold ph-trend-up mr-1"></i> +15.3%
            </div>
        </div>

        <div class="bg-dark-card border border-dark-border rounded-2xl p-5 relative overflow-hidden group">
            <div class="absolute top-0 right-0 w-16 h-16 bg-brand-start/5 rounded-bl-full -z-0 transition-transform group-hover:scale-150"></div>
            <div class="flex justify-between items-start relative z-10 mb-4">
                <div class="w-10 h-10 rounded-xl bg-brand-start/10 flex items-center justify-center text-brand-start">
                    <i class="ph-bold ph-ticket text-xl"></i>
                </div>
            </div>
            <p class="text-text-sub text-xs font-bold uppercase tracking-wider mb-1">Vé đã bán</p>
            <h3 class="text-2xl font-bold text-white mb-2">1,245</h3>
            <div class="flex items-center text-xs font-bold text-success">
                <i class="ph-bold ph-trend-up mr-1"></i> +8.2%
            </div>
        </div>

        <div class="bg-dark-card border border-dark-border rounded-2xl p-5 relative overflow-hidden group">
            <div class="absolute top-0 right-0 w-16 h-16 bg-ai-start/5 rounded-bl-full -z-0 transition-transform group-hover:scale-150"></div>
            <div class="flex justify-between items-start relative z-10 mb-4">
                <div class="w-10 h-10 rounded-xl bg-ai-start/10 flex items-center justify-center text-ai-start">
                    <i class="ph-bold ph-users text-xl"></i>
                </div>
            </div>
            <p class="text-text-sub text-xs font-bold uppercase tracking-wider mb-1">Người dùng</p>
            <h3 class="text-2xl font-bold text-white mb-2">8,592</h3>
            <div class="flex items-center text-xs font-bold text-success">
                <i class="ph-bold ph-trend-up mr-1"></i> +120 mới
            </div>
        </div>

        <div class="bg-dark-card border border-dark-border rounded-2xl p-5 relative overflow-hidden group">
            <div class="absolute top-0 right-0 w-16 h-16 bg-warning/5 rounded-bl-full -z-0 transition-transform group-hover:scale-150"></div>
            <div class="flex justify-between items-start relative z-10 mb-4">
                <div class="w-10 h-10 rounded-xl bg-warning/10 flex items-center justify-center text-warning">
                    <i class="ph-bold ph-film-slate text-xl"></i>
                </div>
            </div>
            <p class="text-text-sub text-xs font-bold uppercase tracking-wider mb-1">Phim đang chiếu</p>
            <h3 class="text-2xl font-bold text-white mb-2">12</h3>
            <div class="flex items-center text-xs font-medium text-text-sub">
                Tại 4 rạp
            </div>
        </div>

        <div class="bg-dark-card border border-dark-border rounded-2xl p-5 relative overflow-hidden group">
            <div class="absolute top-0 right-0 w-16 h-16 bg-purple-500/5 rounded-bl-full -z-0 transition-transform group-hover:scale-150"></div>
            <div class="flex justify-between items-start relative z-10 mb-4">
                <div class="w-10 h-10 rounded-xl bg-purple-500/10 flex items-center justify-center text-purple-500">
                    <i class="ph-bold ph-video-camera text-xl"></i>
                </div>
            </div>
            <p class="text-text-sub text-xs font-bold uppercase tracking-wider mb-1">Suất chiếu h.nay</p>
            <h3 class="text-2xl font-bold text-white mb-2">48</h3>
            <div class="flex items-center text-xs font-medium text-text-sub">
                12 suất đang chiếu
            </div>
        </div>

        <div class="bg-dark-card border border-dark-border rounded-2xl p-5 relative overflow-hidden group">
            <div class="absolute top-0 right-0 w-16 h-16 bg-blue-500/5 rounded-bl-full -z-0 transition-transform group-hover:scale-150"></div>
            <div class="flex justify-between items-start relative z-10 mb-4">
                <div class="w-10 h-10 rounded-xl bg-blue-500/10 flex items-center justify-center text-blue-500">
                    <i class="ph-bold ph-armchair text-xl"></i>
                </div>
            </div>
            <p class="text-text-sub text-xs font-bold uppercase tracking-wider mb-1">Lấp đầy ghế</p>
            <h3 class="text-2xl font-bold text-white mb-2">68%</h3>
            <div class="flex items-center text-xs font-bold text-error">
                <i class="ph-bold ph-trend-down mr-1"></i> -2%
            </div>
        </div>

    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        
        <!-- Revenue Chart -->
        <div class="lg:col-span-2 bg-dark-card border border-dark-border rounded-2xl p-6">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h3 class="font-bold text-white text-lg">Doanh thu 7 ngày qua</h3>
                    <p class="text-xs text-text-sub">Tổng: 450.000.000đ</p>
                </div>
                <button class="px-3 py-1.5 bg-dark-main border border-dark-border text-xs text-white rounded-lg flex items-center gap-2 hover:border-text-sub transition-colors">
                    <i class="ph ph-calendar"></i> Tuần này
                </button>
            </div>
            
            <!-- CSS Bar Chart (Mock) -->
            <div class="h-64 flex items-end justify-between gap-2 sm:gap-4 relative">
                <!-- Grid lines -->
                <div class="absolute inset-0 flex flex-col justify-between pointer-events-none">
                    <div class="border-t border-dark-border/50 w-full h-0"></div>
                    <div class="border-t border-dark-border/50 w-full h-0"></div>
                    <div class="border-t border-dark-border/50 w-full h-0"></div>
                    <div class="border-t border-dark-border/50 w-full h-0"></div>
                </div>

                @php
                    $chartData = [
                        ['day' => 'T2', 'height' => '40%', 'val' => '42M'],
                        ['day' => 'T3', 'height' => '55%', 'val' => '55M'],
                        ['day' => 'T4', 'height' => '35%', 'val' => '38M'],
                        ['day' => 'T5', 'height' => '65%', 'val' => '68M'],
                        ['day' => 'T6', 'height' => '85%', 'val' => '85M'],
                        ['day' => 'T7', 'height' => '100%', 'val' => '120M'],
                        ['day' => 'CN', 'height' => '90%', 'val' => '95M'],
                    ];
                @endphp

                @foreach($chartData as $data)
                <div class="w-full flex flex-col items-center gap-2 relative z-10 group cursor-pointer h-full justify-end">
                    <!-- Tooltip -->
                    <div class="absolute -top-10 bg-dark-main border border-dark-border text-white text-xs py-1 px-2 rounded opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none whitespace-nowrap">
                        {{ $data['val'] }}
                    </div>
                    <!-- Bar -->
                    <div class="w-full max-w-[40px] bg-gradient-to-t from-brand-start/20 to-brand-start rounded-t-sm group-hover:brightness-125 transition-all" style="height: {{ $data['height'] }}"></div>
                    <!-- Label -->
                    <span class="text-xs text-text-sub">{{ $data['day'] }}</span>
                </div>
                @endforeach
            </div>
        </div>

        <!-- AI Insight -->
        <div class="bg-gradient-to-br from-[#1E1B4B] to-dark-main border border-ai-start/30 rounded-2xl p-6 relative overflow-hidden flex flex-col">
            <i class="ph-fill ph-sparkle absolute top-6 right-6 text-4xl text-ai-start/20 animate-pulse"></i>
            
            <div class="flex items-center gap-3 mb-4">
                <div class="w-8 h-8 rounded-full bg-ai-start/20 flex items-center justify-center">
                    <i class="ph-fill ph-magic-wand text-ai-start"></i>
                </div>
                <h3 class="font-bold text-white">MovieMate AI Insights</h3>
            </div>

            <div class="space-y-4 flex-grow">
                <div class="bg-dark-card/50 border border-dark-border rounded-xl p-4">
                    <div class="flex items-start gap-3">
                        <i class="ph-fill ph-trend-up text-success mt-0.5"></i>
                        <div>
                            <h4 class="text-sm font-bold text-white mb-1">Gợi ý tăng suất chiếu</h4>
                            <p class="text-xs text-text-sub leading-relaxed">Phim "Thanh Gươm Diệt Quỷ" đang có tỷ lệ lấp đầy >85% vào các suất 19:00 - 21:00. Nên mở thêm 2 suất chiếu tại rạp Cầu Giấy.</p>
                            <button class="text-xs text-ai-start font-bold mt-2 hover:text-ai-end transition-colors">Áp dụng ngay</button>
                        </div>
                    </div>
                </div>

                <div class="bg-dark-card/50 border border-dark-border rounded-xl p-4">
                    <div class="flex items-start gap-3">
                        <i class="ph-fill ph-warning text-warning mt-0.5"></i>
                        <div>
                            <h4 class="text-sm font-bold text-white mb-1">Cảnh báo doanh thu</h4>
                            <p class="text-xs text-text-sub leading-relaxed">Suất chiếu sáng (09:00 - 11:00) ngày thường tỷ lệ lấp đầy thấp (15%). Cân nhắc tạo chương trình khuyến mãi giảm giá vé.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        
        <!-- Top Phim Bán Chạy -->
        <div class="bg-dark-card border border-dark-border rounded-2xl overflow-hidden">
            <div class="p-6 border-b border-dark-border flex justify-between items-center bg-dark-main/50">
                <h3 class="font-bold text-white">Top phim bán chạy (Tháng)</h3>
                <a href="{{ route('admin.analytics.topMovies') }}" class="text-xs font-bold text-brand-start hover:text-white transition-colors uppercase tracking-wider">Xem tất cả</a>
            </div>
            
            <div class="divide-y divide-dark-border">
                
                <div class="p-4 flex items-center justify-between hover:bg-dark-main/50 transition-colors group">
                    <div class="flex items-center gap-4">
                        <div class="w-8 text-center font-bold text-brand-start text-lg">#1</div>
                        <div class="w-10 h-14 rounded overflow-hidden flex-shrink-0">
                            <img src="https://image.tmdb.org/t/p/w500/tMefBSflR6PGQLvLuPE31clYe3D.jpg" alt="Poster" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <h4 class="font-bold text-white text-sm mb-1 group-hover:text-brand-start transition-colors">Godzilla x Kong</h4>
                            <p class="text-xs text-text-sub">8,240 vé bán ra</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="font-bold text-white text-sm mb-1">820.5M</p>
                        <span class="text-[10px] text-success font-medium"><i class="ph-bold ph-trend-up"></i> +5%</span>
                    </div>
                </div>

                <div class="p-4 flex items-center justify-between hover:bg-dark-main/50 transition-colors group">
                    <div class="flex items-center gap-4">
                        <div class="w-8 text-center font-bold text-text-main text-lg">#2</div>
                        <div class="w-10 h-14 rounded overflow-hidden flex-shrink-0">
                            <img src="https://image.tmdb.org/t/p/w500/qJ2tW6WMUDux911r6m7haRef0WH.jpg" alt="Poster" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <h4 class="font-bold text-white text-sm mb-1 group-hover:text-brand-start transition-colors">Thanh Gươm Diệt Quỷ</h4>
                            <p class="text-xs text-text-sub">6,120 vé bán ra</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="font-bold text-white text-sm mb-1">650.2M</p>
                        <span class="text-[10px] text-success font-medium"><i class="ph-bold ph-trend-up"></i> +12%</span>
                    </div>
                </div>

                <div class="p-4 flex items-center justify-between hover:bg-dark-main/50 transition-colors group">
                    <div class="flex items-center gap-4">
                        <div class="w-8 text-center font-bold text-text-sub text-lg">#3</div>
                        <div class="w-10 h-14 rounded overflow-hidden flex-shrink-0">
                            <img src="https://image.tmdb.org/t/p/w500/1pdfLvkbY9ohJlCjQH2JGjjcNsV.jpg" alt="Poster" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <h4 class="font-bold text-white text-sm mb-1 group-hover:text-brand-start transition-colors">Dune: Part Two</h4>
                            <p class="text-xs text-text-sub">5,050 vé bán ra</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="font-bold text-white text-sm mb-1">540.8M</p>
                        <span class="text-[10px] text-error font-medium"><i class="ph-bold ph-trend-down"></i> -2%</span>
                    </div>
                </div>

            </div>
        </div>

        <!-- Đơn đặt vé gần đây -->
        <div class="bg-dark-card border border-dark-border rounded-2xl overflow-hidden">
            <div class="p-6 border-b border-dark-border flex justify-between items-center bg-dark-main/50">
                <h3 class="font-bold text-white">Đơn đặt vé gần đây</h3>
                <a href="{{ route('admin.bookings.index') }}" class="text-xs font-bold text-brand-start hover:text-white transition-colors uppercase tracking-wider">Xem tất cả</a>
            </div>
            
            <div class="overflow-x-auto hide-scrollbar">
                <table class="w-full text-left border-collapse whitespace-nowrap">
                    <thead>
                        <tr class="bg-dark-main/50 text-[10px] uppercase tracking-wider text-text-sub border-b border-dark-border">
                            <th class="p-4 font-bold">Mã vé</th>
                            <th class="p-4 font-bold">Khách hàng</th>
                            <th class="p-4 font-bold text-right">Tổng tiền</th>
                            <th class="p-4 font-bold text-center">Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-dark-border text-sm">
                        
                        <tr class="hover:bg-dark-main/30 transition-colors">
                            <td class="p-4"><a href="#" class="font-mono text-white font-bold hover:text-brand-start">MMT-0001</a></td>
                            <td class="p-4 text-white">Nguyễn Mạnh</td>
                            <td class="p-4 text-right font-medium text-white">160.000đ</td>
                            <td class="p-4 text-center">
                                <span class="inline-flex px-2 py-1 bg-success/10 text-success rounded text-[10px] font-bold uppercase tracking-wider">Đã thanh toán</span>
                            </td>
                        </tr>

                        <tr class="hover:bg-dark-main/30 transition-colors">
                            <td class="p-4"><a href="#" class="font-mono text-white font-bold hover:text-brand-start">MMT-0002</a></td>
                            <td class="p-4 text-white">Trần B</td>
                            <td class="p-4 text-right font-medium text-white">200.000đ</td>
                            <td class="p-4 text-center">
                                <span class="inline-flex px-2 py-1 bg-success/10 text-success rounded text-[10px] font-bold uppercase tracking-wider">Đã thanh toán</span>
                            </td>
                        </tr>

                        <tr class="hover:bg-dark-main/30 transition-colors">
                            <td class="p-4"><a href="#" class="font-mono text-white font-bold hover:text-brand-start">MMT-0003</a></td>
                            <td class="p-4 text-white">Lê C</td>
                            <td class="p-4 text-right font-medium text-white">120.000đ</td>
                            <td class="p-4 text-center">
                                <span class="inline-flex px-2 py-1 bg-warning/10 text-warning rounded text-[10px] font-bold uppercase tracking-wider">Đang chờ</span>
                            </td>
                        </tr>

                        <tr class="hover:bg-dark-main/30 transition-colors">
                            <td class="p-4"><a href="#" class="font-mono text-white font-bold hover:text-brand-start">MMT-0004</a></td>
                            <td class="p-4 text-white">Phạm D</td>
                            <td class="p-4 text-right font-medium text-white">240.000đ</td>
                            <td class="p-4 text-center">
                                <span class="inline-flex px-2 py-1 bg-error/10 text-error rounded text-[10px] font-bold uppercase tracking-wider">Đã hủy</span>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
