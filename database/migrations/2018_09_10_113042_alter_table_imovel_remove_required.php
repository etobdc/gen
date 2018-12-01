<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableImovelRemoveRequired extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('imovels', function (Blueprint $table) {
            $table->string('quarto')->nullable()->change();
            $table->string('garagem')->nullable()->change();
            $table->string('banheiro')->nullable()->change();
            $table->string('sala')->nullable()->change();
            $table->string('codigo')->nullable()->change();
            $table->string('video', 100)->nullable();
            $table->dropColumn('codigo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('imovels', function (Blueprint $table) {
            $table->string('quarto')->nullable(false)->change();
            $table->string('garagem')->nullable(false)->change();
            $table->string('banheiro')->nullable(false)->change();
            $table->string('sala')->nullable(false)->change();
            $table->string('codigo')->nullable(false)->change();
            $table->dropColumn('video');
            $table->integer('codigo')->unique();
        });
    }
}
