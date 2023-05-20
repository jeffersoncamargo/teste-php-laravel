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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            /**
             * A solução original com o campo bigInteger não funciona, pois o ID da
             * tabela categories é unsigned e a chave estrangeira tem que ser do tipo idêntico.
             * 
             * A primeira possível solução é a mais simples, que consiste de simplesmente ajustar
             * o tipo do campo para unsignedBigInteger:
             * $table->unisignedBigInteger('category_id');
             * 
             * A proposta acima é funcional e compatível desde o Laravel 4, mas desde o Laravel 6
             * o framework disponibiliza um facilitador para a definição de campos de chave estrngeira,
             * que seria o tipo foreingId, que foi o escolhido para a solução final.
             * Esse tipo de dado na instância do Bblueprint permite alguns recursos adicionais, como
             * o uso de um auto_increment na chave estrangeira, caso o campo precise de poupulação
             * serial e também, como implementei abaixo, a própria definição da foreign key na
             * própria criação do campo:
             */
            $table->foreignId('category_id')->constrained()->onDelete('cascade');

            /**
             * Aqui, pela definição atual do projeto, não seti necessidade de prevenir a duplicidade
             * do título do documento.
             */
            $table->string('title', 60);

            $table->text('contents');

            /**
             * A definição abaixo, com o uso do foreignId com constrained não se faz mais necessária.
             * $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            */
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
