<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartExtrasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cart_extras', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('category_id')->unsigned()->index('category_id');
			$table->string('name_ar', 191);
			$table->string('name_en', 191);
			$table->integer('deleted')->default(0);
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
		Schema::drop('cart_extras');
	}

}
