<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void
    {
        Schema::table('despesas', function (Blueprint $table) {
            $table->foreignId('usuario_cadastrante_id')->nullable()->constrained('users')->onDelete('set null');
        });

        Schema::table('receitas', function (Blueprint $table) {
            $table->foreignId('usuario_cadastrante_id')->nullable()->constrained('users')->onDelete('set null');
        });

        Schema::table('categorias', function (Blueprint $table) {
            $table->foreignId('usuario_cadastrante_id')->nullable()->constrained('users')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('despesas', function (Blueprint $table) {
            $table->dropForeign(['usuario_cadastrante_id']);
            $table->dropColumn('usuario_cadastrante_id');
        });

        Schema::table('receitas', function (Blueprint $table) {
            $table->dropForeign(['usuario_cadastrante_id']);
            $table->dropColumn('usuario_cadastrante_id');
        });

        Schema::table('categorias', function (Blueprint $table) {
            $table->dropForeign(['usuario_cadastrante_id']);
            $table->dropColumn('usuario_cadastrante_id');
        });
    }
};