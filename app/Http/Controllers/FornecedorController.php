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

    public function listar(Request $request)
    {
        // dd($request->all());
        $fornecedores = Fornecedor::where('nome', 'like', "%{$request->input('nome')}%")
        ->where('site', 'like', "%{$request->input('site')}%")
        ->where('uf', 'like', "%{$request->input('uf')}%")
        ->where('email', 'like', "%{$request->input('email')}%")
        ->get();

        // dd($fornecedores);
        return view('app.fornecedor.listar', ['fornecedores' => $fornecedores]);
    }

    public function adicionar(Request $request)
    {

        // print_r($request->all());

        $msg = '';

        // inclusão
        if($request->input('_token') !='' && $request->input('id') == ''){
            
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

        // edição
        if($request->input('_token') !='' && $request->input('id') != ''){
            $fornecedor = Fornecedor::find($request->input('id'));
            $update = $fornecedor->update($request->all());

            if($update){
                $msg = 'Atualização realizada com sucesso';
            }else{
                $msg = 'Falha na atualização';
            }

            return redirect()->route('app.fornecedor.editar', ['id' => $request->input('id'), 'msg' => $msg]);
        }

        return view('app.fornecedor.adicionar', ['msg' => $msg]);
    }

    public function editar($id, $msg = '')
    {
        $fornecedor = Fornecedor::find($id);

        return view('app.fornecedor.adicionar', ['fornecedor' => $fornecedor, 'msg' => $msg]);
    }


}
