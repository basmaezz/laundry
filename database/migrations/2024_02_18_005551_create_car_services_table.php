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
        Schema::create('car_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subCategory_id')->index('subCategory_id');
            $table->string('name_ar');
            $table->string('name_en');
            $table->text('desc_ar');
            $table->text('desc_en');
            $table->string('price', 191)->nullable();
            $table->string('image', 191)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('car_services');
    }
};
