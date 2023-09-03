<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        $erro = ''; 
        
        if($request->get('erro') == 1){
            $erro = 'Usuário ou senha invalidos';
        }

        if($request->get('erro') == 2){
            $erro = 'Realize o Login para ter acesso a página';
        }


        return view('site.login', ['titulo'=>'Login', 'erro'=>$erro]);
    }

    public function autenticar(Request $request)
    {
        $regras = [
            'usuario'=>'email',
            'senha'=>'required'
        ];

        $feedback = [
            'usuario.email'=>'O campo usuário (email) é obrigatório',
            'senha.required'=>'O campo senha é obrigatório'
        ];

        // se não passar do validate, acontece um redirect para a rota antiga
        $request->validate($regras, $feedback);

        // print_r($request->all());

        $email = $request->get('usuario');
        $password = $request->get('senha');

        $user = new User();

        $usuario = $user->where('email', $email)->where('password', $password)->get()->first();

        if (isset($usuario->name)) {
            session_start();
            $_SESSION['nome'] = $usuario->name;
            $_SESSION['email'] = $usuario->email;
            // dd($_SESSION);
            return redirect()->route('app.clientes');
        }else{
            return redirect()->route('site.login', ['erro' => 1]);
        }

        // echo "<pre>";
        // print_r($usuario);
        // echo "</pre>";

        // dd($existe);
    }
}
