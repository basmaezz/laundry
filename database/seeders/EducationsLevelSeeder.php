<?php

namespace Database\Seeders;

use App\Models\educationLevel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EducationsLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $levels=
   [
       [
            'id'=>'1',
            'name'=>'ثانوي'
        ],[
            'id'=>'2',
            'name'=>'دبلوم'
        ],[
            'id'=>'3',
            'name'=>'بكالريوس'
        ],[
            'id'=>'4',
            'name'=>'ماجستير'
        ],  [
            'id'=>'5',
            'name'=>'اعلى'
        ],
   ];
        educationLevel::insert($levels);
    }
}
