<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fornecedor extends Model
{
    // use HasFactory;

    // O eloquent ORM apenas coloca um s no final do nome da classe para encontrar a tabela correspondente no banco de dados. Assim, preciso definir aqui a tabela correta. 

    // Usando a Trait SoftDeletes. Obs: para que o softdelete funcione é preciso incluído na Migration da Model
    use SoftDeletes;
    protected $table = 'fornecedores';
    protected $fillable = ['nome', 'site', 'uf', 'email'];

    // Usando o Tinker
    // use \App\Models\Fornecedor;
    // $f = Fornecedor::find(1);
    // $f->nome = 'Fornecedor 123';
    // = "Fornecedor 123"
    // > $f->site = 'fornecedor123.com.br'
    // = "fornecedor123.com.br"
    // > $f->email = 'fornecedor123@teste.com.br'
    // = "fornecedor123@teste.com.br"
    // > $f->save();

    // Usando o fill
    // procurar no metodos de coleções


    
    // > $f = Fornecedor::whereIn('id', [1,2])->update(['nome'=>'Fonecedor Teste', 'site'=>'teste.com.br']);    

    // SoftDelete
    // É preciso trazer a classe softDeletes
    // use Illuminate\Database\Eloquent\SoftDeletes;
    // use \App\Models\Fornecedor
    // $fornecedor = Fornecedor::find(2);
    // $fornecedor->delete();
    // Fornecedor::all();
    // Se quiser deletar mesmo tem que usar o forceDelete
    // $fornecedor = Fornecedor::find(1);
    // $fornecedor->forceDelete();

    // Mostrar registros deletados com softDelete
    // Fornecedor::withTrashed()->get();
    // Fornecedor::create(['nome'=>'Fornecedor 1', 'site'=>'fornecedor1.com.br', 'uf'=>'MG', 'email'=>'contato@fornecedor1.com.br']);
    // Fornecedor::withTrashed()->get();
    // Fornecedor::onlyTrashed()->get();

    // Restaurar registros
    // $fornecedor = Fornecedor::withTrashed()->get();
    // $fornecedor[0]->restore();

    // Reprocessar todas as migrations
    // php artisan migrate:fresh

    // Criar uma seeder
    // php artisan make:seeder FornecedorSeeder


}
