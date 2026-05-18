@extends('layouts.admin')

@section('title', 'Chỉnh sửa phòng chiếu - MovieMate Admin')
@section('page-title', 'Chỉnh sửa phòng chiếu')

@section('content')
    <form action="#" class="max-w-3xl">
        <div class="bg-dark-card border border-dark-border rounded-2xl p-6 md:p-8 space-y-6">
            
            <div>
                <label class="block text-sm font-medium text-text-sub mb-2">Chọn rạp chiếu</label>
                <select class="w-full px-4 py-2.5 bg-dark-main border border-dark-border rounded-xl text-white focus:outline-none focus:border-brand-start transition-colors appearance-none" disabled>
                    <option selected>MovieMate Hà Nội</option>
                    <option>MovieMate Cầu Giấy</option>
                </select>
                <p class="text-[10px] text-warning mt-1"><i class="ph-fill ph-warning-circle"></i> Không thể thay đổi rạp chiếu sau khi phòng đã được tạo.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-text-sub mb-2">Tên phòng chiếu</label>
                    <input type="text" class="w-full px-4 py-2.5 bg-dark-main border border-dark-border rounded-xl text-white focus:outline-none focus:border-brand-start transition-colors" value="Room 01">
                </div>

                <div>
                    <label class="block text-sm font-medium text-text-sub mb-2">Loại phòng</label>
                    <select class="w-full px-4 py-2.5 bg-dark-main border border-dark-border rounded-xl text-white focus:outline-none focus:border-brand-start transition-colors appearance-none">
                        <option selected>2D</option>
                        <option>3D</option>
                        <option>IMAX</option>
                        <option>VIP</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-text-sub mb-2">Tổng số lượng ghế</label>
                    <input type="number" class="w-full px-4 py-2.5 bg-dark-main border border-dark-border rounded-xl text-white focus:outline-none focus:border-brand-start transition-colors" value="120" readonly>
                    <p class="text-[10px] text-text-sub mt-1">Số lượng này được tính tự động dựa trên Sơ đồ ghế.</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-text-sub mb-2">Trạng thái</label>
                    <select class="w-full px-4 py-2.5 bg-dark-main border border-dark-border rounded-xl text-success focus:outline-none focus:border-brand-start transition-colors font-bold appearance-none">
                        <option value="active" class="text-success" selected>Hoạt động</option>
                        <option value="maintenance" class="text-warning">Bảo trì</option>
                    </select>
                </div>
            </div>

            <div class="pt-4 flex gap-3">
                <button type="submit" class="px-6 py-2.5 bg-brand-start text-white font-bold rounded-xl hover:bg-brand-end transition-colors">
                    Cập nhật phòng chiếu
                </button>
                <a href="{{ route('admin.rooms.index') }}" class="px-6 py-2.5 bg-dark-main border border-dark-border text-white font-medium rounded-xl hover:bg-dark-border transition-colors">
                    Hủy
                </a>
            </div>

        </div>
    </form>
@endsection
