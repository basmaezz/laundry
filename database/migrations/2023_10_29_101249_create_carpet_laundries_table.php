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
        Schema::create('carpet_laundries', function (Blueprint $table) {
            $table->id();
            $table->string('area_name',191);
            $table->integer('approximate_duration');
            $table->tinyInteger('range');
            $table->string('lat', 191)->nullable();
            $table->string('lng', 191)->nullable();
            $table->string('delivery_price', 191)->nullable();
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
        Schema::dropIfExists('carpet_laundries');
    }
};
