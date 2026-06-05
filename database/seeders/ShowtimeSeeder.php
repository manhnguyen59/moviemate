<?php

namespace Database\Seeders;

use App\Models\Showtime;
use App\Models\Movie;
use App\Models\Cinema;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ShowtimeSeeder extends Seeder
{
    public function run(): void
    {
        $movies = Movie::whereIn('status', ['now_showing', 'coming_soon'])->get();
        $cinemas = Cinema::with('rooms')->where('status', 'active')->get();
        $timeSlots = ['10:00:00', '13:30:00', '17:00:00', '20:30:00'];

        foreach ($movies as $movieIndex => $movie) {
            $cinema = $cinemas->get($movieIndex % max($cinemas->count(), 1));
            if (! $cinema) {
                continue;
            }

            $rooms = $cinema->rooms;

            if ($rooms->isEmpty()) {
                continue;
            }

            for ($i = 0; $i < 3; $i++) {
                $room = $rooms->get(($movieIndex + $i) % $rooms->count());
                $date = Carbon::today('Asia/Ho_Chi_Minh')->addDays($i + 1)->toDateString();
                $time = $timeSlots[($movieIndex + $i) % count($timeSlots)];

                Showtime::updateOrCreate([
                    'movie_id' => $movie->id,
                    'cinema_id' => $cinema->id,
                    'room_id' => $room->id,
                    'show_date' => $date,
                    'show_time' => $time,
                ], [
                    'price' => 100000, // VND
                    'vip_price' => 150000,
                    'status' => 'active',
                ]);
            }
        }
    }
}
