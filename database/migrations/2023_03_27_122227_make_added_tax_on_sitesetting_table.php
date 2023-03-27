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
        Schema::table('sitesetting', function (Blueprint $table) {
            $table->string('email')->unsigned()->nullable()->change();
            $table->string('whatsapp')->unsigned()->nullable()->change();
            $table->integer('added_tax')->unsigned()->nullable()->change();
            $table->string('delivery_price')->unsigned()->nullable()->change();
            $table->string('register_delegate')->unsigned()->nullable()->change();
            $table->string('distance_range')->unsigned()->nullable()->change();
            $table->string('distance_delegates')->unsigned()->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sitesetting', function (Blueprint $table) {
            $table->string('email')->unsigned()->nullable(false)->change();
            $table->string('whatsapp')->unsigned()->nullable(false)->change();
            $table->string('added_tax')->unsigned()->nullable(false)->change();
            $table->string('delivery_price')->unsigned()->nullable(false)->change();
            $table->string('register_delegate')->unsigned()->nullable(false)->change();
            $table->string('distance_range')->unsigned()->nullable(false)->change();
            $table->string('distance_delegates')->unsigned()->nullable(false)->change();
        });
    }
};
