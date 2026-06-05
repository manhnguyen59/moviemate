<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (DB::getDriverName() === 'mysql') {
            DB::statement("ALTER TABLE payments MODIFY payment_method ENUM('fake', 'counter', 'vnpay', 'payos') NOT NULL DEFAULT 'fake'");
        }

        Schema::table('payments', function (Blueprint $table) {
            $table->string('provider_order_code')->nullable()->after('transaction_code');
            $table->text('checkout_url')->nullable()->after('provider_order_code');
            $table->text('qr_code')->nullable()->after('checkout_url');
        });
    }

    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn(['provider_order_code', 'checkout_url', 'qr_code']);
        });

        if (DB::getDriverName() === 'mysql') {
            DB::statement("ALTER TABLE payments MODIFY payment_method ENUM('fake', 'counter', 'vnpay') NOT NULL DEFAULT 'fake'");
        }
    }
};
