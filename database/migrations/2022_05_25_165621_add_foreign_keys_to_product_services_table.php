<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToProductServicesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('product_services', function(Blueprint $table)
		{
            $table->foreign('product_id', 'product_services_ibfk_1')->references('id')->on('products')->onUpdate('CASCADE')->onDelete('CASCADE');
//            $table->foreign('branche_id', 'product_services_ibfk_2')->references('id')->on('branches')->onUpdate('CASCADE')->onDelete('SET NULL');
        });
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table('product_services', function (Blueprint $table) {
            $table->dropForeign('product_services_ibfk_1');
//            $table->dropForeign('product_services_ibfk_2');

        });
	}

}
