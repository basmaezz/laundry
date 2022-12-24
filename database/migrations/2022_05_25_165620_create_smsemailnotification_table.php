<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmsemailnotificationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('smsemailnotification', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('smtp_type', 191);
			$table->string('smtp_username', 191)->nullable();
			$table->string('smtp_password', 191)->nullable();
			$table->string('smtp_sender_email', 191)->nullable();
			$table->string('smtp_sender_name', 191)->nullable();
			$table->integer('smtp_port')->nullable();
			$table->string('smtp_host', 191)->nullable();
			$table->string('smtp_encryption', 191)->nullable();
			$table->string('sms_number', 191)->nullable();
			$table->string('sms_password', 191)->nullable();
			$table->string('sms_sender_name', 191)->nullable();
			$table->string('oneSignal_application_id', 191)->nullable();
			$table->string('oneSignal_authorization', 191)->nullable();
			$table->string('fcm_server_key', 191)->nullable();
			$table->string('fcm_sender_id', 191)->nullable();
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
		Schema::drop('smsemailnotification');
	}

}
