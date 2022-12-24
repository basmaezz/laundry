<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('products', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('user_id')->unsigned()->index('user_id');
			$table->integer('category_item_id')->unsigned()->nullable()->index('category_item_id');
            $table->integer('subcategory_id')->index('subcategory_id');
			$table->string('name_ar', 191);
			$table->string('name_en', 191);
            $table->string('category_type', 191)->default('category');
            $table->text('desc_ar')->nullable();
			$table->text('desc_en')->nullable();
            $table->string('image', 191)->nullable();
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
		Schema::drop('products');
	}

}
