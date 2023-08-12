<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteContato extends Model
{
    use HasFactory;
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

}

