@extends('layouts.admin')

@section('title', 'Quản lý ghế - MovieMate Admin')
@section('page-title', 'Quản lý ghế (Sơ đồ)')

@section('content')
    <div class="mb-6 flex flex-col sm:flex-row gap-3 items-center justify-between">
        <div class="flex flex-wrap gap-3">
            <select class="app-input px-4 py-2 border app-border rounded-lg text-sm focus:outline-none focus:border-brand-start min-w-[200px] appearance-none">
                <option value="">Tất cả rạp chiếu</option>
                <option selected>MovieMate Hà Nội</option>
                <option>MovieMate Cầu Giấy</option>
                <option>MovieMate Đà Nẵng</option>
            </select>
        </div>

        <div class="relative w-full sm:w-64">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="ph ph-magnifying-glass app-muted text-sm"></i>
            </div>
            <input type="text" class="app-input w-full pl-10 pr-4 py-2 border app-border rounded-lg focus:outline-none focus:border-brand-start transition-colors text-sm" placeholder="Tìm tên phòng...">
        </div>
    </div>

    <!-- Grid of Rooms -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">
        @php
            $rooms = [
                ['name'=>'Room 01','cinema'=>'MovieMate Hà Nội','total'=>120,'normal'=>96,'vip'=>24,'broken'=>0],
                ['name'=>'Room 02','cinema'=>'MovieMate Hà Nội','total'=>96,'normal'=>76,'vip'=>20,'broken'=>0],
                ['name'=>'IMAX 01','cinema'=>'MovieMate Hà Nội','total'=>150,'normal'=>110,'vip'=>40,'broken'=>2],
                ['name'=>'VIP 01','cinema'=>'MovieMate Hà Nội','total'=>40,'normal'=>0,'vip'=>40,'broken'=>0],
                ['name'=>'Room 01','cinema'=>'MovieMate Cầu Giấy','total'=>110,'normal'=>86,'vip'=>24,'broken'=>1],
                ['name'=>'Room 02','cinema'=>'MovieMate Cầu Giấy','total'=>0,'normal'=>0,'vip'=>0,'broken'=>0,'empty'=>true],
            ];
        @endphp

        @foreach($rooms as $room)
        <div class="app-card border app-border rounded-2xl p-5 relative overflow-hidden group hover:border-brand-start/50 transition-colors">

            <div class="flex justify-between items-start mb-4">
                <div>
                    <h3 class="text-lg font-bold app-text mb-0.5">{{ $room['name'] }}</h3>
                    <p class="text-xs app-muted flex items-center gap-1">
                        <i class="ph-fill ph-map-pin"></i> {{ $room['cinema'] }}
                    </p>
                </div>

                @if(isset($room['empty']) && $room['empty'])
                    <span class="inline-flex px-2 py-0.5 bg-warning/10 text-warning rounded text-[10px] font-bold uppercase tracking-wider border border-warning/20">Chưa có sơ đồ</span>
                @else
                    <div class="w-9 h-9 rounded-full app-secondary flex items-center justify-center app-text font-bold border app-border text-sm">
                        {{ $room['total'] }}
                    </div>
                @endif
            </div>

            @if(!isset($room['empty']) || !$room['empty'])
            <div class="grid grid-cols-3 gap-2 mb-5">
                <div class="app-secondary rounded-xl p-3 text-center border app-border">
                    <p class="text-[10px] app-muted uppercase tracking-wider mb-1">Thường</p>
                    <p class="font-bold app-text">{{ $room['normal'] }}</p>
                </div>
                <div class="bg-ai-start/10 rounded-xl p-3 text-center border border-ai-start/20">
                    <p class="text-[10px] text-ai-start uppercase tracking-wider mb-1 font-bold">VIP</p>
                    <p class="font-bold text-ai-start">{{ $room['vip'] }}</p>
                </div>
                <div class="bg-error/10 rounded-xl p-3 text-center border border-error/20">
                    <p class="text-[10px] text-error uppercase tracking-wider mb-1 font-bold">Bảo trì</p>
                    <p class="font-bold text-error">{{ $room['broken'] }}</p>
                </div>
            </div>
            @else
            <div class="h-16 flex items-center justify-center app-secondary rounded-xl border border-dashed app-border mb-5">
                <p class="text-xs app-muted text-center px-4">Phòng chưa được thiết lập ghế. Cần tạo sơ đồ trước khi sử dụng.</p>
            </div>
            @endif

            <a href="{{ route('admin.seats.manage') }}" class="w-full py-2.5 app-secondary border app-border app-muted text-sm font-medium rounded-xl hover:bg-brand-start hover:border-brand-start hover:text-white transition-colors flex items-center justify-center gap-2">
                <i class="ph-bold ph-pencil-simple"></i> Quản lý sơ đồ ghế
            </a>
        </div>
        @endforeach
    </div>
@endsection
