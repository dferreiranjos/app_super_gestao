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
        Schema::create('fornecedores', function (Blueprint $table) {
            $table->id();
            $table->string('nome',50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // para voltar passos, uso php artisan migrate:rollback que o último passo será retornado
        // posso voltar vários passos com php artisan migrate:rollback --step 2
        Schema::dropIfExists('fornecedores');
        // não faz teste prévio
        // Schema::drop('fornecedores');
    }
};
