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
        Schema::create('rate_laundries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('laundry_id');
            $table->foreignId('order_id');
            $table->unsignedInteger('rate')->default(0);
            $table->text('review')->nullable();
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
        Schema::dropIfExists('rate_laundries');
    }
};
