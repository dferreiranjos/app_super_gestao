<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\LogAcesso;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LogAcessoMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
      
        $ip = $request->server->get('REMOTE_ADDR');
        $rota = $request->getRequestUri();
        LogAcesso::create(['log'=>"IP {$ip} requisitou a rota {$rota}"]);

        // return $next($request);

        $resposta = $next($request);
        $resposta->setStatusCode(201, 'O status e o texto da resposta foram modificados');
        // dd($resposta);
        return $resposta;

        // return Response('Chegamos no middleware e finalizamos no próprio middleware');
    }
}
