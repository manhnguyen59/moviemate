@extends('layouts.user')

@section('title', 'Vé Của Tôi - MovieMate')

@section('content')
    <div class="min-h-[80vh] py-12 px-4 sm:px-6 lg:px-8 flex justify-center items-start">
        
        <div class="w-full max-w-md">
            
            <!-- Ticket Header -->
            <div class="flex items-center justify-between mb-6 px-4">
                <a href="{{ route('user.bookings.history') }}" class="text-text-sub hover:text-white transition-colors flex items-center gap-2">
                    <i class="ph-bold ph-arrow-left"></i> Lịch sử
                </a>
                <button class="text-text-sub hover:text-white transition-colors flex items-center gap-2" onclick="window.print()">
                    <i class="ph-bold ph-download-simple"></i> Lưu vé
                </button>
            </div>

            <!-- Ticket Card -->
            <div class="bg-white rounded-3xl overflow-hidden shadow-2xl relative">
                
                <!-- Ticket Top (Branding) -->
                <div class="bg-gradient-to-r from-brand-start to-brand-end p-6 text-center relative overflow-hidden">
                    <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>
                    <div class="relative z-10">
                        <i class="ph-fill ph-film-strip text-4xl text-white/80 mb-2"></i>
                        <h2 class="text-2xl font-bold text-white tracking-widest uppercase">MovieMate Ticket</h2>
                    </div>
                </div>

                <!-- Ticket Middle (QR) -->
                <div class="p-8 text-center bg-white border-b-2 border-dashed border-gray-200 relative">
                    <!-- Notches -->
                    <div class="absolute -bottom-4 -left-4 w-8 h-8 bg-dark-main rounded-full"></div>
                    <div class="absolute -bottom-4 -right-4 w-8 h-8 bg-dark-main rounded-full"></div>
                    
                    <div class="inline-block p-4 border-4 border-gray-100 rounded-2xl mb-4">
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=MMT-2026-0001&color=FF3D57&bgcolor=ffffff" alt="QR Code" class="w-40 h-40">
                    </div>
                    <p class="text-gray-500 text-sm font-medium">Mã quét vé tại cổng rạp</p>
                    <p class="text-2xl font-bold text-gray-900 font-mono mt-1 tracking-widest">MMT-2026-0001</p>
                </div>

                <!-- Ticket Bottom (Info) -->
                <div class="p-8 bg-white text-gray-900">
                    <div class="text-center mb-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-1">Thanh Gươm Diệt Quỷ</h3>
                        <p class="text-gray-500 font-medium">2D Phụ Đề Việt</p>
                    </div>

                    <div class="grid grid-cols-2 gap-y-6 gap-x-4 mb-6">
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-wider mb-1">Ngày chiếu</p>
                            <p class="font-bold text-gray-900">19/05/2026</p>
                        </div>
                        <div class="text-right">
                            <p class="text-xs text-gray-400 uppercase tracking-wider mb-1">Giờ chiếu</p>
                            <p class="font-bold text-gray-900 text-brand-start">09:30</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-wider mb-1">Rạp</p>
                            <p class="font-bold text-gray-900">MovieMate Cầu Giấy</p>
                        </div>
                        <div class="text-right">
                            <p class="text-xs text-gray-400 uppercase tracking-wider mb-1">Phòng chiếu</p>
                            <p class="font-bold text-gray-900">Phòng 3</p>
                        </div>
                    </div>

                    <div class="bg-gray-50 rounded-xl p-4 flex justify-between items-center mb-6">
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-wider mb-1">Ghế ngồi</p>
                            <p class="text-2xl font-bold text-gray-900">F7, F8</p>
                        </div>
                        <div class="text-right">
                            <p class="text-xs text-gray-400 uppercase tracking-wider mb-1">Tổng tiền</p>
                            <p class="text-lg font-bold text-gray-900">160.000đ</p>
                        </div>
                    </div>

                    <div class="text-center flex justify-center">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-green-100 text-green-700 text-sm font-bold border border-green-200">
                            <i class="ph-fill ph-check-circle"></i> Chưa sử dụng
                        </span>
                    </div>
                </div>

            </div>

            <!-- Notes -->
            <div class="mt-6 text-center text-xs text-text-sub space-y-2">
                <p>Vui lòng xuất trình mã QR này cho nhân viên soát vé tại rạp.</p>
                <p>Nên đến rạp trước 15 phút để đảm bảo trải nghiệm tốt nhất.</p>
            </div>

        </div>

    </div>
@endsection