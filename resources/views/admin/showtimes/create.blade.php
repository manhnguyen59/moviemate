@extends('layouts.admin')

@section('title', 'Thêm suất chiếu - MovieMate Admin')
@section('page-title', 'Thêm suất chiếu')

@section('content')
    <form action="#" class="max-w-4xl">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            <div class="space-y-5">
                <!-- Info -->
                <div class="app-card border app-border rounded-2xl p-6">
                    <h3 class="text-base font-bold app-text mb-4">Thông tin cơ bản</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium app-muted mb-1.5">Chọn Phim</label>
                            <select class="app-input w-full px-4 py-2.5 border app-border rounded-xl focus:outline-none focus:border-brand-start transition-colors appearance-none text-sm">
                                <option value="">-- Chọn phim --</option>
                                <option>Thanh Gươm Diệt Quỷ (115 phút)</option>
                                <option>Godzilla x Kong (120 phút)</option>
                                <option>Dune: Part Two (166 phút)</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium app-muted mb-1.5">Chọn Cụm rạp</label>
                            <select class="app-input w-full px-4 py-2.5 border app-border rounded-xl focus:outline-none focus:border-brand-start transition-colors appearance-none text-sm">
                                <option value="">-- Chọn rạp --</option>
                                <option>MovieMate Hà Nội</option>
                                <option>MovieMate Cầu Giấy</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium app-muted mb-1.5">Chọn Phòng chiếu</label>
                            <select class="app-input w-full px-4 py-2.5 border app-border rounded-xl focus:outline-none focus:border-brand-start transition-colors appearance-none text-sm opacity-60 cursor-not-allowed" disabled>
                                <option value="">-- Vui lòng chọn rạp trước --</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Time -->
                <div class="app-card border app-border rounded-2xl p-6">
                    <h3 class="text-base font-bold app-text mb-4">Thời gian</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium app-muted mb-1.5">Ngày chiếu</label>
                            <input type="date" class="app-input w-full px-4 py-2.5 border app-border rounded-xl focus:outline-none focus:border-brand-start transition-colors text-sm [color-scheme:dark]">
                        </div>
                        <div>
                            <label class="block text-sm font-medium app-muted mb-1.5">Giờ bắt đầu</label>
                            <input type="time" class="app-input w-full px-4 py-2.5 border app-border rounded-xl focus:outline-none focus:border-brand-start transition-colors text-sm [color-scheme:dark]">
                        </div>
                    </div>
                    <div class="mt-4 p-3 app-secondary border app-border rounded-xl flex items-center justify-between text-sm">
                        <span class="app-muted">Dự kiến kết thúc:</span>
                        <span class="app-text font-bold">--:--</span>
                    </div>
                </div>
            </div>

            <div class="space-y-5">
                <!-- Pricing -->
                <div class="app-card border app-border rounded-2xl p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-base font-bold app-text">Thiết lập giá vé</h3>
                        <button type="button" class="text-xs text-brand-start font-medium hover:text-brand-end transition-colors">Dùng giá mặc định</button>
                    </div>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium app-muted mb-1.5">Giá ghế thường (VNĐ)</label>
                            <input type="number" class="app-input w-full px-4 py-2.5 border app-border rounded-xl focus:outline-none focus:border-brand-start transition-colors text-sm" placeholder="Ví dụ: 80000">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-ai-start mb-1.5">Giá ghế VIP (VNĐ)</label>
                            <input type="number" class="w-full px-4 py-2.5 bg-ai-start/10 border border-ai-start/30 rounded-xl text-ai-start font-bold focus:outline-none focus:border-ai-start transition-colors text-sm" placeholder="Ví dụ: 100000">
                        </div>
                    </div>
                </div>

                <!-- AI Suggestion -->
                <div class="bg-gradient-to-br from-ai-start/10 to-transparent border border-ai-start/30 rounded-2xl p-5 relative overflow-hidden">
                    <i class="ph-fill ph-sparkle absolute top-4 right-4 text-3xl text-ai-start/20"></i>
                    <h3 class="text-sm font-bold app-text mb-2 flex items-center gap-2">
                        <i class="ph-fill ph-magic-wand text-ai-start"></i> Gợi ý từ AI
                    </h3>
                    <p class="text-xs app-muted leading-relaxed mb-3">
                        Dựa trên lịch sử, suất chiếu <strong class="app-text">19:00 – 21:00</strong> cuối tuần cho phim này có tỷ lệ lấp đầy cao nhất. Giá đề xuất: <strong>90k (Thường) / 120k (VIP)</strong>.
                    </p>
                    <button type="button" class="text-xs font-bold text-ai-start hover:text-white transition-colors">Áp dụng giá đề xuất →</button>
                </div>

                <!-- Actions -->
                <div class="flex flex-col gap-3">
                    <button type="submit" class="w-full py-3 bg-gradient-to-r from-brand-start to-brand-end text-white rounded-xl font-bold text-sm hover:shadow-lg hover:shadow-brand-start/20 transition-all hover:-translate-y-0.5">
                        Tạo suất chiếu
                    </button>
                    <a href="{{ route('admin.showtimes.index') }}" class="w-full py-3 app-secondary border app-border app-muted hover:app-text text-center rounded-xl font-medium transition-colors text-sm">
                        Hủy
                    </a>
                </div>
            </div>
        </div>
    </form>
@endsection
