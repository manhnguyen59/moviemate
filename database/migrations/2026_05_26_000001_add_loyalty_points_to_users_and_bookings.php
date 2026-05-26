<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedInteger('loyalty_points')->default(0)->after('status');
            $table->unsignedInteger('lifetime_loyalty_points')->default(0)->after('loyalty_points');
        });

        Schema::table('bookings', function (Blueprint $table) {
            $table->unsignedInteger('loyalty_points_earned')->default(0)->after('total_amount');
        });
    }

    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn('loyalty_points_earned');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['loyalty_points', 'lifetime_loyalty_points']);
        });
    }
};
