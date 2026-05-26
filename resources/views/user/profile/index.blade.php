@extends('layouts.user')

@section('title', 'Trang cá nhân - MovieMate')

@php
    $user = $user ?? Auth::user();
    $roleName = $user?->role?->name ?? 'Khách';
@endphp

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <aside class="lg:col-span-1">
                <div class="app-card border app-border rounded-2xl p-6 flex flex-col items-center text-center sticky top-24">
                    <div class="relative w-20 h-20 rounded-full overflow-hidden mb-3 border-2 border-brand-start">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=FF3D57&color=fff&size=128"
                             alt="{{ $user->name }}" class="w-full h-full object-cover">
                    </div>
                    <h2 class="text-lg font-bold app-heading mb-0.5">{{ $user->name }}</h2>
                    <p class="text-xs text-ai-start font-bold mb-5">Vai trò {{ $roleName }}</p>

                    <div class="w-full rounded-2xl border border-ai-start/30 bg-ai-start/10 px-4 py-3 mb-4 text-left">
                        <p class="text-xs app-muted">Thành viên {{ $user->membership_tier }}</p>
                        <p class="text-2xl font-extrabold text-ai-start">{{ number_format($user->loyalty_points, 0, ',', '.') }}</p>
                        <p class="text-xs app-muted">điểm khả dụng</p>
                    </div>

                    <div class="w-full space-y-1 text-left">
                        <a href="{{ route('user.profile') }}" class="flex items-center gap-3 px-4 py-2.5 bg-brand-start/10 text-brand-start rounded-xl font-bold border border-brand-start/20 text-sm">
                            <i class="ph-fill ph-user text-lg"></i> Thông tin cá nhân
                        </a>
                        <a href="{{ route('user.bookings.history') }}" class="flex items-center gap-3 px-4 py-2.5 app-text-muted hover:app-text hover:bg-brand-start/5 rounded-xl font-medium transition-colors text-sm">
                            <i class="ph ph-ticket text-lg"></i> Lịch sử đặt vé
                        </a>
                        <a href="#" class="flex items-center gap-3 px-4 py-2.5 app-text-muted hover:app-text hover:bg-brand-start/5 rounded-xl font-medium transition-colors text-sm">
                            <i class="ph ph-star text-lg"></i> Đánh giá của tôi
                        </a>
                        <hr class="app-border my-2">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full flex items-center gap-3 px-4 py-2.5 text-error hover:bg-error/10 rounded-xl font-medium transition-colors text-sm">
                                <i class="ph ph-sign-out text-lg"></i> Đăng xuất
                            </button>
                        </form>
                    </div>
                </div>
            </aside>

            <section class="lg:col-span-3">
                <div class="app-card border app-border rounded-2xl p-6 sm:p-8">
                    <div class="mb-6 pb-4 border-b app-border">
                        <h1 class="text-xl font-bold app-heading">Thông tin cá nhân</h1>
                        <p class="mt-1 text-sm app-text-muted">Cập nhật họ tên và số điện thoại dùng cho đặt vé.</p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
                        <div class="app-secondary border app-border rounded-2xl p-4">
                            <p class="text-xs app-muted mb-1">Hạng thành viên</p>
                            <p class="app-text font-bold">{{ $user->membership_tier }}</p>
                        </div>
                        <div class="app-secondary border app-border rounded-2xl p-4">
                            <p class="text-xs app-muted mb-1">Điểm khả dụng</p>
                            <p class="text-ai-start font-bold">{{ number_format($user->loyalty_points, 0, ',', '.') }}</p>
                        </div>
                        <div class="app-secondary border app-border rounded-2xl p-4">
                            <p class="text-xs app-muted mb-1">Điểm lên hạng</p>
                            <p class="app-text font-bold">{{ $user->points_to_next_tier > 0 ? number_format($user->points_to_next_tier, 0, ',', '.').' điểm' : 'Cao nhất' }}</p>
                        </div>
                    </div>

                        @if($errors->any())
                            <div class="mb-5 rounded-2xl border border-error/30 bg-error/10 text-error px-4 py-3 text-sm font-semibold">
                                {{ $errors->first() }}
                            </div>
                    @endif

                    <form action="{{ route('user.profile.update') }}" method="POST" class="space-y-5">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label for="name" class="block text-sm font-semibold app-text-soft mb-1.5">Họ và tên</label>
                                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                                       class="app-input w-full px-4 py-2.5 border app-border rounded-xl focus:outline-none focus:border-brand-start focus:ring-1 focus:ring-brand-start transition-colors text-sm">
                                @error('name')
                                    <p class="mt-2 text-xs font-semibold text-error">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-semibold app-text-soft mb-1.5">Email</label>
                                <input type="email" id="email" value="{{ $user->email }}"
                                       class="app-input w-full px-4 py-2.5 border app-border rounded-xl text-sm opacity-70 cursor-not-allowed" disabled>
                                <p class="text-xs app-text-muted mt-1">Email không thể thay đổi.</p>
                            </div>

                            <div>
                                <label for="phone" class="block text-sm font-semibold app-text-soft mb-1.5">Số điện thoại</label>
                                <input type="tel" id="phone" name="phone" value="{{ old('phone', $user->phone) }}"
                                       class="app-input w-full px-4 py-2.5 border app-border rounded-xl focus:outline-none focus:border-brand-start focus:ring-1 focus:ring-brand-start transition-colors text-sm"
                                       placeholder="09xx xxx xxx">
                                @error('phone')
                                    <p class="mt-2 text-xs font-semibold text-error">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="pt-5 border-t app-border flex justify-end">
                            <button type="submit" class="px-8 py-2.5 bg-gradient-to-r from-brand-start to-brand-end text-white rounded-xl font-bold text-sm hover:shadow-lg hover:shadow-brand-start/20 transition-all transform hover:-translate-y-0.5">
                                Cập nhật thông tin
                            </button>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>
@endsection
