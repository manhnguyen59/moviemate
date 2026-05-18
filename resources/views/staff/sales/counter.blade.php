@extends('layouts.staff')

@section('title', 'Bán vé tại quầy - MovieMate Staff')
@section('page-title', 'Bán vé tại quầy')

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Left Column: Forms -->
        <div class="lg:col-span-2 space-y-6">
            
            <!-- Step 1: Chọn suất chiếu -->
            <div class="bg-dark-card border border-dark-border rounded-2xl p-6">
                <h2 class="text-lg font-bold text-white mb-4 flex items-center gap-2">
                    <span class="w-6 h-6 rounded-full bg-brand-start text-white text-xs flex items-center justify-center">1</span>
                    Chọn phim và suất chiếu
                </h2>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-xs font-medium text-text-sub mb-1">Rạp chiếu</label>
                        <select class="w-full px-3 py-2 bg-dark-main border border-dark-border rounded-lg text-white focus:outline-none focus:border-brand-start text-sm">
                            <option>MovieMate Cầu Giấy</option>
                            <option>MovieMate Hà Đông</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-text-sub mb-1">Ngày chiếu</label>
                        <input type="date" value="2026-05-19" class="w-full px-3 py-2 bg-dark-main border border-dark-border rounded-lg text-white focus:outline-none focus:border-brand-start text-sm [color-scheme:dark]">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-medium text-text-sub mb-2">Chọn Phim</label>
                    <select class="w-full px-3 py-2 bg-dark-main border border-dark-border rounded-lg text-white focus:outline-none focus:border-brand-start text-sm mb-4">
                        <option>Thanh Gươm Diệt Quỷ - 2D Phụ Đề (Đang chiếu)</option>
                        <option>Dune: Part Two - IMAX 2D</option>
                        <option>Lật Mặt 8 - 2D Lồng Tiếng</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-medium text-text-sub mb-2">Chọn suất</label>
                    <div class="flex flex-wrap gap-2">
                        <button class="px-4 py-2 border border-brand-start bg-brand-start/10 text-brand-start rounded-lg text-sm font-bold">09:30 (P.3)</button>
                        <button class="px-4 py-2 border border-dark-border bg-dark-main text-white hover:border-brand-start rounded-lg text-sm transition-colors">11:45 (P.3)</button>
                        <button class="px-4 py-2 border border-dark-border bg-dark-main text-white hover:border-brand-start rounded-lg text-sm transition-colors">14:00 (P.3)</button>
                        <button class="px-4 py-2 border border-dark-border bg-dark-main text-text-sub opacity-50 cursor-not-allowed rounded-lg text-sm line-through">18:30 (Hết vé)</button>
                    </div>
                </div>
            </div>

            <!-- Step 2: Chọn ghế -->
            <div class="bg-dark-card border border-dark-border rounded-2xl p-6">
                <h2 class="text-lg font-bold text-white mb-4 flex items-center gap-2">
                    <span class="w-6 h-6 rounded-full bg-brand-start text-white text-xs flex items-center justify-center">2</span>
                    Chọn ghế
                </h2>

                <!-- Mini Seat Map -->
                <div class="overflow-x-auto hide-scrollbar pb-4">
                    <div class="min-w-[400px] flex flex-col items-center gap-2">
                        <!-- Screen -->
                        <div class="w-64 h-1 bg-brand-start/50 rounded-t-[100%] shadow-[0_5px_15px_rgba(255,61,87,0.3)] mb-6 relative">
                            <span class="absolute top-2 left-1/2 -translate-x-1/2 text-[10px] text-text-sub uppercase tracking-wider">Màn hình</span>
                        </div>

                        @php $rows = ['A', 'B', 'C', 'D', 'E']; @endphp
                        @foreach($rows as $row)
                            <div class="flex items-center gap-2">
                                <div class="w-4 text-center text-text-sub text-xs font-bold">{{ $row }}</div>
                                <div class="flex gap-1">
                                    @for($i = 1; $i <= 10; $i++)
                                        @php
                                            $status = 'normal';
                                            if($row == 'D' || $row == 'C') $status = 'vip';
                                            if($row == 'B' && in_array($i, [4,5,6])) $status = 'booked';
                                            if($row == 'C' && in_array($i, [5,6])) $status = 'selected';
                                        @endphp
                                        <button class="w-6 h-6 rounded border transition-all text-[8px] font-medium flex items-center justify-center
                                            {{ $status == 'normal' ? 'bg-dark-main border-dark-border text-text-sub hover:border-brand-start' : '' }}
                                            {{ $status == 'vip' ? 'bg-ai-start/10 border-ai-start/50 text-ai-start hover:bg-ai-start hover:text-white' : '' }}
                                            {{ $status == 'selected' ? 'bg-brand-start border-brand-start text-white shadow-lg' : '' }}
                                            {{ $status == 'booked' ? 'bg-dark-border border-dark-border text-dark-border/50 cursor-not-allowed' : '' }}
                                            {{ $i == 5 ? 'mr-4' : '' }}
                                        " {{ $status == 'booked' ? 'disabled' : '' }}>
                                            {{ $i }}
                                        </button>
                                    @endfor
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Legend Mini -->
                <div class="flex justify-center gap-4 mt-4 text-xs text-text-sub pt-4 border-t border-dark-border">
                    <div class="flex items-center gap-1"><div class="w-4 h-4 rounded bg-dark-main border border-dark-border"></div> Thường</div>
                    <div class="flex items-center gap-1"><div class="w-4 h-4 rounded bg-ai-start/10 border border-ai-start/50"></div> VIP</div>
                    <div class="flex items-center gap-1"><div class="w-4 h-4 rounded bg-brand-start border border-brand-start"></div> Đang chọn</div>
                    <div class="flex items-center gap-1"><div class="w-4 h-4 rounded bg-dark-border border border-dark-border"></div> Đã đặt</div>
                </div>
            </div>

            <!-- Step 3: Thông tin khách -->
            <div class="bg-dark-card border border-dark-border rounded-2xl p-6">
                <h2 class="text-lg font-bold text-white mb-4 flex items-center gap-2">
                    <span class="w-6 h-6 rounded-full bg-brand-start text-white text-xs flex items-center justify-center">3</span>
                    Thông tin khách hàng
                </h2>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <input type="text" class="w-full px-4 py-2.5 bg-dark-main border border-dark-border rounded-xl text-white focus:outline-none focus:border-brand-start transition-colors text-sm" placeholder="Họ tên khách (Không bắt buộc)">
                    </div>
                    <div>
                        <input type="tel" class="w-full px-4 py-2.5 bg-dark-main border border-dark-border rounded-xl text-white focus:outline-none focus:border-brand-start transition-colors text-sm" placeholder="Số điện thoại (Không bắt buộc)">
                    </div>
                </div>
                <p class="text-xs text-text-sub mt-2"><i class="ph-fill ph-info"></i> Nhập SĐT để khách hàng tích điểm thành viên (nếu có).</p>
            </div>

        </div>

        <!-- Right Column: Summary -->
        <div class="lg:col-span-1">
            <div class="bg-dark-card border border-dark-border rounded-2xl sticky top-24 overflow-hidden">
                <div class="p-4 border-b border-dark-border bg-dark-main/50">
                    <h3 class="font-bold text-white text-center">Tóm tắt đơn hàng</h3>
                </div>
                
                <div class="p-6">
                    <h4 class="font-bold text-brand-start text-lg mb-1 leading-tight">Thanh Gươm Diệt Quỷ</h4>
                    <p class="text-xs text-text-sub mb-4">2D Phụ Đề Việt - Độ tuổi: T13</p>

                    <div class="space-y-3 text-sm border-b border-dark-border pb-4 mb-4">
                        <div class="flex justify-between">
                            <span class="text-text-sub">Rạp:</span>
                            <span class="text-white font-medium text-right">Cầu Giấy</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-text-sub">Suất chiếu:</span>
                            <span class="text-white font-medium text-right">09:30 - Hôm nay</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-text-sub">Phòng chiếu:</span>
                            <span class="text-white font-medium text-right">Phòng 3</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-text-sub">Ghế chọn (2):</span>
                            <span class="text-white font-bold text-right">C5, C6 (VIP)</span>
                        </div>
                    </div>

                    <div class="space-y-2 mb-6">
                        <div class="flex justify-between text-sm">
                            <span class="text-text-sub">Tiền vé:</span>
                            <span class="text-white font-medium">160.000đ</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-text-sub">Bắp nước:</span>
                            <span class="text-white font-medium">0đ</span>
                        </div>
                        <div class="flex justify-between items-center pt-2">
                            <span class="text-text-sub font-bold uppercase tracking-wider text-xs">Tổng thu:</span>
                            <span class="text-2xl font-bold text-brand-start">160.000đ</span>
                        </div>
                    </div>

                    <div class="flex flex-col gap-3">
                        <button class="w-full py-4 bg-gradient-to-r from-brand-start to-brand-end text-white rounded-xl font-bold text-lg hover:shadow-lg hover:shadow-brand-start/30 transition-transform transform hover:-translate-y-0.5 flex items-center justify-center gap-2">
                            <i class="ph-bold ph-printer"></i> In vé & Thanh toán
                        </button>
                        <button class="w-full py-3 bg-dark-main border border-dark-border text-white rounded-xl font-medium hover:bg-dark-border hover:text-error transition-colors">
                            Hủy giao dịch
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
