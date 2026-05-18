@extends('layouts.admin')

@section('title', 'Quản lý suất chiếu - MovieMate Admin')
@section('page-title', 'Quản lý suất chiếu')

@section('content')
    <div class="app-card border app-border rounded-2xl overflow-hidden shadow-lg">

        <!-- Filters -->
        <div class="p-5 border-b app-border">
            <div class="flex flex-col md:flex-row gap-3 items-start justify-between mb-4">
                <div class="flex flex-wrap gap-3">
                    <select class="app-input px-3 py-2 border app-border rounded-lg text-sm focus:outline-none focus:border-brand-start min-w-[180px] appearance-none">
                        <option value="">Tất cả rạp</option>
                        <option>MovieMate Hà Nội</option>
                        <option>MovieMate Cầu Giấy</option>
                    </select>
                    <select class="app-input px-3 py-2 border app-border rounded-lg text-sm focus:outline-none focus:border-brand-start min-w-[180px] appearance-none">
                        <option value="">Tất cả phim</option>
                        <option>Thanh Gươm Diệt Quỷ</option>
                        <option>Godzilla x Kong</option>
                        <option>Dune: Part Two</option>
                    </select>
                    <input type="date" value="2026-05-19" class="app-input px-3 py-2 border app-border rounded-lg text-sm focus:outline-none focus:border-brand-start [color-scheme:dark]">
                    <select class="app-input px-3 py-2 border app-border rounded-lg text-sm focus:outline-none focus:border-brand-start appearance-none">
                        <option value="">Trạng thái</option>
                        <option>Đang chiếu</option>
                        <option>Sắp chiếu</option>
                        <option>Đã chiếu xong</option>
                    </select>
                </div>

                <a href="{{ route('admin.showtimes.create') }}" class="px-5 py-2 bg-gradient-to-r from-brand-start to-brand-end text-white font-bold rounded-xl hover:shadow-lg transition-all flex items-center gap-2 text-sm flex-shrink-0">
                    <i class="ph-bold ph-plus"></i> Thêm suất chiếu
                </a>
            </div>

            <p class="text-xs app-muted">Hiển thị <span class="app-text font-bold">12</span> suất chiếu trong ngày <span class="text-brand-start font-bold">19/05/2026</span></p>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto hide-scrollbar">
            <table class="w-full text-left border-collapse whitespace-nowrap">
                <thead>
                    <tr class="app-secondary text-xs uppercase tracking-wider app-muted border-b app-border">
                        <th class="px-5 py-3 font-semibold">Giờ chiếu</th>
                        <th class="px-5 py-3 font-semibold">Phim</th>
                        <th class="px-5 py-3 font-semibold">Rạp / Phòng</th>
                        <th class="px-5 py-3 font-semibold text-right">Giá Thường/VIP</th>
                        <th class="px-5 py-3 font-semibold text-center">Ghế đã đặt</th>
                        <th class="px-5 py-3 font-semibold text-center">Trạng thái</th>
                        <th class="px-5 py-3 font-semibold text-center">Thao tác</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[var(--border-color)] text-sm">
                    @php
                        $showtimes = [
                            ['time'=>'09:30','movie'=>'Thanh Gươm Diệt Quỷ','cinema'=>'MovieMate Hà Nội','room'=>'Room 01 (2D)','price_normal'=>'80K','price_vip'=>'100K','booked'=>45,'total'=>120,'status'=>'showing'],
                            ['time'=>'10:15','movie'=>'Dune: Part Two','cinema'=>'MovieMate Hà Nội','room'=>'IMAX 01','price_normal'=>'120K','price_vip'=>'150K','booked'=>140,'total'=>150,'status'=>'upcoming'],
                            ['time'=>'11:00','movie'=>'Godzilla x Kong','cinema'=>'MovieMate Hà Nội','room'=>'Room 02 (2D)','price_normal'=>'80K','price_vip'=>'100K','booked'=>10,'total'=>96,'status'=>'upcoming'],
                            ['time'=>'13:30','movie'=>'Thanh Gươm Diệt Quỷ','cinema'=>'MovieMate Cầu Giấy','room'=>'Room 01 (3D)','price_normal'=>'100K','price_vip'=>'120K','booked'=>85,'total'=>110,'status'=>'upcoming'],
                            ['time'=>'08:00','movie'=>'Lật Mặt 8','cinema'=>'MovieMate Hà Nội','room'=>'Room 01 (2D)','price_normal'=>'80K','price_vip'=>'100K','booked'=>90,'total'=>120,'status'=>'ended'],
                        ];
                    @endphp

                    @foreach($showtimes as $key => $show)
                    <tr class="hover:bg-brand-start/3 transition-colors {{ $show['status'] == 'ended' ? 'opacity-50' : '' }}">
                        <td class="px-5 py-3.5">
                            <span class="font-bold app-text text-base block">{{ $show['time'] }}</span>
                            <span class="text-xs app-muted">19/05/2026</span>
                        </td>
                        <td class="px-5 py-3.5">
                            <span class="font-bold app-text text-sm block truncate max-w-[180px] hover:text-brand-start cursor-pointer">{{ $show['movie'] }}</span>
                        </td>
                        <td class="px-5 py-3.5">
                            <span class="app-text text-sm block">{{ $show['cinema'] }}</span>
                            <span class="text-xs app-muted">{{ $show['room'] }}</span>
                        </td>
                        <td class="px-5 py-3.5 text-right">
                            <span class="app-text text-sm block">{{ $show['price_normal'] }}</span>
                            <span class="text-xs text-ai-start font-bold">{{ $show['price_vip'] }}</span>
                        </td>
                        <td class="px-5 py-3.5">
                            <div class="flex flex-col items-center gap-1 max-w-[110px] mx-auto">
                                <span class="text-xs font-bold {{ $show['booked'] / $show['total'] > 0.8 ? 'text-error' : 'text-success' }}">{{ $show['booked'] }}/{{ $show['total'] }}</span>
                                <div class="w-full h-1.5 app-secondary rounded-full overflow-hidden border app-border">
                                    <div class="h-full rounded-full {{ $show['booked'] / $show['total'] > 0.8 ? 'bg-error' : 'bg-success' }}"
                                         style="width: {{ ($show['booked'] / $show['total']) * 100 }}%"></div>
                                </div>
                            </div>
                        </td>
                        <td class="px-5 py-3.5 text-center">
                            @if($show['status'] == 'showing')
                                <span class="inline-flex px-2 py-0.5 bg-success/10 text-success border border-success/20 rounded text-[10px] font-bold uppercase tracking-wider">Đang chiếu</span>
                            @elseif($show['status'] == 'upcoming')
                                <span class="inline-flex px-2 py-0.5 bg-warning/10 text-warning border border-warning/20 rounded text-[10px] font-bold uppercase tracking-wider">Sắp chiếu</span>
                            @else
                                <span class="inline-flex px-2 py-0.5 app-secondary border app-border app-muted rounded text-[10px] font-bold uppercase tracking-wider">Đã chiếu</span>
                            @endif
                        </td>
                        <td class="px-5 py-3.5">
                            <div class="flex items-center justify-center gap-1.5">
                                <a href="{{ route('admin.showtimes.edit', $key+1) }}" class="w-8 h-8 rounded-lg border app-border app-muted hover:app-text hover:border-brand-start flex items-center justify-center transition-colors" title="Chỉnh sửa">
                                    <i class="ph-bold ph-pencil-simple text-xs"></i>
                                </a>
                                <button class="w-8 h-8 rounded-lg border app-border app-muted hover:text-white hover:bg-error hover:border-error flex items-center justify-center transition-colors" title="Xóa">
                                    <i class="ph-bold ph-trash text-xs"></i>
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
