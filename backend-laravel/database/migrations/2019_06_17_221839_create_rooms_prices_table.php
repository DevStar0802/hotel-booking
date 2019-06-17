<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomsPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms_prices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('price_id')->unsigned();
            $table->bigInteger('room_id')->unsigned();
            $table->timestamps();

            $table->foreign('price_id')->references('id')->on('prices')->onDelete('cascade');
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rooms_prices');
    }
}
