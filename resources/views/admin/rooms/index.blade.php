@extends('layouts.admin')

@section('title', 'Quản lý phòng chiếu - MovieMate Admin')
@section('page-title', 'Quản lý phòng chiếu')

@section('content')
    <div class="bg-dark-card border border-dark-border rounded-2xl overflow-hidden shadow-lg">
        
        <!-- Header & Filters -->
        <div class="p-6 border-b border-dark-border">
            <div class="flex flex-col md:flex-row gap-4 items-center justify-between">
                
                <div class="flex gap-4 w-full md:w-auto">
                    <select class="px-4 py-2 bg-dark-main border border-dark-border rounded-lg text-white text-sm focus:outline-none focus:border-brand-start min-w-[200px]">
                        <option value="">Tất cả rạp chiếu</option>
                        <option>MovieMate Hà Nội</option>
                        <option>MovieMate Cầu Giấy</option>
                        <option>MovieMate Đà Nẵng</option>
                    </select>

                    <select class="px-4 py-2 bg-dark-main border border-dark-border rounded-lg text-white text-sm focus:outline-none focus:border-brand-start">
                        <option value="">Loại phòng</option>
                        <option>2D</option>
                        <option>3D</option>
                        <option>IMAX</option>
                        <option>VIP</option>
                    </select>
                </div>

                <!-- Add Button -->
                <a href="{{ route('admin.rooms.create') }}" class="w-full md:w-auto px-6 py-2.5 bg-brand-start text-white font-bold rounded-xl hover:bg-brand-end transition-colors flex items-center justify-center gap-2 whitespace-nowrap">
                    <i class="ph-bold ph-plus"></i> Thêm phòng
                </a>
                
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto hide-scrollbar">
            <table class="w-full text-left border-collapse whitespace-nowrap">
                <thead>
                    <tr class="bg-dark-main/50 text-xs uppercase tracking-wider text-text-sub border-b border-dark-border">
                        <th class="p-4 font-medium">Tên phòng</th>
                        <th class="p-4 font-medium">Rạp chiếu</th>
                        <th class="p-4 font-medium text-center">Loại phòng</th>
                        <th class="p-4 font-medium text-center">Tổng ghế</th>
                        <th class="p-4 font-medium text-center">Trạng thái</th>
                        <th class="p-4 font-medium text-center">Hành động</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-dark-border text-sm">
                    
                    @php
                        $rooms = [
                            ['name' => 'Room 01', 'cinema' => 'MovieMate Hà Nội', 'type' => '2D', 'seats' => 120, 'status' => 'active'],
                            ['name' => 'Room 02', 'cinema' => 'MovieMate Hà Nội', 'type' => '2D', 'seats' => 96, 'status' => 'active'],
                            ['name' => 'IMAX 01', 'cinema' => 'MovieMate Hà Nội', 'type' => 'IMAX', 'seats' => 150, 'status' => 'active'],
                            ['name' => 'VIP 01', 'cinema' => 'MovieMate Hà Nội', 'type' => 'VIP', 'seats' => 40, 'status' => 'maintenance'],
                            ['name' => 'Room 01', 'cinema' => 'MovieMate Cầu Giấy', 'type' => '3D', 'seats' => 110, 'status' => 'active'],
                        ];
                    @endphp

                    @foreach($rooms as $key => $room)
                    <tr class="hover:bg-dark-main/30 transition-colors">
                        <td class="p-4">
                            <span class="font-bold text-white">{{ $room['name'] }}</span>
                        </td>
                        <td class="p-4 text-text-sub">{{ $room['cinema'] }}</td>
                        <td class="p-4 text-center">
                            @if($room['type'] == 'IMAX')
                                <span class="bg-brand-start/20 text-brand-start border border-brand-start/30 px-2 py-1 rounded font-bold text-xs">{{ $room['type'] }}</span>
                            @elseif($room['type'] == 'VIP')
                                <span class="bg-warning/20 text-warning border border-warning/30 px-2 py-1 rounded font-bold text-xs">{{ $room['type'] }}</span>
                            @else
                                <span class="bg-dark-main border border-dark-border px-2 py-1 rounded font-medium text-xs text-white">{{ $room['type'] }}</span>
                            @endif
                        </td>
                        <td class="p-4 text-center text-white">{{ $room['seats'] }}</td>
                        <td class="p-4 text-center">
                            @if($room['status'] == 'active')
                                <span class="inline-flex px-2 py-1 bg-success/10 text-success border border-success/20 rounded text-[10px] font-bold uppercase tracking-wider">Hoạt động</span>
                            @else
                                <span class="inline-flex px-2 py-1 bg-warning/10 text-warning border border-warning/20 rounded text-[10px] font-bold uppercase tracking-wider">Bảo trì</span>
                            @endif
                        </td>
                        <td class="p-4">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('admin.seats.manage') }}" class="w-8 h-8 rounded-lg border border-ai-start text-ai-start hover:bg-ai-start hover:text-white flex items-center justify-center transition-colors" title="Quản lý ghế">
                                    <i class="ph-bold ph-armchair"></i>
                                </a>
                                <a href="{{ route('admin.rooms.edit', $key+1) }}" class="w-8 h-8 rounded-lg border border-dark-border text-text-sub hover:text-white hover:border-brand-start flex items-center justify-center transition-colors" title="Chỉnh sửa">
                                    <i class="ph-bold ph-pencil-simple"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

    </div>
@endsection
