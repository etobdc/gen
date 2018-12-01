<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagemExtrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imagem_extras', function (Blueprint $table) {
            $table->increments('id');
            $table->string('image');
            $table->integer('imovel_id');
            $table->timestamps();
            $table->foreign('imovel_id')->references('id')->on('imovels');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('imagem_extras');
    }
}
