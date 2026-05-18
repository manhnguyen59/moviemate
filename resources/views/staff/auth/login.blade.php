<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Login - MovieMate</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>
<body class="bg-dark-main text-text-main font-sans antialiased min-h-screen flex items-center justify-center p-4">
    
    <div class="absolute inset-0 z-0">
        <div class="absolute inset-0 bg-gradient-to-tr from-dark-main via-dark-main to-dark-sub z-10"></div>
        <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-ai-start/10 rounded-full blur-[150px] -translate-y-1/2 translate-x-1/3"></div>
        <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-brand-start/5 rounded-full blur-[120px] translate-y-1/3 -translate-x-1/3"></div>
    </div>

    <div class="w-full max-w-md relative z-20">
        
        <div class="text-center mb-10">
            <div class="inline-flex items-center justify-center w-20 h-20 rounded-3xl bg-dark-card border border-dark-border shadow-2xl mb-6">
                <i class="ph-fill ph-film-strip text-4xl text-ai-start"></i>
            </div>
            <h1 class="text-3xl font-bold text-white mb-2">Đăng nhập Nhân viên</h1>
            <p class="text-text-sub">Hệ thống quản lý MovieMate Staff Panel</p>
        </div>

        <div class="bg-dark-card border border-dark-border rounded-3xl p-8 shadow-2xl">
            <form action="{{ route('staff.dashboard') }}" method="GET" class="space-y-6">
                <!-- Using GET and routing to dashboard for static demo purposes -->
                
                <div>
                    <label for="email" class="block text-sm font-medium text-text-sub mb-2">Email nội bộ</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="ph ph-envelope-simple text-text-sub text-lg"></i>
                        </div>
                        <input type="email" id="email" name="email" class="w-full pl-11 pr-4 py-3.5 bg-dark-main border border-dark-border rounded-xl text-white focus:outline-none focus:border-ai-start focus:ring-1 focus:ring-ai-start transition-colors placeholder-text-sub/50" placeholder="staff@moviemate.vn" required>
                    </div>
                </div>

                <div>
                    <div class="flex justify-between items-center mb-2">
                        <label for="password" class="block text-sm font-medium text-text-sub">Mật khẩu</label>
                        <a href="#" class="text-xs font-medium text-ai-start hover:text-white transition-colors">Quên mật khẩu?</a>
                    </div>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="ph ph-lock-key text-text-sub text-lg"></i>
                        </div>
                        <input type="password" id="password" name="password" class="w-full pl-11 pr-11 py-3.5 bg-dark-main border border-dark-border rounded-xl text-white focus:outline-none focus:border-ai-start focus:ring-1 focus:ring-ai-start transition-colors placeholder-text-sub/50" placeholder="••••••••" required>
                        <button type="button" class="absolute inset-y-0 right-0 pr-4 flex items-center text-text-sub hover:text-white">
                            <i class="ph ph-eye text-lg"></i>
                        </button>
                    </div>
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full flex justify-center items-center gap-2 py-4 px-4 border border-transparent rounded-xl shadow-sm text-sm font-bold text-white bg-gradient-to-r from-ai-start to-ai-end hover:shadow-lg hover:shadow-ai-start/25 transition-all transform hover:-translate-y-0.5">
                        Đăng nhập hệ thống <i class="ph-bold ph-arrow-right"></i>
                    </button>
                </div>
            </form>
        </div>

        <p class="text-center text-xs text-text-sub mt-8">
            &copy; {{ date('Y') }} MovieMate. Dành riêng cho nhân viên có thẩm quyền.
        </p>

    </div>
</body>
</html>
