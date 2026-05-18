@extends('layouts.admin')

@section('title', 'Thêm rạp chiếu - MovieMate Admin')
@section('page-title', 'Thêm rạp chiếu')

@section('content')
    <form action="#" class="max-w-5xl">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-dark-card border border-dark-border rounded-2xl p-6">
                    <h3 class="text-lg font-bold text-white mb-6">Thông tin chung</h3>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-text-sub mb-2">Tên cụm rạp</label>
                            <input type="text" class="w-full px-4 py-2.5 bg-dark-main border border-dark-border rounded-xl text-white focus:outline-none focus:border-brand-start transition-colors" placeholder="MovieMate Hà Nội">
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-text-sub mb-2">Thành phố</label>
                                <select class="w-full px-4 py-2.5 bg-dark-main border border-dark-border rounded-xl text-white focus:outline-none focus:border-brand-start transition-colors appearance-none">
                                    <option>Hà Nội</option>
                                    <option>Hồ Chí Minh</option>
                                    <option>Đà Nẵng</option>
                                    <option>Hải Phòng</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-text-sub mb-2">Số điện thoại</label>
                                <input type="tel" class="w-full px-4 py-2.5 bg-dark-main border border-dark-border rounded-xl text-white focus:outline-none focus:border-brand-start transition-colors" placeholder="0123 456 789">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-text-sub mb-2">Địa chỉ chi tiết</label>
                            <input type="text" class="w-full px-4 py-2.5 bg-dark-main border border-dark-border rounded-xl text-white focus:outline-none focus:border-brand-start transition-colors" placeholder="Số nhà, đường, quận/huyện...">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-text-sub mb-2">Mô tả giới thiệu (Không bắt buộc)</label>
                            <textarea rows="4" class="w-full px-4 py-3 bg-dark-main border border-dark-border rounded-xl text-white focus:outline-none focus:border-brand-start transition-colors" placeholder="Giới thiệu về cụm rạp..."></textarea>
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
                                <option value="active" class="text-success">Hoạt động</option>
                                <option value="maintenance" class="text-warning">Bảo trì</option>
                                <option value="inactive" class="text-error">Tạm đóng</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-text-sub mb-2">Ảnh rạp chiếu (16:9)</label>
                            <div class="w-full aspect-video bg-dark-main border-2 border-dashed border-dark-border hover:border-brand-start rounded-xl flex flex-col items-center justify-center cursor-pointer transition-colors text-text-sub hover:text-brand-start">
                                <i class="ph-bold ph-image text-4xl mb-2"></i>
                                <span class="text-xs font-medium">Tải ảnh lên</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col gap-3">
                    <button type="submit" class="w-full py-3 bg-gradient-to-r from-brand-start to-brand-end text-white rounded-xl font-bold hover:shadow-lg hover:shadow-brand-start/20 transition-all">
                        Lưu cụm rạp
                    </button>
                    <a href="{{ route('admin.cinemas.index') }}" class="w-full py-3 bg-dark-main border border-dark-border text-white text-center rounded-xl font-medium hover:bg-dark-border transition-colors">
                        Hủy
                    </a>
                </div>

            </div>
        </div>
    </form>
@endsection
