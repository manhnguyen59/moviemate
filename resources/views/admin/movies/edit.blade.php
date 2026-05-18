@extends('layouts.admin')

@section('title', 'Chỉnh sửa phim - MovieMate Admin')
@section('page-title', 'Chỉnh sửa phim')

@section('content')
    <form action="#" class="max-w-5xl">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <!-- Left: Main Info -->
            <div class="lg:col-span-2 space-y-5">
                <div class="app-card border app-border rounded-2xl p-6">
                    <h3 class="text-base font-bold app-text mb-5">Thông tin chung</h3>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium app-muted mb-1.5">Tên phim</label>
                            <input type="text" class="app-input w-full px-4 py-2.5 border app-border rounded-xl focus:outline-none focus:border-brand-start transition-colors text-sm" value="Thanh Gươm Diệt Quỷ">
                        </div>

                        <div>
                            <label class="block text-sm font-medium app-muted mb-1.5">Slug (Đường dẫn)</label>
                            <input type="text" class="app-input w-full px-4 py-2.5 border app-border rounded-xl focus:outline-none focus:border-brand-start transition-colors text-sm" value="thanh-guom-diet-quy">
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium app-muted mb-1.5">Quốc gia</label>
                                <select class="app-input w-full px-4 py-2.5 border app-border rounded-xl focus:outline-none focus:border-brand-start transition-colors appearance-none text-sm">
                                    <option>Mỹ</option>
                                    <option>Việt Nam</option>
                                    <option selected>Nhật Bản</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium app-muted mb-1.5">Thời lượng (Phút)</label>
                                <input type="number" class="app-input w-full px-4 py-2.5 border app-border rounded-xl focus:outline-none focus:border-brand-start transition-colors text-sm" value="115">
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium app-muted mb-1.5">Ngày khởi chiếu</label>
                                <input type="date" class="app-input w-full px-4 py-2.5 border app-border rounded-xl focus:outline-none focus:border-brand-start transition-colors text-sm [color-scheme:dark]" value="2026-05-19">
                            </div>
                            <div>
                                <label class="block text-sm font-medium app-muted mb-1.5">Độ tuổi</label>
                                <select class="app-input w-full px-4 py-2.5 border app-border rounded-xl focus:outline-none focus:border-brand-start transition-colors appearance-none text-sm">
                                    <option>P - Phổ biến</option>
                                    <option>K - Dưới 13 tuổi</option>
                                    <option selected>T13 - Từ 13 tuổi</option>
                                    <option>T16 - Từ 16 tuổi</option>
                                    <option>T18 - Từ 18 tuổi</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Description + AI -->
                <div class="app-card border app-border rounded-2xl p-6 relative overflow-hidden group">
                    <div class="absolute inset-0 bg-gradient-to-br from-ai-start/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none"></div>

                    <div class="flex justify-between items-center mb-4 relative z-10">
                        <h3 class="text-base font-bold app-text flex items-center gap-2">
                            Mô tả phim
                            <span class="text-[10px] bg-ai-start/20 text-ai-start px-2 py-0.5 rounded border border-ai-start/30 font-bold uppercase">AI Support</span>
                        </h3>
                        <a href="{{ route('admin.ai.movieContent') }}" class="px-3 py-1.5 bg-ai-start/10 text-ai-start text-xs font-bold rounded hover:bg-ai-start hover:text-white transition-colors border border-ai-start/50 flex items-center gap-1">
                            <i class="ph-bold ph-magic-wand"></i> Tạo lại bằng AI
                        </a>
                    </div>

                    <textarea rows="5" class="app-input w-full px-4 py-3 border app-border rounded-xl focus:outline-none focus:border-ai-start transition-colors text-sm resize-none relative z-10">Tanjirou và những người bạn cùng với Luyến Trụ và Hà Trụ phải đối mặt với Thượng Huyền Ngũ và Thượng Huyền Tứ trong một cuộc chiến sinh tử tại Làng Thợ Rèn.</textarea>
                </div>
            </div>

            <!-- Right: Status, Genre, Media -->
            <div class="space-y-5">

                <div class="app-card border app-border rounded-2xl p-6">
                    <h3 class="text-base font-bold app-text mb-4">Thể loại & Trạng thái</h3>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium app-muted mb-1.5">Trạng thái</label>
                            <select class="app-input w-full px-4 py-2.5 border app-border rounded-xl focus:outline-none focus:border-brand-start transition-colors font-bold appearance-none text-sm text-success">
                                <option value="showing" selected class="text-success">Đang chiếu</option>
                                <option value="upcoming" class="text-warning">Sắp chiếu</option>
                                <option value="stopped" class="app-muted">Ngừng chiếu</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium app-muted mb-1.5">Thể loại (Chọn nhiều)</label>
                            <div class="h-32 overflow-y-auto app-secondary border app-border rounded-xl p-3 space-y-2 hide-scrollbar">
                                @foreach(['Hành động', 'Hài hước', 'Hoạt hình', 'Tâm lý', 'Kinh dị', 'Tình cảm'] as $i => $genre)
                                <label class="flex items-center gap-2 text-sm app-text cursor-pointer hover:text-brand-start">
                                    <input type="checkbox" class="rounded app-card border-dark-border text-brand-start focus:ring-brand-start" {{ in_array($i, [0,2]) ? 'checked' : '' }}>
                                    {{ $genre }}
                                </label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="app-card border app-border rounded-2xl p-6">
                    <h3 class="text-base font-bold app-text mb-4">Media</h3>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium app-muted mb-2">Poster dọc (2:3)</label>
                            <div class="w-36 mx-auto rounded-xl overflow-hidden relative group cursor-pointer" style="padding-top: 54%; padding-top: calc(36px * 1.5);">
                                <div class="relative overflow-hidden" style="padding-top: 150%;">
                                    <img src="https://image.tmdb.org/t/p/w500/qJ2tW6WMUDux911r6m7haRef0WH.jpg" class="absolute inset-0 w-full h-full object-cover">
                                    <div class="absolute inset-0 bg-black/50 flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity text-white">
                                        <i class="ph-bold ph-pencil-simple text-2xl mb-1"></i>
                                        <span class="text-xs font-bold">Thay ảnh</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium app-muted mb-1.5">Trailer URL (Youtube)</label>
                            <input type="url" class="app-input w-full px-4 py-2 border app-border rounded-xl focus:outline-none focus:border-brand-start transition-colors text-sm" value="https://youtube.com/watch?v=...">
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col gap-3">
                    <button type="submit" class="w-full py-3 bg-gradient-to-r from-brand-start to-brand-end text-white rounded-xl font-bold text-sm hover:shadow-lg hover:shadow-brand-start/20 transition-all hover:-translate-y-0.5">
                        Cập nhật phim
                    </button>
                    <a href="{{ route('admin.movies.index') }}" class="w-full py-3 app-secondary border app-border app-muted hover:app-text text-center rounded-xl font-medium transition-colors text-sm">
                        Hủy
                    </a>
                </div>

            </div>
        </div>
    </form>
@endsection
