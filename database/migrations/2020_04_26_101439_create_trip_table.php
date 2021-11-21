<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adv', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
            $table->Increments('id');
            $table->string('name');
            $table->string('main_image');
            $table->Integer('zone_id');
            $table->Integer('city_id');
            $table->Integer('category_id');
            $table->string('details');
            $table->integer('user_id');
            $table->integer('total_notify');
            $table->tinyInteger('status')->nullable();
            $table->tinyInteger('show_mobile')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('adv_attachment', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
            $table->Increments('id');
            $table->Integer('trip_id');
            $table->string('attachment');
            $table->integer('user_id');
            $table->integer('type'); // 1 images // 2 videos
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('tag', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
            $table->Increments('id');
            $table->string('name');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('adv_tag', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
            $table->Increments('id');
            $table->Integer('tag_id');
            $table->Integer('adv_id');
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
        Schema::dropIfExists('adv');
        Schema::dropIfExists('adv_attachment');
    }
}
