@extends('layouts.staff')

@section('title', 'Vé Hợp Lệ - MovieMate Staff')
@section('page-title', 'Kết quả kiểm tra vé')

@section('content')
    <div class="max-w-xl mx-auto">
        
        <div class="bg-success/10 border-2 border-success rounded-3xl p-8 text-center shadow-lg shadow-success/20 mb-6">
            
            <div class="w-20 h-20 bg-success text-white rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg shadow-success/40">
                <i class="ph-bold ph-check text-4xl"></i>
            </div>

            <h2 class="text-3xl font-bold text-success mb-2">Vé Hợp Lệ</h2>
            <p class="text-text-sub font-medium mb-6">Vé chưa được sử dụng và đúng suất chiếu hiện tại.</p>

            <div class="bg-dark-card border border-dark-border rounded-2xl p-6 text-left mb-8">
                <div class="border-b border-dark-border pb-4 mb-4 flex justify-between items-center">
                    <div>
                        <p class="text-xs text-text-sub uppercase tracking-wider mb-1">Mã đặt vé</p>
                        <p class="text-xl font-bold text-white font-mono">MMT-2026-0001</p>
                    </div>
                    <div class="px-3 py-1 bg-success/20 text-success text-xs font-bold rounded uppercase">
                        Chưa sử dụng
                    </div>
                </div>

                <div class="space-y-4 text-sm">
                    <div class="flex justify-between">
                        <span class="text-text-sub">Khách hàng</span>
                        <span class="text-white font-medium">Nguyễn Mạnh</span>
                    </div>
                    <div class="flex justify-between items-start">
                        <span class="text-text-sub">Phim</span>
                        <span class="text-white font-bold text-right max-w-[60%]">Thanh Gươm Diệt Quỷ</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-text-sub">Rạp / Phòng</span>
                        <span class="text-white font-medium text-right">MovieMate Cầu Giấy / Phòng 3</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-text-sub">Suất chiếu</span>
                        <span class="text-success font-bold text-right">09:30 - Thứ 3, 19/05/2026</span>
                    </div>
                    <div class="flex justify-between pt-4 border-t border-dark-border">
                        <span class="text-text-sub">Ghế</span>
                        <span class="text-2xl text-white font-bold text-right">F7, F8</span>
                    </div>
                    <div class="flex justify-between pt-2">
                        <span class="text-text-sub">Loại vé</span>
                        <span class="text-white font-medium text-right">2x Ghế VIP (160.000đ)</span>
                    </div>
                </div>
            </div>

            <div class="flex flex-col gap-3">
                <button class="w-full py-4 bg-success text-white rounded-xl font-bold text-lg hover:bg-success/90 hover:shadow-lg hover:shadow-success/30 transition-all">
                    Xác nhận cho khách vào rạp
                </button>
                <a href="{{ route('staff.tickets.check') }}" class="w-full py-3 bg-dark-main border border-dark-border text-white rounded-xl font-medium hover:bg-dark-border transition-colors">
                    Quay lại quét vé
                </a>
            </div>

        </div>

    </div>
@endsection
