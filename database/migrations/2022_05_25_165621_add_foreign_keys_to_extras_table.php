<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToExtrasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('extras', function(Blueprint $table)
		{
			$table->foreign('cart_extra_id', 'extras_ibfk_1')->references('id')->on('cart_extras')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('extras', function(Blueprint $table)
		{
			$table->dropForeign('extras_ibfk_1');
		});
	}

}
