<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyToSearchHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('search_history', function (Blueprint $table) {
            $table->foreign('subcategory_id', 'history_ibfk_1')->references('id')->on('subcategories')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('search_history', function (Blueprint $table) {
            $table->dropForeign('history_ibfk_1');
        });
    }
}
