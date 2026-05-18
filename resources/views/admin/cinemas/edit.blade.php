@extends('layouts.admin')

@section('title', 'Chỉnh sửa rạp chiếu - MovieMate Admin')
@section('page-title', 'Chỉnh sửa rạp chiếu')

@section('content')
    <form action="#" class="max-w-5xl">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-dark-card border border-dark-border rounded-2xl p-6">
                    <h3 class="text-lg font-bold text-white mb-6">Thông tin chung</h3>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-text-sub mb-2">Tên cụm rạp</label>
                            <input type="text" class="w-full px-4 py-2.5 bg-dark-main border border-dark-border rounded-xl text-white focus:outline-none focus:border-brand-start transition-colors" value="MovieMate Hà Nội">
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-text-sub mb-2">Thành phố</label>
                                <select class="w-full px-4 py-2.5 bg-dark-main border border-dark-border rounded-xl text-white focus:outline-none focus:border-brand-start transition-colors appearance-none">
                                    <option selected>Hà Nội</option>
                                    <option>Hồ Chí Minh</option>
                                    <option>Đà Nẵng</option>
                                    <option>Hải Phòng</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-text-sub mb-2">Số điện thoại</label>
                                <input type="tel" class="w-full px-4 py-2.5 bg-dark-main border border-dark-border rounded-xl text-white focus:outline-none focus:border-brand-start transition-colors" value="0987 654 321">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-text-sub mb-2">Địa chỉ chi tiết</label>
                            <input type="text" class="w-full px-4 py-2.5 bg-dark-main border border-dark-border rounded-xl text-white focus:outline-none focus:border-brand-start transition-colors" value="Tầng 5, Vincom Center, Bà Triệu">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-text-sub mb-2">Mô tả giới thiệu (Không bắt buộc)</label>
                            <textarea rows="4" class="w-full px-4 py-3 bg-dark-main border border-dark-border rounded-xl text-white focus:outline-none focus:border-brand-start transition-colors">Cụm rạp lớn nhất tại khu vực trung tâm Hà Nội với 6 phòng chiếu tiêu chuẩn và 2 phòng IMAX hiện đại.</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                
                <div class="bg-dark-card border border-dark-border rounded-2xl p-6">
                    <h3 class="text-lg font-bold text-white mb-4">Trạng thái & Hình ảnh</h3>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-text-sub mb-2">Trạng thái</label>
                            <select class="w-full px-4 py-2.5 bg-dark-main border border-dark-border rounded-xl text-success focus:outline-none focus:border-brand-start transition-colors font-bold appearance-none">
                                <option value="active" class="text-success" selected>Hoạt động</option>
                                <option value="maintenance" class="text-warning">Bảo trì</option>
                                <option value="inactive" class="text-error">Tạm đóng</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-text-sub mb-2">Ảnh rạp chiếu (16:9)</label>
                            <div class="w-full aspect-video rounded-xl overflow-hidden relative group">
                                <img src="https://images.unsplash.com/photo-1517604931442-7e0c8ed2963c?q=80&w=500&auto=format&fit=crop" class="w-full h-full object-cover">
                                <div class="absolute inset-0 bg-black/50 flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer text-white">
                                    <i class="ph-bold ph-pencil-simple text-3xl mb-1"></i>
                                    <span class="text-xs font-bold">Thay ảnh</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col gap-3">
                    <button type="submit" class="w-full py-3 bg-gradient-to-r from-brand-start to-brand-end text-white rounded-xl font-bold hover:shadow-lg hover:shadow-brand-start/20 transition-all">
                        Cập nhật rạp
                    </button>
                    <a href="{{ route('admin.cinemas.index') }}" class="w-full py-3 bg-dark-main border border-dark-border text-white text-center rounded-xl font-medium hover:bg-dark-border transition-colors">
                        Hủy
                    </a>
                </div>

            </div>
        </div>
    </form>
@endsection
