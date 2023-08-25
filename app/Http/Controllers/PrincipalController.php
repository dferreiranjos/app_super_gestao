<?php

namespace App\Http\Controllers;

use App\Models\MotivoContato;
use Illuminate\Http\Request;

class PrincipalController extends Controller
{
    public function principal()
    {

        // $motivo_contatos = [
        //     '1'=>'Dúvida',
        //     '2'=>'Elogio',
        //     '3'=>'Reclamação'
        // ];

        $motivo_contatos = MotivoContato::all();

        // dd($motivo_contatos);

        return view('site.principal', ['motivo_contatos'=>$motivo_contatos]);
    }
}
