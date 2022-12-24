<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToCategoryItemTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('category_item', function(Blueprint $table)
		{
            $table->foreign('subcategory_id', 'category_item_ibfk_1')->references('id')->on('subcategories')->onUpdate('CASCADE')->onDelete('CASCADE');
//            $table->foreign('product_id', 'category_item_ibfk_2')->references('id')->on('products')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('category_item', function(Blueprint $table)
		{
            $table->dropForeign('category_item_ibfk_1');
//            $table->dropForeign('category_item_ibfk_2');
		});
	}

}
