<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderTablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_tables', function (Blueprint $table) {
            $table->integer('id',true);
            $table->integer('user_id')->unsigned()->index('user_id');
            $table->integer('category_id')->unsigned()->nullable()->index('category_id');
            $table->integer('laundry_id')->index('laundry_id');
            $table->string('total_price', 191);
            $table->string('count_products', 191);
            $table->string('status', 191)->default('pending')->comment('cart - pending - accepted - refuse - completed');
            $table->enum('status_id',[1 , 2 , 3 , 4 , 5])->nullable();
            $table->string('discount_value', 191)->nullable();
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
        Schema::dropIfExists('order_tables');
    }
}
