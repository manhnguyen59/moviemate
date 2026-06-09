<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (DB::getDriverName() !== 'mysql') {
            return;
        }

        DB::statement("ALTER TABLE loyalty_point_transactions MODIFY type ENUM('earn', 'reverse', 'adjustment', 'redeem') NOT NULL DEFAULT 'earn'");
    }

    public function down(): void
    {
        if (DB::getDriverName() !== 'mysql') {
            return;
        }

        DB::table('loyalty_point_transactions')
            ->where('type', 'redeem')
            ->update(['type' => 'adjustment']);

        DB::statement("ALTER TABLE loyalty_point_transactions MODIFY type ENUM('earn', 'reverse', 'adjustment') NOT NULL DEFAULT 'earn'");
    }
};
