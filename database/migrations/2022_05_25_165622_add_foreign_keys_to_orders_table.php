<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('orders', function(Blueprint $table)
		{
			$table->foreign('user_id', 'orders_ibfk_1')->references('id')->on('app_users')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('category_id', 'orders_ibfk_2')->references('id')->on('categories')->onUpdate('CASCADE')->onDelete('SET NULL');
			$table->foreign('delegate_id', 'orders_ibfk_3')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('SET NULL');
			$table->foreign('branche_id', 'orders_ibfk_4')->references('id')->on('branches')->onUpdate('CASCADE')->onDelete('SET NULL');
			$table->foreign('provider_id', 'orders_ibfk_5')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('delegate_delivery_id', 'orders_ibfk_6')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('SET NULL');
//            $table->foreign('product_id', 'orders_ibfk_8')->references('id')->on('products')->onUpdate('CASCADE')->onDelete('SET NULL');
//            $table->foreign('product_service_id', 'orders_ibfk_9')->references('id')->on('product_services')->onUpdate('CASCADE')->onDelete('SET NULL');
//            $table->foreign('subcategory_id', 'orders_ibfk_7')->references('id')->on('subcategories')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('orders', function(Blueprint $table)
		{
			$table->dropForeign('orders_ibfk_1');
			$table->dropForeign('orders_ibfk_2');
			$table->dropForeign('orders_ibfk_3');
			$table->dropForeign('orders_ibfk_4');
			$table->dropForeign('orders_ibfk_5');
			$table->dropForeign('orders_ibfk_6');
		});
	}

}
