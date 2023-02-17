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
            $table->string("payment_method")->default("Cash")->after("status_id");
            $table->unsignedBigInteger('address_id');

            $table->foreign('address_id')
                ->references('id')
                ->on('addresses')->nullable()->after("payment_method");
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
            $table->dropColumn(['payment_method','address_id']);
        });
    }
};
