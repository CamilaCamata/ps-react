<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('imagem');
            $table->integer('quantidade');
            $table->string('descrição');
            //$table->string('categoria');
            $table->unsignedBigInteger('categorias_id');
            $table->timestamps();

            $table->foreign('categorias_id')->references('id')->on('categorias')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produtos');
    }
};
