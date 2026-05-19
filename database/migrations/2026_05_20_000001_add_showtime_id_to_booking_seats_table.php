<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('booking_seats', function (Blueprint $table) {
            $table->foreignId('showtime_id')
                ->nullable()
                ->after('booking_id')
                ->constrained('showtimes')
                ->cascadeOnDelete();
        });

        DB::statement('
            UPDATE booking_seats
            SET showtime_id = (
                SELECT bookings.showtime_id
                FROM bookings
                WHERE bookings.id = booking_seats.booking_id
            )
            WHERE showtime_id IS NULL
        ');

        Schema::table('booking_seats', function (Blueprint $table) {
            $table->unique(['showtime_id', 'seat_id']);
        });
    }

    public function down(): void
    {
        Schema::table('booking_seats', function (Blueprint $table) {
            $table->dropUnique(['showtime_id', 'seat_id']);
            $table->dropConstrainedForeignId('showtime_id');
        });
    }
};
