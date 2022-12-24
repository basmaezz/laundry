<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyToOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_details', function (Blueprint $table) {
            $table->foreign('order_table_id', 'order_ibfk_1')->references('id')->on('order_tables')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('product_id', 'order_ibfk_2')->references('id')->on('products')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('category_id', 'order_ibfk_3')->references('id')->on('categories')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('product_service_id', 'order_ibfk_4')->references('id')->on('product_services')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_details', function (Blueprint $table) {
            $table->dropForeign('order_ibfk_1');
            $table->dropForeign('order_ibfk_2');
            $table->dropForeign('order_ibfk_3');
            $table->dropForeign('order_ibfk_4');
        });
    }
}
