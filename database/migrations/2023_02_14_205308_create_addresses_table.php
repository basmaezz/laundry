<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId("app_user_id");
            $table->foreignId("city_id");
            $table->string("region_name");
            $table->string("address");
            $table->string("building");
            $table->string('lat', 191)->nullable();
            $table->string('lng', 191)->nullable();
            $table->string("description")->nullable();
            $table->string("image")->nullable();
            $table->boolean("default")->default(false);
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
        Schema::dropIfExists('addresses');
    }
};
