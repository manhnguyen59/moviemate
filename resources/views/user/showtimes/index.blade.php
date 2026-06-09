@extends('layouts.user')

@section('title', 'Lịch chiếu phim - MovieMate')

@section('content')
    <section class="cinema-surface border-b app-border">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-14">
            <div class="max-w-3xl">
                <p class="text-brand-start text-sm font-extrabold uppercase tracking-[0.22em] mb-3">MovieMate Showtime</p>
                <h1 class="text-3xl sm:text-5xl font-extrabold app-text">Lịch chiếu phim</h1>
                <p class="mt-4 app-muted leading-relaxed">
                    Chọn thành phố, rạp, ngày chiếu và suất chiếu phù hợp. Các suất còn hiệu lực có thể đi thẳng tới bước chọn ghế.
                </p>
            </div>
        </div>
    </section>

    @include('user.partials.showtime-section', [
        'showtimeAjaxRoute' => 'user.showtimes.ajax',
        'showtimeBaseRoute' => 'user.showtimes.index',
    ])
@endsection
