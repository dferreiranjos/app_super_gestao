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
        //Coluna em produtos que receberá a fk de forncedores
        Schema::table('produtos', function(Blueprint $table){

            // insere um registro de fornecedor na tabela produtos para estabelecer um relacionamento e não ter que apagar os registros da tabela produtos
            // OBS: se estiver rodando as migrations pela primeira vez não é necessário criar esse registro
           
            $fornecedor_id = DB::table('fornecedores')->insertGetId([
                'nome'=>'Fornecedor Padrão SG',
                'site'=>'fornecedorpadraosg.com.br',
                'uf'=>'MG',
                'email'=>'contato@fornecedorpadraosg.com.br',
            ]);

            $table->unsignedBigInteger('fornecedor_id')->default($fornecedor_id)->after('id');
            $table->foreign('fornecedor_id')->references('id')->on('fornecedores');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::table('produtos', function(Blueprint $table){
            $table->dropforeign('produtos_fornecedor_id_foreign');
            $table->dropColumn('fornecedor_id');
        });
    }
};
