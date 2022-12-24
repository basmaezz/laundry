<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHtmlTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('html', function(Blueprint $table)
		{
			$table->increments('id');
			$table->text('footer_copyrigh')->nullable();
			$table->string('email_header_color', 191)->nullable();
			$table->string('email_footer_color', 191)->nullable();
			$table->string('email_font_color', 191);
			$table->text('google_analytics')->nullable();
			$table->text('live_chat')->nullable();
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
		Schema::drop('html');
	}

}
