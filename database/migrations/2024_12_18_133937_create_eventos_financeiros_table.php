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
        Schema::create('eventos_financeiros', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->date('data_inicio');
            $table->enum('tipo', ['despesa', 'receita']); // Define se é despesa ou receita
            $table->decimal('valor', 10, 2)->nullable();
            $table->unsignedBigInteger('categoria_id'); // FK para categorias
            $table->timestamps();

            // Definindo a relação com categorias
            $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('eventos_financeiros');
    }
};
