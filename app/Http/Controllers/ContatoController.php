<?php

namespace App\Http\Controllers;

use App\Models\MotivoContato;
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
        // $contato = new SiteContato();
        // $contato->fill($request->all());
        // print_r($contato->getAttributes());
        // $contato->save();

        // $motivo_contatos = [
        //     '1'=>'Dúvida',
        //     '2'=>'Elogio',
        //     '3'=>'Reclamação'
        // ];


        $motivo_contatos = MotivoContato::all();

        $title = 'Contato';
        return view('site.contato', ['title'=>'Contatos', 'motivo_contatos'=>$motivo_contatos]);
    }

    public function salvar(Request $request)
    {
        $regras =             [
            'nome' => 'required|min:3|max:40|unique:site_contatos',
            'telefone' => 'required',
            'email' => 'email',
            'motivo_contatos_id' => 'required',
            'mensagem' => 'required|max:2000'
        ];

        $feedback = [
            'nome.min' => 'O campo nome precisa ter no mínimo 3 caracteres',
            'nome.max' => 'O campo nome deve ter no máximo 40 caracteres',
            'nome.unique' => 'O nome informado já está em uso',

            'email.email' => 'O email informado não é válido',

            'mensagem.max' => 'A mensagem deve ter no máximo 2000 caracteres',

            'required' => 'O campo :attribute deve ser preenchido'
        ];

        $request->validate($regras, $feedback);

        SiteContato::create($request->all());
        return redirect()->route('site.index');
    }
}
