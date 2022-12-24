<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyToOrderTablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_tables', function (Blueprint $table) {
            $table->foreign('user_id', 'ordertables_ibfk_1')->references('id')->on('app_users')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('category_id', 'ordertables_ibfk_3')->references('id')->on('categories')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('laundry_id', 'ordertables_ibfk_2')->references('id')->on('subcategories')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shopping_cart', function (Blueprint $table) {
            $table->dropForeign('shopping_cart_ibfk_1');
            $table->dropForeign('shopping_cart_ibfk_2');
            $table->dropForeign('shopping_cart_ibfk_3');
        });
    }
}
