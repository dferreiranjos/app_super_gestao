<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
     // use HasFactory;
     protected $table = 'produtos';
     protected $fillable = ['nome', 'descricao', 'peso', 'unidade_id'];

     // Para fazer um relacionamento de 1 x 1 usando o eloquente, preciso criar uma função
     // que vai procurar um registro relacionado em produto_detalhes com base na fk relacionada a pk de produtos
     public function itemDetalhe(){
         return $this->hasOne('App\Models\ItemDetalhe', 'produto_id', 'id');
 
     }
 
}
