<?php

namespace Database\Seeders;

use App\Models\Subcategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class subCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Subcategory::create([
            'name_ar' => 'مغسلة اداء',
            'name_en' => 'Laundry 1',
            'category_id' => 1,
            'is_favorite' => false,
            'lat'=> 20.28219,
            'lng'=> 23.19921,
            'rate' => 4.5,
            'price'=>100,
            'address' => 'حي البريد,الدمام,المنطقه الشرقية',
            'deleted' => 0,
            'image' => '4.jpg',
            'status'=>1
        ]);
        Subcategory::create([
            'name_ar' => 'مغسلة الاولي',
            'name_en' => 'Laundry 2',
            'category_id' => 1,
            'is_favorite' => false,
            'rate' => 5,
            'price'=>100,
            'lat'=> 40.289,
            'lng'=> 25.1921,
            'address' => 'حي البريد,الدمام,المنطقه الشرقية',
            'deleted' => 0,
            'image' => '4.jpg',
            'status'=>1
        ]);
        Subcategory::create([
            'name_ar' => 'مغسلة هدومي',
            'name_en' => 'Laundry 3',
            'category_id' => 1,
            'is_favorite' => false,
            'address' => 'حي البريد,الدمام,المنطقه الشرقية',
            'deleted' => 0,
            'rate' => 3.5,
            'price'=>100,
            'lat'=> 10.219,
            'lng'=> 32.197,
            'image' => '4.jpg',
            'status'=>1
        ]);
        Subcategory::create([
            'name_ar' => 'مغسلة الزاوية',
            'name_en' => 'Laundry 4',
            'category_id' => 1,
            'is_favorite' => false,
            'address' => 'حي البريد,الدمام,المنطقه الشرقية',
            'deleted' => 0,
            'lat'=> 15.29,
            'lng'=> 31.0921,
            'rate' => 5,
            'price'=>100,
            'image' =>'4.jpg',
            'status'=>1
        ]);
        Subcategory::create([
            'name_ar' => 'مغسلة طوخ',
            'name_en' => 'Laundry 5',
            'category_id' => 1,
            'is_favorite' => false,
            'address' => 'حي البريد,الدمام,المنطقه الشرقية',
            'deleted' => 0,
            'lat'=> 30.28219,
            'lng'=> 31.1970921,
            'rate' => 5,
            'price'=>100,
            'image' =>'4.jpg',
            'status'=>1
        ]);
        Subcategory::create([
            'name_ar' => 'مغسلة قها',
            'name_en' => 'Laundry 4',
            'category_id' => 1,
            'is_favorite' => false,
            'address' => 'حي البريد,الدمام,المنطقه الشرقية',
            'deleted' => 0,
            'lat'=> 30.28219,
            'lng'=> 31.1970921,
            'rate' => 5,
            'price'=>100,
            'image' =>'4.jpg',
            'status'=>1
        ]);
    }
}
