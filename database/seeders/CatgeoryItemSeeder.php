<?php

namespace Database\Seeders;

use App\Models\CategoryItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CatgeoryItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CategoryItem::create([
            'id' => 1,
            'category_type' => 'ملابس رجالي',
            'subcategory_id' => 1,
        ]);

        CategoryItem::create([
            'id' => 2,
            'category_type' => 'ملابس حريمي',
            'subcategory_id' => 1,
        ]);

        CategoryItem::create([
            'id' => 3,
            'category_type' => 'ملابس اطفالي',
            'subcategory_id' => 1,
        ]);

        CategoryItem::create([
            'id' => 4,
            'category_type' => 'ملابس رجالي',
            'subcategory_id' => 2,
        ]);
        CategoryItem::create([
            'id' => 5,
            'category_type' => 'ملابس حريمي',
            'subcategory_id' => 2,
        ]);
        CategoryItem::create([
            'id' => 6,
            'category_type' => 'ملابس اطفالي',
            'subcategory_id' => 2,
        ]);

        CategoryItem::create([
            'id' => 7,
            'category_type' => 'ملابس رجالي',
            'subcategory_id' => 3,
        ]);
        CategoryItem::create([
            'id' => 8,
            'category_type' => 'ملابس حريمي',
            'subcategory_id' => 3,
        ]);
        CategoryItem::create([
            'id' => 9,
            'category_type' => 'ملابس اطفالي',
            'subcategory_id' => 3,
        ]);

        CategoryItem::create([
            'id' => 10,
            'category_type' => 'ملابس رجالي',
            'subcategory_id' => 4,
        ]);
        CategoryItem::create([
            'id' => 11,
            'category_type' => 'ملابس حريمي',
            'subcategory_id' => 4,
        ]);
        CategoryItem::create([
            'id' => 12,
            'category_type' => 'ملابس اطفالي',
            'subcategory_id' => 4,
        ]);
        CategoryItem::create([
            'id' => 13,
            'category_type' => 'ملابس رجالي',
            'subcategory_id' => 5,
        ]);
        CategoryItem::create([
            'id' => 14,
            'category_type' => 'ملابس حريمي',
            'subcategory_id' => 5,
        ]);
        CategoryItem::create([
            'id' => 15,
            'category_type' => 'ملابس اطفالي',
            'subcategory_id' => 5,
        ]);
        CategoryItem::create([
            'id' => 16,
            'category_type' => 'ملابس رجالي',
            'subcategory_id' => 6,
        ]);
        CategoryItem::create([
            'id' => 17,
            'category_type' => 'ملابس حريمي',
            'subcategory_id' => 6,
        ]);
        CategoryItem::create([
            'id' => 18,
            'category_type' => 'ملابس اطفالي',
            'subcategory_id' => 6,
        ]);

    }
}
