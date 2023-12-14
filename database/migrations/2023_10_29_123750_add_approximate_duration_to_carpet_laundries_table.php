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
        Schema::table('carpet_laundries', function (Blueprint $table) {
           $table->integer('approximate_duration')->after('area_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('carpet_laundries', function (Blueprint $table) {
           $table->dropColumn('approximate_duration');

        });
    }
};
