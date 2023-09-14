<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PrincipalController;
use App\Http\Controllers\SobreNosController;
use App\Http\Controllers\ContatoController;
use App\Http\Controllers\TesteController;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\HomeController;
// use App\Http\Middleware\LogAcessoMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\ProdutoDetalheController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::middleware(LogAcessoMiddleware::class)
//     ->get('/', [PrincipalController::class, 'principal'])
//     ->name('site.index');
// Retirado a middleware para que seja feita para todas as rotas no arquivo Kernel
// Aqui estou usando um apelido para a middleware
Route::get('/', [PrincipalController::class, 'principal'])->name('site.index')->middleware('log.acesso');

Route::get('/sobre-nos', [SobreNosController::class, 'sobreNos'])->name('site.sobrenos');

// Route::get('/contato', [ContatoController::class, 'contato'])
//     ->name('site.contato')
//     ->middleware(LogAcessoMiddleware::class);  
// Retirado a middleware para que seja feita para todas as rotas no arquivo Kernel
Route::get('/contato', [ContatoController::class, 'contato'])->name('site.contato');  

Route::post('/contato', [ContatoController::class, 'salvar'])->name('site.contato');    

Route::get('/login{erro?}', [LoginController::class, 'index'])->name('site.login');
Route::post('/login', [LoginController::class, 'autenticar'])->name('site.login');


// Route::prefix('/app')->group(function(){
//     Route::middleware('autenticacao')->get('/clientes', function(){return 'Clientes';})->name('app.clientes');
//     Route::middleware('autenticacao')->get('/fornecedores', [FornecedorController::class, 'index'])->name('app.fornecedores');
//     Route::middleware('autenticacao')->get('/produtos', function(){return 'Produtos';})->name('app.produtos');
// });

// Aplicando a middleware a um grupo de rotas
Route::middleware('autenticacao:padrao,visitante')->prefix('/app')->group(function(){
    Route::get('/home', [HomeController::class, 'index'])->name('app.home');
    Route::get('/sair', [LoginController::class, 'sair'])->name('app.sair');
    Route::get('/cliente', [ClienteController::class, 'index'])->name('app.cliente');

    Route::get('/fornecedor', [FornecedorController::class, 'index'])->name('app.fornecedor');
    Route::post('/fornecedor/listar', [FornecedorController::class, 'listar'])->name('app.fornecedor.listar');
    Route::get('/fornecedor/listar', [FornecedorController::class, 'listar'])->name('app.fornecedor.listar');
    Route::get('/fornecedor/adicionar', [FornecedorController::class, 'adicionar'])->name('app.fornecedor.adicionar');
    Route::post('/fornecedor/adicionar', [FornecedorController::class, 'adicionar'])->name('app.fornecedor.adicionar');
    Route::get('/fornecedor/editar/{id}/{msg?}', [FornecedorController::class, 'editar'])->name('app.fornecedor.editar');
    Route::get('/fornecedor/excluir/{id}', [FornecedorController::class, 'excluir'])->name('app.fornecedor.excluir');
    
    // Produtos
    // Essa não será mais necessária pois o controlador agora é do tipo resource
    // Route::get('/produto', [ProdutoController::class, 'index'])->name('app.produto');
    Route::resource('produto', ProdutoController::class);
    
    // Produtos Detelhas
    Route::resource('produto-detalhe', ProdutoDetalheController::class);

});

Route::get('/teste/{p1}/{p2}', [TesteController::class, 'teste'])->name('teste');

Route::fallback(function(){
    echo 'A rota acessada não existe. <a href='.route('site.index').'>Clique aqui</a> para ir para a página inicial';
});



// Route::get('/rota1', function(){return 'Rota1';})->name('site.rota1');
// Route::get('/rota2', function(){
//     return redirect()->route('site.rota1');
// })->name('site.rota2');
// Route::redirect('rota2','rota1');





// Route::get('/contato/{nome}/{categoria_id}', 
//     function(
//         string $nome, 
//         string $categoria_id
//         ){
//     echo "Teste Rotas com parametros: $nome - $categoria_id";
// })->where('categoria_id','[0-9]+')->where('nome','[A-Za-z]+');
