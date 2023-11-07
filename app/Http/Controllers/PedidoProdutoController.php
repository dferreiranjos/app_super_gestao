<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\PedidoProduto;
use App\Models\Produto;
use Illuminate\Http\Request;

class PedidoProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Pedido $pedido)
    {
        // dd($pedido);
        $produtos = Produto::all();
        // Comentei a instrução abaixo, pois já estou usando o método produtos de Pedido na View Create de pedido produto
        $pedido->produtos; //eager loading. OBS a função produtos foi criada na model Pedido
        return view('app.pedido_produto.create', ['pedido' => $pedido, 'produtos' => $produtos]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Pedido $pedido)
    {
        // dd($pedido);
        // echo '<pre>';
        // // print_r($pedido);
        // print_r($pedido->id);
        // echo '</pre>';
        // echo '<hr>';
        // echo '<pre>';
        // // print_r($request->all());
        // print_r($request->produto_id);
        // echo '</pre>';

        $regras = [
            'produto_id' => 'exists:produtos,id',
            'quantidade' => 'required'
        ];

        $feedback = [
            'produto_id.exists' => 'Produto informado não existe',
            'required' => 'O campo :attribute deve possuir um valor válido'
        ];

        $request->validate($regras, $feedback);

        /*
        $pedidoProduto = new PedidoProduto();
        $pedidoProduto->pedido_id = $pedido->id;
        $pedidoProduto->produto_id = $request->get('produto_id');
        $pedidoProduto->quantidade = $request->get('quantidade');
        $pedidoProduto->save();
        */

        // $pedido->produtos; //os registros do relacionamento
        // $pedido->produtos()->attach(
        //     $request->get('produto_id'),
        //     ['quantidade' => $request->get('quantidade')]
        // ); //Objeto

        // caso queira fazer com múltiplos registros
        $pedido->produtos()->attach([
            $request->get('produto_id')=>['quantidade' => $request->get('quantidade')]
        ]);

        return redirect()->route('pedido-produto.create', ['pedido' => $pedido->id]);

        // echo "{$pedido->id} - $request->produto_id";
    }
    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(Pedido $pedido, Produto $produto)
    public function destroy(PedidoProduto $pedidoProduto, $pedido_id)
    {
        /*
        print_r($pedido->getAttributes());
        echo '<hr>';
        print_r($produto->getAttributes());
        */

        // echo $pedido->id.' - '.$produto->id;

        // Convencional
        /*
        PedidoProduto::where([
            'pedido_id' => $pedido->id,
            'produto_id' => $produto->id
        ])->delete();
        */
        
        // detach (delete pelo relacionamento com base no método de relacionamento belongToMany)
        // deve-se lembrar, que se estou com o pedido estancioado e o id dele já esta no contesto
        // $pedido->produtos()->detach($produto->id);

        $pedidoProduto->delete();

        return redirect()->route('pedido-produto.create', [$pedido_id]);

    }
}
