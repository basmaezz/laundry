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
        Schema::create('delivery_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id');
            $table->foreignId('delivery_id');
            $table->enum('direction', ['ToLaundry','FromLaundry']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('delivery_histories');
    }
};
