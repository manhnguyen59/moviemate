@extends('layouts.admin')

@section('title', 'Phim bán chạy - MovieMate Admin')
@section('page-title', 'Báo cáo Phim bán chạy')

@section('content')
    
    <!-- Filters -->
    <div class="bg-dark-card border border-dark-border rounded-2xl p-6 mb-6 flex flex-col md:flex-row gap-4 justify-between items-center relative z-20">
        <div class="flex gap-2 w-full md:w-auto">
            <button class="px-4 py-2 bg-brand-start text-white text-sm font-medium rounded-lg">Tháng này</button>
            <button class="px-4 py-2 bg-dark-main border border-dark-border text-text-sub hover:text-white transition-colors text-sm font-medium rounded-lg">Quý này</button>
            <button class="px-4 py-2 bg-dark-main border border-dark-border text-text-sub hover:text-white transition-colors text-sm font-medium rounded-lg">Năm nay</button>
        </div>
        <div class="flex gap-4 w-full md:w-auto">
            <select class="px-4 py-2 bg-dark-main border border-dark-border rounded-lg text-white text-sm focus:outline-none focus:border-brand-start">
                <option value="">Tất cả rạp</option>
                <option>MovieMate Hà Nội</option>
                <option>MovieMate Hồ Chí Minh</option>
            </select>
            <button class="px-4 py-2 bg-dark-main border border-dark-border text-white text-sm font-medium rounded-lg hover:border-brand-start transition-colors flex items-center gap-2">
                <i class="ph ph-export"></i> Xuất Excel
            </button>
        </div>
    </div>

    <!-- Top Movies Table -->
    <div class="bg-dark-card border border-dark-border rounded-2xl overflow-hidden shadow-lg mb-8">
        <div class="overflow-x-auto hide-scrollbar">
            <table class="w-full text-left border-collapse whitespace-nowrap">
                <thead>
                    <tr class="bg-dark-main/50 text-xs uppercase tracking-wider text-text-sub border-b border-dark-border">
                        <th class="p-4 font-medium w-16 text-center">Top</th>
                        <th class="p-4 font-medium">Phim</th>
                        <th class="p-4 font-medium text-right">Doanh thu</th>
                        <th class="p-4 font-medium text-center">Vé bán ra</th>
                        <th class="p-4 font-medium text-center">Tỷ lệ lấp đầy</th>
                        <th class="p-4 font-medium text-center">Tăng trưởng</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-dark-border text-sm">
                    
                    @php
                        $topMovies = [
                            ['rank' => 1, 'title' => 'Godzilla x Kong: Đế Chế Mới', 'revenue' => '180.5M', 'tickets' => '1,805', 'fill' => '85%', 'growth' => '+12.5%', 'img' => 'tMefBSflR6PGQLvLuPE31clYe3D.jpg'],
                            ['rank' => 2, 'title' => 'Thanh Gươm Diệt Quỷ', 'revenue' => '150.2M', 'tickets' => '1,502', 'fill' => '82%', 'growth' => '+5.2%', 'img' => 'qJ2tW6WMUDux911r6m7haRef0WH.jpg'],
                            ['rank' => 3, 'title' => 'Dune: Part Two', 'revenue' => '85.0M', 'tickets' => '750', 'fill' => '65%', 'growth' => '-2.1%', 'img' => '1pdfLvkbY9ohJlCjQH2JGjjcNsV.jpg'],
                            ['rank' => 4, 'title' => 'Lật Mặt 8', 'revenue' => '25.5M', 'tickets' => '300', 'fill' => '70%', 'growth' => '+15.0%', 'img' => 'qJ2tW6WMUDux911r6m7haRef0WH.jpg'],
                            ['rank' => 5, 'title' => 'Kung Fu Panda 4', 'revenue' => '9.3M', 'tickets' => '105', 'fill' => '45%', 'growth' => '-10.5%', 'img' => 'tMefBSflR6PGQLvLuPE31clYe3D.jpg'],
                        ];
                    @endphp

                    @foreach($topMovies as $movie)
                    <tr class="hover:bg-dark-main/30 transition-colors">
                        <td class="p-4 text-center">
                            @if($movie['rank'] == 1)
                                <span class="text-2xl font-black text-brand-start drop-shadow-[0_0_8px_rgba(255,61,87,0.5)]">1</span>
                            @elseif($movie['rank'] == 2)
                                <span class="text-xl font-bold text-gray-300">2</span>
                            @elseif($movie['rank'] == 3)
                                <span class="text-xl font-bold text-amber-700">3</span>
                            @else
                                <span class="font-bold text-text-sub">{{ $movie['rank'] }}</span>
                            @endif
                        </td>
                        <td class="p-4">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-14 rounded overflow-hidden flex-shrink-0 border border-dark-border">
                                    <img src="https://image.tmdb.org/t/p/w500/{{ $movie['img'] }}" class="w-full h-full object-cover">
                                </div>
                                <a href="{{ route('admin.movies.show', 1) }}" class="font-bold text-white hover:text-brand-start transition-colors block max-w-xs truncate">{{ $movie['title'] }}</a>
                            </div>
                        </td>
                        <td class="p-4 text-right">
                            <span class="font-bold text-white">{{ $movie['revenue'] }}</span>
                        </td>
                        <td class="p-4 text-center">
                            <span class="text-white">{{ $movie['tickets'] }}</span>
                        </td>
                        <td class="p-4">
                            <div class="flex flex-col items-center gap-1 w-full max-w-[100px] mx-auto">
                                <span class="text-xs font-medium text-white">{{ $movie['fill'] }}</span>
                                <div class="w-full h-1.5 bg-dark-main rounded-full overflow-hidden border border-dark-border">
                                    <div class="h-full bg-brand-start rounded-full" style="width: {{ $movie['fill'] }}"></div>
                                </div>
                            </div>
                        </td>
                        <td class="p-4 text-center">
                            @if(str_starts_with($movie['growth'], '+'))
                                <span class="text-success text-xs font-bold"><i class="ph-bold ph-trend-up mr-1"></i>{{ $movie['growth'] }}</span>
                            @else
                                <span class="text-error text-xs font-bold"><i class="ph-bold ph-trend-down mr-1"></i>{{ $movie['growth'] }}</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>

    <!-- AI Insights Area -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        
        <div class="bg-dark-card border border-dark-border rounded-2xl p-6 relative overflow-hidden group">
            <div class="absolute inset-0 bg-gradient-to-br from-ai-start/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
            <div class="flex items-center gap-3 mb-6 relative z-10">
                <div class="w-10 h-10 rounded-xl bg-ai-start/20 flex items-center justify-center">
                    <i class="ph-fill ph-magic-wand text-xl text-ai-start"></i>
                </div>
                <h3 class="font-bold text-white">AI Phân tích Thể loại</h3>
            </div>
            
            <div class="space-y-4 relative z-10">
                <div>
                    <div class="flex justify-between text-sm mb-1">
                        <span class="text-text-sub">Hành động</span>
                        <span class="text-white font-bold">45%</span>
                    </div>
                    <div class="w-full h-2 bg-dark-main rounded-full overflow-hidden">
                        <div class="h-full bg-ai-start rounded-full" style="width: 45%"></div>
                    </div>
                </div>
                <div>
                    <div class="flex justify-between text-sm mb-1">
                        <span class="text-text-sub">Hoạt hình</span>
                        <span class="text-white font-bold">30%</span>
                    </div>
                    <div class="w-full h-2 bg-dark-main rounded-full overflow-hidden">
                        <div class="h-full bg-ai-start/80 rounded-full" style="width: 30%"></div>
                    </div>
                </div>
                <div>
                    <div class="flex justify-between text-sm mb-1">
                        <span class="text-text-sub">Viễn tưởng</span>
                        <span class="text-white font-bold">15%</span>
                    </div>
                    <div class="w-full h-2 bg-dark-main rounded-full overflow-hidden">
                        <div class="h-full bg-ai-start/60 rounded-full" style="width: 15%"></div>
                    </div>
                </div>
                <div>
                    <div class="flex justify-between text-sm mb-1">
                        <span class="text-text-sub">Khác</span>
                        <span class="text-white font-bold">10%</span>
                    </div>
                    <div class="w-full h-2 bg-dark-main rounded-full overflow-hidden">
                        <div class="h-full bg-ai-start/40 rounded-full" style="width: 10%"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-[#1E1B4B] to-dark-main border border-ai-start/30 rounded-2xl p-6">
            <h3 class="font-bold text-white mb-4 flex items-center gap-2">
                <i class="ph-fill ph-lightbulb text-warning"></i> Khuyến nghị từ hệ thống
            </h3>
            
            <ul class="space-y-4">
                <li class="flex items-start gap-3 bg-dark-card/50 p-4 rounded-xl border border-dark-border">
                    <i class="ph-bold ph-arrow-circle-up text-success mt-0.5 text-lg"></i>
                    <div>
                        <p class="text-sm font-bold text-white mb-1">Tăng suất chiếu "Godzilla x Kong"</p>
                        <p class="text-xs text-text-sub leading-relaxed">Phim đang có tỷ lệ lấp đầy >85%. Nên ưu tiên xếp vào các phòng chiếu lớn (IMAX) vào khung giờ vàng (19:00 - 21:00).</p>
                    </div>
                </li>
                <li class="flex items-start gap-3 bg-dark-card/50 p-4 rounded-xl border border-dark-border">
                    <i class="ph-bold ph-arrow-circle-down text-warning mt-0.5 text-lg"></i>
                    <div>
                        <p class="text-sm font-bold text-white mb-1">Giảm suất chiếu "Kung Fu Panda 4"</p>
                        <p class="text-xs text-text-sub leading-relaxed">Doanh thu và tỷ lệ lấp đầy giảm mạnh trong 3 ngày qua. Nên chuyển sang các phòng nhỏ hoặc giảm số suất chiếu/ngày.</p>
                    </div>
                </li>
            </ul>
        </div>

    </div>

@endsection
