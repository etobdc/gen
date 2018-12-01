<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id')->nullable();
            $table->string('email')->unique();
            $table->string('name');
            $table->string('cpf');
            $table->string('birthdate')->length(14);
            $table->string('phone')->length(11);
            $table->string('secondary_phone')->length(11);
            $table->string('zipcode')->length(10);
            $table->string('street')->length(50);
            $table->string('number')->length(20);
            $table->string('complement')->length(100);
            $table->string('district')->length(50);
            $table->string('city');
            $table->string('state')->length(2);
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
        Schema::dropIfExists('clients');
    }
}
