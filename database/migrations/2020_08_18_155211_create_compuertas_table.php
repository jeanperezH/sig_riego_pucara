<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompuertasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compuertas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_zona')->unsigned();
            $table->string('compuerta',20);
            $table->time('start_at')->nullable();
            $table->time('end_at')->nullable();
            $table->string('dias',50)->nullable();
            $table->foreign('id_zona')->references('id')->on('zonas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('compuertas');
    }
}
