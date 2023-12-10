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
        Schema::table('order_tables', function (Blueprint $table) {
            $table->foreignId('receive_time_id')->nullable();
            $table->date('receive_date')->nullable();
            $table->foreignId('delivery_time_id')->nullable();
            $table->date('delivery_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_tables', function (Blueprint $table) {
            $table->dropColumn(['receive_time','receive_date','delivery_time','delivery_date']);
        });
    }
};
