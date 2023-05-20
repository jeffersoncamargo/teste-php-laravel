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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            /**
             * Ao valida as entradas de dados, percebí que a Categoria
             * vai ser inputada por texto a ser relacionado com o ID
             * 
             * Assim, julguei duas melhorias serem necessárias:
             * 
             * 1 => adicionar um índice de Unique na coluna com o nome da categoria,
             * garantindo que não haverá duplicidade no nome
             * 
             * 2 => adicionar um índice simpes na coluna, agilizando ainda mais a
             * busca do ID da categoria pelo nome
             */
            $table->string('name', 20)->unique()->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
