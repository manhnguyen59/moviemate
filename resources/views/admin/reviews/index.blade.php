@extends('layouts.admin')

@section('title', 'Quản lý đánh giá - MovieMate Admin')
@section('page-title', 'Quản lý đánh giá')

@section('content')
    <div class="bg-dark-card border border-dark-border rounded-2xl overflow-hidden shadow-lg">
        
        <!-- Header & Filters -->
        <div class="p-6 border-b border-dark-border">
            <div class="flex flex-col md:flex-row gap-4 items-center justify-between mb-6">
                
                <div class="relative w-full md:w-96">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i class="ph ph-magnifying-glass text-text-sub text-lg"></i>
                    </div>
                    <input type="text" class="w-full pl-11 pr-4 py-2.5 bg-dark-main border border-dark-border rounded-xl text-white focus:outline-none focus:border-brand-start transition-colors text-sm" placeholder="Tìm theo tên phim, nội dung đánh giá...">
                </div>

            </div>

            <div class="flex flex-wrap gap-4">
                <select class="px-4 py-2 bg-dark-main border border-dark-border rounded-lg text-white text-sm focus:outline-none focus:border-brand-start min-w-[150px]">
                    <option value="">Tất cả số sao</option>
                    <option>5 sao</option>
                    <option>4 sao</option>
                    <option>3 sao</option>
                    <option>Dưới 3 sao</option>
                </select>

                <select class="px-4 py-2 bg-dark-main border border-dark-border rounded-lg text-white text-sm focus:outline-none focus:border-brand-start min-w-[150px]">
                    <option value="">Trạng thái</option>
                    <option>Hiển thị</option>
                    <option>Đã ẩn (Spam/Vi phạm)</option>
                </select>

                <input type="date" class="px-4 py-2 bg-dark-main border border-dark-border rounded-lg text-white text-sm focus:outline-none focus:border-brand-start [color-scheme:dark]">
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto hide-scrollbar">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-dark-main/50 text-xs uppercase tracking-wider text-text-sub border-b border-dark-border">
                        <th class="p-4 font-medium w-48">Người dùng</th>
                        <th class="p-4 font-medium w-48">Phim</th>
                        <th class="p-4 font-medium w-24 text-center">Đánh giá</th>
                        <th class="p-4 font-medium">Nội dung</th>
                        <th class="p-4 font-medium text-center w-32">Ngày</th>
                        <th class="p-4 font-medium text-center w-24">Hành động</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-dark-border text-sm">
                    
                    @php
                        $reviews = [
                            ['user' => 'Nguyễn Mạnh', 'movie' => 'Dune: Part Two', 'rating' => 5, 'content' => 'Phim quá đỉnh, hình ảnh và âm thanh Imax thực sự tuyệt vời. Sẽ xem lại lần 2!', 'date' => '06/05/2026', 'status' => 'visible'],
                            ['user' => 'Trần B', 'movie' => 'Thanh Gươm Diệt Quỷ', 'rating' => 4, 'content' => 'Hoạt hình đẹp, nội dung bám sát nguyên tác. Tuy nhiên thời lượng hơi ngắn.', 'date' => '19/05/2026', 'status' => 'visible'],
                            ['user' => 'Lê C', 'movie' => 'Godzilla x Kong', 'rating' => 1, 'content' => 'Link nhà cái x8 bet... (Spam content)', 'date' => '10/05/2026', 'status' => 'hidden'],
                            ['user' => 'Phạm D', 'movie' => 'Lật Mặt 8', 'rating' => 5, 'content' => 'Rất xúc động, một bộ phim ý nghĩa về tình cảm gia đình.', 'date' => '02/05/2026', 'status' => 'visible'],
                            ['user' => 'Hoàng E', 'movie' => 'Dune: Part Two', 'rating' => 3, 'content' => 'Phim hơi dài và khó hiểu với người chưa xem phần 1.', 'date' => '08/05/2026', 'status' => 'visible'],
                        ];
                    @endphp

                    @foreach($reviews as $key => $review)
                    <tr class="hover:bg-dark-main/30 transition-colors {{ $review['status'] == 'hidden' ? 'opacity-60 bg-dark-main/50' : '' }}">
                        <td class="p-4">
                            <span class="font-bold text-white block">{{ $review['user'] }}</span>
                        </td>
                        <td class="p-4">
                            <a href="{{ route('admin.movies.show', 1) }}" class="text-brand-start font-medium hover:text-white transition-colors truncate block max-w-[150px]">{{ $review['movie'] }}</a>
                        </td>
                        <td class="p-4 text-center">
                            <div class="flex items-center justify-center text-warning text-xs">
                                @for($i = 0; $i < 5; $i++)
                                    @if($i < $review['rating'])
                                        <i class="ph-fill ph-star"></i>
                                    @else
                                        <i class="ph ph-star text-dark-border"></i>
                                    @endif
                                @endfor
                            </div>
                        </td>
                        <td class="p-4">
                            <p class="text-text-main max-w-md truncate" title="{{ $review['content'] }}">
                                @if($review['status'] == 'hidden')
                                    <span class="text-error font-bold text-xs mr-1">[Đã ẩn]</span>
                                @endif
                                {{ $review['content'] }}
                            </p>
                        </td>
                        <td class="p-4 text-center text-text-sub">
                            {{ $review['date'] }}
                        </td>
                        <td class="p-4 text-center">
                            @if($review['status'] == 'visible')
                                <button class="w-8 h-8 rounded-lg border border-dark-border text-text-sub hover:text-white hover:bg-warning hover:border-warning flex items-center justify-center transition-colors mx-auto" title="Ẩn đánh giá (Spam/Vi phạm)">
                                    <i class="ph-bold ph-eye-slash"></i>
                                </button>
                            @else
                                <button class="w-8 h-8 rounded-lg border border-dark-border text-text-sub hover:text-white hover:bg-success hover:border-success flex items-center justify-center transition-colors mx-auto" title="Khôi phục hiển thị">
                                    <i class="ph-bold ph-eye"></i>
                                </button>
                            @endif
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="p-4 border-t border-dark-border bg-dark-main/50 flex items-center justify-between text-sm">
            <span class="text-text-sub">Hiển thị 1 - 5 trong tổng số 1,245 đánh giá</span>
            <div class="flex gap-1">
                <button class="w-8 h-8 flex items-center justify-center rounded-lg border border-dark-border text-text-sub hover:text-white transition-colors disabled:opacity-50"><i class="ph ph-caret-left"></i></button>
                <button class="w-8 h-8 flex items-center justify-center rounded-lg bg-brand-start text-white font-medium">1</button>
                <button class="w-8 h-8 flex items-center justify-center rounded-lg border border-dark-border text-text-sub hover:text-white transition-colors">2</button>
                <button class="w-8 h-8 flex items-center justify-center rounded-lg border border-dark-border text-text-sub hover:text-white transition-colors">3</button>
                <button class="w-8 h-8 flex items-center justify-center rounded-lg border border-dark-border text-text-sub hover:text-white transition-colors disabled:opacity-50"><i class="ph ph-caret-right"></i></button>
            </div>
        </div>

    </div>
@endsection
