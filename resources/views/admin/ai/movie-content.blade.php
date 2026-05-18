@extends('layouts.admin')

@section('title', 'AI Movie Content Generator - MovieMate Admin')
@section('page-title', 'Tạo nội dung phim bằng AI')

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        
        <!-- Left: Input Area -->
        <div class="bg-dark-card border border-dark-border rounded-2xl p-6 md:p-8 flex flex-col h-full relative overflow-hidden">
            <!-- Background Glow -->
            <div class="absolute top-0 right-0 w-64 h-64 bg-ai-start/10 rounded-full blur-[100px] pointer-events-none"></div>

            <div class="mb-6 relative z-10">
                <h3 class="text-xl font-bold text-white mb-2 flex items-center gap-2">
                    <i class="ph-fill ph-magic-wand text-ai-start"></i> Thông tin đầu vào
                </h3>
                <p class="text-sm text-text-sub">Cung cấp một số thông tin cơ bản, AI sẽ giúp bạn tạo mô tả hấp dẫn và chuẩn SEO.</p>
            </div>

            <form action="#" class="space-y-6 flex-grow relative z-10">
                <div>
                    <label class="block text-sm font-medium text-text-sub mb-2">Tên phim gốc</label>
                    <input type="text" class="w-full px-4 py-3 bg-dark-main border border-dark-border rounded-xl text-white focus:outline-none focus:border-ai-start transition-colors" placeholder="Ví dụ: Godzilla x Kong: The New Empire">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-text-sub mb-2">Thể loại chính</label>
                        <select class="w-full px-4 py-3 bg-dark-main border border-dark-border rounded-xl text-white focus:outline-none focus:border-ai-start transition-colors appearance-none">
                            <option>Hành động</option>
                            <option>Viễn tưởng</option>
                            <option>Kinh dị</option>
                            <option>Tình cảm</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-text-sub mb-2">Đạo diễn</label>
                        <input type="text" class="w-full px-4 py-3 bg-dark-main border border-dark-border rounded-xl text-white focus:outline-none focus:border-ai-start transition-colors" placeholder="Tên đạo diễn">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-text-sub mb-2">Từ khóa (Keywords) - Phân cách bằng dấu phẩy</label>
                    <input type="text" class="w-full px-4 py-3 bg-dark-main border border-dark-border rounded-xl text-white focus:outline-none focus:border-ai-start transition-colors" placeholder="quái vật, hành động, kỹ xảo...">
                </div>

                <div>
                    <label class="block text-sm font-medium text-text-sub mb-2">Phong cách viết</label>
                    <div class="grid grid-cols-3 gap-2">
                        <label class="cursor-pointer">
                            <input type="radio" name="style" class="peer sr-only" checked>
                            <div class="text-center px-2 py-2 bg-dark-main border border-dark-border rounded-lg text-sm text-text-sub peer-checked:bg-ai-start/10 peer-checked:border-ai-start peer-checked:text-ai-start font-medium transition-colors">
                                Hấp dẫn
                            </div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="style" class="peer sr-only">
                            <div class="text-center px-2 py-2 bg-dark-main border border-dark-border rounded-lg text-sm text-text-sub peer-checked:bg-ai-start/10 peer-checked:border-ai-start peer-checked:text-ai-start font-medium transition-colors">
                                Bí ẩn
                            </div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="style" class="peer sr-only">
                            <div class="text-center px-2 py-2 bg-dark-main border border-dark-border rounded-lg text-sm text-text-sub peer-checked:bg-ai-start/10 peer-checked:border-ai-start peer-checked:text-ai-start font-medium transition-colors">
                                Chuyên nghiệp
                            </div>
                        </label>
                    </div>
                </div>

                <div class="pt-4">
                    <button type="button" class="w-full py-4 bg-gradient-to-r from-ai-start to-ai-end text-white rounded-xl font-bold text-lg hover:shadow-lg hover:shadow-ai-start/30 transition-transform transform hover:-translate-y-0.5 flex items-center justify-center gap-2 group">
                        <i class="ph-bold ph-sparkle group-hover:animate-spin"></i> Tạo nội dung
                    </button>
                </div>
            </form>
        </div>

        <!-- Right: Result Area -->
        <div class="bg-dark-main border border-dark-border rounded-2xl flex flex-col h-full relative">
            
            <div class="p-4 border-b border-dark-border flex justify-between items-center bg-dark-card/50 rounded-t-2xl">
                <h3 class="font-bold text-white text-sm">Kết quả tạo (Preview)</h3>
                <div class="flex gap-2">
                    <button class="w-8 h-8 rounded-lg bg-dark-main border border-dark-border text-text-sub hover:text-white transition-colors flex items-center justify-center" title="Sao chép">
                        <i class="ph ph-copy"></i>
                    </button>
                    <button class="px-3 py-1.5 bg-brand-start text-white text-xs font-bold rounded-lg hover:bg-brand-end transition-colors">
                        Sử dụng cho phim mới
                    </button>
                </div>
            </div>

            <div class="p-6 flex-grow overflow-y-auto hide-scrollbar space-y-6">
                
                <!-- Skeleton Loading (Hidden by default, shown while generating) -->
                <div class="hidden animate-pulse space-y-4">
                    <div class="h-6 bg-dark-border rounded w-3/4"></div>
                    <div class="space-y-2">
                        <div class="h-4 bg-dark-border rounded"></div>
                        <div class="h-4 bg-dark-border rounded w-5/6"></div>
                        <div class="h-4 bg-dark-border rounded w-4/6"></div>
                    </div>
                </div>

                <!-- Generated Content (Mock) -->
                <div>
                    <h4 class="text-sm font-medium text-text-sub mb-2 uppercase tracking-wider">Tiêu đề (Tiếng Việt)</h4>
                    <p class="text-xl font-bold text-white bg-dark-card border border-dark-border p-3 rounded-xl">Godzilla x Kong: Đế Chế Mới</p>
                </div>

                <div>
                    <h4 class="text-sm font-medium text-text-sub mb-2 uppercase tracking-wider">Đoạn tóm tắt (Short Description - SEO)</h4>
                    <div class="bg-dark-card border border-dark-border p-4 rounded-xl relative">
                        <p class="text-sm text-white leading-relaxed">Chứng kiến cuộc đụng độ lịch sử khi hai siêu quái vật Godzilla và Kong buộc phải hợp sức để đối mặt với một mối đe dọa bí ẩn chưa từng có, đe dọa sự sinh tồn của cả nhân loại và Trái Đất Rỗng.</p>
                        <span class="absolute -top-2 -right-2 px-2 py-0.5 bg-success text-white text-[10px] font-bold rounded">Tối ưu</span>
                    </div>
                </div>

                <div>
                    <h4 class="text-sm font-medium text-text-sub mb-2 uppercase tracking-wider">Nội dung chi tiết (Full Description)</h4>
                    <div class="bg-dark-card border border-dark-border p-4 rounded-xl text-sm text-white leading-relaxed space-y-3">
                        <p>Tiếp nối thành công của những phần phim trước, <strong>Godzilla x Kong: Đế Chế Mới</strong> đưa khán giả vào một cuộc phiêu lưu ngoạn mục chưa từng có. Lần này, kẻ thù không chỉ đến từ trên mặt đất mà còn trỗi dậy từ những nơi sâu thẳm nhất của Trái Đất Rỗng - Skar King.</p>
                        <p>Liệu sức mạnh của Kong với vũ khí mới và sự tiến hóa của Godzilla có đủ để ngăn chặn thảm họa diệt vong? Với kỹ xảo CGI đỉnh cao, âm thanh sống động và những cảnh hành động mãn nhãn, đây chắc chắn là bom tấn bạn không thể bỏ lỡ tại rạp trong mùa hè này.</p>
                    </div>
                </div>

            </div>

        </div>

    </div>
@endsection
