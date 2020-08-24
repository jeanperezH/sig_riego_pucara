<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChacrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chacras', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_canal')->unsigned();
            $table->string('chacra',50);
            $table->string('tipo_cultivo',50);
            $table->foreign('id_canal')->references('id')->on('canals')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chacras');
    }
}
