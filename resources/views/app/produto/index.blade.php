@extends('app.layouts.basico')

@section('titulo', 'Produto')

@section('conteudo')

    <div class="conteudo-pagina">

        <div class="titulo-pagina-2">
            <p>Listagem de Produtos</p>
        </div>

        <div class="menu">
            <ul>
                <li><a href="{{ route('produto.create') }}">Novo</a></li>
                <li><a href="">Consulta</a></li>
            </ul>
        </div>

        <div class="informacao-pagina">
            <div style="width: 90%; margin-left: auto; margin-right: auto;">
                <!-- {{ $produtos->toJson() }} -->
                <table border="1" width="100%">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Descrição</th>
                            <th>Nome Fornecedor</th>
                            <th>Site Fornecedor</th>
                            <th>Peso</th>
                            <th>Unidade ID</th>
                            <th>Comprimento</th>
                            <th>Altura</th>
                            <th>Largura</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($produtos as $produto)
                            <tr>
                                <td>{{ $produto->nome }}</td>
                                <td>{{ $produto->descricao }}</td>
                                <td>{{ $produto->fornecedor->nome }}</td>
                                <td>{{ $produto->fornecedor->site }}</td>
                                <td>{{ $produto->peso }}</td>
                                <td>{{ $produto->unidade_id }}</td>
                                <!-- Sem o eloquent -->
                                <!-- <td>{{ $produto->comprimento ?? '' }}</td>
                                <td>{{ $produto->altura ?? '' }}</td>
                                <td>{{ $produto->largura ?? '' }}</td> -->
                                <!-- Com o eloquent -->
                                <td>{{ $produto->itemDetalhe->comprimento ?? '' }}</td>
                                <td>{{ $produto->itemDetalhe->altura ?? '' }}</td>
                                <td>{{ $produto->itemDetalhe->largura ?? '' }}</td>
                                <td><a href="{{ route('produto.show', ['produto' => $produto->id ]) }}">Visualizar</a></td>
                                <td>
                                    <form id="form_{{$produto->id}}" method="post" action="{{ route('produto.destroy', ['produto'=>$produto->id]) }}">
                                        @csrf
                                        @method('DELETE')
                                        <!-- <button type="submit">Excluir</button> -->
                                        <a href="#" onclick="document.querySelector('#form_{{$produto->id}}').submit()">Excluir</a>
                                    </form>
                                </td>
                                <td><a href="{{ route('produto.edit' , ['produto' => $produto->id]) }}">Editar</a></td>
                            </tr>
                            <tr>
                                <td colspan="12">
                                    <p>Pedidos</p>
                                    @foreach ($produto->pedidos as $pedido)
                                        <a href="{{ route('pedido-produto.create', ['pedido' => $pedido->id]) }}">
                                            Pedido: {{ $pedido->id }},   
                                        </a>
                                       
                                    @endforeach
                                     <!-- SELECT
                                            b.id as pedido_id,
                                            c.id as produto_id,
                                            c.nome
                                        FROM
                                            pedidos_produtos as a
                                            LEFT JOIN pedidos as b on (a.pedido_id = b.id)
                                            LEFT JOIN produtos as c on (a.produto_id = c.id) -->
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- {{ $produtos->toJson() }} -->

                {{ $produtos->appends($request)->links() }}

                <!--
                <br>
                {{ $produtos->count() }} - Total de registros por página
                <br>
                {{ $produtos->total() }} - Total de registros da consulta
                <br>
                {{ $produtos->firstItem() }} - Número do primeiro registro da página
                <br>
                {{ $produtos->lastItem() }} - Número do último registro da página

                -->
                <br>
                Exibindo {{ $produtos->count() }} produtos de {{ $produtos->total() }} (de {{ $produtos->firstItem() }} a {{ $produtos->lastItem() }})
            </div>
        </div>

    </div>

@endsection
