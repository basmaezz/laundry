<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToOrderAdditionalsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('order_additionals', function(Blueprint $table)
		{
			$table->foreign('extra_id', 'order_additionals_ibfk_1')->references('id')->on('provider_extras')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('order_id', 'order_additionals_ibfk_2')->references('id')->on('orders')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('order_additionals', function(Blueprint $table)
		{
			$table->dropForeign('order_additionals_ibfk_1');
			$table->dropForeign('order_additionals_ibfk_2');
		});
	}

}
