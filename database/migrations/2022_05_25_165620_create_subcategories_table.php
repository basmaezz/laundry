<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubcategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('subcategories', function(Blueprint $table)
		{
            $table->integer('id', true);
            $table->integer('category_id')->unsigned()->index('category_id');
            $table->string('name_ar', 191);
            $table->string('name_en', 191);
            $table->string('rate', 191)->nullable();
            $table->string('image', 191)->nullable();
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->boolean('is_favorite')->default(true);
            $table->text('address')->nullable();
            $table->integer('deleted')->default(0);
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
		Schema::drop('subcategories');
	}

}
