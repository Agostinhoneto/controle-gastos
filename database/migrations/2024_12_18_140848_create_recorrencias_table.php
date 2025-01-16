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
        Schema::create('recorrencias', function (Blueprint $table) {
            $table->id();
            $table->enum('tipo', ['despesa', 'receita']);
            $table->decimal('valor', 15, 2);
            $table->unsignedBigInteger('categoria_id');
            $table->string('descricao')->nullable();
            $table->enum('frequencia', ['diaria', 'semanal', 'mensal', 'anual']);
            $table->date('data_inicio');
            $table->date('data_fim')->nullable();
            $table->unsignedBigInteger('usuario_id');
            $table->boolean('ativo')->default(true);
            $table->timestamps();

            // Relacionamentos
            $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete('cascade');
            $table->foreign('usuario_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recorrencias');
    }
};
