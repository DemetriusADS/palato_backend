<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePicoleLoteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('picole_lote', function (Blueprint $table) {
            $table->id();
            $table->integer("picole_id");
            $table->integer('lote_ref')->default(1);
            $table->integer("quantidade_total")->default(0);
            $table->decimal("valor_varejo");
            $table->decimal("valor_atacado");
            $table->integer("quantidade_restante")->default(0);
            $table->timestamps();

            $table->foreign('picole_id')->references('id')->on('picole')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('picole_lote');
    }
}
