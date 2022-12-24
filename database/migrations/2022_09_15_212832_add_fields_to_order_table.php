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
            $table->string('coupon')->after('vat')->default(null)->nullable();
            $table->unsignedDecimal('discount')->after('coupon')->default(0);
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
            $table->dropColumn(['coupon','discount']);
        });
    }
};
