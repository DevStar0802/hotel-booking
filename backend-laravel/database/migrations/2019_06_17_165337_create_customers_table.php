<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->string('first_name', 150);
            $table->string('last_name', 150);
            $table->string('address', 250)->nullable();
            $table->string('city', 150)->nullable();
            $table->string('country', 150)->nullable();
            $table->string('phone', 150);
            $table->string('fax', 150)->nullable();
            $table->string('email', 250);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
        Schema::table('users', function($table) {
              $table->unsignedBigInteger('customer_id')->nullable();
             $table->foreign('customer_id')->references('id')->on('customers')->onDelete('set null');
         });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
