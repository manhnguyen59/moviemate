@extends('layouts.staff')

@section('title', 'Staff Dashboard - MovieMate')
@section('page-title', 'Staff Dashboard')

@section('content')
    
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        
        <div class="bg-dark-card border border-dark-border rounded-2xl p-6">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <p class="text-text-sub text-sm font-medium mb-1">Vé bán hôm nay</p>
                    <h3 class="text-3xl font-bold text-white">128</h3>
                </div>
                <div class="w-12 h-12 rounded-xl bg-ai-start/10 flex items-center justify-center">
                    <i class="ph-fill ph-ticket text-2xl text-ai-start"></i>
                </div>
            </div>
            <div class="flex items-center gap-2 text-xs">
                <span class="text-success flex items-center"><i class="ph-bold ph-trend-up mr-1"></i> +12%</span>
                <span class="text-text-sub">so với hôm qua</span>
            </div>
        </div>

        <div class="bg-dark-card border border-dark-border rounded-2xl p-6">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <p class="text-text-sub text-sm font-medium mb-1">Vé đã Check-in</p>
                    <h3 class="text-3xl font-bold text-white">85</h3>
                </div>
                <div class="w-12 h-12 rounded-xl bg-success/10 flex items-center justify-center">
                    <i class="ph-fill ph-check-circle text-2xl text-success"></i>
                </div>
            </div>
            <div class="flex items-center gap-2 text-xs">
                <div class="w-full bg-dark-main rounded-full h-1.5 mt-1">
                    <div class="bg-success h-1.5 rounded-full" style="width: 66%"></div>
                </div>
            </div>
        </div>

        <div class="bg-dark-card border border-dark-border rounded-2xl p-6">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <p class="text-text-sub text-sm font-medium mb-1">Vé chưa sử dụng</p>
                    <h3 class="text-3xl font-bold text-white">43</h3>
                </div>
                <div class="w-12 h-12 rounded-xl bg-warning/10 flex items-center justify-center">
                    <i class="ph-fill ph-clock text-2xl text-warning"></i>
                </div>
            </div>
            <div class="flex items-center gap-2 text-xs">
                <span class="text-text-sub">Khách chưa đến rạp</span>
            </div>
        </div>

        <div class="bg-dark-card border border-dark-border rounded-2xl p-6">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <p class="text-text-sub text-sm font-medium mb-1">Suất chiếu hôm nay</p>
                    <h3 class="text-3xl font-bold text-white">12</h3>
                </div>
                <div class="w-12 h-12 rounded-xl bg-brand-start/10 flex items-center justify-center">
                    <i class="ph-fill ph-video-camera text-2xl text-brand-start"></i>
                </div>
            </div>
            <div class="flex items-center gap-2 text-xs">
                <span class="text-text-sub">Tại rạp MovieMate Cầu Giấy</span>
            </div>
        </div>

    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        
        <a href="{{ route('staff.tickets.check') }}" class="group bg-gradient-to-br from-dark-card to-dark-main border border-ai-start/30 rounded-2xl p-6 hover:border-ai-start transition-colors relative overflow-hidden">
            <i class="ph-fill ph-qr-code absolute -right-6 -bottom-6 text-9xl text-ai-start/5 group-hover:text-ai-start/10 transition-colors"></i>
            <div class="flex items-center gap-4 mb-2">
                <div class="w-12 h-12 rounded-xl bg-ai-start text-white flex items-center justify-center shadow-lg shadow-ai-start/30">
                    <i class="ph-bold ph-scan text-2xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-white">Kiểm tra vé (QR)</h3>
                    <p class="text-text-sub text-sm">Quét mã QR để soát vé khách hàng</p>
                </div>
            </div>
        </a>

        <a href="{{ route('staff.sales.counter') }}" class="group bg-gradient-to-br from-dark-card to-dark-main border border-brand-start/30 rounded-2xl p-6 hover:border-brand-start transition-colors relative overflow-hidden">
            <i class="ph-fill ph-storefront absolute -right-6 -bottom-6 text-9xl text-brand-start/5 group-hover:text-brand-start/10 transition-colors"></i>
            <div class="flex items-center gap-4 mb-2">
                <div class="w-12 h-12 rounded-xl bg-brand-start text-white flex items-center justify-center shadow-lg shadow-brand-start/30">
                    <i class="ph-bold ph-ticket text-2xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-white">Bán vé tại quầy</h3>
                    <p class="text-text-sub text-sm">Hỗ trợ khách mua vé trực tiếp</p>
                </div>
            </div>
        </a>

    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        
        <!-- Suất chiếu gần nhất -->
        <div class="bg-dark-card border border-dark-border rounded-2xl overflow-hidden">
            <div class="p-6 border-b border-dark-border flex justify-between items-center bg-dark-main/50">
                <h3 class="font-bold text-white text-lg">Suất chiếu gần nhất</h3>
                <a href="#" class="text-sm font-medium text-ai-start hover:text-white transition-colors">Xem tất cả</a>
            </div>
            
            <div class="divide-y divide-dark-border">
                
                <div class="p-4 flex items-center justify-between hover:bg-dark-main/50 transition-colors">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-16 rounded overflow-hidden flex-shrink-0">
                            <img src="https://image.tmdb.org/t/p/w500/qJ2tW6WMUDux911r6m7haRef0WH.jpg" alt="Poster" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <h4 class="font-bold text-white mb-1">Thanh Gươm Diệt Quỷ</h4>
                            <p class="text-xs text-text-sub flex items-center gap-2">
                                <span class="bg-dark-border text-white px-2 py-0.5 rounded">Phòng 3</span>
                                <span>2D Phụ Đề Việt</span>
                            </p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="font-bold text-ai-start text-lg mb-1">09:30</p>
                        <span class="text-[10px] font-bold uppercase tracking-wider text-success bg-success/10 px-2 py-1 rounded">Đang soát vé</span>
                    </div>
                </div>

                <div class="p-4 flex items-center justify-between hover:bg-dark-main/50 transition-colors">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-16 rounded overflow-hidden flex-shrink-0">
                            <img src="https://image.tmdb.org/t/p/w500/1pdfLvkbY9ohJlCjQH2JGjjcNsV.jpg" alt="Poster" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <h4 class="font-bold text-white mb-1">Dune: Part Two</h4>
                            <p class="text-xs text-text-sub flex items-center gap-2">
                                <span class="bg-dark-border text-white px-2 py-0.5 rounded">Phòng 1 (IMAX)</span>
                                <span>IMAX 2D</span>
                            </p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="font-bold text-white text-lg mb-1">10:15</p>
                        <span class="text-[10px] font-bold uppercase tracking-wider text-warning bg-warning/10 px-2 py-1 rounded">Sắp chiếu</span>
                    </div>
                </div>

                <div class="p-4 flex items-center justify-between hover:bg-dark-main/50 transition-colors">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-16 rounded overflow-hidden flex-shrink-0">
                            <img src="https://image.tmdb.org/t/p/w500/tMefBSflR6PGQLvLuPE31clYe3D.jpg" alt="Poster" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <h4 class="font-bold text-white mb-1">Godzilla x Kong</h4>
                            <p class="text-xs text-text-sub flex items-center gap-2">
                                <span class="bg-dark-border text-white px-2 py-0.5 rounded">Phòng 2</span>
                                <span>2D Lồng Tiếng</span>
                            </p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="font-bold text-text-sub text-lg mb-1">11:00</p>
                        <span class="text-[10px] font-bold uppercase tracking-wider text-text-sub bg-dark-border px-2 py-1 rounded">Còn nhiều vé</span>
                    </div>
                </div>

            </div>
        </div>

        <!-- Check-in gần đây -->
        <div class="bg-dark-card border border-dark-border rounded-2xl overflow-hidden">
            <div class="p-6 border-b border-dark-border flex justify-between items-center bg-dark-main/50">
                <h3 class="font-bold text-white text-lg">Check-in gần đây</h3>
                <a href="{{ route('staff.tickets.index') }}" class="text-sm font-medium text-ai-start hover:text-white transition-colors">Xem tất cả</a>
            </div>
            
            <div class="overflow-x-auto hide-scrollbar">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-dark-main text-xs uppercase tracking-wider text-text-sub border-b border-dark-border">
                            <th class="p-4 font-medium">Mã vé</th>
                            <th class="p-4 font-medium">Khách hàng</th>
                            <th class="p-4 font-medium">Phim</th>
                            <th class="p-4 font-medium text-right">Thời gian</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-dark-border text-sm">
                        
                        <tr class="hover:bg-dark-main/30 transition-colors">
                            <td class="p-4">
                                <span class="font-mono text-white bg-dark-border px-2 py-1 rounded text-xs">MMT-0001</span>
                            </td>
                            <td class="p-4 text-white font-medium">Nguyễn Mạnh</td>
                            <td class="p-4 text-text-sub">Thanh Gươm Diệt Quỷ</td>
                            <td class="p-4 text-right text-text-sub">Vừa xong</td>
                        </tr>

                        <tr class="hover:bg-dark-main/30 transition-colors">
                            <td class="p-4">
                                <span class="font-mono text-white bg-dark-border px-2 py-1 rounded text-xs">MMT-0045</span>
                            </td>
                            <td class="p-4 text-white font-medium">Trần Thị B</td>
                            <td class="p-4 text-text-sub">Thanh Gươm Diệt Quỷ</td>
                            <td class="p-4 text-right text-text-sub">2 phút trước</td>
                        </tr>

                        <tr class="hover:bg-dark-main/30 transition-colors">
                            <td class="p-4">
                                <span class="font-mono text-white bg-dark-border px-2 py-1 rounded text-xs">MMT-0128</span>
                            </td>
                            <td class="p-4 text-white font-medium">Lê Văn C</td>
                            <td class="p-4 text-text-sub">Dune: Part Two</td>
                            <td class="p-4 text-right text-text-sub">15 phút trước</td>
                        </tr>

                        <tr class="hover:bg-dark-main/30 transition-colors">
                            <td class="p-4">
                                <span class="font-mono text-white bg-dark-border px-2 py-1 rounded text-xs">MMT-0201</span>
                            </td>
                            <td class="p-4 text-white font-medium">Phạm D</td>
                            <td class="p-4 text-text-sub">Lật Mặt 8</td>
                            <td class="p-4 text-right text-text-sub">1 giờ trước</td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
