<?php

namespace Database\Seeders;

use App\Models\CarType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class carTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $cars=[
            [
           'id' => '2',
           'name_ar' => 'BMW',
           'name_en' => 'BMW'
            ],
           [
           'id' => '3',
           'name_ar' => 'Audi',
           'name_en' => 'Audi'
            ],
           [
           'id' => '4',
           'name_ar' => 'FIAT',
           'name_en' => 'FIAT'
            ],
           [
           'id' => '5',
           'name_ar' => 'Ram',
           'name_en' => 'Ram'
            ],
           [
           'id' => '6',
           'name_ar' => 'GMC',
           'name_en' => 'GMC'
            ],

       ];
       CarType::insert($cars);
    }
}





