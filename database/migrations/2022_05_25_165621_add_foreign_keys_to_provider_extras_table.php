<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToProviderExtrasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('provider_extras', function(Blueprint $table)
		{
			$table->foreign('extra_id', 'provider_extras_ibfk_1')->references('id')->on('extras')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('provider_id', 'provider_extras_ibfk_2')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('category_id', 'provider_extras_ibfk_3')->references('id')->on('categories')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('cart_extra_id', 'provider_extras_ibfk_4')->references('id')->on('cart_extras')->onUpdate('CASCADE')->onDelete('SET NULL');
             $table->foreign('user_id', 'provider_extras_ibfk_5')->references('id')->on('app_users')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('provider_extras', function(Blueprint $table)
		{
			$table->dropForeign('provider_extras_ibfk_1');
			$table->dropForeign('provider_extras_ibfk_2');
			$table->dropForeign('provider_extras_ibfk_3');
			$table->dropForeign('provider_extras_ibfk_4');
		});
	}

}
