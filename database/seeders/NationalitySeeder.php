<?php

namespace Database\Seeders;

use App\Models\Nationality;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NationalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nationalities=[
            [
                'id'=>1,
                'name_en'=>'saudi Arabia',
                'name_ar'=>'سعودى'
            ],
            [
                'id'=>2,
                'name_en'=>'Egypt',
                'name_ar'=>'مصرى'
            ],
            [
                'id'=>3,
                'name_en'=>'Sudan',
                'name_ar'=>'سوداني'
            ],
            [
                'id'=>4,
                'name_en'=>'Yemen',
                'name_ar'=>'يمني'
            ],
            [
                'id'=>5,
                'name_en'=>'Morocco',
                'name_ar'=>'مغربي'
            ],
            [
                'id'=>6,
                'name_en'=>'India',
                'name_ar'=>'هندي'
            ],
            [
                'id'=>7,
                'name_en'=>'Pakistan',
                'name_ar'=>'باكستاني'
            ],
            [
                'id'=>8,
                'name_en'=>'Bangladesh',
                'name_ar'=>'بنقلاديشي'
            ],
            [
                'id'=>9,
                'name_en'=>'Philippines',
                'name_ar'=>'فلبيني'
            ],
            [
                'id'=>10,
                'name_en'=>'Somalia',
                'name_ar'=>'صومالي'
            ],
        ];


        Nationality::insert($nationalities);
    }
}
