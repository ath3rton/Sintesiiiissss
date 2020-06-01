<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDenunciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('denuncies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('descripcio');
            $table->bigInteger('proj')->unsigned();
            $table->foreign('proj')->references('id')->on('projectes');
            $table->bigInteger('usuari')->unsigned();
            $table->foreign('usuari')->references('id')->on('users');
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
        Schema::dropIfExists('denuncies');
    }
}
