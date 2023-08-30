<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Http\Middleware\LogAcessoMiddleware;

class SobreNosController extends Controller
{
    // Retirado a middleware para que seja feita para todas as rotas no arquivo Kernel
    // public function __construct()
    // {
    //     $this->middleware(LogAcessoMiddleware::class);
    // }
    // Aqui estou passando pelo apelido da middleware. OBS: no caso de apelido, não é necessário um use App\Http\Middleware\LogAcessoMiddleware;
    public function __construct()
    {
        $this->middleware('log.acesso');
    }
    public function sobreNos()
    {
        return view('site.sobre-nos');
    }
}
