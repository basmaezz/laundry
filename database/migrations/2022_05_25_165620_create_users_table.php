<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 191);
			$table->string('last_name', 191)->nullable();
			$table->string('email', 191)->nullable()->unique();
			$table->string('password', 191);
			$table->string('phone', 191)->unique();
			$table->string('address', 191)->nullable();
			$table->string('lat', 191)->nullable();
			$table->string('lng', 191)->nullable();
			$table->string('code', 191)->nullable();
			$table->string('avatar', 191)->default('default.png');
			$table->string('arrears', 191)->default('0');
			$table->integer('city_id')->nullable()->index('city_id');
			$table->integer('active')->default(1);
			$table->integer('confirm')->default(0);
			$table->integer('role')->default(0);
			$table->integer('notification')->default(1);
			$table->text('jwt_token')->nullable();
			$table->string('user_type', 500)->default('user');
			$table->string('subscribe', 191)->nullable()->comment('pending - current - refusal ');
			$table->integer('package_id')->nullable()->index('package_id');
			$table->string('subscribe_end_date', 191)->nullable();
			$table->string('package_num_orders', 191)->nullable();
			$table->string('urgent', 191)->default('0');
			$table->string('price_urgent', 191)->default('20');
			$table->string('delivery_price', 191)->default('20');
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
		Schema::drop('users');
	}

}
