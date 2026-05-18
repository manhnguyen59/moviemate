@extends('layouts.admin')

@section('title', 'Quản lý phim - MovieMate Admin')
@section('page-title', 'Quản lý phim')

@section('content')
    <div class="bg-dark-card border border-dark-border rounded-2xl overflow-hidden shadow-lg">
        
        <!-- Header & Filters -->
        <div class="p-6 border-b border-dark-border">
            <div class="flex flex-col md:flex-row gap-4 items-center justify-between mb-6">
                
                <!-- Search -->
                <div class="relative w-full md:w-96">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i class="ph ph-magnifying-glass text-text-sub text-lg"></i>
                    </div>
                    <input type="text" class="w-full pl-11 pr-4 py-2.5 bg-dark-main border border-dark-border rounded-xl text-white focus:outline-none focus:border-brand-start transition-colors text-sm" placeholder="Tìm tên phim, đạo diễn...">
                </div>

                <!-- Add Button -->
                <a href="{{ route('admin.movies.create') }}" class="w-full md:w-auto px-6 py-2.5 bg-brand-start text-white font-bold rounded-xl hover:bg-brand-end transition-colors flex items-center justify-center gap-2">
                    <i class="ph-bold ph-plus"></i> Thêm phim mới
                </a>
                
            </div>

            <div class="flex flex-wrap gap-4">
                <select class="px-4 py-2 bg-dark-main border border-dark-border rounded-lg text-white text-sm focus:outline-none focus:border-brand-start min-w-[150px]">
                    <option value="">Tất cả trạng thái</option>
                    <option value="showing">Đang chiếu</option>
                    <option value="upcoming">Sắp chiếu</option>
                    <option value="stopped">Ngừng chiếu</option>
                </select>

                <select class="px-4 py-2 bg-dark-main border border-dark-border rounded-lg text-white text-sm focus:outline-none focus:border-brand-start min-w-[150px]">
                    <option value="">Tất cả thể loại</option>
                    <option>Hành động</option>
                    <option>Kinh dị</option>
                    <option>Hài hước</option>
                </select>

                <select class="px-4 py-2 bg-dark-main border border-dark-border rounded-lg text-white text-sm focus:outline-none focus:border-brand-start min-w-[150px]">
                    <option value="">Quốc gia</option>
                    <option>Mỹ</option>
                    <option>Hàn Quốc</option>
                    <option>Việt Nam</option>
                </select>
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto hide-scrollbar">
            <table class="w-full text-left border-collapse whitespace-nowrap">
                <thead>
                    <tr class="bg-dark-main/50 text-xs uppercase tracking-wider text-text-sub border-b border-dark-border">
                        <th class="p-4 font-medium">Phim</th>
                        <th class="p-4 font-medium">Thể loại</th>
                        <th class="p-4 font-medium">Khởi chiếu</th>
                        <th class="p-4 font-medium text-center">Trạng thái</th>
                        <th class="p-4 font-medium text-right">Lượt đặt</th>
                        <th class="p-4 font-medium text-center">Hành động</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-dark-border text-sm">
                    
                    @php
                        $movies = [
                            ['title' => 'Thanh Gươm Diệt Quỷ', 'genre' => 'Hành động, Hoạt hình', 'date' => '19/05/2026', 'status' => 'showing', 'booking' => '6,120', 'img' => 'qJ2tW6WMUDux911r6m7haRef0WH.jpg'],
                            ['title' => 'Godzilla x Kong', 'genre' => 'Hành động, Viễn tưởng', 'date' => '10/05/2026', 'status' => 'showing', 'booking' => '8,240', 'img' => 'tMefBSflR6PGQLvLuPE31clYe3D.jpg'],
                            ['title' => 'Dune: Part Two', 'genre' => 'Viễn tưởng, Phiêu lưu', 'date' => '01/05/2026', 'status' => 'showing', 'booking' => '5,050', 'img' => '1pdfLvkbY9ohJlCjQH2JGjjcNsV.jpg'],
                            ['title' => 'Deadpool & Wolverine', 'genre' => 'Hành động, Hài', 'date' => '25/07/2026', 'status' => 'upcoming', 'booking' => '1,200', 'img' => '8cdWjvZQUExUUTzyp4t6EDMubfO.jpg'],
                            ['title' => 'Lật Mặt 8', 'genre' => 'Hành động, Gia đình', 'date' => '30/04/2026', 'status' => 'showing', 'booking' => '4,500', 'img' => 'qJ2tW6WMUDux911r6m7haRef0WH.jpg'], // Tạm dùng ảnh cũ
                            ['title' => 'Mai', 'genre' => 'Tình cảm, Tâm lý', 'date' => '10/02/2024', 'status' => 'stopped', 'booking' => '15,000', 'img' => 'tMefBSflR6PGQLvLuPE31clYe3D.jpg'],
                        ];
                    @endphp

                    @foreach($movies as $key => $movie)
                    <tr class="hover:bg-dark-main/30 transition-colors">
                        <td class="p-4">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-16 rounded overflow-hidden flex-shrink-0 border border-dark-border">
                                    <img src="https://image.tmdb.org/t/p/w500/{{ $movie['img'] }}" alt="Poster" class="w-full h-full object-cover">
                                </div>
                                <div>
                                    <a href="{{ route('admin.movies.show', $key+1) }}" class="font-bold text-white hover:text-brand-start transition-colors mb-1 block">{{ $movie['title'] }}</a>
                                    <p class="text-xs text-text-sub">115 phút • T13</p>
                                </div>
                            </div>
                        </td>
                        <td class="p-4 text-white">{{ $movie['genre'] }}</td>
                        <td class="p-4 text-white">{{ $movie['date'] }}</td>
                        <td class="p-4 text-center">
                            @if($movie['status'] == 'showing')
                                <span class="inline-flex px-2 py-1 bg-success/10 text-success border border-success/20 rounded text-[10px] font-bold uppercase tracking-wider">Đang chiếu</span>
                            @elseif($movie['status'] == 'upcoming')
                                <span class="inline-flex px-2 py-1 bg-warning/10 text-warning border border-warning/20 rounded text-[10px] font-bold uppercase tracking-wider">Sắp chiếu</span>
                            @else
                                <span class="inline-flex px-2 py-1 bg-dark-border text-text-sub border border-dark-border rounded text-[10px] font-bold uppercase tracking-wider">Ngừng chiếu</span>
                            @endif
                        </td>
                        <td class="p-4 text-right font-medium text-white">{{ $movie['booking'] }}</td>
                        <td class="p-4">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('admin.ai.movieContent') }}" class="w-8 h-8 rounded-lg border border-ai-start text-ai-start hover:bg-ai-start hover:text-white flex items-center justify-center transition-colors" title="AI Mô tả">
                                    <i class="ph-bold ph-magic-wand"></i>
                                </a>
                                <a href="{{ route('admin.movies.edit', $key+1) }}" class="w-8 h-8 rounded-lg border border-dark-border text-text-sub hover:text-white hover:border-brand-start flex items-center justify-center transition-colors" title="Chỉnh sửa">
                                    <i class="ph-bold ph-pencil-simple"></i>
                                </a>
                                <button class="w-8 h-8 rounded-lg border border-dark-border text-text-sub hover:text-white hover:bg-error hover:border-error flex items-center justify-center transition-colors" title="Xóa">
                                    <i class="ph-bold ph-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="p-4 border-t border-dark-border bg-dark-main/50 flex items-center justify-between text-sm">
            <span class="text-text-sub">Hiển thị 1 - 6 trong tổng số 45 phim</span>
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
