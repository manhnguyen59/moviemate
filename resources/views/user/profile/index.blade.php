@extends('layouts.user')

@section('title', 'Trang cá nhân - MovieMate')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <div class="app-card border app-border rounded-2xl p-6 flex flex-col items-center text-center sticky top-24">
                    <div class="relative w-20 h-20 rounded-full overflow-hidden mb-3 border-2 border-brand-start">
                        <img src="https://ui-avatars.com/api/?name=Nguyen+Manh&background=FF3D57&color=fff&size=128"
                             alt="Avatar" class="w-full h-full object-cover">
                        <button class="absolute bottom-0 inset-x-0 bg-black/60 text-white text-[10px] py-1 hover:bg-brand-start transition-colors">
                            Đổi ảnh
                        </button>
                    </div>
                    <h2 class="text-lg font-bold app-text mb-0.5">Nguyễn Mạnh</h2>
                    <p class="text-xs text-ai-start font-bold mb-5">Hạng Vàng ✦</p>

                    <div class="w-full space-y-1 text-left">
                        <a href="{{ route('user.profile') }}" class="flex items-center gap-3 px-4 py-2.5 bg-brand-start/10 text-brand-start rounded-xl font-bold border border-brand-start/20 text-sm">
                            <i class="ph-fill ph-user text-lg"></i> Thông tin cá nhân
                        </a>
                        <a href="{{ route('user.bookings.history') }}" class="flex items-center gap-3 px-4 py-2.5 app-muted hover:app-text hover:bg-brand-start/5 rounded-xl font-medium transition-colors text-sm">
                            <i class="ph ph-ticket text-lg"></i> Lịch sử đặt vé
                        </a>
                        <a href="#" class="flex items-center gap-3 px-4 py-2.5 app-muted hover:app-text hover:bg-brand-start/5 rounded-xl font-medium transition-colors text-sm">
                            <i class="ph ph-star text-lg"></i> Đánh giá của tôi
                        </a>
                        <a href="#" class="flex items-center gap-3 px-4 py-2.5 app-muted hover:app-text hover:bg-brand-start/5 rounded-xl font-medium transition-colors text-sm">
                            <i class="ph ph-lock-key text-lg"></i> Đổi mật khẩu
                        </a>
                        <hr class="app-border my-2">
                        <a href="#" class="flex items-center gap-3 px-4 py-2.5 text-error hover:bg-error/10 rounded-xl font-medium transition-colors text-sm">
                            <i class="ph ph-sign-out text-lg"></i> Đăng xuất
                        </a>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="lg:col-span-3">
                <div class="app-card border app-border rounded-2xl p-6 sm:p-8">
                    <h1 class="text-xl font-bold app-text mb-6 pb-4 border-b app-border">Thông tin cá nhân</h1>

                    <form action="#" method="POST" class="space-y-5">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label for="name" class="block text-sm font-medium app-muted mb-1.5">Họ và tên</label>
                                <input type="text" id="name" name="name" value="Nguyễn Mạnh"
                                       class="app-input w-full px-4 py-2.5 border app-border rounded-xl focus:outline-none focus:border-brand-start focus:ring-1 focus:ring-brand-start transition-colors text-sm">
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium app-muted mb-1.5">Email</label>
                                <input type="email" id="email" name="email" value="manh@example.com"
                                       class="app-input w-full px-4 py-2.5 border app-border rounded-xl text-sm opacity-60 cursor-not-allowed" disabled>
                                <p class="text-xs app-muted mt-1">Email không thể thay đổi</p>
                            </div>

                            <div>
                                <label for="phone" class="block text-sm font-medium app-muted mb-1.5">Số điện thoại</label>
                                <input type="tel" id="phone" name="phone" value="0987654321"
                                       class="app-input w-full px-4 py-2.5 border app-border rounded-xl focus:outline-none focus:border-brand-start focus:ring-1 focus:ring-brand-start transition-colors text-sm">
                            </div>

                            <div>
                                <label for="city" class="block text-sm font-medium app-muted mb-1.5">Khu vực / Thành phố</label>
                                <select id="city" name="city" class="app-input w-full px-4 py-2.5 border app-border rounded-xl focus:outline-none focus:border-brand-start transition-colors appearance-none text-sm">
                                    <option value="Hà Nội" selected>Hà Nội</option>
                                    <option value="Hồ Chí Minh">TP. Hồ Chí Minh</option>
                                    <option value="Đà Nẵng">Đà Nẵng</option>
                                </select>
                            </div>

                            <div>
                                <label for="dob" class="block text-sm font-medium app-muted mb-1.5">Ngày sinh</label>
                                <input type="date" id="dob" name="dob" value="2000-01-01"
                                       class="app-input w-full px-4 py-2.5 border app-border rounded-xl focus:outline-none focus:border-brand-start transition-colors text-sm [color-scheme:dark]">
                            </div>

                            <div>
                                <label class="block text-sm font-medium app-muted mb-1.5">Giới tính</label>
                                <div class="flex items-center gap-6 mt-3">
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input type="radio" name="gender" value="male" checked class="text-brand-start focus:ring-brand-start">
                                        <span class="app-text text-sm">Nam</span>
                                    </label>
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input type="radio" name="gender" value="female" class="text-brand-start focus:ring-brand-start">
                                        <span class="app-text text-sm">Nữ</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="pt-5 border-t app-border flex justify-end">
                            <button type="submit" class="px-8 py-2.5 bg-gradient-to-r from-brand-start to-brand-end text-white rounded-xl font-bold text-sm hover:shadow-lg hover:shadow-brand-start/20 transition-all transform hover:-translate-y-0.5">
                                Cập nhật thông tin
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection