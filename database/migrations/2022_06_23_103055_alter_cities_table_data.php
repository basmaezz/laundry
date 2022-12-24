<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterCitiesTableData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $city = \App\Models\City::create(['name_ar'=>'الرياض','name_en'=>'Riyadh']);
        \App\Models\Region::create(['city_id'=>$city->id,'name_ar'=>'الدرعية','name_en'=>'Diriyah']);
        \App\Models\Region::create(['city_id'=>$city->id,'name_ar'=>'الدوادمي','name_en'=>'Dawadmi']);
        \App\Models\Region::create(['city_id'=>$city->id,'name_ar'=>'المجمعة','name_en'=>'Combined']);

        $city2 = \App\Models\City::create(['name_ar'=>'مكة المكرمة','name_en'=>'Mecca']);
        \App\Models\Region::create(['city_id'=>$city2->id,'name_ar'=>'جدة','name_en'=>'Jeddah']);
        \App\Models\Region::create(['city_id'=>$city2->id,'name_ar'=>'الطائف','name_en'=>'Taif']);
        \App\Models\Region::create(['city_id'=>$city2->id,'name_ar'=>'القنفذة','name_en'=>'the hedgehog']);

        $city3 = \App\Models\City::create(['name_ar'=>' المدينة المنورة','name_en'=>'AL Madinah AL Munawwarah']);
        \App\Models\Region::create(['city_id'=>$city3->id,'name_ar'=>'ينبع','name_en'=>'Yanbo7']);
        \App\Models\Region::create(['city_id'=>$city3->id,'name_ar'=>'العلا','name_en'=>'El ola']);
        \App\Models\Region::create(['city_id'=>$city3->id,'name_ar'=>'المهد','name_en'=>'El mahd']);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
