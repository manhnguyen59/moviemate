@extends('layouts.admin')

@section('title', 'Thêm phim mới - MovieMate Admin')
@section('page-title', 'Thêm phim mới')

@section('content')
    <form action="#" class="max-w-5xl">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            <!-- Cột trái: Form thông tin chính -->
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-dark-card border border-dark-border rounded-2xl p-6">
                    <h3 class="text-lg font-bold text-white mb-6">Thông tin chung</h3>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-text-sub mb-2">Tên phim</label>
                            <input type="text" class="w-full px-4 py-2.5 bg-dark-main border border-dark-border rounded-xl text-white focus:outline-none focus:border-brand-start transition-colors" placeholder="Nhập tên phim">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-text-sub mb-2">Slug (Đường dẫn)</label>
                            <input type="text" class="w-full px-4 py-2.5 bg-dark-main border border-dark-border rounded-xl text-white focus:outline-none focus:border-brand-start transition-colors" placeholder="nhap-ten-phim">
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-text-sub mb-2">Quốc gia</label>
                                <select class="w-full px-4 py-2.5 bg-dark-main border border-dark-border rounded-xl text-white focus:outline-none focus:border-brand-start transition-colors appearance-none">
                                    <option>Mỹ</option>
                                    <option>Việt Nam</option>
                                    <option>Hàn Quốc</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-text-sub mb-2">Thời lượng (Phút)</label>
                                <input type="number" class="w-full px-4 py-2.5 bg-dark-main border border-dark-border rounded-xl text-white focus:outline-none focus:border-brand-start transition-colors" placeholder="120">
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-text-sub mb-2">Ngày khởi chiếu</label>
                                <input type="date" class="w-full px-4 py-2.5 bg-dark-main border border-dark-border rounded-xl text-white focus:outline-none focus:border-brand-start transition-colors [color-scheme:dark]">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-text-sub mb-2">Độ tuổi</label>
                                <select class="w-full px-4 py-2.5 bg-dark-main border border-dark-border rounded-xl text-white focus:outline-none focus:border-brand-start transition-colors appearance-none">
                                    <option>P - Phổ biến</option>
                                    <option>K - Khán giả dưới 13 tuổi</option>
                                    <option>T13 - Khán giả từ 13 tuổi</option>
                                    <option>T16 - Khán giả từ 16 tuổi</option>
                                    <option>T18 - Khán giả từ 18 tuổi</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-dark-card border border-dark-border rounded-2xl p-6 relative overflow-hidden group">
                    <div class="absolute inset-0 bg-gradient-to-br from-ai-start/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    
                    <div class="flex justify-between items-center mb-4 relative z-10">
                        <h3 class="text-lg font-bold text-white flex items-center gap-2">
                            Mô tả phim 
                            <span class="text-[10px] bg-ai-start/20 text-ai-start px-2 py-0.5 rounded border border-ai-start/30 font-bold uppercase">AI Support</span>
                        </h3>
                        <a href="{{ route('admin.ai.movieContent') }}" class="px-3 py-1.5 bg-ai-start/10 text-ai-start text-xs font-bold rounded hover:bg-ai-start hover:text-white transition-colors border border-ai-start/50 flex items-center gap-1">
                            <i class="ph-bold ph-magic-wand"></i> Tạo bằng AI
                        </a>
                    </div>
                    
                    <div class="relative z-10">
                        <textarea rows="6" class="w-full px-4 py-3 bg-dark-main border border-dark-border rounded-xl text-white focus:outline-none focus:border-ai-start transition-colors" placeholder="Nhập nội dung mô tả..."></textarea>
                    </div>
                </div>
            </div>

            <!-- Cột phải: Media & Action -->
            <div class="space-y-6">
                
                <div class="bg-dark-card border border-dark-border rounded-2xl p-6">
                    <h3 class="text-lg font-bold text-white mb-4">Thể loại & Trạng thái</h3>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-text-sub mb-2">Trạng thái</label>
                            <select class="w-full px-4 py-2.5 bg-dark-main border border-dark-border rounded-xl text-success focus:outline-none focus:border-brand-start transition-colors font-bold appearance-none">
                                <option value="showing" class="text-success">Đang chiếu</option>
                                <option value="upcoming" class="text-warning">Sắp chiếu</option>
                                <option value="stopped" class="text-text-sub">Ngừng chiếu</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-text-sub mb-2">Thể loại (Chọn nhiều)</label>
                            <div class="h-32 overflow-y-auto bg-dark-main border border-dark-border rounded-xl p-3 space-y-2 custom-scrollbar">
                                <label class="flex items-center gap-2 text-sm text-white cursor-pointer hover:text-brand-start">
                                    <input type="checkbox" class="rounded bg-dark-card border-dark-border text-brand-start focus:ring-brand-start">
                                    Hành động
                                </label>
                                <label class="flex items-center gap-2 text-sm text-white cursor-pointer hover:text-brand-start">
                                    <input type="checkbox" class="rounded bg-dark-card border-dark-border text-brand-start focus:ring-brand-start">
                                    Hài hước
                                </label>
                                <label class="flex items-center gap-2 text-sm text-white cursor-pointer hover:text-brand-start">
                                    <input type="checkbox" class="rounded bg-dark-card border-dark-border text-brand-start focus:ring-brand-start">
                                    Viễn tưởng
                                </label>
                                <label class="flex items-center gap-2 text-sm text-white cursor-pointer hover:text-brand-start">
                                    <input type="checkbox" class="rounded bg-dark-card border-dark-border text-brand-start focus:ring-brand-start">
                                    Tâm lý
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-dark-card border border-dark-border rounded-2xl p-6">
                    <h3 class="text-lg font-bold text-white mb-4">Media</h3>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-text-sub mb-2">Poster dọc (2:3)</label>
                            <div class="w-full aspect-[2/3] max-w-[200px] mx-auto bg-dark-main border-2 border-dashed border-dark-border hover:border-brand-start rounded-xl flex flex-col items-center justify-center cursor-pointer transition-colors text-text-sub hover:text-brand-start">
                                <i class="ph-bold ph-image text-4xl mb-2"></i>
                                <span class="text-xs font-medium">Tải ảnh lên</span>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-text-sub mb-2">Banner ngang (16:9)</label>
                            <div class="w-full aspect-video bg-dark-main border-2 border-dashed border-dark-border hover:border-brand-start rounded-xl flex flex-col items-center justify-center cursor-pointer transition-colors text-text-sub hover:text-brand-start">
                                <i class="ph-bold ph-image text-3xl mb-2"></i>
                                <span class="text-xs font-medium">Tải ảnh lên</span>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-text-sub mb-2">Trailer URL (Youtube)</label>
                            <input type="url" class="w-full px-4 py-2 bg-dark-main border border-dark-border rounded-xl text-white focus:outline-none focus:border-brand-start transition-colors text-sm" placeholder="https://youtube.com/...">
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col gap-3">
                    <button type="submit" class="w-full py-3 bg-gradient-to-r from-brand-start to-brand-end text-white rounded-xl font-bold hover:shadow-lg hover:shadow-brand-start/20 transition-all">
                        Lưu Phim
                    </button>
                    <a href="{{ route('admin.movies.index') }}" class="w-full py-3 bg-dark-main border border-dark-border text-white text-center rounded-xl font-medium hover:bg-dark-border transition-colors">
                        Hủy
                    </a>
                </div>

            </div>
        </div>
    </form>
@endsection
