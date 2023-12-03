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
        Schema::create('carpet_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subCategory_id')->index('subCategory_id');
            $table->string('category_en');
            $table->string('category_ar');
            $table->string('desc_ar');
            $table->string('desc_en');
            $table->string('price', 191)->nullable();
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
        Schema::dropIfExists('carpet_categories');
    }
};
