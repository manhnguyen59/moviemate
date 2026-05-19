@extends('layouts.user')

@section('title', 'AI Chatbot - MovieMate')

@section('content')
<div class="chat-shell max-w-7xl mx-auto px-3 sm:px-6 lg:px-8 py-4 sm:py-6 h-[calc(100dvh-7rem)] md:h-[calc(100dvh-8rem)] min-h-[32rem]">
    <div class="app-card border app-border rounded-3xl h-full flex overflow-hidden shadow-2xl shadow-black/25">
        <aside class="w-72 border-r app-border flex-col hidden md:flex app-secondary">
            <div class="p-5 border-b app-border">
                <a href="{{ route('user.ai.recommend') }}" class="w-full py-2.5 bg-gradient-to-r from-ai-start to-ai-end text-white rounded-xl font-bold flex items-center justify-center gap-2 hover:shadow-lg hover:shadow-ai-start/20 transition-all text-sm">
                    <i class="ph-fill ph-magic-wand"></i> AI Gợi ý phim
                </a>
            </div>

            <div class="p-5 flex-grow overflow-y-auto hide-scrollbar">
                <h3 class="text-[10px] font-bold app-muted uppercase tracking-wider mb-3">Câu hỏi thường gặp</h3>
                <div class="space-y-1.5">
                    <button class="w-full text-left p-3 rounded-xl app-card border app-border text-sm app-muted hover:app-text hover:border-ai-start/50 transition-colors">Hôm nay có phim gì hay?</button>
                    <button class="w-full text-left p-3 rounded-xl app-card border app-border text-sm app-muted hover:app-text hover:border-ai-start/50 transition-colors">Tôi muốn xem phim hành động</button>
                    <button class="w-full text-left p-3 rounded-xl app-card border app-border text-sm app-muted hover:app-text hover:border-ai-start/50 transition-colors">Phim nào phù hợp xem với gia đình?</button>
                    <button class="w-full text-left p-3 rounded-xl app-card border app-border text-sm app-muted hover:app-text hover:border-ai-start/50 transition-colors">Làm sao để đặt vé?</button>
                </div>

                <h3 class="text-[10px] font-bold app-muted uppercase tracking-wider mb-3 mt-6">Lịch sử chat</h3>
                <div class="space-y-1">
                    <div class="p-3 rounded-xl hover:app-card text-sm app-muted cursor-pointer transition-colors line-clamp-1">
                        <i class="ph ph-chat-teardrop mr-2"></i>Review phim Lật Mặt 8
                    </div>
                    <div class="p-3 rounded-xl hover:app-card text-sm app-muted cursor-pointer transition-colors line-clamp-1">
                        <i class="ph ph-chat-teardrop mr-2"></i>Rạp Cầu Giấy ở đâu?
                    </div>
                </div>
            </div>
        </aside>

        <section class="flex-grow flex flex-col min-w-0">
            <div class="h-16 border-b app-border flex items-center justify-between px-5 app-card shrink-0">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-full bg-gradient-to-br from-ai-start to-ai-end flex items-center justify-center relative shrink-0">
                        <i class="ph-fill ph-robot text-white text-lg"></i>
                        <div class="absolute bottom-0 right-0 w-2.5 h-2.5 bg-success rounded-full border-2 border-[var(--card-bg)]"></div>
                    </div>
                    <div>
                        <h1 class="font-bold app-text text-sm leading-tight">MovieMate AI</h1>
                        <p class="text-xs text-ai-start">Đang hoạt động</p>
                    </div>
                </div>
                <button class="app-muted hover:app-text">
                    <i class="ph ph-dots-three-circle text-xl"></i>
                </button>
            </div>

            <div class="flex-grow overflow-y-auto p-5 space-y-5 scroll-smooth" id="chat-messages">
                <div class="flex gap-3 max-w-[88%]">
                    <div class="w-8 h-8 rounded-full bg-gradient-to-br from-ai-start to-ai-end shrink-0 flex items-center justify-center mt-1">
                        <i class="ph-fill ph-robot text-white text-sm"></i>
                    </div>
                    <div class="min-w-0">
                        <div class="app-secondary border app-border rounded-2xl rounded-tl-sm p-4 text-sm app-text leading-relaxed">
                            Xin chào! Tôi là trợ lý ảo AI của MovieMate. Tôi có thể giúp bạn tìm kiếm phim, gợi ý phim theo sở thích, kiểm tra lịch chiếu hoặc hướng dẫn đặt vé. Bạn cần tôi giúp gì hôm nay?
                        </div>
                        <span class="text-[10px] app-muted mt-1.5 inline-block">10:00 AM</span>
                    </div>
                </div>

                <div class="flex gap-3 max-w-[88%] ml-auto justify-end">
                    <div class="text-right min-w-0">
                        <div class="bg-gradient-to-br from-brand-start to-brand-end rounded-2xl rounded-tr-sm p-4 text-sm text-white leading-relaxed inline-block text-left">
                            Có phim nào hành động hay đang chiếu không? Tôi muốn xem ở khu vực Cầu Giấy tối nay.
                        </div>
                        <span class="text-[10px] app-muted mt-1.5 inline-block">10:02 AM</span>
                    </div>
                    <div class="w-8 h-8 rounded-full app-secondary shrink-0 overflow-hidden mt-1 border app-border">
                        <img src="https://ui-avatars.com/api/?name=User&background=333&color=fff" alt="User" class="w-full h-full object-cover">
                    </div>
                </div>

                <div class="flex gap-3 max-w-[88%]">
                    <div class="w-8 h-8 rounded-full bg-gradient-to-br from-ai-start to-ai-end shrink-0 flex items-center justify-center mt-1">
                        <i class="ph-fill ph-robot text-white text-sm"></i>
                    </div>
                    <div class="min-w-0">
                        <div class="app-secondary border app-border rounded-2xl rounded-tl-sm p-4 text-sm app-text leading-relaxed space-y-3">
                            <p>Tuyệt vời! Dựa trên yêu cầu của bạn, tôi tìm thấy 2 bộ phim hành động đang chiếu tại <strong>MovieMate Cầu Giấy</strong> vào tối nay:</p>

                            <div class="app-card border app-border rounded-xl p-3 flex gap-3 min-w-0">
                                <img src="https://image.tmdb.org/t/p/w500/tMefBSflR6PGQLvLuPE31clYe3D.jpg" alt="Godzilla x Kong" class="w-10 h-14 rounded object-cover shrink-0">
                                <div class="min-w-0">
                                    <h4 class="font-bold text-brand-start text-sm mb-0.5">Godzilla x Kong: Đế Chế Mới</h4>
                                    <p class="text-xs app-muted mb-2">Suất chiếu: 19:30, 21:00, 22:15</p>
                                    <a href="{{ route('user.movies.index') }}" class="text-xs text-white bg-brand-start px-2.5 py-1 rounded-lg hover:bg-brand-end transition-colors">Đặt vé</a>
                                </div>
                            </div>

                            <div class="app-card border app-border rounded-xl p-3 flex gap-3 min-w-0">
                                <img src="https://image.tmdb.org/t/p/w500/8cdWjvZQUExUUTzyp4t6EDMubfO.jpg" alt="Deadpool & Wolverine" class="w-10 h-14 rounded object-cover shrink-0">
                                <div class="min-w-0">
                                    <h4 class="font-bold text-brand-start text-sm mb-0.5">Deadpool & Wolverine</h4>
                                    <p class="text-xs app-muted mb-2">Suất chiếu: 20:15, 23:00</p>
                                    <a href="{{ route('user.movies.index') }}" class="text-xs text-white bg-brand-start px-2.5 py-1 rounded-lg hover:bg-brand-end transition-colors">Đặt vé</a>
                                </div>
                            </div>

                            <p>Bạn muốn xem thông tin chi tiết hay tiến hành đặt vé luôn?</p>
                        </div>
                        <span class="text-[10px] app-muted mt-1.5 inline-block">10:03 AM</span>
                    </div>
                </div>

                <div class="flex gap-3 max-w-[88%] hidden" id="typing-indicator">
                    <div class="w-8 h-8 rounded-full bg-gradient-to-br from-ai-start to-ai-end shrink-0 flex items-center justify-center mt-1">
                        <i class="ph-fill ph-robot text-white text-sm"></i>
                    </div>
                    <div class="app-secondary border app-border rounded-2xl rounded-tl-sm p-4">
                        <div class="flex gap-1">
                            <div class="w-2 h-2 bg-text-sub rounded-full animate-bounce"></div>
                            <div class="w-2 h-2 bg-text-sub rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
                            <div class="w-2 h-2 bg-text-sub rounded-full animate-bounce" style="animation-delay: 0.4s"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-4 border-t app-border app-secondary shrink-0">
                <form action="#" class="flex items-end gap-2">
                    <button type="button" class="p-2.5 app-muted hover:app-text transition-colors shrink-0">
                        <i class="ph ph-microphone text-xl"></i>
                    </button>
                    <div class="relative flex-grow">
                        <textarea rows="1"
                            class="app-input w-full border app-border rounded-2xl py-3 pl-4 pr-4 text-sm focus:outline-none focus:border-ai-start transition-colors resize-none hide-scrollbar"
                            placeholder="Nhập tin nhắn..."
                            style="min-height: 46px; max-height: 120px;"></textarea>
                    </div>
                    <button type="submit" class="p-2.5 bg-ai-start hover:bg-ai-end text-white rounded-xl transition-colors shrink-0">
                        <i class="ph-fill ph-paper-plane-right text-xl"></i>
                    </button>
                </form>
                <p class="text-[10px] text-center app-muted mt-2">AI có thể mắc lỗi. Vui lòng kiểm tra lại thông tin quan trọng.</p>
            </div>
        </section>
    </div>
</div>
@endsection
