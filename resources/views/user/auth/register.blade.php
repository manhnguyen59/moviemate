@extends('layouts.user')

@section('title', 'Đăng ký - MovieMate')

@section('content')
    <div class="min-h-[calc(100vh-80px)] flex">
        <!-- Left Side -->
        <div class="hidden lg:flex w-1/2 relative app-secondary border-r app-border overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-t from-[var(--bg-main)] via-[var(--bg-main)]/40 to-transparent z-10"></div>
            <img src="https://images.unsplash.com/photo-1517604931442-7e0c8ed2963c?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80"
                 alt="Cinema" class="w-full h-full object-cover opacity-40">
            <div class="absolute bottom-16 left-12 right-12 z-20">
                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-ai-start/20 border border-ai-start/50 text-ai-start text-sm font-medium mb-5 backdrop-blur-sm">
                    <i class="ph-fill ph-sparkle"></i> Trải nghiệm AI tích hợp
                </div>
                <h2 class="text-3xl font-bold text-white mb-3 leading-tight">Tham gia cộng đồng<br>yêu điện ảnh.</h2>
                <p class="app-muted text-base">Trở thành thành viên để nhận ưu đãi đặc quyền và trải nghiệm đặt vé nhanh chóng.</p>
            </div>
        </div>

        <!-- Right Side: Form -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-6 sm:p-10">
            <div class="w-full max-w-md">
                <div class="mb-7">
                    <h1 class="text-2xl md:text-3xl font-bold app-text mb-2">Đăng ký tài khoản</h1>
                    <p class="app-muted text-sm">Tạo tài khoản MovieMate chỉ trong vài bước</p>
                </div>

                <form action="#" method="POST" class="space-y-4">
                    @csrf

                    <div>
                        <label for="name" class="block text-sm font-medium app-muted mb-1.5">Họ và tên</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="ph ph-user app-muted text-lg"></i>
                            </div>
                            <input type="text" id="name" name="name"
                                   class="app-input w-full pl-11 pr-4 py-3 border app-border rounded-xl focus:outline-none focus:border-brand-start focus:ring-1 focus:ring-brand-start transition-colors text-sm"
                                   placeholder="VD: Nguyễn Văn A" required>
                        </div>
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium app-muted mb-1.5">Email</label>
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
                        <label for="phone" class="block text-sm font-medium app-muted mb-1.5">Số điện thoại</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="ph ph-phone app-muted text-lg"></i>
                            </div>
                            <input type="tel" id="phone" name="phone"
                                   class="app-input w-full pl-11 pr-4 py-3 border app-border rounded-xl focus:outline-none focus:border-brand-start focus:ring-1 focus:ring-brand-start transition-colors text-sm"
                                   placeholder="09xx xxx xxx" required>
                        </div>
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium app-muted mb-1.5">Mật khẩu</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="ph ph-lock-key app-muted text-lg"></i>
                            </div>
                            <input type="password" id="password" name="password"
                                   class="app-input w-full pl-11 pr-11 py-3 border app-border rounded-xl focus:outline-none focus:border-brand-start focus:ring-1 focus:ring-brand-start transition-colors text-sm"
                                   placeholder="Ít nhất 8 ký tự" required>
                            <button type="button" class="absolute inset-y-0 right-0 pr-4 flex items-center app-muted hover:app-text">
                                <i class="ph ph-eye text-lg"></i>
                            </button>
                        </div>
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium app-muted mb-1.5">Xác nhận mật khẩu</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="ph ph-lock-key app-muted text-lg"></i>
                            </div>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                   class="app-input w-full pl-11 pr-11 py-3 border app-border rounded-xl focus:outline-none focus:border-brand-start focus:ring-1 focus:ring-brand-start transition-colors text-sm"
                                   placeholder="Nhập lại mật khẩu" required>
                        </div>
                    </div>

                    <div class="flex items-start pt-1">
                        <input id="terms" name="terms" type="checkbox" required class="h-4 w-4 rounded border-dark-border bg-dark-main text-brand-start focus:ring-brand-start mt-0.5 flex-shrink-0">
                        <label for="terms" class="ml-2 text-sm app-muted leading-relaxed cursor-pointer">
                            Tôi đồng ý với <a href="#" class="text-brand-start hover:text-brand-end">Điều khoản dịch vụ</a> và <a href="#" class="text-brand-start hover:text-brand-end">Chính sách bảo mật</a>
                        </label>
                    </div>

                    <button type="submit" class="w-full py-3.5 rounded-xl font-bold text-white bg-gradient-to-r from-brand-start to-brand-end hover:shadow-lg hover:shadow-brand-start/25 transition-all transform hover:-translate-y-0.5 text-sm mt-2">
                        Tạo tài khoản
                    </button>
                </form>

                <p class="mt-6 text-center text-sm app-muted">
                    Đã có tài khoản?
                    <a href="{{ route('login') }}" class="font-bold text-brand-start hover:text-brand-end ml-1">Đăng nhập</a>
                </p>
            </div>
        </div>
    </div>
@endsection