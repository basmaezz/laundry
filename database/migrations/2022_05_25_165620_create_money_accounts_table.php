<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoneyAccountsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('money_accounts', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 191);
			$table->string('bank_name', 191);
			$table->string('amount', 191);
			$table->string('image', 191)->nullable();
			$table->integer('status')->default(0);
			$table->integer('user_id')->unsigned()->index('money_accounts_user_id_foreign');
			$table->integer('package_id')->nullable()->index('package_id');
			$table->integer('order_id')->nullable()->index('order_id');
			$table->string('type', 191)->default('order')->comment('subscribe - order');
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
		Schema::drop('money_accounts');
	}

}
