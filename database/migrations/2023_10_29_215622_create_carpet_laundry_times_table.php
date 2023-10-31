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
        Schema::create('carpet_laundry_times', function (Blueprint $table) {
            $table->id();
            $table->foreignId('carpet_laundry_id')->index('carpet_laundry_id');
            $table->time('start_from')->nullable();
            $table->time('end_to')->nullable();
            $table->enum('service_type',['received','delivered']);
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
        Schema::dropIfExists('carpet_laundry_times');
    }
};
