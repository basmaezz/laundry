<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('delegates', function (Blueprint $table) {
            $table->string('car_plate_letter', 191)->after('driving_license');
            $table->string('car_plate_number', 191)->after('car_plate_letter');
            $table->foreignId('nationality_id')->after('user_id')->default('1');
            $table->foreignId('car_manufacture_year_id')->after('car_type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('delegates', function (Blueprint $table) {
             $table->dropColumn('car_plate_letter');
             $table->dropColumn('car_plate_number');
            $table->dropColumn('nationality_id');
        });
    }
};
