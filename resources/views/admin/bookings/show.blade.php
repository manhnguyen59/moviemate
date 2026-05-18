@extends('layouts.admin')

@section('title', 'Chi tiết đơn đặt vé - MovieMate Admin')
@section('page-title', 'Chi tiết đơn đặt vé')

@section('content')
    <div class="max-w-4xl">
        
        <div class="flex justify-between items-center mb-6">
            <a href="{{ route('admin.bookings.index') }}" class="flex items-center gap-2 text-text-sub hover:text-white transition-colors font-medium">
                <i class="ph-bold ph-arrow-left"></i> Quay lại
            </a>
            <div class="flex gap-2">
                <button class="px-4 py-2 bg-dark-main border border-dark-border text-white text-sm font-medium rounded-xl hover:border-brand-start transition-colors flex items-center gap-2">
                    <i class="ph ph-printer"></i> In vé
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            
            <!-- Cột trái: Thông tin vé -->
            <div class="md:col-span-2 space-y-6">
                
                <div class="bg-dark-card border border-dark-border rounded-2xl p-6 relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-brand-start to-brand-end"></div>
                    
                    <div class="flex justify-between items-start mb-6">
                        <div>
                            <h3 class="text-lg font-bold text-white mb-1">Mã đơn: <span class="font-mono text-brand-start">MMT-8A2F9B</span></h3>
                            <p class="text-sm text-text-sub">Ngày đặt: 19/05/2026 14:30</p>
                        </div>
                        <span class="inline-flex px-3 py-1.5 bg-success/10 text-success border border-success/20 rounded font-bold uppercase tracking-wider text-xs">
                            Đã thanh toán
                        </span>
                    </div>

                    <div class="flex gap-6 py-6 border-y border-dark-border border-dashed mb-6">
                        <div class="w-24 h-36 flex-shrink-0 rounded-lg overflow-hidden border border-dark-border">
                            <img src="https://image.tmdb.org/t/p/w500/qJ2tW6WMUDux911r6m7haRef0WH.jpg" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <h4 class="text-xl font-bold text-white mb-2">Thanh Gươm Diệt Quỷ: Chuyến Tàu Vô Tận</h4>
                            <p class="text-sm text-text-sub mb-4">MovieMate Hà Nội • Room 01 (2D)</p>
                            
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <p class="text-xs text-text-sub mb-1 uppercase tracking-wider">Suất chiếu</p>
                                    <p class="font-bold text-white">19:30 - 19/05/2026</p>
                                </div>
                                <div>
                                    <p class="text-xs text-text-sub mb-1 uppercase tracking-wider">Ghế đã chọn</p>
                                    <p class="font-bold text-brand-start text-lg">G4, G5</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h4 class="font-bold text-white mb-4">Chi tiết thanh toán</h4>
                        <div class="space-y-3 text-sm">
                            <div class="flex justify-between text-text-sub">
                                <span>Ghế VIP (x2)</span>
                                <span>200.000đ</span>
                            </div>
                            <div class="flex justify-between text-text-sub">
                                <span>Combo Bắp Nước (x0)</span>
                                <span>0đ</span>
                            </div>
                            <div class="flex justify-between text-success">
                                <span>Mã giảm giá (NEWUSER)</span>
                                <span>-20.000đ</span>
                            </div>
                            <div class="flex justify-between items-center pt-3 border-t border-dark-border mt-3">
                                <span class="font-bold text-white">Tổng cộng</span>
                                <span class="text-2xl font-bold text-brand-start">180.000đ</span>
                            </div>
                        </div>
                        <div class="mt-4 p-3 bg-dark-main border border-dark-border rounded-xl text-xs text-text-sub flex justify-between items-center">
                            <span>Phương thức: <strong class="text-white">VNPay</strong></span>
                            <span>Mã GD: <strong class="text-white font-mono">VNP123456789</strong></span>
                        </div>
                    </div>

                </div>

            </div>

            <!-- Cột phải: Khách hàng & Hành động -->
            <div class="space-y-6">
                
                <div class="bg-dark-card border border-dark-border rounded-2xl p-6">
                    <h3 class="font-bold text-white mb-4">Thông tin khách hàng</h3>
                    
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-12 h-12 rounded-full bg-dark-main border border-dark-border flex items-center justify-center text-text-sub">
                            <i class="ph-bold ph-user text-xl"></i>
                        </div>
                        <div>
                            <p class="font-bold text-white">Nguyễn Mạnh</p>
                            <p class="text-xs text-text-sub">Thành viên Bạc</p>
                        </div>
                    </div>

                    <div class="space-y-4 text-sm">
                        <div>
                            <p class="text-xs text-text-sub mb-1">Số điện thoại</p>
                            <p class="text-white font-medium">0987 654 321</p>
                        </div>
                        <div>
                            <p class="text-xs text-text-sub mb-1">Email</p>
                            <p class="text-white font-medium">manh@example.com</p>
                        </div>
                        <div>
                            <p class="text-xs text-text-sub mb-1">Đã đặt tại hệ thống</p>
                            <p class="text-white font-medium">12 vé</p>
                        </div>
                    </div>
                </div>

                <div class="bg-dark-card border border-dark-border rounded-2xl p-6">
                    <h3 class="font-bold text-white mb-4">Trạng thái sử dụng vé</h3>
                    
                    <div class="text-center mb-4">
                        <div class="inline-flex px-4 py-2 bg-brand-start/10 text-brand-start border border-brand-start/20 rounded-xl font-bold mb-2">
                            <i class="ph-fill ph-ticket mr-2"></i> Chưa sử dụng
                        </div>
                        <p class="text-xs text-text-sub">Khách hàng chưa check-in tại rạp.</p>
                    </div>

                    <!-- Nút Hủy vé (Nếu chưa chiếu và chưa dùng) -->
                    <button class="w-full py-2.5 bg-error/10 border border-error/30 text-error font-bold rounded-xl hover:bg-error hover:text-white transition-colors text-sm">
                        Hủy đơn & Hoàn tiền
                    </button>
                    <p class="text-[10px] text-text-sub text-center mt-2">Chỉ hỗ trợ hủy vé trước giờ chiếu 30 phút.</p>
                </div>

            </div>

        </div>
    </div>
@endsection
