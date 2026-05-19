<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\CinemaController as AdminCinemaController;
use App\Http\Controllers\Admin\GenreController as AdminGenreController;
use App\Http\Controllers\Admin\MovieController as AdminMovieController;
use App\Http\Controllers\Admin\RoomController as AdminRoomController;
use App\Http\Controllers\Admin\SeatController as AdminSeatController;
use App\Http\Controllers\Admin\ShowtimeController as AdminShowtimeController;
use App\Http\Controllers\Staff\TicketCheckController as StaffTicketCheckController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\MovieController;
use App\Http\Controllers\User\BookingController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');

Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/movies', [MovieController::class, 'index'])->name('user.movies.index');

Route::get('/movies/{slug}', [MovieController::class, 'show'])->name('user.movies.show');

Route::middleware('user')->group(function () {
    Route::get('/booking/select-seat/{showtime}', [BookingController::class, 'selectSeat'])
        ->name('user.bookings.selectSeat');

    Route::get('/booking/checkout/{showtime}', [BookingController::class, 'checkout'])
        ->name('user.bookings.checkout');

    Route::post('/booking/store', [BookingController::class, 'store'])
        ->name('user.bookings.store');

    Route::get('/booking/success/{booking}', [BookingController::class, 'success'])
        ->name('user.bookings.success');

    Route::get('/my-ticket/{booking}', [BookingController::class, 'ticket'])
        ->name('user.bookings.ticket');

    Route::get('/booking-history', [BookingController::class, 'history'])
        ->name('user.bookings.history');

    Route::delete('/booking/{booking}/cancel', [BookingController::class, 'cancel'])
        ->name('user.bookings.cancel');
});

Route::get('/ai/recommend', function () {
    return view('user.ai.recommend');
})->name('user.ai.recommend');

Route::get('/ai/chatbot', function () {
    return view('user.ai.chatbot');
})->name('user.ai.chatbot');

Route::get('/profile', function () {
    return view('user.profile.index');
})->middleware('user')->name('user.profile');

Route::get('/admin/login', function () {
    return view('admin.auth.login');
})->name('admin.login');

Route::get('/staff/login', function () {
    return view('staff.auth.login');
})->name('staff.login');

// Staff Routes
Route::prefix('staff')->name('staff.')->middleware('staff')->group(function () {
    Route::get('/dashboard', function () {
        return view('staff.dashboard');
    })->name('dashboard');

    Route::get('/tickets/check', [StaffTicketCheckController::class, 'show'])
        ->name('tickets.check');

    Route::post('/tickets/check', [StaffTicketCheckController::class, 'check'])
        ->name('tickets.check.submit');

    Route::post('/tickets/{booking}/use', [StaffTicketCheckController::class, 'markUsed'])
        ->name('tickets.use');

    Route::get('/tickets/valid/{booking?}', [StaffTicketCheckController::class, 'valid'])
        ->name('tickets.valid');

    Route::get('/tickets/used/{booking?}', [StaffTicketCheckController::class, 'used'])
        ->name('tickets.used');

    Route::get('/tickets/not-found', [StaffTicketCheckController::class, 'notFound'])
        ->name('tickets.notFound');

    Route::get('/tickets', [StaffTicketCheckController::class, 'index'])
        ->name('tickets.index');

    Route::get('/counter-sale', function () {
        return view('staff.sales.counter');
    })->name('sales.counter');
});

// API endpoint for dynamic room loading (used by Showtime create/edit forms)
Route::get('/api/cinemas/{cinema}/rooms', function (App\Models\Cinema $cinema) {
    return $cinema->rooms()->select('id', 'name')->get();
})->middleware('admin');

Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::resource('movies', AdminMovieController::class);
    Route::resource('genres', AdminGenreController::class)->except(['show']);
    Route::resource('cinemas', AdminCinemaController::class)->except(['show']);
    Route::resource('rooms', AdminRoomController::class)->except(['show']);

    Route::get('/seats', [AdminSeatController::class, 'index'])->name('seats.index');
    Route::get('/seats/manage/{room}', [AdminSeatController::class, 'manage'])->name('seats.manage');
    Route::post('/seats/generate/{room}', [AdminSeatController::class, 'generate'])->name('seats.generate');
    Route::patch('/seats/{seat}', [AdminSeatController::class, 'update'])->name('seats.update');

    Route::resource('showtimes', AdminShowtimeController::class)->except(['show']);

    Route::get('/bookings', function () {
        return view('admin.bookings.index');
    })->name('bookings.index');

    Route::get('/bookings/{id}', function ($id) {
        return view('admin.bookings.show');
    })->name('bookings.show');

    Route::get('/users', function () {
        return view('admin.users.index');
    })->name('users.index');

    Route::get('/users/{id}', function ($id) {
        return view('admin.users.show');
    })->name('users.show');

    Route::get('/reviews', function () {
        return view('admin.reviews.index');
    })->name('reviews.index');

    Route::get('/analytics/revenue', function () {
        return view('admin.analytics.revenue');
    })->name('analytics.revenue');

    Route::get('/analytics/top-movies', function () {
        return view('admin.analytics.top-movies');
    })->name('analytics.topMovies');

    Route::get('/ai/movie-content', function () {
        return view('admin.ai.movie-content');
    })->name('ai.movieContent');
});
