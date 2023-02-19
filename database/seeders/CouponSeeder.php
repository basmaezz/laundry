<?php

use App\Models\Category;
use Illuminate\Database\Seeder;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {

        \App\Models\CouponShopCart::create([
            'code_name' => '102030',
            'discount_value' => 0.05,
        ]);

        \App\Models\CouponShopCart::create([
            'code_name' => '201030',
            'discount_value' => 0.10,
        ]);
        \App\Models\CouponShopCart::create([
            'code_name' => '302010',
            'discount_value' => 0.15,
        ]);
    }
}
