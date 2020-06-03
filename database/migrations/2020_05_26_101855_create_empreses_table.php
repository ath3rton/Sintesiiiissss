<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateEmpresesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empreses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nom_empresa');
            $table->string('cif');
            $table->string('ciutat');
            $table->string('telf')->default('');
            $table->string('web')->default('');
            $table->string('logo')->default('logo.png');
            $table->bigInteger('owner')->unsigned();
            $table->foreign('owner')->references('id')->on('users');
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
        Schema::dropIfExists('empreses');
    }
}
