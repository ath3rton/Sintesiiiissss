<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projectes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nom_projecte');
            $table->string('descripcio');
            $table->string('feedback');
            $table->decimal('objectiu', 11, 3);
            $table->decimal('fraccio', 11, 3);
            $table->enum('estat', ['Creat', 'Obert','Bloquejat'])->default('Creat');
            $table->boolean('actiu')->default(1);
            $table->string('img')->default('white-canyon.jpg');
            $table->bigInteger('emp_id')->unsigned();
            $table->foreign('emp_id')->references('id')->on('empreses');
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
        Schema::dropIfExists('projectes');
    }
}
