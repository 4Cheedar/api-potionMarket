<?php

namespace App\Http\Middleware;

use App\Models\UsuarioAPI;
use Closure;

class APIUserControl
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //se nao vier o token no cabecalho
        if($request->header('authorization') == null){
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        // Basic $2y$10$eaSew/Z2tDi4orR3J8UHyOJNG4J7AJFALapCf9thhtdE/0ryAuTpO
        $dadosToken = explode(' ', $request->header('authorization'));
        $token = $dadosToken[1];
        //verificar se o token eh valido
        $usuario = UsuarioAPI::where('token', $token)->first();
        if($usuario == null){
            return response()->json(['message' => 'Token invalido'], 401);
        }
        
        return $next($request);
    }
}
