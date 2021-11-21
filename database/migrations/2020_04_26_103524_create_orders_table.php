<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
            $table->Increments('id');
            $table->Integer('zone_id');
            $table->Integer('city_id');
            $table->Integer('port_id');
            $table->Integer('service_id');
            $table->double('price_from')->nullable();
            $table->double('price_to')->nullable(); 
            $table->tinyInteger('status')->default(1); 
            $table->Integer('client_id');
            $table->Integer('category_id');
            $table->string('notes','500');
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
        Schema::dropIfExists('orders');
    }
}
