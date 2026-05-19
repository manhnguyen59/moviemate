@extends('layouts.user')

@section('title', 'AI Gợi ý phim - MovieMate')

@section('content')
<section class="relative overflow-hidden py-14 md:py-20">
    <div class="absolute inset-0 bg-gradient-to-br from-dark-main via-dark-main to-[#111827]"></div>
    <div class="absolute inset-0 opacity-40 bg-[radial-gradient(circle_at_18%_18%,rgba(124,58,237,0.28),transparent_32%),radial-gradient(circle_at_82%_8%,rgba(37,99,235,0.22),transparent_30%),radial-gradient(circle_at_52%_100%,rgba(255,61,87,0.14),transparent_34%)]"></div>

    <div class="relative max-w-4xl mx-auto px-4 text-center">
        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-ai-start/10 border border-ai-start/30 mb-6">
            <i class="ph-fill ph-magic-wand text-ai-start"></i>
            <span class="text-sm font-medium text-ai-start">Trí tuệ nhân tạo MovieMate</span>
        </div>
        <h1 class="hero-title text-4xl md:text-6xl font-extrabold app-text mb-6">
            AI gợi ý phim <span class="text-transparent bg-clip-text bg-gradient-to-r from-ai-start to-ai-end">dành riêng cho bạn</span>
        </h1>
        <p class="text-lg app-muted mb-0 max-w-2xl mx-auto leading-relaxed">
            Hãy cho chúng tôi biết bạn đang cảm thấy thế nào, muốn xem với ai và rạp mong muốn. AI sẽ đề xuất lựa chọn phù hợp cho buổi xem phim hôm nay.
        </p>
    </div>
