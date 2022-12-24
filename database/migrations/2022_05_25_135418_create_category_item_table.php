<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_item', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('subcategory_id')->index('subcategory_id');
//            $table->integer('product_id')->index('product_id');
            $table->enum('category_type',['ملابس رجالي','ملابس حريمي','ملابس اطفالي'])->default('ملابس رجالي');
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
        Schema::dropIfExists('category_item');
    }
}
