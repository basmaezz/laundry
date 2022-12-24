<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDelegatesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('delegates', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('user_id')->unsigned()->index('user_id');
			$table->string('id_number', 191)->nullable();
			$table->string('iban_number', 191)->nullable();
			$table->string('bank_name', 191)->nullable();
			$table->string('id_image', 191)->nullable();
			$table->string('driving_license', 191)->nullable();
			$table->string('car_picture_front', 191)->nullable();
			$table->string('car_picture_behind', 191)->nullable();
			$table->string('car_registration', 191)->nullable();
			$table->string('glasses_avatar', 191)->nullable();
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
		Schema::drop('delegates');
	}

}
