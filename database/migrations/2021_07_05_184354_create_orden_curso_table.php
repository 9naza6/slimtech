<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdenCursoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orden_curso', function (Blueprint $table) {
            $table->bigInteger('orden_id')->unsigned();
            $table->bigInteger('curso_id')->unsigned();
            $table->integer('quantity')->unsigned();
            $table->foreign('orden_id')->references('id')->on('ordens');
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
        Schema::dropIfExists('orden_curso');
    }
}
