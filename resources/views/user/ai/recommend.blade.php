@extends('layouts.user')

@section('title', 'AI Gợi ý phim - MovieMate')

@section('content')
    <!-- AI Hero -->
    <section class="relative pt-24 pb-16 overflow-hidden">
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-5"></div>
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-ai-start/20 rounded-full blur-[120px] -translate-y-1/2 translate-x-1/3"></div>
        <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-brand-start/10 rounded-full blur-[100px] translate-y-1/3 -translate-x-1/3"></div>

        <div class="max-w-4xl mx-auto px-4 text-center relative z-10">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-ai-start/10 border border-ai-start/30 mb-6 animate-[fade-in-up_0.5s_ease-out]">
                <i class="ph-fill ph-magic-wand text-ai-start"></i>
                <span class="text-sm font-medium text-ai-start">Trí tuệ nhân tạo MovieMate</span>
            </div>
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-6 animate-[fade-in-up_0.6s_ease-out]">
                AI gợi ý phim <span class="text-transparent bg-clip-text bg-gradient-to-r from-ai-start to-brand-start">dành riêng cho bạn</span>
            </h1>
            <p class="text-lg text-text-sub mb-10 max-w-2xl mx-auto animate-[fade-in-up_0.7s_ease-out]">
                Hãy cho chúng tôi biết bạn đang cảm thấy thế nào và muốn xem gì. AI sẽ phân tích hàng ngàn bộ phim để tìm ra lựa chọn hoàn hảo nhất lúc này.
            </p>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12">
            
            <!-- Form Area (Left) -->
            <div class="lg:col-span-5 relative z-20">
                <div class="bg-dark-card border border-dark-border rounded-3xl p-6 sm:p-8 shadow-2xl shadow-black">
                    <form action="#" method="POST" class="space-y-6">
                        @csrf
                        
                        <div>
                            <label class="block text-sm font-medium text-white mb-3">Bạn đang cảm thấy thế nào?</label>
                            <div class="flex flex-wrap gap-3">
                                <label class="cursor-pointer">
                                    <input type="radio" name="mood" class="peer sr-only" value="happy">
                                    <div class="px-4 py-2 bg-dark-main border border-dark-border rounded-xl text-text-sub hover:border-ai-start/50 peer-checked:bg-ai-start/10 peer-checked:border-ai-start peer-checked:text-white transition-all text-sm flex items-center gap-2">
                                        😀 Vui vẻ
                                    </div>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="radio" name="mood" class="peer sr-only" value="sad">
                                    <div class="px-4 py-2 bg-dark-main border border-dark-border rounded-xl text-text-sub hover:border-ai-start/50 peer-checked:bg-ai-start/10 peer-checked:border-ai-start peer-checked:text-white transition-all text-sm flex items-center gap-2">
                                        😔 Buồn chán
                                    </div>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="radio" name="mood" class="peer sr-only" value="stress" checked>
                                    <div class="px-4 py-2 bg-dark-main border border-dark-border rounded-xl text-text-sub hover:border-ai-start/50 peer-checked:bg-ai-start/10 peer-checked:border-ai-start peer-checked:text-white transition-all text-sm flex items-center gap-2">
                                        😫 Căng thẳng
                                    </div>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="radio" name="mood" class="peer sr-only" value="chill">
                                    <div class="px-4 py-2 bg-dark-main border border-dark-border rounded-xl text-text-sub hover:border-ai-start/50 peer-checked:bg-ai-start/10 peer-checked:border-ai-start peer-checked:text-white transition-all text-sm flex items-center gap-2">
                                        ☕ Chill
                                    </div>
                                </label>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-white mb-3">Thể loại bạn muốn xem?</label>
                            <div class="flex flex-wrap gap-3">
                                <label class="cursor-pointer">
                                    <input type="checkbox" name="genre[]" class="peer sr-only" value="action" checked>
                                    <div class="px-4 py-2 bg-dark-main border border-dark-border rounded-xl text-text-sub hover:border-ai-start/50 peer-checked:bg-ai-start/10 peer-checked:border-ai-start peer-checked:text-white transition-all text-sm">
                                        Hành động
                                    </div>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="checkbox" name="genre[]" class="peer sr-only" value="comedy">
                                    <div class="px-4 py-2 bg-dark-main border border-dark-border rounded-xl text-text-sub hover:border-ai-start/50 peer-checked:bg-ai-start/10 peer-checked:border-ai-start peer-checked:text-white transition-all text-sm">
                                        Hài hước
                                    </div>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="checkbox" name="genre[]" class="peer sr-only" value="scifi" checked>
                                    <div class="px-4 py-2 bg-dark-main border border-dark-border rounded-xl text-text-sub hover:border-ai-start/50 peer-checked:bg-ai-start/10 peer-checked:border-ai-start peer-checked:text-white transition-all text-sm">
                                        Viễn tưởng
                                    </div>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="checkbox" name="genre[]" class="peer sr-only" value="horror">
                                    <div class="px-4 py-2 bg-dark-main border border-dark-border rounded-xl text-text-sub hover:border-ai-start/50 peer-checked:bg-ai-start/10 peer-checked:border-ai-start peer-checked:text-white transition-all text-sm">
                                        Kinh dị
                                    </div>
                                </label>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-white mb-3">Bạn đi xem với ai?</label>
                            <select class="w-full px-4 py-3 bg-dark-main border border-dark-border rounded-xl text-white focus:outline-none focus:border-ai-start focus:ring-1 focus:ring-ai-start transition-colors appearance-none">
                                <option value="alone">Một mình</option>
                                <option value="couple" selected>Người yêu / Vợ chồng</option>
                                <option value="friends">Bạn bè</option>
                                <option value="family">Gia đình có trẻ em</option>
                            </select>
                        </div>

                        <button type="submit" class="w-full py-4 bg-gradient-to-r from-ai-start to-ai-end text-white rounded-xl font-bold text-lg hover:shadow-lg hover:shadow-ai-start/30 transition-all transform hover:-translate-y-0.5 flex items-center justify-center gap-2">
                            <i class="ph-fill ph-magic-wand"></i> Tạo gợi ý ngay
                        </button>
                    </form>
                </div>
            </div>

            <!-- Result Area (Right) -->
            <div class="lg:col-span-7">
                <div class="h-full flex flex-col justify-center">
                    
                    <!-- Title -->
                    <div class="mb-6 flex items-center gap-3">
                        <span class="w-8 h-px bg-ai-start/50"></span>
                        <h2 class="text-xl font-bold text-white uppercase tracking-wider">AI Đề xuất cho bạn</h2>
                        <span class="w-full h-px bg-dark-border flex-grow"></span>
                    </div>

                    <!-- Result Card -->
                    <div class="bg-gradient-to-br from-[#1E1B4B] to-dark-main border border-ai-start/30 rounded-3xl p-6 sm:p-8 relative overflow-hidden group">
                        <!-- AI Sparkles -->
                        <i class="ph-fill ph-sparkle absolute top-6 right-6 text-4xl text-ai-start/40 group-hover:text-ai-start/80 transition-colors animate-pulse"></i>

                        <div class="flex flex-col md:flex-row gap-8">
                            <!-- Poster -->
                            <div class="w-full md:w-48 flex-shrink-0">
                                <img src="https://image.tmdb.org/t/p/w500/tMefBSflR6PGQLvLuPE31clYe3D.jpg" alt="Poster" class="w-full rounded-2xl shadow-2xl shadow-black">
                            </div>

                            <!-- Info -->
                            <div>
                                <div class="inline-block px-3 py-1 bg-ai-start/20 border border-ai-start/50 text-ai-start text-xs font-bold rounded-lg mb-4">
                                    Độ phù hợp: 98%
                                </div>
                                <h3 class="text-3xl font-bold text-white mb-2">Godzilla x Kong</h3>
                                <p class="text-text-sub mb-4">Hành động, Viễn tưởng • 115 phút • T13</p>

                                <!-- AI Reason -->
                                <div class="bg-dark-main/50 rounded-xl p-4 mb-6 border border-dark-border">
                                    <p class="text-sm text-white leading-relaxed">
                                        <i class="ph-fill ph-robot text-ai-start mr-1"></i> 
                                        <strong>Tại sao chọn phim này?</strong> Vì bạn đang cảm thấy căng thẳng và muốn xem phim hành động viễn tưởng cùng người yêu, những pha kỹ xảo hoành tráng và âm thanh bùng nổ của bộ phim này sẽ giúp bạn xả stress cực tốt. Phim mang tính giải trí cao, không cần suy nghĩ nhiều.
                                    </p>
                                </div>

                                <div class="flex flex-wrap gap-4">
                                    <a href="{{ route('user.bookings.selectSeat') }}" class="px-6 py-3 bg-gradient-to-r from-brand-start to-brand-end text-white rounded-xl font-bold hover:shadow-lg hover:shadow-brand-start/30 transition-transform transform hover:-translate-y-0.5">
                                        Đặt vé ngay
                                    </a>
                                    <a href="{{ route('user.movies.show', 1) }}" class="px-6 py-3 bg-dark-card border border-dark-border text-white rounded-xl font-bold hover:bg-dark-border transition-colors">
                                        Xem chi tiết
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Alternate suggestions -->
                    <div class="mt-8 grid grid-cols-2 gap-4">
                        <div class="bg-dark-card border border-dark-border rounded-2xl p-4 flex gap-4 hover:border-ai-start/50 transition-colors cursor-pointer">
                            <img src="https://image.tmdb.org/t/p/w500/1pdfLvkbY9ohJlCjQH2JGjjcNsV.jpg" alt="Dune" class="w-16 h-24 object-cover rounded-lg">
                            <div>
                                <p class="text-xs text-ai-start font-bold mb-1">Phù hợp 92%</p>
                                <h4 class="text-white font-bold text-sm line-clamp-1 mb-1">Dune: Part Two</h4>
                                <p class="text-xs text-text-sub line-clamp-2">Cốt truyện sâu sắc, hình ảnh tráng lệ nếu bạn muốn một trải nghiệm điện ảnh thực thụ.</p>
                            </div>
                        </div>
                        <div class="bg-dark-card border border-dark-border rounded-2xl p-4 flex gap-4 hover:border-ai-start/50 transition-colors cursor-pointer">
                            <img src="https://image.tmdb.org/t/p/w500/qJ2tW6WMUDux911r6m7haRef0WH.jpg" alt="Demon" class="w-16 h-24 object-cover rounded-lg">
                            <div>
                                <p class="text-xs text-ai-start font-bold mb-1">Phù hợp 85%</p>
                                <h4 class="text-white font-bold text-sm line-clamp-1 mb-1">Thanh Gươm Diệt Quỷ</h4>
                                <p class="text-xs text-text-sub line-clamp-2">Hành động nhịp độ nhanh, đồ họa đẹp mắt giúp giải tỏa mệt mỏi hiệu quả.</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection