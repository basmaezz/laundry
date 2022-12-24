<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSitesettingTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sitesetting', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('site_name', 191)->nullable();
			$table->string('site_phone', 191)->nullable();
			$table->string('email', 191);
			$table->string('whatsapp', 191);
			$table->integer('distance_range')->default(50);
			$table->string('distance_delegates', 191)->default('20');
			$table->string('site_address', 191)->nullable();
			$table->string('added_tax', 191);
			$table->string('delivery_price', 191)->default('10');
			$table->integer('register_delegate')->default(1);
			$table->string('site_logo', 191)->nullable();
			$table->text('site_description')->nullable();
			$table->text('site_tagged')->nullable();
			$table->text('site_copyrigth')->nullable();
			$table->string('app_android_link', 191)->nullable();
			$table->string('app_apple_link', 191)->nullable();
			$table->string('link_video_motion', 191)->nullable();
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
		Schema::drop('sitesetting');
	}

}
