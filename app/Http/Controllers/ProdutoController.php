<?php

namespace App\Http\Controllers;

// use App\Models\Produto;
use App\Models\Item;
use App\Models\ProdutoDetalhe;
use App\Models\Unidade;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $produtos = Produto::paginate(5);
        // Usando model com nomes diferentes e explicitos
        $produtos = Item::paginate(5); // aqui estou usando o lazy loading
        $produtos = Item::with(['itemDetalhe'])->paginate(5); // aqui estou usando o eager loading

        // dd($fornecedores);

        // Relacionamento de 1 x 1 sem a utilização do Eloquent
        /*
        foreach($produtos as $key=>$produto){
            // print_r($produto->getAttributes());
            // echo '<br><br>';

            $produtoDetalhe = ProdutoDetalhe::where('produto_id', $produto->id)->first();
            if(isset($produtoDetalhe)){
                // print_r($produtoDetalhe->getAttributes());

                $produtos[$key]['comprimento'] = $produtoDetalhe->comprimento;
                $produtos[$key]['largura'] = $produtoDetalhe->largura;
                $produtos[$key]['altura'] = $produtoDetalhe->altura;
            }
            // echo '<hr>';
        }
        */
        
        return view('app.produto.index', ['produtos' => $produtos, 'request' => $request->all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $unidades = Unidade::all();
        return view('app.produto.create' , ['unidades' => $unidades]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $regras = [
            'nome' => 'required|min:3|max:40',
            'descricao' => 'required|min:3|max:2000',
            'peso' => 'required|integer',
            // não pode haver espaço entre a tabela e o campo
            'unidade_id' => 'exists:unidades,id',
        ];

        $feedback = [
            'required' => 'O campo :attribute deve ser preenchido!',
            'nome.min' => 'O campo nome deve ter no mínimo 3 caracteres',
            'nome.max' => 'O campo nome deve ter no máximo 40 caracteres',
            'descricao.min' => 'O campo descricao deve ter no mínimo 3 caracteres',
            'descricao.max' => 'O campo descricao deve ter no máximo 2000 caracteres',
            'peso.integer' => 'O campo peso dever ser um número inteiro',
            'unidade_id.exists' => 'A unidade de medida informada não existe'
        ];

        $request->validate($regras, $feedback);

        // Essa é a forma mais simples de inserir os dados no banco
        Produto::create($request->all());
        return redirect()->route('produto.index');

        // Caso precise tratar os dados antes, posso usar como abaixo:
        // $produto = New Produto();
        // $nome = $request->get('nome');
        // $descricao = $request->get('descricao');

        // $nome = strtoupper($nome);

        // $produto->nome = $nome;
        // $produto->descricao = $descricao;

        // $produto->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(Produto $produto)
    {
        // Como a variável recebida é do tipo Produto, então o método show receberá o objeto produto referente ao id encaminhado.
        // dd($produto);
        return view('app.produto.show', ['produto' => $produto]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produto $produto)
    {
        $unidades = Unidade::all();
       
        return view('app.produto.edit', ['produto' => $produto, 'unidades' => $unidades]);
        // return view('app.produto.create', ['produto' => $produto, 'unidades' => $unidades]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produto $produto)
    {
        // print_r($request->all());
        // echo '<br><br><br>';
        // print_r($produto->getAttributes());

        $produto->update($request->all());
        return redirect()->route('produto.show', ['produto' => $produto->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produto $produto)
    {
        // dd($produto);
        $produto->delete();
        return redirect()->route('produto.index');
    }
}
