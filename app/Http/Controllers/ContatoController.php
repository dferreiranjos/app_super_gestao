<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\VarDumper\VarDumper;

class ContatoController extends Controller
{
    public function contato()
    {

        var_dump($_POST);
        $title = 'Contato';
        return view('site.contato', compact('title'));
    }
}
