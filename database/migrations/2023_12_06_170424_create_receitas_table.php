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
        Schema::create('receitas', function (Blueprint $table) {
            $table->id();
            $table->string('descricao');
            $table->decimal('valor', 10, 2);
            $table->date('data_recebimento');
            $table->boolean('status')->default(true);
            //$table->unsignedBigInteger('categoria_id');
            //$table->foreign('categoria_id')->references('id')->on('categorias'); 
            
            $table->foreignId('categoria_id')->constrained('categorias')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receitas');
    }
};
