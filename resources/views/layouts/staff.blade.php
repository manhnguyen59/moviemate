<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'MovieMate Staff Panel')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    {{-- Prevent theme flash --}}
    <script>
        (function() {
            var t = localStorage.getItem('moviemate_theme') || 'dark';
            if (t === 'light') document.documentElement.classList.add('light');
            else document.documentElement.classList.remove('light');
        })();
    </script>
</head>
<body class="app-bg font-sans antialiased flex h-screen overflow-hidden">

    <!-- Mobile Sidebar Backdrop -->
    <div id="sidebar-backdrop" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-40 lg:hidden hidden"></div>

    <!-- Sidebar -->
    <aside id="sidebar" class="fixed lg:static inset-y-0 left-0 z-50 w-64 app-sidebar border-r app-border transform -translate-x-full lg:translate-x-0 transition-transform duration-300 flex flex-col h-full">

        <!-- Logo -->
        <div class="h-16 lg:h-20 flex items-center px-6 border-b app-border shrink-0">
            <a href="{{ route('staff.dashboard') }}" class="flex items-center gap-2">
                <i class="ph-fill ph-film-strip text-3xl text-ai-start"></i>
                <div class="leading-tight">
                    <span class="text-xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-ai-start to-brand-start">
                        MovieMate
                    </span>
                    <span class="block text-[10px] uppercase tracking-widest app-muted font-bold">Staff Panel</span>
                </div>
            </a>
        </div>

        <!-- Menu -->
        <nav class="flex-grow py-6 px-4 space-y-1 overflow-y-auto hide-scrollbar">
            <a href="{{ route('staff.dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl {{ request()->routeIs('staff.dashboard') ? 'bg-ai-start/10 text-ai-start font-bold border border-ai-start/20' : 'app-muted hover:bg-brand-start/5 hover:text-brand-start font-medium transition-colors text-sm' }}">
                <i class="{{ request()->routeIs('staff.dashboard') ? 'ph-fill' : 'ph' }} ph-squares-four text-lg"></i>
                Dashboard
            </a>

            <a href="{{ route('staff.tickets.check') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl {{ request()->routeIs('staff.tickets.check') || request()->routeIs('staff.tickets.valid') || request()->routeIs('staff.tickets.used') || request()->routeIs('staff.tickets.notFound') ? 'bg-ai-start/10 text-ai-start font-bold border border-ai-start/20' : 'app-muted hover:bg-brand-start/5 hover:text-brand-start font-medium transition-colors text-sm' }}">
                <i class="{{ request()->routeIs('staff.tickets.check') ? 'ph-fill' : 'ph' }} ph-qr-code text-lg"></i>
                Kiểm tra vé QR
            </a>

            <a href="{{ route('staff.tickets.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl {{ request()->routeIs('staff.tickets.index') ? 'bg-ai-start/10 text-ai-start font-bold border border-ai-start/20' : 'app-muted hover:bg-brand-start/5 hover:text-brand-start font-medium transition-colors text-sm' }}">
                <i class="{{ request()->routeIs('staff.tickets.index') ? 'ph-fill' : 'ph' }} ph-ticket text-lg"></i>
                Danh sách vé
            </a>

            <a href="{{ route('staff.sales.counter') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl {{ request()->routeIs('staff.sales.counter') ? 'bg-ai-start/10 text-ai-start font-bold border border-ai-start/20' : 'app-muted hover:bg-brand-start/5 hover:text-brand-start font-medium transition-colors text-sm' }}">
                <i class="{{ request()->routeIs('staff.sales.counter') ? 'ph-fill' : 'ph' }} ph-storefront text-lg"></i>
                Bán vé tại quầy
            </a>
        </nav>

        <!-- Bottom Action -->
        <div class="p-4 border-t app-border shrink-0">
            <a href="{{ route('home') }}" target="_blank" class="flex items-center justify-center gap-2 w-full py-2.5 app-card border app-border app-muted rounded-xl hover:text-brand-start hover:border-brand-start transition-colors text-sm font-medium">
                <i class="ph ph-arrow-square-out text-lg"></i> Về website
            </a>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-grow flex flex-col min-w-0 app-bg relative h-full overflow-hidden">

        <!-- Topbar -->
        <header class="h-16 lg:h-20 flex items-center justify-between px-4 sm:px-8 border-b app-border app-card backdrop-blur-md sticky top-0 z-30 shrink-0">

            <div class="flex items-center gap-4">
                <button id="mobile-menu-btn" class="lg:hidden app-muted hover:app-text">
                    <i class="ph ph-list text-2xl"></i>
                </button>
                <h1 class="text-lg sm:text-xl font-bold app-text">@yield('page-title')</h1>
            </div>

            <div class="flex items-center gap-3">
                <!-- Theme Toggle -->
                <button data-theme-toggle type="button"
                    class="flex items-center gap-1.5 px-3 py-2 rounded-xl app-card border app-border app-muted hover:border-brand-start transition-all text-sm">
                    <span class="theme-icon">🌙</span>
                    <span class="theme-text hidden sm:inline text-xs font-medium">Tối</span>
                </button>

                <!-- Staff Profile (Static) -->
                <div class="flex items-center gap-3 pl-3 border-l app-border">
                    <div class="hidden sm:block text-right">
                        <p class="text-sm font-bold app-text leading-tight">Nhân viên rạp</p>
                        <p class="text-xs text-ai-start font-medium">Staff</p>
                    </div>
                    <div class="w-9 h-9 rounded-full app-bg border app-border overflow-hidden cursor-pointer hover:border-ai-start transition-colors">
                        <img src="https://ui-avatars.com/api/?name=Staff&background=151A27&color=fff" alt="Staff" class="w-full h-full object-cover">
                    </div>
                </div>
            </div>

        </header>

        <!-- Content Area -->
        <div class="flex-grow p-4 sm:p-8 overflow-y-auto">
            <div class="max-w-7xl mx-auto pb-10">
                @yield('content')
            </div>
        </div>

    </main>

    <script>
        const sidebar = document.getElementById('sidebar');
        const backdrop = document.getElementById('sidebar-backdrop');
        const toggleBtn = document.getElementById('mobile-menu-btn');

        function toggleSidebar() {
            sidebar.classList.toggle('-translate-x-full');
            backdrop.classList.toggle('hidden');
        }

        toggleBtn.addEventListener('click', toggleSidebar);
        backdrop.addEventListener('click', toggleSidebar);
    </script>

    @stack('scripts')
</body>
</html>
