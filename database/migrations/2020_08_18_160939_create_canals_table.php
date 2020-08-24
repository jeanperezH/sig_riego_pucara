<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCanalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('canals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_zona')->unsigned();
            $table->bigInteger('id_compuerta')->unsigned();
            $table->string('canal',25);
            $table->decimal('longitud',11,2)->nullable();
            $table->foreign('id_zona')->references('id')->on('zonas')->onDelete('cascade');
            $table->foreign('id_compuerta')->references('id')->on('compuertas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('canals');
    }
}
