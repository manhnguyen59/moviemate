@extends('layouts.admin')

@section('title', 'Chi tiết Người dùng - MovieMate Admin')
@section('page-title', 'Hồ sơ người dùng')

@section('content')
    <div class="max-w-5xl">
        
        <div class="flex justify-between items-center mb-6">
            <a href="{{ route('admin.users.index') }}" class="flex items-center gap-2 text-text-sub hover:text-white transition-colors font-medium">
                <i class="ph-bold ph-arrow-left"></i> Quay lại
            </a>
            <div class="flex gap-2">
                <button class="px-4 py-2 bg-dark-main border border-dark-border text-text-sub font-medium rounded-xl hover:text-white transition-colors flex items-center gap-2">
                    <i class="ph-bold ph-pencil-simple"></i> Sửa thông tin
                </button>
                <button class="px-4 py-2 bg-error/10 border border-error/30 text-error font-bold rounded-xl hover:bg-error hover:text-white transition-colors flex items-center gap-2">
                    <i class="ph-bold ph-lock-key"></i> Khóa tài khoản
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            <!-- Cột trái: Thông tin cá nhân -->
            <div class="space-y-6">
                
                <div class="bg-dark-card border border-dark-border rounded-2xl p-6 text-center relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-full h-24 bg-gradient-to-br from-brand-start/20 to-transparent"></div>
                    
                    <div class="w-24 h-24 rounded-full overflow-hidden border-4 border-dark-card mx-auto relative z-10 mb-4 bg-dark-main">
                        <img src="https://ui-avatars.com/api/?name=Nguyen+Manh&background=252A36&color=fff&size=128" class="w-full h-full object-cover">
                    </div>
                    
                    <h3 class="text-xl font-bold text-white mb-1 relative z-10">Nguyễn Mạnh</h3>
                    <p class="text-text-sub text-sm relative z-10 mb-4">Khách hàng (User)</p>
                    
                    <div class="inline-flex px-3 py-1.5 bg-gradient-to-r from-[#FFD700]/10 to-[#FFA500]/10 border border-[#FFD700]/30 rounded-xl relative z-10">
                        <span class="text-[#FFD700] font-bold text-xs flex items-center gap-1"><i class="ph-fill ph-crown"></i> Hạng Vàng (Gold)</span>
                    </div>

                    <div class="mt-6 pt-6 border-t border-dark-border text-left space-y-4 relative z-10">
                        <div>
                            <p class="text-xs text-text-sub mb-1">Email</p>
                            <p class="text-white font-medium text-sm">manh@example.com</p>
                        </div>
                        <div>
                            <p class="text-xs text-text-sub mb-1">Số điện thoại</p>
                            <p class="text-white font-medium text-sm">0987 654 321</p>
                        </div>
                        <div>
                            <p class="text-xs text-text-sub mb-1">Ngày tham gia</p>
                            <p class="text-white font-medium text-sm">15/01/2026</p>
                        </div>
                        <div>
                            <p class="text-xs text-text-sub mb-1">Trạng thái</p>
                            <span class="inline-flex px-2 py-1 bg-success/10 text-success rounded text-[10px] font-bold uppercase tracking-wider">Đang hoạt động</span>
                        </div>
                    </div>
                </div>

                <div class="bg-dark-card border border-dark-border rounded-2xl p-6">
                    <h3 class="font-bold text-white mb-4">Thống kê điểm</h3>
                    <div class="text-center py-4">
                        <p class="text-3xl font-bold text-brand-start mb-1">1,250</p>
                        <p class="text-xs text-text-sub uppercase tracking-wider font-medium">Điểm hiện tại</p>
                    </div>
                    <div class="space-y-3 mt-4">
                        <div class="flex justify-between text-sm">
                            <span class="text-text-sub">Tổng điểm đã tích:</span>
                            <span class="text-white font-medium">2,500</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-text-sub">Điểm đã đổi:</span>
                            <span class="text-white font-medium">1,250</span>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Cột phải: Lịch sử & Hoạt động -->
            <div class="lg:col-span-2 space-y-6">
                
                <!-- Thống kê chi tiêu -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="bg-dark-card border border-dark-border rounded-xl p-4 text-center">
                        <p class="text-xs text-text-sub mb-1">Tổng chi tiêu</p>
                        <p class="font-bold text-white text-lg">2.5M</p>
                    </div>
                    <div class="bg-dark-card border border-dark-border rounded-xl p-4 text-center">
                        <p class="text-xs text-text-sub mb-1">Số lượng vé</p>
                        <p class="font-bold text-white text-lg">24</p>
                    </div>
                    <div class="bg-dark-card border border-dark-border rounded-xl p-4 text-center">
                        <p class="text-xs text-text-sub mb-1">Đánh giá</p>
                        <p class="font-bold text-white text-lg">5</p>
                    </div>
                    <div class="bg-dark-card border border-dark-border rounded-xl p-4 text-center">
                        <p class="text-xs text-text-sub mb-1">Hủy vé</p>
                        <p class="font-bold text-error text-lg">0</p>
                    </div>
                </div>

                <!-- Lịch sử đặt vé gần đây -->
                <div class="bg-dark-card border border-dark-border rounded-2xl overflow-hidden">
                    <div class="p-6 border-b border-dark-border flex justify-between items-center">
                        <h3 class="font-bold text-white">Lịch sử đặt vé gần đây</h3>
                        <a href="{{ route('admin.bookings.index') }}" class="text-xs font-bold text-brand-start hover:text-white transition-colors">Xem tất cả đơn</a>
                    </div>
                    
                    <div class="divide-y divide-dark-border">
                        
                        <div class="p-4 flex flex-col sm:flex-row gap-4 items-start sm:items-center justify-between hover:bg-dark-main/50 transition-colors">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-14 rounded overflow-hidden flex-shrink-0">
                                    <img src="https://image.tmdb.org/t/p/w500/qJ2tW6WMUDux911r6m7haRef0WH.jpg" class="w-full h-full object-cover">
                                </div>
                                <div>
                                    <p class="font-mono text-brand-start font-bold text-sm">MMT-8A2F9B</p>
                                    <h4 class="font-bold text-white text-sm">Thanh Gươm Diệt Quỷ</h4>
                                    <p class="text-xs text-text-sub">19/05/2026 14:30</p>
                                </div>
                            </div>
                            <div class="text-left sm:text-right w-full sm:w-auto flex flex-row sm:flex-col justify-between sm:justify-start items-center sm:items-end">
                                <p class="font-bold text-white text-sm">200.000đ</p>
                                <span class="inline-flex px-2 py-1 bg-success/10 text-success rounded text-[10px] font-bold uppercase tracking-wider mt-1">Đã dùng</span>
                            </div>
                        </div>

                        <div class="p-4 flex flex-col sm:flex-row gap-4 items-start sm:items-center justify-between hover:bg-dark-main/50 transition-colors">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-14 rounded overflow-hidden flex-shrink-0">
                                    <img src="https://image.tmdb.org/t/p/w500/1pdfLvkbY9ohJlCjQH2JGjjcNsV.jpg" class="w-full h-full object-cover">
                                </div>
                                <div>
                                    <p class="font-mono text-brand-start font-bold text-sm">MMT-9B3C4D</p>
                                    <h4 class="font-bold text-white text-sm">Dune: Part Two</h4>
                                    <p class="text-xs text-text-sub">05/05/2026 09:15</p>
                                </div>
                            </div>
                            <div class="text-left sm:text-right w-full sm:w-auto flex flex-row sm:flex-col justify-between sm:justify-start items-center sm:items-end">
                                <p class="font-bold text-white text-sm">160.000đ</p>
                                <span class="inline-flex px-2 py-1 bg-success/10 text-success rounded text-[10px] font-bold uppercase tracking-wider mt-1">Đã dùng</span>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Lịch sử đánh giá -->
                <div class="bg-dark-card border border-dark-border rounded-2xl overflow-hidden">
                    <div class="p-6 border-b border-dark-border">
                        <h3 class="font-bold text-white">Đánh giá gần đây</h3>
                    </div>
                    
                    <div class="divide-y divide-dark-border">
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-2">
                                <h4 class="font-bold text-white text-sm">Dune: Part Two</h4>
                                <div class="flex text-warning text-xs">
                                    <i class="ph-fill ph-star"></i><i class="ph-fill ph-star"></i><i class="ph-fill ph-star"></i><i class="ph-fill ph-star"></i><i class="ph-fill ph-star"></i>
                                </div>
                            </div>
                            <p class="text-sm text-text-sub mb-2">"Phim quá đỉnh, hình ảnh và âm thanh Imax thực sự tuyệt vời. Sẽ xem lại lần 2!"</p>
                            <p class="text-xs text-text-sub font-medium">06/05/2026</p>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection
