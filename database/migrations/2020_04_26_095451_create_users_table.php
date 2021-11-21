<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
            $table->Increments('id');
            $table->string('mobile','30');
            $table->string('name')->nullable();
            $table->string('country_code')->default('966');
            $table->string('email')->nullable();
            $table->string('image')->nullable();
            $table->string('password','300')->nullable();
            $table->string('about','500')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->integer('user_id')->nullable();
            $table->float('stars_no')->default(0);
            $table->integer('rates_no')->default(0);
            $table->Integer('adv_fav')->default('0');
            $table->Integer('users_fav')->default('0');
            $table->Integer('total_adv')->default('0');
            $table->softDeletes();
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
        Schema::dropIfExists('users');
    }
}
