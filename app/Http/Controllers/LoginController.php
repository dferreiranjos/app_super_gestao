<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller
{
    public function index()
    {
        return view('site.login', ['titulo'=>'Login']);
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
            echo 'Usuário existe';
        }else{
            echo 'Usuário não existe';
        }

        // echo "<pre>";
        // print_r($usuario);
        // echo "</pre>";

        // dd($existe);
    }
}
