<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToRequestsDeliveryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('requests_delivery', function(Blueprint $table)
		{
			$table->foreign('user_id', 'requests_delivery_ibfk_1')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('category_id', 'requests_delivery_ibfk_2')->references('id')->on('categories')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('requests_delivery', function(Blueprint $table)
		{
			$table->dropForeign('requests_delivery_ibfk_1');
			$table->dropForeign('requests_delivery_ibfk_2');
		});
	}

}
