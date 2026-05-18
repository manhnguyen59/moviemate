@extends('layouts.admin')

@section('title', 'Quản lý thể loại - MovieMate Admin')
@section('page-title', 'Quản lý thể loại')

@section('content')
    <div class="bg-dark-card border border-dark-border rounded-2xl overflow-hidden shadow-lg">
        
        <!-- Header & Filters -->
        <div class="p-6 border-b border-dark-border">
            <div class="flex flex-col md:flex-row gap-4 items-center justify-between">
                
                <!-- Search -->
                <div class="relative w-full md:w-96">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i class="ph ph-magnifying-glass text-text-sub text-lg"></i>
                    </div>
                    <input type="text" class="w-full pl-11 pr-4 py-2.5 bg-dark-main border border-dark-border rounded-xl text-white focus:outline-none focus:border-brand-start transition-colors text-sm" placeholder="Tìm tên thể loại...">
                </div>

                <!-- Add Button -->
                <a href="{{ route('admin.genres.create') }}" class="w-full md:w-auto px-6 py-2.5 bg-brand-start text-white font-bold rounded-xl hover:bg-brand-end transition-colors flex items-center justify-center gap-2">
                    <i class="ph-bold ph-plus"></i> Thêm thể loại
                </a>
                
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto hide-scrollbar">
            <table class="w-full text-left border-collapse whitespace-nowrap">
                <thead>
                    <tr class="bg-dark-main/50 text-xs uppercase tracking-wider text-text-sub border-b border-dark-border">
                        <th class="p-4 font-medium">Tên thể loại</th>
                        <th class="p-4 font-medium">Slug</th>
                        <th class="p-4 font-medium">Mô tả</th>
                        <th class="p-4 font-medium text-center">Số phim</th>
                        <th class="p-4 font-medium text-center">Trạng thái</th>
                        <th class="p-4 font-medium text-center">Hành động</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-dark-border text-sm">
                    
                    @php
                        $genres = [
                            ['name' => 'Hành động', 'slug' => 'hanh-dong', 'desc' => 'Phim có nhiều cảnh chiến đấu, rượt đuổi...', 'count' => 120, 'status' => 'active'],
                            ['name' => 'Kinh dị', 'slug' => 'kinh-di', 'desc' => 'Phim mang yếu tố giật gân, sợ hãi...', 'count' => 85, 'status' => 'active'],
                            ['name' => 'Hài hước', 'slug' => 'hai-huoc', 'desc' => 'Phim mang tính giải trí, gây cười...', 'count' => 150, 'status' => 'active'],
                            ['name' => 'Tình cảm', 'slug' => 'tinh-cam', 'desc' => 'Phim xoay quanh các mối quan hệ tình cảm...', 'count' => 95, 'status' => 'active'],
                            ['name' => 'Hoạt hình', 'slug' => 'hoat-hinh', 'desc' => 'Phim sử dụng kỹ xảo hoạt họa...', 'count' => 200, 'status' => 'active'],
                            ['name' => 'Tài liệu', 'slug' => 'tai-lieu', 'desc' => 'Phim phản ánh thực tế...', 'count' => 15, 'status' => 'inactive'],
                        ];
                    @endphp

                    @foreach($genres as $key => $genre)
                    <tr class="hover:bg-dark-main/30 transition-colors">
                        <td class="p-4">
                            <span class="font-bold text-white">{{ $genre['name'] }}</span>
                        </td>
                        <td class="p-4 text-text-sub">{{ $genre['slug'] }}</td>
                        <td class="p-4 text-text-sub max-w-xs truncate">{{ $genre['desc'] }}</td>
                        <td class="p-4 text-center text-white font-medium">{{ $genre['count'] }}</td>
                        <td class="p-4 text-center">
                            @if($genre['status'] == 'active')
                                <span class="inline-flex px-2 py-1 bg-success/10 text-success border border-success/20 rounded text-[10px] font-bold uppercase tracking-wider">Hoạt động</span>
                            @else
                                <span class="inline-flex px-2 py-1 bg-dark-border text-text-sub border border-dark-border rounded text-[10px] font-bold uppercase tracking-wider">Tạm ẩn</span>
                            @endif
                        </td>
                        <td class="p-4">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('admin.genres.edit', $key+1) }}" class="w-8 h-8 rounded-lg border border-dark-border text-text-sub hover:text-white hover:border-brand-start flex items-center justify-center transition-colors" title="Chỉnh sửa">
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

    </div>
@endsection
