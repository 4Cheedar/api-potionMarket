<?php

namespace App\Http\Controllers;

use App\Models\UsuarioAPI;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioAPIController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //verificar se esta vindo dados em JSON
        if( ! $request->isJson() ) return response()->json('somente formato JSON é valido', 415);
        
        $dados = $request->all();
        $mensagensValidacao = UsuarioAPI::validacao($dados);

        if(!empty($mensagensValidacao)){
            return response()->json(['error' => $mensagensValidacao->first()], 400);
        } 

        $usuario = new UsuarioAPI();
        $usuario->email = $dados['email'];
        $usuario->senha = $dados['senha'];
        $usuario->token = Hash::make($dados['email'] . $dados['senha']);
        if($usuario->save()) return response()->json(['token' => $usuario->token], 201);
        return response()->json(['error' => 'comportamento inesperado, volte amanha'], 500);

    }
}
