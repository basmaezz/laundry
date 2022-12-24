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
            $table->boolean("request_employment")->default(false)->after("glasses_avatar");
            $table->date("license_start_date")->after("request_employment");
            $table->date("license_end_date")->after("license_start_date");
            $table->string("medic_check")->after("license_end_date")->nullable();
            $table->year("manufacture_year")->after("medic_check")->nullable();
            $table->string("car_type")->after("manufacture_year")->nullable();
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
            $table->dropColumn(['request_employment', 'license_start_date', 'license_end_date', 'car_type', 'manufacture_year', 'medic_check', 'avatar']);
        });
    }
};
