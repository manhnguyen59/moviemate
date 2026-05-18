@extends('layouts.admin')

@section('title', 'Chỉnh sửa suất chiếu - MovieMate Admin')
@section('page-title', 'Chỉnh sửa suất chiếu')

@section('content')
    <form action="#" class="max-w-4xl">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            <div class="space-y-5">
                <!-- Info (read-only) -->
                <div class="app-card border app-border rounded-2xl p-6">
                    <h3 class="text-base font-bold app-text mb-4">Thông tin cơ bản</h3>

                    <div class="p-3 app-secondary border border-warning/30 rounded-xl mb-4">
                        <p class="text-[10px] text-warning mb-1.5 uppercase tracking-wider font-bold flex items-center gap-1"><i class="ph-fill ph-warning-circle"></i> Lưu ý</p>
                        <p class="text-xs app-muted">Không thể thay đổi Phim, Rạp và Phòng chiếu khi suất chiếu đã được tạo. Tạo suất chiếu mới nếu cần.</p>
                    </div>

                    <div class="space-y-3">
                        <div>
                            <label class="block text-sm font-medium app-muted mb-1.5">Phim</label>
                            <input type="text" class="app-input w-full px-4 py-2.5 border app-border rounded-xl text-sm opacity-60 cursor-not-allowed" value="Thanh Gươm Diệt Quỷ (115 phút)" disabled>
                        </div>
                        <div>
                            <label class="block text-sm font-medium app-muted mb-1.5">Cụm rạp</label>
                            <input type="text" class="app-input w-full px-4 py-2.5 border app-border rounded-xl text-sm opacity-60 cursor-not-allowed" value="MovieMate Hà Nội" disabled>
                        </div>
                        <div>
                            <label class="block text-sm font-medium app-muted mb-1.5">Phòng chiếu</label>
                            <input type="text" class="app-input w-full px-4 py-2.5 border app-border rounded-xl text-sm opacity-60 cursor-not-allowed" value="Room 01 (2D)" disabled>
                        </div>
                    </div>
                </div>

                <!-- Time -->
                <div class="app-card border app-border rounded-2xl p-6">
                    <h3 class="text-base font-bold app-text mb-4">Thời gian</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium app-muted mb-1.5">Ngày chiếu</label>
                            <input type="date" class="app-input w-full px-4 py-2.5 border app-border rounded-xl focus:outline-none focus:border-brand-start transition-colors text-sm [color-scheme:dark]" value="2026-05-19">
                        </div>
                        <div>
                            <label class="block text-sm font-medium app-muted mb-1.5">Giờ bắt đầu</label>
                            <input type="time" class="app-input w-full px-4 py-2.5 border app-border rounded-xl focus:outline-none focus:border-brand-start transition-colors text-sm [color-scheme:dark]" value="09:30">
                        </div>
                    </div>
                    <div class="mt-4 p-3 app-secondary border app-border rounded-xl flex items-center justify-between text-sm">
                        <span class="app-muted">Dự kiến kết thúc:</span>
                        <span class="app-text font-bold">11:25</span>
                    </div>
                </div>
            </div>

            <div class="space-y-5">
                <!-- Pricing -->
                <div class="app-card border app-border rounded-2xl p-6">
                    <h3 class="text-base font-bold app-text mb-4">Thiết lập giá vé</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium app-muted mb-1.5">Giá ghế thường (VNĐ)</label>
                            <input type="number" class="app-input w-full px-4 py-2.5 border app-border rounded-xl focus:outline-none focus:border-brand-start transition-colors text-sm" value="80000">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-ai-start mb-1.5">Giá ghế VIP (VNĐ)</label>
                            <input type="number" class="w-full px-4 py-2.5 bg-ai-start/10 border border-ai-start/30 rounded-xl text-ai-start font-bold focus:outline-none focus:border-ai-start transition-colors text-sm" value="100000">
                        </div>
                    </div>
                </div>

                <!-- Status -->
                <div class="app-card border app-border rounded-2xl p-6">
                    <h3 class="text-base font-bold app-text mb-4">Trạng thái</h3>
                    <select class="app-input w-full px-4 py-2.5 border app-border rounded-xl focus:outline-none focus:border-brand-start transition-colors appearance-none text-sm">
                        <option value="upcoming">Sắp chiếu</option>
                        <option value="showing" selected>Đang chiếu</option>
                        <option value="ended">Đã chiếu xong</option>
                        <option value="cancelled">Đã hủy</option>
                    </select>
                </div>

                <!-- Actions -->
                <div class="flex flex-col gap-3">
                    <button type="submit" class="w-full py-3 bg-gradient-to-r from-brand-start to-brand-end text-white rounded-xl font-bold text-sm hover:shadow-lg hover:shadow-brand-start/20 transition-all hover:-translate-y-0.5">
                        Cập nhật suất chiếu
                    </button>
                    <a href="{{ route('admin.showtimes.index') }}" class="w-full py-3 app-secondary border app-border app-muted hover:app-text text-center rounded-xl font-medium transition-colors text-sm">
                        Hủy
                    </a>
                </div>
            </div>
        </div>
    </form>
@endsection
