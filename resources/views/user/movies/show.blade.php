@extends('layouts.user')

@section('title', $movie->title . ' - MovieMate')

@section('content')
<div class="relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-dark-main via-dark-main to-dark-sub"></div>
    <div class="absolute inset-0 opacity-30 bg-[radial-gradient(circle_at_18%_12%,rgba(255,61,87,0.25),transparent_30%),radial-gradient(circle_at_85%_20%,rgba(124,58,237,0.18),transparent_28%)]"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 md:py-14">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12">
            <div class="lg:col-span-4">
                <div class="poster-frame rounded-[2rem] app-card border app-border shadow-2xl shadow-black/30">
                    @if($movie->poster)
                        <img src="{{ asset('storage/' . $movie->poster) }}" alt="{{ $movie->title }}">
                    @else
                        <img src="{{ asset('images/placeholder.png') }}" alt="{{ $movie->title }}">
                    @endif
                </div>
            </div>

            <div class="lg:col-span-8 flex flex-col justify-center">
                <div class="flex flex-wrap items-center gap-3 mb-5">
                    <span class="{{ $movie->status === 'now_showing' ? 'bg-brand-start' : 'bg-ai-start' }} text-white text-xs font-bold px-3 py-1.5 rounded-full uppercase tracking-wider">
                        {{ $movie->status === 'now_showing' ? 'Đang chiếu' : 'Sắp chiếu' }}
                    </span>
                    @if($movie->age_rating)
                        <span class="border app-border app-text text-xs font-bold px-3 py-1.5 rounded-full">{{ $movie->age_rating }}</span>
                    @endif
                </div>

                <h1 class="hero-title text-4xl md:text-6xl font-extrabold app-text mb-6">{{ $movie->title }}</h1>

                <div class="flex flex-wrap items-center gap-5 text-sm app-muted mb-8">
                    <div class="flex items-center gap-2">
                        <i class="ph ph-clock text-lg text-brand-start"></i> {{ $movie->duration ?? '--' }} phút
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="ph ph-calendar-blank text-lg text-brand-start"></i>
                        Khởi chiếu:
                        {{ $movie->release_date ? \Carbon\Carbon::parse($movie->release_date)->format('d/m/Y') : 'Chưa xác định' }}
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="ph ph-globe-hemisphere-west text-lg text-brand-start"></i> {{ $movie->country ?? 'Đang cập nhật' }}
                    </div>
                </div>

                <div class="app-card border app-border rounded-3xl p-5 sm:p-6 mb-6">
                    <h2 class="text-xl font-bold app-text mb-3 border-l-4 border-brand-start pl-3">Nội dung phim</h2>
                    <p class="app-muted leading-relaxed">
                        {{ $movie->description ?? 'Nội dung phim đang được cập nhật.' }}
                    </p>

                    <div class="mt-5 flex flex-wrap gap-2 text-sm">
                        @forelse($movie->genres as $genre)
                            <span class="px-3 py-1.5 app-secondary border app-border rounded-xl app-muted">{{ $genre->name }}</span>
                        @empty
                            <span class="app-muted">Chưa cập nhật thể loại</span>
                        @endforelse
                    </div>
                </div>

                <div class="flex flex-wrap gap-3">
                    <a href="#showtimes" class="inline-flex items-center gap-2 px-5 py-3 bg-gradient-to-r from-brand-start to-brand-end text-white rounded-2xl font-bold hover:shadow-lg hover:shadow-brand-start/25 transition-all">
                        <i class="ph-fill ph-ticket"></i> Xem lịch chiếu
                    </a>
                    @if($movie->trailer_url)
                        <a href="{{ $movie->trailer_url }}" target="_blank" class="inline-flex items-center gap-2 px-5 py-3 app-card border app-border app-text rounded-2xl font-bold hover:border-brand-start hover:text-brand-start transition-colors">
                            <i class="ph-fill ph-play-circle text-xl"></i> Xem trailer
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <section id="showtimes" class="mt-14">
            <div class="flex items-center gap-3 mb-6">
                <span class="w-1 h-8 rounded-full bg-gradient-to-b from-brand-start to-brand-end"></span>
                <h2 class="text-2xl md:text-3xl font-bold app-text">Lịch chiếu</h2>
            </div>

            @if($showtimes->isEmpty())
                <div class="app-card border app-border rounded-3xl p-8 app-muted">
                    Hiện chưa có suất chiếu khả dụng.
                </div>
            @else
                <div class="app-card border app-border rounded-3xl overflow-hidden shadow-2xl shadow-black/20">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left min-w-[760px]">
                            <thead class="app-secondary border-b app-border">
                                <tr>
                                    <th class="px-5 py-4 app-text text-sm font-semibold">Ngày</th>
                                    <th class="px-5 py-4 app-text text-sm font-semibold">Giờ</th>
                                    <th class="px-5 py-4 app-text text-sm font-semibold">Rạp / Phòng</th>
                                    <th class="px-5 py-4 app-text text-sm font-semibold">Giá thường</th>
                                    <th class="px-5 py-4 app-text text-sm font-semibold">Giá VIP</th>
                                    <th class="px-5 py-4 app-text text-sm font-semibold text-right">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y app-border">
                                @foreach($showtimes as $show)
                                    <tr class="hover:bg-white/5 transition-colors">
                                        <td class="px-5 py-4 app-text">
                                            {{ $show->show_date ? \Carbon\Carbon::parse($show->show_date)->format('d/m/Y') : 'Đang cập nhật' }}
                                        </td>
                                        <td class="px-5 py-4 text-brand-start font-extrabold">
                                            {{ $show->show_time ? \Carbon\Carbon::parse($show->show_time)->format('H:i') : '--:--' }}
                                        </td>
                                        <td class="px-5 py-4 app-muted">
                                            <span class="app-text font-semibold">{{ $show->cinema->name }}</span>
                                            <span class="mx-1">/</span>
                                            {{ $show->room->name }}
                                        </td>
                                        <td class="px-5 py-4 app-text font-semibold">
                                            {{ number_format($show->price, 0, ',', '.') }}đ
                                        </td>
                                        <td class="px-5 py-4 app-text font-semibold">
                                            {{ number_format($show->vip_price ?? $show->price, 0, ',', '.') }}đ
                                        </td>
                                        <td class="px-5 py-4 text-right">
                                            <a href="{{ route('user.bookings.selectSeat', $show->id) }}" class="inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-gradient-to-r from-brand-start to-brand-end text-white rounded-xl font-bold text-sm hover:shadow-lg hover:shadow-brand-start/30 transition-all">
                                                <i class="ph-fill ph-armchair"></i>
                                                Chọn ghế
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </section>
    </div>
</div>
@endsection
