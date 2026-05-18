@extends('layouts.staff')

@section('title', 'Danh Sách Vé - MovieMate Staff')
@section('page-title', 'Danh sách vé hôm nay')

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
                    <input type="text" class="w-full pl-11 pr-4 py-2.5 bg-dark-main border border-dark-border rounded-xl text-white focus:outline-none focus:border-ai-start transition-colors text-sm" placeholder="Tìm theo mã vé, số điện thoại, tên khách...">
                </div>

                <!-- Filters -->
                <div class="flex gap-2 w-full md:w-auto overflow-x-auto hide-scrollbar">
                    <button class="px-4 py-2 bg-ai-start text-white text-sm font-medium rounded-lg whitespace-nowrap">Tất cả (128)</button>
                    <button class="px-4 py-2 bg-dark-main border border-dark-border text-text-sub hover:text-white text-sm font-medium rounded-lg transition-colors whitespace-nowrap">Chưa sử dụng (43)</button>
                    <button class="px-4 py-2 bg-dark-main border border-dark-border text-text-sub hover:text-white text-sm font-medium rounded-lg transition-colors whitespace-nowrap">Đã sử dụng (85)</button>
                    <button class="px-4 py-2 bg-dark-main border border-dark-border text-text-sub hover:text-white text-sm font-medium rounded-lg transition-colors whitespace-nowrap">Đã hủy (2)</button>
                </div>
                
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto hide-scrollbar">
            <table class="w-full text-left border-collapse whitespace-nowrap">
                <thead>
                    <tr class="bg-dark-main/50 text-xs uppercase tracking-wider text-text-sub border-b border-dark-border">
                        <th class="p-4 font-medium">Mã vé</th>
                        <th class="p-4 font-medium">Khách hàng</th>
                        <th class="p-4 font-medium">Phim</th>
                        <th class="p-4 font-medium">Suất chiếu</th>
                        <th class="p-4 font-medium">Ghế</th>
                        <th class="p-4 font-medium text-right">Tổng tiền</th>
                        <th class="p-4 font-medium text-center">Trạng thái</th>
                        <th class="p-4 font-medium text-center">Hành động</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-dark-border text-sm">
                    
                    <!-- Row 1: Chưa sử dụng -->
                    <tr class="hover:bg-dark-main/30 transition-colors">
                        <td class="p-4">
                            <span class="font-mono text-white font-bold">MMT-0001</span>
                        </td>
                        <td class="p-4">
                            <p class="text-white font-medium">Nguyễn Mạnh</p>
                            <p class="text-xs text-text-sub">0987654321</p>
                        </td>
                        <td class="p-4">
                            <p class="text-white font-medium truncate max-w-[150px]">Thanh Gươm Diệt Quỷ</p>
                            <p class="text-xs text-text-sub">Phòng 3</p>
                        </td>
                        <td class="p-4 text-white">09:30<br><span class="text-xs text-text-sub">19/05/2026</span></td>
                        <td class="p-4 text-brand-start font-bold">F7, F8</td>
                        <td class="p-4 text-right text-white font-medium">160.000đ</td>
                        <td class="p-4 text-center">
                            <span class="inline-flex px-2 py-1 bg-success/10 text-success border border-success/20 rounded text-[10px] font-bold uppercase tracking-wider">Chưa sử dụng</span>
                        </td>
                        <td class="p-4">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('staff.tickets.valid') }}" class="w-8 h-8 rounded-lg bg-ai-start/10 text-ai-start hover:bg-ai-start hover:text-white flex items-center justify-center transition-colors" title="Check-in nhanh">
                                    <i class="ph-bold ph-check"></i>
                                </a>
                                <button class="w-8 h-8 rounded-lg border border-dark-border text-text-sub hover:text-white hover:bg-dark-border flex items-center justify-center transition-colors" title="Xem chi tiết">
                                    <i class="ph-bold ph-eye"></i>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Row 2: Đã sử dụng -->
                    <tr class="hover:bg-dark-main/30 transition-colors">
                        <td class="p-4">
                            <span class="font-mono text-white font-bold">MMT-0002</span>
                        </td>
                        <td class="p-4">
                            <p class="text-white font-medium">Trần Thị B</p>
                            <p class="text-xs text-text-sub">0912345678</p>
                        </td>
                        <td class="p-4">
                            <p class="text-white font-medium truncate max-w-[150px]">Dune: Part Two</p>
                            <p class="text-xs text-text-sub">Phòng 1 (IMAX)</p>
                        </td>
                        <td class="p-4 text-white">08:15<br><span class="text-xs text-text-sub">19/05/2026</span></td>
                        <td class="p-4 text-white font-medium">H10, H11</td>
                        <td class="p-4 text-right text-white font-medium">200.000đ</td>
                        <td class="p-4 text-center">
                            <span class="inline-flex px-2 py-1 bg-warning/10 text-warning border border-warning/20 rounded text-[10px] font-bold uppercase tracking-wider">Đã sử dụng</span>
                        </td>
                        <td class="p-4">
                            <div class="flex items-center justify-center gap-2">
                                <button class="w-8 h-8 rounded-lg border border-dark-border text-text-sub hover:text-white hover:bg-dark-border flex items-center justify-center transition-colors" title="Xem chi tiết">
                                    <i class="ph-bold ph-eye"></i>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Row 3: Đã hủy -->
                    <tr class="hover:bg-dark-main/30 transition-colors opacity-60">
                        <td class="p-4">
                            <span class="font-mono text-white font-bold">MMT-0003</span>
                        </td>
                        <td class="p-4">
                            <p class="text-white font-medium">Lê Văn C</p>
                            <p class="text-xs text-text-sub">0909090909</p>
                        </td>
                        <td class="p-4">
                            <p class="text-white font-medium truncate max-w-[150px]">Lật Mặt 8</p>
                            <p class="text-xs text-text-sub">Phòng 2</p>
                        </td>
                        <td class="p-4 text-white">10:00<br><span class="text-xs text-text-sub">19/05/2026</span></td>
                        <td class="p-4 text-white font-medium">A1, A2</td>
                        <td class="p-4 text-right text-white font-medium">120.000đ</td>
                        <td class="p-4 text-center">
                            <span class="inline-flex px-2 py-1 bg-error/10 text-error border border-error/20 rounded text-[10px] font-bold uppercase tracking-wider">Đã hủy</span>
                        </td>
                        <td class="p-4">
                            <div class="flex items-center justify-center gap-2">
                                <button class="w-8 h-8 rounded-lg border border-dark-border text-text-sub hover:text-white hover:bg-dark-border flex items-center justify-center transition-colors" title="Xem chi tiết">
                                    <i class="ph-bold ph-eye"></i>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Add a few more dummy rows for UI completeness -->
                    @for($i = 4; $i <= 8; $i++)
                    <tr class="hover:bg-dark-main/30 transition-colors">
                        <td class="p-4">
                            <span class="font-mono text-white font-bold">MMT-000{{ $i }}</span>
                        </td>
                        <td class="p-4">
                            <p class="text-white font-medium">Khách Hàng {{ $i }}</p>
                            <p class="text-xs text-text-sub">0987xxx{{ $i }}</p>
                        </td>
                        <td class="p-4">
                            <p class="text-white font-medium truncate max-w-[150px]">Phim Demo {{ $i }}</p>
                            <p class="text-xs text-text-sub">Phòng {{ $i % 3 + 1 }}</p>
                        </td>
                        <td class="p-4 text-white">14:00<br><span class="text-xs text-text-sub">19/05/2026</span></td>
                        <td class="p-4 text-brand-start font-bold">C{{ $i }}, C{{ $i+1 }}</td>
                        <td class="p-4 text-right text-white font-medium">160.000đ</td>
                        <td class="p-4 text-center">
                            <span class="inline-flex px-2 py-1 bg-success/10 text-success border border-success/20 rounded text-[10px] font-bold uppercase tracking-wider">Chưa sử dụng</span>
                        </td>
                        <td class="p-4">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('staff.tickets.valid') }}" class="w-8 h-8 rounded-lg bg-ai-start/10 text-ai-start hover:bg-ai-start hover:text-white flex items-center justify-center transition-colors">
                                    <i class="ph-bold ph-check"></i>
                                </a>
                                <button class="w-8 h-8 rounded-lg border border-dark-border text-text-sub hover:text-white hover:bg-dark-border flex items-center justify-center transition-colors">
                                    <i class="ph-bold ph-eye"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endfor

                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="p-4 border-t border-dark-border bg-dark-main/50 flex items-center justify-between text-sm">
            <span class="text-text-sub">Hiển thị 1 - 8 trong tổng số 128 vé</span>
            <div class="flex gap-1">
                <button class="w-8 h-8 flex items-center justify-center rounded-lg border border-dark-border text-text-sub hover:text-white hover:border-text-sub transition-colors disabled:opacity-50"><i class="ph ph-caret-left"></i></button>
                <button class="w-8 h-8 flex items-center justify-center rounded-lg bg-ai-start text-white font-medium">1</button>
                <button class="w-8 h-8 flex items-center justify-center rounded-lg border border-dark-border text-text-sub hover:text-white hover:border-text-sub transition-colors">2</button>
                <button class="w-8 h-8 flex items-center justify-center rounded-lg border border-dark-border text-text-sub hover:text-white hover:border-text-sub transition-colors">3</button>
                <button class="w-8 h-8 flex items-center justify-center rounded-lg border border-dark-border text-text-sub hover:text-white hover:border-text-sub transition-colors disabled:opacity-50"><i class="ph ph-caret-right"></i></button>
            </div>
        </div>

    </div>
@endsection
