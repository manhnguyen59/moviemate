@extends('layouts.admin')

@section('title', 'Quản lý rạp chiếu - MovieMate Admin')
@section('page-title', 'Quản lý rạp chiếu')

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
                    <input type="text" class="w-full pl-11 pr-4 py-2.5 bg-dark-main border border-dark-border rounded-xl text-white focus:outline-none focus:border-brand-start transition-colors text-sm" placeholder="Tìm tên rạp, địa chỉ...">
                </div>

                <div class="flex gap-4 w-full md:w-auto">
                    <select class="px-4 py-2 bg-dark-main border border-dark-border rounded-lg text-white text-sm focus:outline-none focus:border-brand-start">
                        <option value="">Tất cả thành phố</option>
                        <option>Hà Nội</option>
                        <option>Đà Nẵng</option>
                        <option>Hồ Chí Minh</option>
                    </select>

                    <a href="{{ route('admin.cinemas.create') }}" class="px-6 py-2.5 bg-brand-start text-white font-bold rounded-xl hover:bg-brand-end transition-colors flex items-center justify-center gap-2 whitespace-nowrap">
                        <i class="ph-bold ph-plus"></i> Thêm rạp
                    </a>
                </div>
                
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto hide-scrollbar">
            <table class="w-full text-left border-collapse whitespace-nowrap">
                <thead>
                    <tr class="bg-dark-main/50 text-xs uppercase tracking-wider text-text-sub border-b border-dark-border">
                        <th class="p-4 font-medium w-16">Ảnh</th>
                        <th class="p-4 font-medium">Tên rạp</th>
                        <th class="p-4 font-medium">Thành phố</th>
                        <th class="p-4 font-medium">Phòng</th>
                        <th class="p-4 font-medium text-center">Suất chiếu (hôm nay)</th>
                        <th class="p-4 font-medium text-center">Trạng thái</th>
                        <th class="p-4 font-medium text-center">Hành động</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-dark-border text-sm">
                    
                    @php
                        $cinemas = [
                            ['name' => 'MovieMate Hà Nội', 'city' => 'Hà Nội', 'address' => 'Tầng 5, Vincom Center, Bà Triệu', 'rooms' => 6, 'shows' => 24, 'status' => 'active'],
                            ['name' => 'MovieMate Cầu Giấy', 'city' => 'Hà Nội', 'address' => 'Discovery Complex, Cầu Giấy', 'rooms' => 4, 'shows' => 16, 'status' => 'active'],
                            ['name' => 'MovieMate Đà Nẵng', 'city' => 'Đà Nẵng', 'address' => 'Vincom Center, Ngô Quyền', 'rooms' => 5, 'shows' => 20, 'status' => 'active'],
                            ['name' => 'MovieMate Hồ Chí Minh', 'city' => 'Hồ Chí Minh', 'address' => 'Landmark 81, Bình Thạnh', 'rooms' => 8, 'shows' => 32, 'status' => 'active'],
                        ];
                    @endphp

                    @foreach($cinemas as $key => $cinema)
                    <tr class="hover:bg-dark-main/30 transition-colors">
                        <td class="p-4">
                            <div class="w-12 h-12 rounded-lg overflow-hidden border border-dark-border">
                                <img src="https://images.unsplash.com/photo-1517604931442-7e0c8ed2963c?q=80&w=200&auto=format&fit=crop" class="w-full h-full object-cover">
                            </div>
                        </td>
                        <td class="p-4">
                            <span class="font-bold text-white block">{{ $cinema['name'] }}</span>
                            <span class="text-xs text-text-sub max-w-[200px] truncate block">{{ $cinema['address'] }}</span>
                        </td>
                        <td class="p-4 text-white">{{ $cinema['city'] }}</td>
                        <td class="p-4 text-white"><span class="bg-dark-main border border-dark-border px-2 py-1 rounded">{{ $cinema['rooms'] }} phòng</span></td>
                        <td class="p-4 text-center text-ai-start font-bold">{{ $cinema['shows'] }}</td>
                        <td class="p-4 text-center">
                            @if($cinema['status'] == 'active')
                                <span class="inline-flex px-2 py-1 bg-success/10 text-success border border-success/20 rounded text-[10px] font-bold uppercase tracking-wider">Hoạt động</span>
                            @else
                                <span class="inline-flex px-2 py-1 bg-dark-border text-text-sub border border-dark-border rounded text-[10px] font-bold uppercase tracking-wider">Bảo trì</span>
                            @endif
                        </td>
                        <td class="p-4">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('admin.cinemas.edit', $key+1) }}" class="w-8 h-8 rounded-lg border border-dark-border text-text-sub hover:text-white hover:border-brand-start flex items-center justify-center transition-colors" title="Chỉnh sửa">
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
