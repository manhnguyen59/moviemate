<?php

namespace Database\Seeders;

use App\Models\Voucher;
use Illuminate\Database\Seeder;

class VoucherSeeder extends Seeder
{
    public function run(): void
    {
        Voucher::updateOrCreate(['code' => 'MMT10'], [
            'name' => 'Giảm 10% MovieMate',
            'discount_type' => 'percent',
            'discount_value' => 10,
            'min_order_amount' => 50000,
            'max_discount_amount' => 50000,
            'usage_limit' => null,
            'status' => 'active',
        ]);

        Voucher::updateOrCreate(['code' => 'GIAM20K'], [
            'name' => 'Giảm 20.000đ',
            'discount_type' => 'fixed',
            'discount_value' => 20000,
            'min_order_amount' => 100000,
            'max_discount_amount' => null,
            'usage_limit' => null,
            'status' => 'active',
        ]);
    }
}
