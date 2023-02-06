<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class productSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'user_id' => 1,
            'category_item_id' => 1,
            'subcategory_id' => 1,
            'name_ar' => 'ثوب شتوي',
            'name_en' => 'winter dress',
            'image' => '97781624535210.7586.png',
            'desc_ar' => 'جاكيت / بلوفر / جلباب',
            'desc_en' => 'Robe / Pullover / Jacket',
        ]);

        Product::create([
            'user_id' => 1,
            'category_item_id' => 1,
            'subcategory_id' => 1,
            'name_ar' => 'ثوب شتوي ابيض',
            'name_en' => 'winter dress',
            'image' => '96531619609648.3968.png',
            'desc_ar' => 'جاكيت / بلوفر / جلباب',
            'desc_en' => 'Robe / Pullover / Jacket',
        ]);

        Product::create([
            'user_id' => 1,
            'category_item_id' => 2,
            'subcategory_id' => 1,
            'name_ar' => 'ثوب عام ابيض',
            'name_en' => 'White dress',
            'image' => '87451624534925.2126.png',
            'desc_ar' => 'قميص / شراب / اشارب',
            'desc_en' => 'shirt / drink / veil',
        ]);

        Product::create([
            'user_id' => 1,
            'category_item_id' => 2,
            'subcategory_id' => 1,
            'name_ar' => 'بلوزه حريمي ',
            'name_en' => 'blouse',
            'image' => '82171624454739.3721.png',
            'desc_ar' => 'بنطلون / تيشيرت / جلباب',
            'desc_en' => 'بنطلون / تيشيرت / جلباب',

        ]);


        Product::create([
            'user_id' => 1,
            'category_item_id' => 3,
            'subcategory_id' => 1,
            'name_ar' => 'بلوزه بناتي صغار',
            'name_en' => 'blouse',
            'image' => '24471624186131.4621.png',
            'desc_ar' => 'بنطلون / تيشيرت / جلباب',
            'desc_en' => 'بنطلون / تيشيرت / جلباب',

        ]);

        Product::create([
            'user_id' => 1,
            'category_item_id' => 3,
            'subcategory_id' => 1,
            'name_ar' => 'ثوب شتوي اسود',
            'name_en' => 'blouse',
            'image' => '11391624185656.3533.png',
            'desc_ar' => 'بنطلون / تيشيرت / جلباب',
            'desc_en' => 'بنطلون / تيشيرت / جلباب',

        ]);

        Product::create([
            'user_id' => 1,
            'category_item_id' => 4,
            'subcategory_id' => 1,
            'name_ar' => 'قمصان',
            'name_en' => 'shemagh',
            'image' => '11431624453576.3212.png',
            'desc_ar' => 'جاكيت / بلوفر / جلباب',
            'desc_en' => 'Robe / Pullover / Jacket',
        ]);

        Product::create([
            'user_id' => 1,
            'category_item_id' => 4,
            'subcategory_id' => 1,
            'name_ar' => 'بلوزه بناتي صغار',
            'name_en' => 'blouse',
            'image' => '11431624453576.3212.png',
            'desc_ar' => 'جاكيت / بلوفر / جلباب',
            'desc_en' => 'Robe / Pullover / Jacket',
        ]);

        Product::create([
            'user_id' => 1,
            'category_item_id' => 5,
            'subcategory_id' => 1,
            'name_ar' => 'ثوب شتوي اسود',
            'name_en' => 'blouse',
            'image' => '11431624453576.3212.png',
            'desc_ar' => 'جاكيت / بلوفر / جلباب',
            'desc_en' => 'Robe / Pullover / Jacket',
        ]);

        Product::create([
            'user_id' => 1,
            'category_item_id' => 5,
            'subcategory_id' => 1,
            'name_ar' => 'ثوب شتوي اسود',
            'name_en' => 'shemagh',
            'image' => '11431624453576.3212.png',
            'desc_ar' => 'جاكيت / بلوفر / جلباب',
            'desc_en' => 'Robe / Pullover / Jacket',
        ]);

        Product::create([
            'user_id' => 1,
            'category_item_id' => 6,
            'subcategory_id' => 1,
            'name_ar' => 'تشيرت',
            'name_en' => 'shemagh',
            'image' => '11431624453576.3212.png',
            'desc_ar' => 'جاكيت / بلوفر / جلباب',
            'desc_en' => 'Robe / Pullover / Jacket',
        ]);

        Product::create([
            'user_id' => 1,
            'category_item_id' => 6,
            'subcategory_id' => 1,
            'name_ar' => 'قمصان رجالي',
            'name_en' => 'shemagh',
            'image' => '11431624453576.3212.png',
            'desc_ar' => 'جاكيت / بلوفر / جلباب',
            'desc_en' => 'Robe / Pullover / Jacket',
        ]);

        Product::create([
            'user_id' => 1,
            'category_item_id' => 7,
            'subcategory_id' => 1,
            'name_ar' => 'قمصان رجالي',
            'name_en' => 'shemagh',
            'image' => '11431624453576.3212.png',
            'desc_ar' => 'جاكيت / بلوفر / جلباب',
            'desc_en' => 'Robe / Pullover / Jacket',
        ]);

        Product::create([
            'user_id' => 1,
            'category_item_id' => 7,
            'subcategory_id' => 1,
            'name_ar' => 'قمصان',
            'name_en' => 'shemagh',
            'image' => '11431624453576.3212.png',
            'desc_ar' => 'جاكيت / بلوفر / جلباب',
            'desc_en' => 'Robe / Pullover / Jacket',
        ]);
        Product::create([
            'user_id' => 1,
            'category_item_id' => 8,
            'subcategory_id' => 1,
            'name_ar' => 'قمصان رجالي',
            'name_en' => 'shemagh',
            'image' => '11431624453576.3212.png',
            'desc_ar' => 'جاكيت / بلوفر / جلباب',
            'desc_en' => 'Robe / Pullover / Jacket',
        ]);

        Product::create([
            'user_id' => 1,
            'category_item_id' => 8,
            'subcategory_id' => 1,
            'name_ar' => 'قمصان',
            'name_en' => 'shemagh',
            'image' => '11431624453576.3212.png',
            'desc_ar' => 'جاكيت / بلوفر / جلباب',
            'desc_en' => 'Robe / Pullover / Jacket',
        ]);

        Product::create([
            'user_id' => 1,
            'category_item_id' => 9,
            'subcategory_id' => 1,
            'name_ar' => 'قمصان رجالي',
            'name_en' => 'shemagh',
            'image' => '11431624453576.3212.png',
            'desc_ar' => 'جاكيت / بلوفر / جلباب',
            'desc_en' => 'Robe / Pullover / Jacket',
        ]);
        Product::create([
            'user_id' => 1,
            'category_item_id' => 9,
            'subcategory_id' => 1,
            'name_ar' => 'قمصان',
            'name_en' => 'shemagh',
            'image' => '11431624453576.3212.png',
            'desc_ar' => 'جاكيت / بلوفر / جلباب',
            'desc_en' => 'Robe / Pullover / Jacket',
        ]);

        Product::create([
            'user_id' => 1,
            'category_item_id' => 10,
            'subcategory_id' => 1,
            'name_ar' => 'قمصان رجالي',
            'name_en' => 'shemagh',
            'image' => '11431624453576.3212.png',
            'desc_ar' => 'جاكيت / بلوفر / جلباب',
            'desc_en' => 'Robe / Pullover / Jacket',
        ]);

        Product::create([
            'user_id' => 1,
            'category_item_id' => 11,
            'subcategory_id' => 1,
            'name_ar' => 'قمصان رجالي',
            'name_en' => 'shemagh',
            'image' => '11431624453576.3212.png',
            'desc_ar' => 'جاكيت / بلوفر / جلباب',
            'desc_en' => 'Robe / Pullover / Jacket',
        ]);
        Product::create([
            'user_id' => 1,
            'category_item_id' => 12,
            'subcategory_id' => 1,
            'name_ar' => 'قمصان',
            'name_en' => 'shemagh',
            'image' => '11431624453576.3212.png',
            'desc_ar' => 'جاكيت / بلوفر / جلباب',
            'desc_en' => 'Robe / Pullover / Jacket',
        ]);
        Product::create([
            'user_id' => 1,
            'category_item_id' => 13,
            'subcategory_id' => 1,
            'name_ar' => 'قمصان رجالي',
            'name_en' => 'shemagh',
            'image' => '11431624453576.3212.png',
            'desc_ar' => 'جاكيت / بلوفر / جلباب',
            'desc_en' => 'Robe / Pullover / Jacket',
        ]);

        Product::create([
            'user_id' => 1,
            'category_item_id' => 13,
            'subcategory_id' => 1,
            'name_ar' => 'قمصان',
            'name_en' => 'shemagh',
            'image' => '11431624453576.3212.png',
            'desc_ar' => 'جاكيت / بلوفر / جلباب',
            'desc_en' => 'Robe / Pullover / Jacket',
        ]);

        Product::create([
            'user_id' => 1,
            'category_item_id' => 14,
            'subcategory_id' => 1,
            'name_ar' => 'اشارب',
            'name_en' => 'shemagh',
            'image' => '11431624453576.3212.png',
            'desc_ar' => 'جاكيت / بلوفر / جلباب',
            'desc_en' => 'Robe / Pullover / Jacket',
        ]);
        Product::create([
            'user_id' => 1,
            'category_item_id' => 15,
            'subcategory_id' => 1,
            'name_ar' => 'شماغ',
            'name_en' => 'shemagh',
            'image' => '11431624453576.3212.png',
            'desc_ar' => 'جاكيت / بلوفر / جلباب',
            'desc_en' => 'Robe / Pullover / Jacket',
        ]);

        Product::create([
            'user_id' => 1,
            'category_item_id' => 16,
            'subcategory_id' => 1,
            'name_ar' => 'تي شيرت',
            'name_en' => 'shemagh',
            'image' => '11431624453576.3212.png',
            'desc_ar' => 'جاكيت / بلوفر / جلباب',
            'desc_en' => 'Robe / Pullover / Jacket',
        ]);

        Product::create([
            'user_id' => 1,
            'category_item_id' => 16,
            'subcategory_id' => 1,
            'name_ar' => 'جاكت',
            'name_en' => 'shemagh',
            'image' => '11431624453576.3212.png',
            'desc_ar' => 'جاكيت / بلوفر / جلباب',
            'desc_en' => 'Robe / Pullover / Jacket',
        ]);
        Product::create([
            'user_id' => 1,
            'category_item_id' => 17,
            'subcategory_id' => 1,
            'name_ar' => 'بلوزه',
            'name_en' => 'shemagh',
            'image' => '11431624453576.3212.png',
            'desc_ar' => 'جاكيت / بلوفر / جلباب',
            'desc_en' => 'Robe / Pullover / Jacket',
        ]);

        Product::create([
            'user_id' => 1,
            'category_item_id' => 18,
            'subcategory_id' => 1,
            'name_ar' => 'ثوب غامق',
            'name_en' => 'shemagh',
            'image' => '11431624453576.3212.png',
            'desc_ar' => 'جاكيت / بلوفر / جلباب',
            'desc_en' => 'Robe / Pullover / Jacket',
        ]);

        Product::create([
            'user_id' => 1,
            'category_item_id' => 18,
            'subcategory_id' => 1,
            'name_ar' => 'ثوب ابيض',
            'name_en' => 'shemagh',
            'image' => '11431624453576.3212.png',
            'desc_ar' => 'جاكيت / بلوفر / جلباب',
            'desc_en' => 'Robe / Pullover / Jacket',
        ]);

    }
}
