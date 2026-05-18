@extends('layouts.staff')

@section('title', 'Kiểm tra vé QR - MovieMate Staff')
@section('page-title', 'Kiểm tra vé QR')

@section('content')
    <div class="max-w-3xl mx-auto">
        
        <div class="bg-dark-card border border-dark-border rounded-3xl p-8 sm:p-12 text-center shadow-2xl relative overflow-hidden">
            <!-- Background Elements -->
            <div class="absolute top-0 right-0 w-[300px] h-[300px] bg-ai-start/5 rounded-full blur-[80px] -translate-y-1/2 translate-x-1/2"></div>
            
            <h2 class="text-2xl font-bold text-white mb-2 relative z-10">Kiểm tra vé khách hàng</h2>
            <p class="text-text-sub mb-8 relative z-10">Đưa mã QR của khách hàng vào khung hình hoặc nhập mã vé thủ công để kiểm tra.</p>

            <!-- Scanner Frame -->
            <div class="relative w-64 h-64 mx-auto mb-8">
                <!-- Frame corners -->
                <div class="absolute top-0 left-0 w-8 h-8 border-t-4 border-l-4 border-ai-start rounded-tl-lg"></div>
                <div class="absolute top-0 right-0 w-8 h-8 border-t-4 border-r-4 border-ai-start rounded-tr-lg"></div>
                <div class="absolute bottom-0 left-0 w-8 h-8 border-b-4 border-l-4 border-ai-start rounded-bl-lg"></div>
                <div class="absolute bottom-0 right-0 w-8 h-8 border-b-4 border-r-4 border-ai-start rounded-br-lg"></div>
                
                <!-- Scanning line animation -->
                <div class="absolute top-0 left-0 w-full h-1 bg-ai-start shadow-[0_0_10px_rgba(124,58,237,1)] animate-[fade-in-up_2s_ease-in-out_infinite_alternate]"></div>

                <!-- Camera view placeholder -->
                <div class="absolute inset-2 bg-dark-main border border-dark-border/50 rounded-lg flex flex-col items-center justify-center opacity-80">
                    <i class="ph-bold ph-qr-code text-6xl text-text-sub mb-2"></i>
                    <span class="text-xs text-text-sub uppercase tracking-wider font-medium">Camera View</span>
                </div>
            </div>

            <!-- Manual Input Form -->
            <div class="max-w-md mx-auto relative z-10">
                <div class="flex items-center gap-4 mb-4">
                    <div class="h-px bg-dark-border flex-grow"></div>
                    <span class="text-xs text-text-sub font-medium uppercase tracking-wider">Hoặc nhập tay</span>
                    <div class="h-px bg-dark-border flex-grow"></div>
                </div>

                <form action="#" class="flex gap-2">
                    <input type="text" class="flex-grow px-4 py-3 bg-dark-main border border-dark-border rounded-xl text-white font-mono text-center focus:outline-none focus:border-ai-start uppercase tracking-widest placeholder-text-sub/30" placeholder="MMT-XXXX-XXXX">
                    <button type="button" class="px-6 py-3 bg-ai-start text-white font-bold rounded-xl hover:bg-ai-end transition-colors whitespace-nowrap">
                        Kiểm tra
                    </button>
                </form>
            </div>
            
        </div>

        <!-- Demo Buttons (For testing only) -->
        <div class="mt-8 pt-8 border-t border-dark-border">
            <p class="text-xs text-text-sub mb-4 text-center uppercase tracking-wider font-bold">Demo Trạng Thái Vé (Dành cho Test)</p>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="{{ route('staff.tickets.valid') }}" class="px-4 py-2 bg-success/10 border border-success/30 text-success rounded-lg text-sm font-bold hover:bg-success hover:text-white transition-colors">
                    Vé Hợp Lệ
                </a>
                <a href="{{ route('staff.tickets.used') }}" class="px-4 py-2 bg-warning/10 border border-warning/30 text-warning rounded-lg text-sm font-bold hover:bg-warning hover:text-white transition-colors">
                    Vé Đã Dùng
                </a>
                <a href="{{ route('staff.tickets.notFound') }}" class="px-4 py-2 bg-error/10 border border-error/30 text-error rounded-lg text-sm font-bold hover:bg-error hover:text-white transition-colors">
                    Vé Không Tồn Tại
                </a>
            </div>
        </div>

    </div>
@endsection
