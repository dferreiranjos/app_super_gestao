<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteContato extends Model
{

    protected $fillable = ['nome', 'telefone', 'email', 'motivo_contato', 'mensagem'];

    // use HasFactory;
    // SELECT * FROM site_contatos WHERE nome <> 'Fernando' and motivo_contato in(1,2) and created_at BETWEEN '2020-08-01 00:00:00' AND '2023-08-31 23:59:59';

    // No tinker
    // $c = SiteContato::where('nome', '<>', 'Fernando')->whereIn('motivo_contato', [1,2])->whereBetween('created_at',['2020-08-01 00:00:00','2023-08-31 23:59:59'])->get();

    // $c = SiteContato::where('nome', '<>', 'Fernando')->orWhereIn('motivo_contato', [1,2])->orWhereBetween('created_at',['2020-08-01 00:00:00','2023-08-31 23:59:59'])->get();

    // $c= SiteContato::whereNotNull('updated_at')->orWhereNull('created_at')->get();
    // $c= SiteContato::whereDate('created_at', '2023-08-09')->get();
    // $c= SiteContato::whereDay('created_at', '09')->get();
    // $c= SiteContato::whereMonth('created_at', '08')->get();
    // $c= SiteContato::whereYear('created_at', '2023')->whereDay('created_at', '09')->get();
    // $c= SiteContato::whereTime('created_at', '=', '23:33:16')->get();

    // O método whereColumn não retorna valores nulos
    // use \App\Models\SiteContato;
    // $c = SiteContato::whereColumn('created_at', 'updated_at')->get();
    // $c = SiteContato::whereColumn('created_at', '<>', 'updated_at')->get();  
    // $c = SiteContato::where('id', '>', 0)->whereColumn('created_at', '<>', 'updated_at')->get();

    // Caso com precedência
    // select 
	//     * 
    // from 
    //     site_contatos
    // where
    //     (nome = 'Daniel' or nome = 'Ana') and (motivo_contato in (1,2) or id between 4 and 6);
    //     /*nome = 'Daniel' or nome = 'Ana' and motivo_contato in (1,2) or id between 4 and 6;*/
    // $c = SiteContato::where(function($query){$query->where('nome', 'Daniel')->orWhere('nome', 'Ana');})->where(function($query){$query->whereIn('motivo_contato', [1,2])->orWhereBetween('id', [4,6]);})->get();
    // $c = SiteContato::whereBetween('id', [2,6])->orderBy('motivo_contato')->orderBy('nome', 'desc')->get();

    // Com o pluck eu consigo extrair apenas o itens de interesse da coleção de objetos
    // SiteContato::all()->pluck('email');
    // SiteContato::all()->pluck('email')->first();
    // SiteContato::all()->pluck('email')->last();
    // SiteContato::all()->pluck('email')->reverse();
    // SiteContato::all()->pluck('email')->toArray();
    // SiteContato::all()->pluck('email','nome');

    // Deletando registros
    // use \App\Models\SiteContato;
    // $contato = SiteContato::find(4);
    // $contato->delete();
    // SiteContato::where('id', 7)->delete();
    // SiteContato::destroy(5);
}

