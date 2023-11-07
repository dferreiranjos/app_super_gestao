<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    public function produtos(){
        // Utilizando o model Produto
        // return $this->belongsToMany('App\Models\Produto', 'pedidos_produtos');

        // Utilizando a model com o nome diferente de produto
        // O withPivot é usado para passar todos os campos da tabela de NxN que é pedidos_produtos
        return $this->belongsToMany('App\Models\Item', 'pedidos_produtos', 'pedido_id', 'produto_id')->withPivot('id', 'created_at', 'updated_at');

        /**
         * 1 parametro - Modelo do relacionamento NxN em relação ao modelo que estamos implementando(Item)
         * 2 parametro - É a tabela auxiliar que armazena os registros de relacionamento
         * 3 parametro - Representa o nome da fk da tabela mapeada pelo modelo na tabela de relacionamento
         * 4 parametro - Representa o nome da fk da tabela mapeada pelo modelo utilizado no relacionamento que estamos implementando
         */
    }
}
