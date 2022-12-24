<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('orders', function(Blueprint $table)
		{
			$table->integer('id', true);
            $table->integer('user_id')->unsigned()->nullable()->index('user_id');
            $table->integer('subcategory_id')->unsigned()->nullable()->index('subcategory_id');
            $table->integer('category_id')->unsigned()->nullable()->index('category_id');
            $table->integer('product_id')->unsigned()->nullable()->index('product_id');
            $table->integer('product_service_id')->unsigned()->nullable()->index('product_service_id');
			$table->integer('provider_id')->unsigned()->nullable()->index('provider_id');
			$table->string('address', 191)->nullable();
			$table->string('lat', 191)->nullable();
			$table->string('lng', 191)->nullable();
			$table->string('received_date', 191)->nullable();
			$table->string('delivery_date', 191)->nullable();
			$table->text('delegates')->nullable();
			$table->integer('delegate_id')->unsigned()->nullable()->index('delegate_id');
			$table->integer('delegate_delivery_id')->unsigned()->nullable()->index('delegate_delivery_id');
			$table->text('notes')->nullable();
			$table->string('status', 191)->default('cart')->comment('cart - pending - accepted - refuse - current');
			$table->string('payment', 191)->nullable()->comment('cash - online - balance');
			$table->string('total', 191)->nullable();
			$table->string('final_total', 191)->nullable();
			$table->string('total_tax', 191)->nullable();
			$table->string('total_delivery', 191)->nullable();
			$table->string('total_additional', 191)->default('0');
			$table->string('delivery_price', 191)->nullable();
			$table->string('urgent_price', 11)->default('0');
			$table->string('discount', 191)->nullable();
			$table->string('coupon', 191)->nullable();
			$table->integer('branche_id')->nullable()->index('branche_id');
			$table->string('mac_address_id', 191)->nullable();
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
		Schema::drop('orders');
	}

}
