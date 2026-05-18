@extends('layouts.admin')

@section('title', 'Thêm phòng chiếu - MovieMate Admin')
@section('page-title', 'Thêm phòng chiếu')

@section('content')
    <form action="#" class="max-w-3xl">
        <div class="bg-dark-card border border-dark-border rounded-2xl p-6 md:p-8 space-y-6">
            
            <div>
                <label class="block text-sm font-medium text-text-sub mb-2">Chọn rạp chiếu</label>
                <select class="w-full px-4 py-2.5 bg-dark-main border border-dark-border rounded-xl text-white focus:outline-none focus:border-brand-start transition-colors appearance-none">
                    <option>MovieMate Hà Nội</option>
                    <option>MovieMate Cầu Giấy</option>
                    <option>MovieMate Đà Nẵng</option>
                    <option>MovieMate Hồ Chí Minh</option>
                </select>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-text-sub mb-2">Tên phòng chiếu</label>
                    <input type="text" class="w-full px-4 py-2.5 bg-dark-main border border-dark-border rounded-xl text-white focus:outline-none focus:border-brand-start transition-colors" placeholder="Ví dụ: Room 01, IMAX 01">
                </div>

                <div>
                    <label class="block text-sm font-medium text-text-sub mb-2">Loại phòng</label>
                    <select class="w-full px-4 py-2.5 bg-dark-main border border-dark-border rounded-xl text-white focus:outline-none focus:border-brand-start transition-colors appearance-none">
                        <option>2D</option>
                        <option>3D</option>
                        <option>IMAX</option>
                        <option>VIP</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-text-sub mb-2">Tổng số lượng ghế (Dự kiến)</label>
                    <input type="number" class="w-full px-4 py-2.5 bg-dark-main border border-dark-border rounded-xl text-white focus:outline-none focus:border-brand-start transition-colors" placeholder="Ví dụ: 120">
                </div>

                <div>
                    <label class="block text-sm font-medium text-text-sub mb-2">Trạng thái</label>
                    <select class="w-full px-4 py-2.5 bg-dark-main border border-dark-border rounded-xl text-success focus:outline-none focus:border-brand-start transition-colors font-bold appearance-none">
                        <option value="active" class="text-success">Hoạt động</option>
                        <option value="maintenance" class="text-warning">Bảo trì</option>
                    </select>
                </div>
            </div>

            <div class="pt-4 flex gap-3">
                <button type="submit" class="px-6 py-2.5 bg-brand-start text-white font-bold rounded-xl hover:bg-brand-end transition-colors">
                    Lưu phòng chiếu
                </button>
                <a href="{{ route('admin.rooms.index') }}" class="px-6 py-2.5 bg-dark-main border border-dark-border text-white font-medium rounded-xl hover:bg-dark-border transition-colors">
                    Hủy
                </a>
            </div>

            <div class="mt-6 p-4 bg-ai-start/10 border border-ai-start/30 rounded-xl">
                <p class="text-xs text-ai-start font-medium flex items-start gap-2">
                    <i class="ph-fill ph-info mt-0.5"></i>
                    Sau khi tạo phòng chiếu thành công, bạn cần cấu hình Sơ đồ ghế (Seat Map) cho phòng này trong mục "Quản lý ghế" trước khi có thể tạo Suất chiếu.
                </p>
            </div>

        </div>
    </form>
@endsection
