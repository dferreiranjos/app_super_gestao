<?php

namespace App\Http\Controllers;

use App\Models\SiteContato;
use Illuminate\Http\Request;
use Symfony\Component\VarDumper\VarDumper;

class ContatoController extends Controller
{
    public function contato(Request $request)
    {

        // dd($request);
        /*echo '<pre>';
        print_r($request->all());
        echo '</pre>';
        echo $request->input('nome');
        echo '<br>';
        echo $request->input('email');
        echo '<br>';
        echo $_POST['nome'];*/

        // primeira forma
        
        /*$contato = new SiteContato();
        $contato->nome = $request->nome;
        $contato->telefone = $request->telefone;
        $contato->email = $request->email;
        $contato->motivo_contato = $request->motivo_contato;
        $contato->mensagem = $request->mensagem;

        // print_r($contato->getAttributes());
        $contato->save();*/

        // segunda forma

        // O metodo fill preenche o objeto através de um array associativo. Posso usar o create no lugar do fill e nesse caso não preciso usa o método save().
        // OBS: É preciso definir o protected fillable na model
        $contato = new SiteContato();
        $contato->fill($request->all());
        // print_r($contato->getAttributes());
        $contato->save();

        $title = 'Contato';
        return view('site.contato', compact('title'));
    }
}
