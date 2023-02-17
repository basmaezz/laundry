<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name_ar' => 'مغاسل الملابس',
            'name_en' => 'Laundry',
            'image' => '1.jpg',
            'type' => 'category',
        ]);

        Category::create([
            'name_ar' => 'مغاسل متكاملة',
            'name_en' => 'Laundry Complete',
            'image' => '2.jpg',
            'type' => 'category',
        ]);

        Category::create([
            'name_ar' => 'مغاسل سجاد',
            'name_en' => 'Laundry carpet',
            'image' => '3.jpg',
            'type' => 'category',
        ]);

        Category::create([
            'name_ar' => 'غسيل مستعجلة',
            'name_en' => 'Laundry hurry',
            'image' => '4.jpg',
            'type' => 'category',
        ]);
    }
}
