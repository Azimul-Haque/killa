<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDisdatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disdatas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('discategory_id')->unsigned();
            $table->timestamps();
        });

        Schema::create('disdata_districtscord', function (Blueprint $table) {
            $table->integer('disdata_id')->unsigned();
            $table->integer('districtscord_id')->unsigned();

            $table->foreign('disdata_id')->references('id')->on('disdatas')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('districtscord_id')->references('id')->on('districtscords')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['disdata_id', 'districtscord_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('disdatas');
        Schema::drop('disdata_districtscord');
    }
}
