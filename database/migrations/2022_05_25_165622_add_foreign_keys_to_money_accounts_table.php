<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToMoneyAccountsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('money_accounts', function(Blueprint $table)
		{
			$table->foreign('package_id', 'money_accounts_ibfk_1')->references('id')->on('packages')->onUpdate('CASCADE')->onDelete('SET NULL');
			$table->foreign('order_id', 'money_accounts_ibfk_2')->references('id')->on('orders')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('user_id')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('money_accounts', function(Blueprint $table)
		{
			$table->dropForeign('money_accounts_ibfk_1');
			$table->dropForeign('money_accounts_ibfk_2');
			$table->dropForeign('money_accounts_user_id_foreign');
		});
	}

}