</section>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10">
        <div class="lg:col-span-5">
            <div class="app-card border app-border rounded-3xl p-6 sm:p-8 shadow-2xl shadow-black/25">
                <form action="#" method="POST" class="space-y-6">
                    @csrf

                    <div>
                        <label class="block text-sm font-bold app-text mb-3">Bạn đang cảm thấy thế nào?</label>
                        <div class="grid grid-cols-2 gap-3">
                            @foreach([
                                ['happy', 'Vui vẻ', 'ph-smiley'],
                                ['sad', 'Buồn chán', 'ph-cloud-rain'],
                                ['stress', 'Căng thẳng', 'ph-lightning', true],
                                ['chill', 'Muốn thư giãn', 'ph-coffee'],
                            ] as $mood)
                                <label class="cursor-pointer">
                                    <input type="radio" name="mood" class="peer sr-only" value="{{ $mood[0] }}" {{ !empty($mood[3]) ? 'checked' : '' }}>
                                    <span class="min-h-12 px-4 py-3 app-input border app-border rounded-2xl app-muted hover:border-ai-start/50 peer-checked:bg-ai-start/10 peer-checked:border-ai-start peer-checked:text-ai-start transition-all text-sm font-semibold flex items-center gap-2">
                                        <i class="ph {{ $mood[2] }}"></i> {{ $mood[1] }}
                                    </span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-bold app-text mb-3">Thể loại bạn muốn xem?</label>
                        <div class="flex flex-wrap gap-3">
                            @foreach([
                                ['action', 'Hành động', true],
                                ['comedy', 'Hài hước'],
                                ['scifi', 'Viễn tưởng', true],
                                ['horror', 'Kinh dị'],
                            ] as $genre)
                                <label class="cursor-pointer">
                                    <input type="checkbox" name="genre[]" class="peer sr-only" value="{{ $genre[0] }}" {{ !empty($genre[2]) ? 'checked' : '' }}>
                                    <span class="inline-flex px-4 py-2.5 app-input border app-border rounded-xl app-muted hover:border-ai-start/50 peer-checked:bg-ai-start/10 peer-checked:border-ai-start peer-checked:text-ai-start transition-all text-sm font-semibold">
                                        {{ $genre[1] }}
                                    </span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-bold app-text mb-3">Bạn muốn xem với ai?</label>
                            <select class="w-full px-4 py-3 app-input border app-border rounded-2xl focus:outline-none focus:border-ai-start">
                                <option value="alone">Một mình</option>
                                <option value="couple" selected>Người yêu / Vợ chồng</option>
                                <option value="friends">Bạn bè</option>
                                <option value="family">Gia đình có trẻ em</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-bold app-text mb-3">Thời gian muốn xem?</label>
                            <select class="w-full px-4 py-3 app-input border app-border rounded-2xl focus:outline-none focus:border-ai-start">
                                <option>Tối nay</option>
                                <option>Cuối tuần</option>
                                <option>Ngày mai</option>
                                <option>Suất sau 21:00</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-bold app-text mb-3">Khu vực/rạp mong muốn?</label>
                        <input type="text" class="w-full px-4 py-3 app-input border app-border rounded-2xl focus:outline-none focus:border-ai-start" placeholder="Ví dụ: Cầu Giấy, Quận 1, MovieMate Center">
                    </div>

                    <button type="submit" class="w-full py-4 bg-gradient-to-r from-ai-start to-ai-end text-white rounded-2xl font-bold text-lg hover:shadow-lg hover:shadow-ai-start/30 transition-all flex items-center justify-center gap-2">
                        <i class="ph-fill ph-magic-wand"></i> Tạo gợi ý ngay
                    </button>
                </form>
            </div>
        </div>

        <div class="lg:col-span-7">
            <div class="mb-6 flex items-center gap-3">
                <span class="w-8 h-px bg-ai-start/60"></span>
                <h2 class="text-xl font-bold app-text uppercase tracking-wider">AI đề xuất cho bạn</h2>
                <span class="h-px bg-[var(--border-color)] flex-grow"></span>
            </div>

            <div class="bg-gradient-to-br from-[#1E1B4B] to-dark-main border border-ai-start/30 rounded-3xl p-6 sm:p-8 relative overflow-hidden shadow-2xl shadow-ai-start/10">
                <i class="ph-fill ph-sparkle absolute top-6 right-6 text-4xl text-ai-start/45"></i>

                <div class="flex flex-col md:flex-row gap-8">
                    <div class="w-full max-w-56 mx-auto md:mx-0 md:w-48 shrink-0">
                        <div class="poster-frame rounded-3xl shadow-2xl shadow-black">
                            <img src="https://image.tmdb.org/t/p/w500/tMefBSflR6PGQLvLuPE31clYe3D.jpg" alt="Godzilla x Kong">
                        </div>
                    </div>

                    <div class="min-w-0">
                        <div class="inline-flex px-3 py-1 bg-ai-start/20 border border-ai-start/50 text-ai-start text-xs font-bold rounded-lg mb-4">
                            Độ phù hợp: 98%
                        </div>
                        <h3 class="text-2xl sm:text-3xl font-bold text-white mb-2">Godzilla x Kong</h3>
                        <p class="text-text-sub mb-4">Hành động, Viễn tưởng · 115 phút · T13</p>

                        <div class="bg-dark-main/55 rounded-2xl p-4 mb-6 border border-dark-border">
                            <p class="text-sm text-white leading-relaxed">
                                <i class="ph-fill ph-robot text-ai-start mr-1"></i>
                                <strong>Tại sao chọn phim này?</strong> Vì bạn đang căng thẳng và muốn xem phim hành động viễn tưởng cùng người yêu. Nhịp phim nhanh, kỹ xảo lớn và âm thanh mạnh giúp buổi xem phim giàu tính giải trí.
                            </p>
                        </div>

                        <div class="flex flex-wrap gap-3">
                            <a href="{{ route('user.movies.index') }}" class="px-6 py-3 bg-gradient-to-r from-brand-start to-brand-end text-white rounded-2xl font-bold hover:shadow-lg hover:shadow-brand-start/30 transition-all">
                                Đặt vé ngay
                            </a>
                            <a href="{{ route('user.movies.index') }}" class="px-6 py-3 app-card border app-border text-white rounded-2xl font-bold hover:border-ai-start transition-colors">
                                Xem chi tiết
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="app-card border app-border rounded-2xl p-4 flex gap-4 hover:border-ai-start/50 transition-colors">
                    <img src="https://image.tmdb.org/t/p/w500/1pdfLvkbY9ohJlCjQH2JGjjcNsV.jpg" alt="Dune: Part Two" class="w-16 h-24 object-cover rounded-xl">
                    <div>
                        <p class="text-xs text-ai-start font-bold mb-1">Phù hợp 92%</p>
                        <h4 class="app-text font-bold text-sm line-clamp-1 mb-1">Dune: Part Two</h4>
                        <p class="text-xs app-muted line-clamp-2">Cốt truyện sâu sắc, hình ảnh tráng lệ cho một trải nghiệm điện ảnh giàu cảm xúc.</p>
                    </div>
                </div>
                <div class="app-card border app-border rounded-2xl p-4 flex gap-4 hover:border-ai-start/50 transition-colors">
                    <img src="https://image.tmdb.org/t/p/w500/qJ2tW6WMUDux911r6m7haRef0WH.jpg" alt="Thanh Gươm Diệt Quỷ" class="w-16 h-24 object-cover rounded-xl">
                    <div>
                        <p class="text-xs text-ai-start font-bold mb-1">Phù hợp 85%</p>
                        <h4 class="app-text font-bold text-sm line-clamp-1 mb-1">Thanh Gươm Diệt Quỷ</h4>
                        <p class="text-xs app-muted line-clamp-2">Hành động nhịp nhanh, đồ họa đẹp mắt và phù hợp khi muốn giải tỏa mệt mỏi.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
