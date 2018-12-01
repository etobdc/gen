<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableCourseAddValues extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->integer('price')->default(0);
            $table->integer('promotional_price')->default(0);
            $table->boolean('promotion_active')->default(0);
            $table->string('promotional_phrase')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn('price');
            $table->dropColumn('promotional_price');
            $table->dropColumn('promotion_active');
            $table->dropColumn('promotional_phrase');
        });
    }
}
