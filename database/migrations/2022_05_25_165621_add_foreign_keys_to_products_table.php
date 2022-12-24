<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('products', function(Blueprint $table)
		{
			$table->foreign('category_item_id', 'products_ibfk_1')->references('id')->on('category_item')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('subcategory_id', 'products_ibfk_2')->references('id')->on('subcategories')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('user_id', 'products_ibfk_3')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
//			$table->foreign('category_item_id', 'products_ibfk_4')->references('id')->on('category_item')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('products', function(Blueprint $table)
		{
			$table->dropForeign('products_ibfk_1');
			$table->dropForeign('products_ibfk_2');
            $table->dropForeign('products_ibfk_3');
//            $table->dropForeign('products_ibfk_4');
		});
	}

}
