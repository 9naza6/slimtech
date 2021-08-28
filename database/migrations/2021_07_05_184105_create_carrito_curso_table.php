<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarritoCursoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carrito_curso', function (Blueprint $table) {
            $table->bigInteger('carrito_id')->unsigned();
            $table->bigInteger('curso_id')->unsigned();
            $table->integer('quantity')->unsigned();
            $table->foreign('carrito_id')->references('id')->on('carritos');
            $table->foreign('curso_id')->references('id')->on('cursos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carrito_curso');
    }
}
