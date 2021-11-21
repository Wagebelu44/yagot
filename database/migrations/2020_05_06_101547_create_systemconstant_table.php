<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSystemconstantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('system_constants', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
            $table->Increments('id');
            $table->string('name');
            $table->integer('value');
            $table->string('value2')->nullable();
            $table->integer('value3')->nullable();
            $table->string('type');
            $table->integer('order')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->string('photo')->nullable();
            $table->integer('user_id')->nullable();
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
        Schema::dropIfExists('system_constants');
    }
}
