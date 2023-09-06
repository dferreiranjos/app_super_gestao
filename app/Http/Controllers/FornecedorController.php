<?php

namespace App\Http\Controllers;

use App\Models\Fornecedor;
use Illuminate\Http\Request;

class FornecedorController extends Controller
{
    public function index()
    {
        return view('app.fornecedor.index');
    }

    public function listar()
    {
        return view('app.fornecedor.listar');
    }

    public function adicionar(Request $request)
    {

        // print_r($request->all());

        $msg = '';

        if($request->input('_token') !=''){
            
            $regras = [
                'nome'=>'required|min:3|max:40',
                'site'=>'required',
                'uf'=>'required|min:2|max:2',
                'email'=>'email'
            ];

            $feedback = [
                'required'=>'O campo :attribute deve ser preenchido!',
                'nome.min'=>'O campo nome dever ter no mínimo 3 caracteres',
                'nome.max'=>'O campo nome dever ter no máximo 40 caracteres',
                'uf.min'=>'O campo uf dever ter no mínimo 2 caracteres',
                'uf.max'=>'O campo uf dever ter no máximo 2 caracteres',
                'email'=>'O campo email não foi preenchido corretamente',
            ];

            $request->validate($regras, $feedback);

            $fornecedor = new Fornecedor();
            $fornecedor->create($request->all());

            $msg = 'Cadastro realizado com sucesso!';
        }

        return view('app.fornecedor.adicionar', ['msg' => $msg]);
    }
}
