<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('order_tables', function ($table) {
            $table->unsignedBigInteger('address_id')->unsigned()->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_tables', function ($table) {
            $table->unsignedBigInteger('address_id')->unsigned()->nullable()->change();
        });
    }
};
