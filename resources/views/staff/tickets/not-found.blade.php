@extends('layouts.staff')

@section('title', 'Vé Không Tồn Tại - MovieMate Staff')
@section('page-title', 'Kết quả kiểm tra vé')

@section('content')
    <div class="max-w-xl mx-auto">
        
        <div class="bg-error/10 border-2 border-error rounded-3xl p-8 text-center shadow-lg shadow-error/20 mb-6">
            
            <div class="w-20 h-20 bg-error text-white rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg shadow-error/40">
                <i class="ph-bold ph-x text-4xl"></i>
            </div>

            <h2 class="text-3xl font-bold text-error mb-2">Không Tìm Thấy Vé</h2>
            <p class="text-text-sub font-medium mb-8">Mã vé không tồn tại trong hệ thống hoặc đã bị hủy.</p>

            <div class="bg-dark-card border border-dark-border rounded-2xl p-6 text-left mb-8">
                <p class="text-xs text-text-sub uppercase tracking-wider mb-2 text-center font-bold">Mã đã quét</p>
                <div class="bg-dark-main border border-dark-border rounded-xl p-4 text-center">
                    <p class="text-xl font-bold text-white font-mono tracking-widest opacity-50 line-through">{{ $bookingCode ?? 'MMT-9999-0000' }}</p>
                </div>
                
                <div class="mt-6 space-y-2 text-sm text-text-sub">
                    <p class="flex items-center gap-2"><i class="ph-fill ph-info text-brand-start"></i> Vui lòng kiểm tra lại:</p>
                    <ul class="list-disc list-inside pl-4 space-y-1">
                        <li>Mã vé có bị sai kỹ tự không?</li>
                        <li>Vé đã bị hủy trước đó?</li>
                        <li>Đây có phải vé của cụm rạp khác?</li>
                    </ul>
                </div>
            </div>

            <div class="flex flex-col gap-3">
                <a href="{{ route('staff.tickets.check') }}" class="w-full py-4 bg-error text-white rounded-xl font-bold text-lg hover:bg-error/90 hover:shadow-lg hover:shadow-error/30 transition-all inline-block">
                    Thử quét lại
                </a>
                <a href="{{ route('staff.dashboard') }}" class="w-full py-3 bg-dark-main border border-dark-border text-white rounded-xl font-medium hover:bg-dark-border transition-colors inline-block">
                    Về Dashboard
                </a>
            </div>

        </div>

    </div>
@endsection
