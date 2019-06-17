<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 150);
            $table->integer('room_type_id')->unsigned();
            $table->integer('room_capacity_id')->unsigned();
            $table->string('image',255);
            $table->timestamps();

            $table->foreign('room_type_id')->references('id')->on('room_types')->onDelete('restrict');
            $table->foreign('room_capacity_id')->references('id')->on('room_capacities')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rooms');
    }
}
