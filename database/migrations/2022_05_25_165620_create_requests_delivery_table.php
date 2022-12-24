<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestsDeliveryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('requests_delivery', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('user_id')->unsigned()->index('user_id');
			$table->integer('category_id')->unsigned()->index('category_id');
			$table->string('lat', 191);
			$table->string('lng', 191);
			$table->string('address', 191);
			$table->string('date', 191);
			$table->string('time', 191);
			$table->string('bill_number', 191);
			$table->text('notes')->nullable();
			$table->string('status', 191)->default('0')->comment('[not_done => 0 , done => 1 ]');
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
		Schema::drop('requests_delivery');
	}

}
