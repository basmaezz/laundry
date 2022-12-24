<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_users', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid("uuid")->unique();
            $table->string('mobile')->unique();
            $table->string('password')->nullable();
            $table->string('email')->nullable()->unique();
            $table->string('name')->nullable();
            $table->string('image')->nullable();
            $table->enum('gender',['m','f'])->default('m');
            $table->enum('status', ['active', 'deactivated', 'blocked'])->default('active');
            $table->integer('city_id')->nullable();
            $table->string('region_name')->nullable();
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->string('address')->nullable();
            $table->string('building')->nullable();
            $table->timestamp('last_activity')->nullable();
            $table->string('activation_code')->nullable();
            $table->string('reset_password_code')->nullable();
            $table->datetime('last_request_reset_code')->nullable();
            $table->string('fcm_token')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->index(['mobile','name']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('app_users');
    }
}
