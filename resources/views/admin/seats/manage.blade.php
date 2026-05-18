@extends('layouts.admin')

@section('title', 'Quản lý Sơ đồ ghế - MovieMate Admin')
@section('page-title', 'Sơ đồ ghế: Room 01')

@section('content')
    <div class="grid grid-cols-1 xl:grid-cols-4 gap-6">

        <!-- Left: Seat Map Editor -->
        <div class="xl:col-span-3">
            <div class="app-card border app-border rounded-2xl p-5 md:p-7 overflow-x-auto hide-scrollbar">

                <div class="flex justify-between items-center mb-8 min-w-[580px]">
                    <div>
                        <h3 class="text-lg font-bold app-text mb-0.5">Thiết kế sơ đồ ghế</h3>
                        <p class="text-xs app-muted">Click để thay đổi loại ghế cho từng vị trí</p>
                    </div>
                    <div class="flex gap-2">
                        <button class="px-3 py-2 app-secondary border app-border app-muted hover:app-text hover:border-brand-start text-sm font-medium rounded-lg transition-colors flex items-center gap-1.5">
                            <i class="ph ph-magic-wand"></i> Tạo tự động
                        </button>
                        <button class="px-3 py-2 bg-error/10 border border-error/30 text-error text-sm font-bold rounded-lg hover:bg-error hover:text-white transition-colors">
                            Xóa trắng
                        </button>
                    </div>
                </div>

                <!-- Screen -->
                <div class="min-w-[580px] mb-12 flex flex-col items-center">
                    <div class="w-3/4 max-w-2xl h-2 bg-brand-start/50 rounded-t-[100%] shadow-[0_10px_30px_rgba(255,61,87,0.35)]"></div>
                    <span class="text-xs app-muted uppercase tracking-widest font-bold mt-4">Màn hình chiếu</span>
                </div>

                <!-- Seats -->
                <div class="min-w-[580px] flex flex-col items-center gap-2.5">
                    @php $rows = ['A','B','C','D','E','F','G','H']; @endphp
                    @foreach($rows as $row)
                        <div class="flex items-center gap-3">
                            <div class="w-5 text-center app-muted font-bold text-xs">{{ $row }}</div>

                            <div class="flex gap-1.5">
                                @for($i = 1; $i <= 12; $i++)
                                    @php
                                        $status = 'normal';
                                        if(in_array($row, ['D','E','F'])) $status = 'vip';
                                        if($row == 'B' && in_array($i, [5,6])) $status = 'broken';
                                        if($row == 'A' && in_array($i, [1,12])) $status = 'empty';
                                        if($row == 'G' && $i == 4) $status = 'selected';
                                    @endphp

                                    @if($status == 'empty')
                                        <div class="w-8 h-8 md:w-9 md:h-9 border border-dashed border-[var(--border-color)] rounded-lg flex items-center justify-center cursor-pointer hover:border-brand-start/50 transition-colors {{ $i == 6 ? 'mr-5' : '' }}">
                                            <i class="ph ph-plus text-xs app-muted"></i>
                                        </div>
                                    @else
                                        <button class="w-8 h-8 md:w-9 md:h-9 rounded-lg border transition-all text-[10px] font-bold flex items-center justify-center
                                            {{ $status == 'normal'   ? 'app-input border-[var(--border-color)] app-muted hover:border-brand-start hover:text-brand-start' : '' }}
                                            {{ $status == 'vip'      ? 'bg-ai-start/10 border-ai-start/50 text-ai-start hover:bg-ai-start hover:text-white' : '' }}
                                            {{ $status == 'broken'   ? 'bg-error/10 border-error/50 text-error hover:bg-error hover:text-white' : '' }}
                                            {{ $status == 'selected' ? 'bg-brand-start border-brand-start text-white shadow-lg shadow-brand-start/40 scale-110' : '' }}
                                            {{ $i == 6 ? 'mr-5' : '' }}"
                                            title="Ghế {{ $row }}{{ $i }}">
                                            {{ $status == 'broken' ? '!' : $i }}
                                        </button>
                                    @endif
                                @endfor
                            </div>

                            <div class="w-5 text-center app-muted font-bold text-xs">{{ $row }}</div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>

        <!-- Right: Settings & Stats -->
        <div class="space-y-5">

            <div class="app-card border app-border rounded-2xl p-5">
                <h3 class="font-bold app-text mb-3 text-sm">Thông tin phòng</h3>
                <div class="space-y-2.5 text-sm mb-5 pb-5 border-b app-border">
                    <div class="flex justify-between">
                        <span class="app-muted text-xs">Rạp:</span>
                        <span class="app-text font-medium text-xs text-right">MovieMate Hà Nội</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="app-muted text-xs">Phòng:</span>
                        <span class="app-text font-medium text-xs text-right">Room 01 (2D)</span>
                    </div>
                </div>

                <h3 class="font-bold app-text mb-3 text-sm">Thống kê ghế</h3>
                <div class="space-y-2 text-sm">
                    <div class="flex justify-between items-center p-2 rounded-lg app-secondary border app-border">
                        <div class="flex items-center gap-2">
                            <div class="w-3.5 h-3.5 rounded app-secondary border app-border"></div>
                            <span class="app-muted text-xs">Ghế thường</span>
                        </div>
                        <span class="app-text font-bold">56</span>
                    </div>
                    <div class="flex justify-between items-center p-2 rounded-lg bg-ai-start/10 border border-ai-start/30">
                        <div class="flex items-center gap-2">
                            <div class="w-3.5 h-3.5 rounded bg-ai-start/10 border border-ai-start/50"></div>
                            <span class="text-ai-start font-bold text-xs">Ghế VIP</span>
                        </div>
                        <span class="text-ai-start font-bold">36</span>
                    </div>
                    <div class="flex justify-between items-center p-2 rounded-lg bg-error/10 border border-error/30">
                        <div class="flex items-center gap-2">
                            <div class="w-3.5 h-3.5 rounded bg-error/10 border border-error/50"></div>
                            <span class="text-error font-bold text-xs">Bảo trì</span>
                        </div>
                        <span class="text-error font-bold">2</span>
                    </div>
                    <div class="flex justify-between items-center p-2 mt-1">
                        <span class="app-muted font-bold uppercase tracking-wider text-[10px]">Tổng sức chứa</span>
                        <span class="text-xl font-bold text-brand-start">94</span>
                    </div>
                </div>
            </div>

            <div class="app-card border app-border rounded-2xl p-5">
                <h3 class="font-bold app-text mb-3 text-sm">Công cụ chọn</h3>
                <div class="grid grid-cols-2 gap-2 mb-5">
                    <button class="py-2 app-input border border-brand-start rounded-lg app-text text-xs font-bold">Click chọn</button>
                    <button class="py-2 app-secondary border app-border app-muted hover:app-text transition-colors rounded-lg text-xs font-medium">Quét vùng</button>
                </div>

                <h3 class="font-bold app-text mb-3 text-sm">Áp dụng loại ghế</h3>
                <div class="space-y-2 mb-5">
                    <button class="w-full py-2 app-secondary border app-border app-muted hover:border-brand-start hover:text-brand-start rounded-lg text-xs transition-colors">Ghế Thường</button>
                    <button class="w-full py-2 bg-ai-start/10 border border-ai-start/30 rounded-lg text-ai-start font-bold text-xs hover:bg-ai-start hover:text-white transition-colors">Ghế VIP</button>
                    <button class="w-full py-2 bg-error/10 border border-error/30 rounded-lg text-error font-bold text-xs hover:bg-error hover:text-white transition-colors">Đánh dấu Bảo Trì</button>
                    <button class="w-full py-2 app-secondary border border-dashed app-border app-muted hover:app-text rounded-lg text-xs transition-colors">Xóa ghế (Tạo lối đi)</button>
                </div>

                <button class="w-full py-3 bg-gradient-to-r from-brand-start to-brand-end text-white rounded-xl font-bold text-sm hover:shadow-lg hover:shadow-brand-start/30 transition-all hover:-translate-y-0.5">
                    Lưu sơ đồ
                </button>
            </div>

        </div>
    </div>
@endsection
