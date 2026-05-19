@extends('layouts.user')

@section('title', 'Đăng nhập - MovieMate')

@section('content')
    <div class="min-h-[calc(100svh-4rem)] md:min-h-[calc(100svh-5rem)] flex">
        <!-- Left Side: Image/Branding -->
        <div class="hidden lg:flex w-1/2 relative app-secondary border-r app-border overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-t from-[var(--bg-main)] via-[var(--bg-main)]/40 to-transparent z-10"></div>
            <img src="https://images.unsplash.com/photo-1489599849927-2ee91cede3ba?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80"
                 alt="Cinema" class="w-full h-full object-cover opacity-50">
            <div class="absolute bottom-20 left-12 right-12 z-20">
                <h2 class="text-3xl font-bold text-white mb-3 leading-tight">Mở ra thế giới điện ảnh<br>của riêng bạn.</h2>
                <p class="app-muted text-base">Hàng ngàn bộ phim bom tấn và tính năng AI đề xuất thông minh đang chờ đón bạn.</p>
            </div>
        </div>

        <!-- Right Side: Form -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-6 sm:p-10">
            <div class="w-full max-w-md">
                <div class="mb-8">
                    <h1 class="text-2xl md:text-3xl font-bold app-text mb-2">Đăng nhập</h1>
                    <p class="app-muted text-sm">Chào mừng bạn quay lại với MovieMate!</p>
                </div>

                <form action="{{ route('login.post') }}" method="POST" class="space-y-5">
                    @csrf

                    <div>
                        <label for="email" class="block text-sm font-medium app-muted mb-2">Email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="ph ph-envelope app-muted text-lg"></i>
                            </div>
                            <input type="email" id="email" name="email"
                                   class="app-input w-full pl-11 pr-4 py-3 border app-border rounded-xl focus:outline-none focus:border-brand-start focus:ring-1 focus:ring-brand-start transition-colors text-sm"
                                   placeholder="Nhập email của bạn" required>
                        </div>
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium app-muted mb-2">Mật khẩu</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="ph ph-lock-key app-muted text-lg"></i>
                            </div>
                            <input type="password" id="password" name="password"
                                   class="app-input w-full pl-11 pr-11 py-3 border app-border rounded-xl focus:outline-none focus:border-brand-start focus:ring-1 focus:ring-brand-start transition-colors text-sm"
                                   placeholder="••••••••" required>
                            <button type="button" class="absolute inset-y-0 right-0 pr-4 flex items-center app-muted hover:app-text">
                                <i class="ph ph-eye text-lg"></i>
                            </button>
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input id="remember-me" name="remember" type="checkbox" class="h-4 w-4 rounded border-dark-border bg-dark-main text-brand-start focus:ring-brand-start">
                            <span class="text-sm app-muted">Ghi nhớ đăng nhập</span>
                        </label>
                        <a href="#" class="text-sm font-medium text-brand-start hover:text-brand-end">Quên mật khẩu?</a>
                    </div>

                    <button type="submit" class="w-full py-3.5 rounded-xl font-bold text-white bg-gradient-to-r from-brand-start to-brand-end hover:shadow-lg hover:shadow-brand-start/25 transition-all transform hover:-translate-y-0.5 text-sm">
                        Đăng nhập
                    </button>
                </form>

                <!-- Divider -->
                <div class="mt-6 relative">
                    <div class="absolute inset-0 flex items-center"><div class="w-full border-t app-border"></div></div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-3 app-secondary app-muted">Hoặc đăng nhập với</span>
                    </div>
                </div>

                <div class="mt-5 grid grid-cols-2 gap-3">
                    <button class="flex items-center justify-center gap-2 w-full py-2.5 app-input border app-border rounded-xl app-muted hover:app-text hover:border-brand-start transition-colors text-sm font-medium">
                        <i class="ph-fill ph-google-logo text-lg"></i> Google
                    </button>
                    <button class="flex items-center justify-center gap-2 w-full py-2.5 app-input border app-border rounded-xl app-muted hover:app-text hover:border-brand-start transition-colors text-sm font-medium">
                        <i class="ph-fill ph-facebook-logo text-lg text-blue-500"></i> Facebook
                    </button>
                </div>

                <p class="mt-6 text-center text-sm app-muted">
                    Chưa có tài khoản?
                    <a href="{{ route('register') }}" class="font-bold text-brand-start hover:text-brand-end ml-1">Đăng ký ngay</a>
                </p>
            </div>
        </div>
    </div>
@endsection
