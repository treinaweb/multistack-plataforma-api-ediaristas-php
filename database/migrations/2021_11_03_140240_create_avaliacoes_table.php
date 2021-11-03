<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAvaliacoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('avaliacoes', function (Blueprint $table) {
            $table->id();

            $table->integer('visibilidade');

            $table->integer('nota');
            $table->text('descricao');

            $table->unsignedBigInteger('avaliador_id')->nullable();
            $table->foreign('avaliador_id')->references('id')->on('users');

            $table->unsignedBigInteger('avaliado_id');
            $table->foreign('avaliado_id')->references('id')->on('users');

            $table->unsignedBigInteger('diaria_id');
            $table->foreign('diaria_id')->references('id')->on('diarias');

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
        Schema::dropIfExists('avaliacoes');
    }
}
