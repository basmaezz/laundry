<?php

namespace Database\Seeders;

use App\Models\ProductService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class productServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductService::create([
            'product_id' => 1,
            'services' => 'غسيل جاف',
            'price' => '30',
        ]);

        ProductService::create([
            'product_id' => 2,
            'services' => 'تلميع',
            'price' => '45',
        ]);

        ProductService::create([
            'product_id' => 3,
            'services' => 'غسيل جاف',
            'price' => '60',
        ]);


        ProductService::create([
            'product_id' => 4,
            'services' => 'تنقيع ققط',
            'price' => '20',
        ]);

        ProductService::create([
            'product_id' => 5,
            'services' => 'تلميغ',
            'price' => '50',
        ]);

        ProductService::create([
            'product_id' => 6,
            'services' => 'تنظيف',
            'price' => '15',
        ]);

        /**************************************************************/

        ProductService::create([
            'product_id' => 7,
            'services' => 'غسيل وتنظيف',
            'price' => '35',
        ]);

        ProductService::create([
            'product_id' => 8,
            'services' => 'غسيل فقط',
            'price' => '30',
        ]);

        ProductService::create([
            'product_id' => 9,
            'services' => 'غسيل جاف',
            'price' => '60',
        ]);

        ProductService::create([
            'product_id' => 10,
            'services' => 'تشطيف فقط',
            'price' => '60',
        ]);

        ProductService::create([
            'product_id' => 11,
            'services' => 'غسيل فقط',
            'price' => '80',
        ]);

        ProductService::create([
            'product_id' => 12,
            'services' => 'تنظيف',
            'price' => '15',
        ]);


        /*******************************************************************/

        ProductService::create([
            'product_id' => 13,
            'services' => 'غسيل جاف',
            'price' => '30',
        ]);

        ProductService::create([
            'product_id' => 14,
            'services' => 'غسيل وكوي',
            'price' => '40',
        ]);

        ProductService::create([
            'product_id' => 15,
            'services' => 'تشطيف وكوي',
            'price' => '50',
        ]);

        ProductService::create([
            'product_id' => 16,
            'services' => 'تلميع وكوي',
            'price' => '25',
        ]);


        ProductService::create([
            'product_id' => 17,
            'services' => 'تلميع وكوي',
            'price' => '25',
        ]);

        ProductService::create([
            'product_id' => 18,
            'services' => 'تنقيع ققط',
            'price' => '20',
        ]);

        ProductService::create([
            'product_id' => 19,
            'services' => 'وكوي فقط',
            'price' => '64',
        ]);

        ProductService::create([
            'product_id' => 20,
            'services' => 'غسيل جاف',
            'price' => '30',
        ]);

        ProductService::create([
            'product_id' => 21,
            'services' => 'غسيل وكوي',
            'price' => '40',
        ]);

        ProductService::create([
            'product_id' => 22,
            'services' => 'تشطيف وكوي',
            'price' => '50',
        ]);

        ProductService::create([
            'product_id' => 23,
            'services' => 'تلميع وكوي',
            'price' => '25',
        ]);


        ProductService::create([
            'product_id' => 24,
            'services' => 'تلميع وكوي',
            'price' => '25',
        ]);

        ProductService::create([
            'product_id' => 25,
            'services' => 'تنقيع ققط',
            'price' => '20',
        ]);

        ProductService::create([
            'product_id' => 26,
            'services' => 'وكوي فقط',
            'price' => '64',
        ]);


        ProductService::create([
            'product_id' => 27,
            'services' => 'غسيل جاف',
            'price' => '30',
        ]);

        ProductService::create([
            'product_id' => 28,
            'services' => 'غسيل وكوي',
            'price' => '40',
        ]);

        ProductService::create([
            'product_id' => 29,
            'services' => 'تشطيف وكوي',
            'price' => '50',
        ]);

        ProductService::create([
            'product_id' => 30,
            'services' => 'تلميع وكوي',
            'price' => '25',
        ]);

    }
}
