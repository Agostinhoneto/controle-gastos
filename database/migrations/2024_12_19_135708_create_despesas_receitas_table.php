<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('despesas_receitas', function (Blueprint $table) {
            $table->id();
            $table->enum('tipo', ['despesa', 'receita']);
            $table->decimal('valor', 15, 2);
            $table->unsignedBigInteger('categoria_id');
            $table->string('descricao')->nullable();
            $table->date('data');
            $table->unsignedBigInteger('usuario_id');
            $table->unsignedBigInteger('recorrencia_id')->nullable();
            $table->timestamps();

            // Relacionamentos
            $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete('cascade');
            $table->foreign('usuario_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('recorrencia_id')->references('id')->on('recorrencias')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('despesas_receitas');
    }
};
