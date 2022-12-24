<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProviderExtrasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('provider_extras', function(Blueprint $table)
		{
			$table->integer('id', true);
            $table->integer('user_id')->unsigned()->index('user_id');
            $table->integer('provider_id')->unsigned()->nullable()->index('provider_id');
            $table->integer('category_id')->unsigned()->index('category_id');
			$table->integer('cart_extra_id')->nullable()->index('cart_extra_id');
			$table->integer('extra_id')->index('extra_id');
			$table->string('price', 191)->nullable();
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
		Schema::drop('provider_extras');
	}

}
