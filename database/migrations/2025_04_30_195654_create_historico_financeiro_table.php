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
            Schema::create('historico_financeiro', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('categoria_id');
                $table->unsignedBigInteger('usuario_id');
                $table->enum('tipo', ['receita', 'despesa']);
                $table->string('descricao');
                $table->decimal('valor', 10, 2);
                $table->date('data');
                $table->string('comprovante_path')->nullable();
                $table->timestamps();

                $table->foreign('usuario_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('historico_financeiro');
    }
};
