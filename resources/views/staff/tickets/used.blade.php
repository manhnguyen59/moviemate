@extends('layouts.staff')

@section('title', 'Vé Đã Sử Dụng - MovieMate Staff')
@section('page-title', 'Kết quả kiểm tra vé')

@section('content')
    <div class="max-w-xl mx-auto">
        
        <div class="bg-warning/10 border-2 border-warning rounded-3xl p-8 text-center shadow-lg shadow-warning/20 mb-6">
            
            <div class="w-20 h-20 bg-warning text-white rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg shadow-warning/40">
                <i class="ph-bold ph-warning text-4xl"></i>
            </div>

            <h2 class="text-3xl font-bold text-warning mb-2">Vé Đã Được Sử Dụng</h2>
            <p class="text-text-sub font-medium mb-6">Vé này đã được check-in trước đó. Không thể sử dụng lại.</p>

            <div class="bg-dark-card border border-dark-border rounded-2xl p-6 text-left mb-8">
                <div class="border-b border-dark-border pb-4 mb-4 flex justify-between items-center">
                    <div>
                        <p class="text-xs text-text-sub uppercase tracking-wider mb-1">Mã đặt vé</p>
                        <p class="text-xl font-bold text-white font-mono">MMT-2026-0002</p>
                    </div>
                    <div class="px-3 py-1 bg-warning/20 text-warning text-xs font-bold rounded uppercase">
                        Đã sử dụng
                    </div>
                </div>

                <div class="space-y-4 text-sm mb-6">
                    <div class="flex justify-between items-start">
                        <span class="text-text-sub">Phim</span>
                        <span class="text-white font-bold text-right max-w-[60%]">Dune: Part Two</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-text-sub">Ghế</span>
                        <span class="text-white font-bold text-right">H10, H11</span>
                    </div>
                </div>

                <div class="bg-dark-main border border-dark-border rounded-xl p-4">
                    <p class="text-xs text-text-sub uppercase tracking-wider mb-3 font-bold">Lịch sử Check-in</p>
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span class="text-text-sub">Thời gian quét:</span>
                            <span class="text-white font-medium">10/05/2026 19:45:22</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-text-sub">Nhân viên trực:</span>
                            <span class="text-white font-medium">Nguyễn Văn Staff</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-text-sub">Cổng soát vé:</span>
                            <span class="text-white font-medium">Cửa số 2</span>
                        </div>
                    </div>
                </div>
            </div>

            <a href="{{ route('staff.tickets.check') }}" class="block w-full py-4 bg-dark-main border border-dark-border text-white rounded-xl font-bold hover:bg-dark-border transition-colors">
                Kiểm tra vé khác
            </a>

        </div>

    </div>
@endsection
