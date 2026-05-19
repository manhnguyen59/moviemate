@extends('layouts.admin')

@section('title', 'Quản lý suất chiếu - MovieMate Admin')
@section('page-title', 'Quản lý suất chiếu')

@section('content')
    <div class="app-card border app-border rounded-2xl overflow-hidden shadow-lg">
        <!-- Filters -->
        <div class="p-5 border-b app-border">
            <form method="GET" action="{{ route('admin.showtimes.index') }}" class="flex flex-col md:flex-row gap-3 items-start justify-between mb-4">
                <div class="flex flex-wrap gap-3">
                    <select name="cinema_id" class="app-input px-3 py-2 border app-border rounded-lg text-sm focus:outline-none focus:border-brand-start min-w-[180px] appearance-none">
                        <option value="">Tất cả rạp</option>
                        @foreach($cinemas as $cinema)
                            <option value="{{ $cinema->id }}" {{ request('cinema_id') == $cinema->id ? 'selected' : '' }}>
                                {{ $cinema->name }}
                            </option>
                        @endforeach
                    </select>

                    <select name="movie_id" class="app-input px-3 py-2 border app-border rounded-lg text-sm focus:outline-none focus:border-brand-start min-w-[180px] appearance-none">
                        <option value="">Tất cả phim</option>
                        @foreach($movies as $movie)
                            <option value="{{ $movie->id }}" {{ request('movie_id') == $movie->id ? 'selected' : '' }}>
                                {{ $movie->title }}
                            </option>
                        @endforeach
                    </select>

                    <input type="date" name="show_date" value="{{ request('show_date') }}" class="app-input px-3 py-2 border app-border rounded-lg text-sm focus:outline-none focus:border-brand-start">

                    <select name="status" class="app-input px-3 py-2 border app-border rounded-lg text-sm focus:outline-none focus:border-brand-start appearance-none">
                        <option value="">Trạng thái</option>
                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Đang chiếu</option>
                        <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
                        <option value="finished" {{ request('status') == 'finished' ? 'selected' : '' }}>Đã chiếu xong</option>
                    </select>
                </div>

                <div class="flex gap-2">
                    <button type="submit" class="px-5 py-2 bg-brand-start text-white font-bold rounded-xl hover:shadow-lg transition-all">
                        Lọc
                    </button>
                    <a href="{{ route('admin.showtimes.create') }}" class="px-5 py-2 bg-gradient-to-r from-brand-start to-brand-end text-white font-bold rounded-xl hover:shadow-lg transition-all flex items-center gap-2 text-sm">
                        <i class="ph-bold ph-plus"></i> Thêm suất chiếu
                    </a>
                </div>
            </form>

            <p class="text-xs app-muted">
                Hiển thị <span class="app-text font-bold">{{ $showtimes->total() }}</span> suất chiếu
                @if(request()->hasAny(['cinema_id','movie_id','show_date','status']))
                    với bộ lọc hiện tại
                @endif
            </p>
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
                        <th class="px-5 py-3 font-semibold text-center">Trạng thái</th>
                        <th class="px-5 py-3 font-semibold text-center">Thao tác</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[var(--border-color)] text-sm">
                    @forelse($showtimes as $showtime)
                        <tr class="hover:bg-brand-start/3 transition-colors">
                            <td class="px-5 py-3.5">
                                <span class="font-bold app-text text-base block">{{ \Carbon\Carbon::parse($showtime->show_time)->format('H:i') }}</span>
                                <span class="text-xs app-muted">{{ $showtime->show_date->format('d/m/Y') }}</span>
                            </td>
                            <td class="px-5 py-3.5">
                                <span class="font-bold app-text text-sm block truncate max-w-[180px] hover:text-brand-start cursor-pointer">
                                    {{ $showtime->movie->title }}
                                </span>
                            </td>
                            <td class="px-5 py-3.5">
                                <span class="app-text text-sm block">{{ $showtime->cinema->name }}</span>
                                <span class="text-xs app-muted">{{ $showtime->room->name }}</span>
                            </td>
                            <td class="px-5 py-3.5 text-right">
                                <span class="app-text text-sm block">{{ number_format($showtime->price,0,',','.') }}₫</span>
                                @if($showtime->vip_price)
                                    <span class="text-xs text-brand-start font-bold">{{ number_format($showtime->vip_price,0,',','.') }}₫</span>
                                @endif
                            </td>
                            <td class="px-5 py-3.5 text-center">
                                @if($showtime->status == 'active')
                                    <span class="inline-flex px-2 py-0.5 bg-success/10 text-success border border-success/20 rounded text-[10px] font-bold uppercase tracking-wider">Đang chiếu</span>
                                @elseif($showtime->status == 'cancelled')
                                    <span class="inline-flex px-2 py-0.5 bg-error/10 text-error border border-error/20 rounded text-[10px] font-bold uppercase tracking-wider">Đã hủy</span>
                                @else
                                    <span class="inline-flex px-2 py-0.5 bg-warning/10 text-warning border border-warning/20 rounded text-[10px] font-bold uppercase tracking-wider">Đã chiếu xong</span>
                                @endif
                            </td>
                            <td class="px-5 py-3.5">
                                <div class="flex items-center justify-center gap-1.5">
                                    <a href="{{ route('admin.showtimes.edit', $showtime) }}" class="w-8 h-8 rounded-lg border app-border app-muted hover:app-text hover:border-brand-start flex items-center justify-center transition-colors" title="Chỉnh sửa">
                                        <i class="ph-bold ph-pencil-simple text-xs"></i>
                                    </a>
                                    <form method="POST" action="{{ route('admin.showtimes.destroy', $showtime) }}" onsubmit="return confirm('Bạn có chắc muốn xóa suất chiếu này?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-8 h-8 rounded-lg border app-border app-muted hover:text-white hover:bg-error hover:border-error flex items-center justify-center transition-colors" title="Xóa">
                                            <i class="ph-bold ph-trash text-xs"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-5 py-3 text-center text-muted">Không có suất chiếu nào.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-5 border-t app-border">
            {{ $showtimes->links() }}
        </div>
    </div>
@endsection