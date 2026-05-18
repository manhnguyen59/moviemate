@extends('layouts.admin')

@section('title', 'Quản lý Đơn đặt vé - MovieMate Admin')
@section('page-title', 'Quản lý đơn đặt vé')

@section('content')
    <div class="app-card border app-border rounded-2xl overflow-hidden shadow-lg">

        <!-- Header & Filters -->
        <div class="p-5 border-b app-border">
            <div class="flex flex-col md:flex-row gap-3 items-center justify-between mb-4">
                <div class="relative w-full md:w-96">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i class="ph ph-magnifying-glass app-muted text-sm"></i>
                    </div>
                    <input type="text" class="app-input w-full pl-10 pr-4 py-2 border app-border rounded-xl focus:outline-none focus:border-brand-start transition-colors text-sm" placeholder="Tìm theo Mã vé, Tên KH, SĐT...">
                </div>

                <button class="px-4 py-2 app-secondary border app-border app-muted hover:app-text hover:border-brand-start rounded-xl transition-colors text-sm font-medium flex items-center gap-2 flex-shrink-0">
                    <i class="ph ph-export"></i> Xuất Excel
                </button>
            </div>

            <div class="flex flex-wrap gap-3">
                <input type="date" class="app-input px-3 py-2 border app-border rounded-lg text-sm focus:outline-none focus:border-brand-start [color-scheme:dark]">

                <select class="app-input px-3 py-2 border app-border rounded-lg text-sm focus:outline-none focus:border-brand-start min-w-[140px] appearance-none">
                    <option value="">Tất cả rạp</option>
                    <option>MovieMate Hà Nội</option>
                    <option>MovieMate Cầu Giấy</option>
                </select>

                <select class="app-input px-3 py-2 border app-border rounded-lg text-sm focus:outline-none focus:border-brand-start min-w-[160px] appearance-none">
                    <option value="">Trạng thái thanh toán</option>
                    <option>Đã thanh toán</option>
                    <option>Chờ thanh toán</option>
                    <option>Đã hủy</option>
                </select>

                <select class="app-input px-3 py-2 border app-border rounded-lg text-sm focus:outline-none focus:border-brand-start min-w-[130px] appearance-none">
                    <option value="">Tình trạng vé</option>
                    <option>Chưa dùng</option>
                    <option>Đã dùng</option>
                </select>
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto hide-scrollbar">
            <table class="w-full text-left border-collapse whitespace-nowrap">
                <thead>
                    <tr class="app-secondary text-xs uppercase tracking-wider app-muted border-b app-border">
                        <th class="px-5 py-3 font-semibold">Mã vé / Ngày đặt</th>
                        <th class="px-5 py-3 font-semibold">Khách hàng</th>
                        <th class="px-5 py-3 font-semibold">Suất chiếu</th>
                        <th class="px-5 py-3 font-semibold text-right">Tổng tiền</th>
                        <th class="px-5 py-3 font-semibold text-center">Thanh toán</th>
                        <th class="px-5 py-3 font-semibold text-center">Tình trạng</th>
                        <th class="px-5 py-3 font-semibold text-center">Thao tác</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[var(--border-color)] text-sm">
                    @php
                        $bookings = [
                            ['code'=>'MMT-8A2F9B','date'=>'19/05/2026 14:30','name'=>'Nguyễn Mạnh','phone'=>'0987xxx123','movie'=>'Thanh Gươm Diệt Quỷ','show_time'=>'19/05 - 19:30','total'=>'200.000đ','pay_status'=>'paid','ticket_status'=>'unused'],
                            ['code'=>'MMT-3C7D1E','date'=>'19/05/2026 10:15','name'=>'Trần B','phone'=>'0912xxx456','movie'=>'Godzilla x Kong','show_time'=>'19/05 - 14:00','total'=>'160.000đ','pay_status'=>'paid','ticket_status'=>'used'],
                            ['code'=>'MMT-9F4A2C','date'=>'19/05/2026 09:00','name'=>'Lê C','phone'=>'0933xxx789','movie'=>'Dune: Part Two','show_time'=>'20/05 - 20:00','total'=>'300.000đ','pay_status'=>'pending','ticket_status'=>'unused'],
                            ['code'=>'MMT-1B8E5D','date'=>'18/05/2026 22:10','name'=>'Phạm D','phone'=>'0901xxx321','movie'=>'Lật Mặt 8','show_time'=>'19/05 - 09:30','total'=>'160.000đ','pay_status'=>'cancelled','ticket_status'=>'invalid'],
                            ['code'=>'MMT-5D2C1A','date'=>'18/05/2026 15:45','name'=>'Hoàng E','phone'=>'0988xxx555','movie'=>'Thanh Gươm Diệt Quỷ','show_time'=>'19/05 - 19:30','total'=>'240.000đ','pay_status'=>'paid','ticket_status'=>'unused'],
                        ];
                    @endphp

                    @foreach($bookings as $key => $booking)
                    <tr class="hover:bg-brand-start/3 transition-colors">
                        <td class="px-5 py-3.5">
                            <span class="font-mono text-brand-start font-bold text-xs block">{{ $booking['code'] }}</span>
                            <span class="text-xs app-muted">{{ $booking['date'] }}</span>
                        </td>
                        <td class="px-5 py-3.5">
                            <span class="font-bold app-text text-sm block">{{ $booking['name'] }}</span>
                            <span class="text-xs app-muted">{{ $booking['phone'] }}</span>
                        </td>
                        <td class="px-5 py-3.5">
                            <span class="app-text text-sm block max-w-[200px] truncate" title="{{ $booking['movie'] }}">{{ $booking['movie'] }}</span>
                            <span class="text-xs app-muted font-medium">{{ $booking['show_time'] }}</span>
                        </td>
                        <td class="px-5 py-3.5 text-right">
                            <span class="font-bold app-text">{{ $booking['total'] }}</span>
                        </td>
                        <td class="px-5 py-3.5 text-center">
                            @if($booking['pay_status'] == 'paid')
                                <span class="inline-flex px-2 py-0.5 bg-success/10 text-success rounded text-[10px] font-bold uppercase tracking-wider">Đã TT</span>
                            @elseif($booking['pay_status'] == 'pending')
                                <span class="inline-flex px-2 py-0.5 bg-warning/10 text-warning rounded text-[10px] font-bold uppercase tracking-wider">Chờ TT</span>
                            @else
                                <span class="inline-flex px-2 py-0.5 bg-error/10 text-error rounded text-[10px] font-bold uppercase tracking-wider">Đã hủy</span>
                            @endif
                        </td>
                        <td class="px-5 py-3.5 text-center">
                            @if($booking['pay_status'] != 'paid')
                                <span class="app-muted text-xs">—</span>
                            @elseif($booking['ticket_status'] == 'unused')
                                <span class="text-brand-start text-xs font-bold"><i class="ph-fill ph-ticket"></i> Chưa dùng</span>
                            @else
                                <span class="app-muted text-xs font-medium"><i class="ph ph-check-circle"></i> Đã dùng</span>
                            @endif
                        </td>
                        <td class="px-5 py-3.5 text-center">
                            <a href="{{ route('admin.bookings.show', $key+1) }}" class="inline-flex w-8 h-8 rounded-lg border app-border app-muted hover:app-text hover:border-brand-start items-center justify-center transition-colors" title="Xem chi tiết">
                                <i class="ph-bold ph-eye text-sm"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="px-5 py-3 border-t app-border app-secondary flex items-center justify-between text-sm">
            <span class="app-muted text-xs">Hiển thị 1 - 5 trong tổng số 1,245 đơn</span>
            <div class="flex gap-1">
                <button class="w-8 h-8 flex items-center justify-center rounded-lg border app-border app-muted hover:app-text transition-colors"><i class="ph ph-caret-left text-xs"></i></button>
                <button class="w-8 h-8 flex items-center justify-center rounded-lg bg-brand-start text-white font-bold text-sm">1</button>
                <button class="w-8 h-8 flex items-center justify-center rounded-lg border app-border app-muted hover:app-text transition-colors text-sm">2</button>
                <button class="w-8 h-8 flex items-center justify-center rounded-lg border app-border app-muted hover:app-text transition-colors text-sm">3</button>
                <button class="w-8 h-8 flex items-center justify-center rounded-lg border app-border app-muted hover:app-text transition-colors"><i class="ph ph-caret-right text-xs"></i></button>
            </div>
        </div>

    </div>
@endsection
