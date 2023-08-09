<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model
{
    // use HasFactory;

    // O eloquent ORM apenas coloca um s no final do nome da classe para encontrar a tabela correspondente no banco de dados. Assim, preciso definir aqui a tabela correta. 

    protected $table = 'fornecedores';
}
