<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_table_id')->index('order_table_id');
            $table->integer('product_id')->index('product_id');
            $table->integer('category_id')->unsigned()->index('category_id');
            $table->integer('product_service_id')->unsigned()->index('product_service_id');
            $table->string('price', 191);
            $table->string('quantity', 191);
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
        Schema::dropIfExists('order_details');
    }
}
