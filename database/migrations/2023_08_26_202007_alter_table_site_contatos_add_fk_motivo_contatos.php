<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // adicionando a coluna motivo_contatos_id
        Schema::table('site_contatos', function (Blueprint $table) {
            $table->unsignedBigInteger('motivo_contatos_id');
        });

        // atribuindo motivo_contato para a nova coluna motivo_contatos_id
        DB::statement('UPDATE site_contatos SET motivo_contatos_id = motivo_contato');

        // cria a fk e remove a coluna motivo_contato
        Schema::table('site_contatos', function (Blueprint $table) {
            $table->foreign('motivo_contatos_id')->references('id')->on('motivo_contatos');
            $table->dropColumn('motivo_contato');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         // cria a coluna motivo_contato e removendo a fk
         Schema::table('site_contatos', function (Blueprint $table) {
            $table->integer('motivo_contato');
            // Padrão do laravel
            // $table->dropForeign('<table>_<column>_foreign');
            $table->dropForeign('site_contatos_motivo_contatos_id_foreign');
        });

        // atribui motivo_contatos_id para a coluna motivo_contato
        DB::statement('UPDATE site_contatos SET motivo_contato = motivo_contatos_id');

        // remove a coluna motivo_contatos_id
        Schema::table('site_contatos', function (Blueprint $table) {
            $table->dropColumn('motivo_contatos_id');
        });
    }
};
