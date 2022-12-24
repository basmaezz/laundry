<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductServicesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('product_services', function(Blueprint $table)
		{
            $table->increments('id');
            $table->integer('product_id')->index('product_id');
//            $table->integer('branche_id')->nullable()->default(1)->index('branche_id');
            $table->string('services');
            $table->integer('price');
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
		Schema::drop('product_services');
	}

}
