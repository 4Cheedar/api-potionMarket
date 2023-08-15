<?php

namespace App\Http\Controllers;

use App\Models\Pocoes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PocoesController extends Controller
{
    public function __construct()
    {
        $this->middleware('apicheck');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pocoes = Pocoes::all();
        return response()->json($pocoes, 200);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      if( ! $request->isJson() ) return response()->json('somente formato JSON é valido', 415);
       
      $mensagensValidacao = Pocoes::validacao($request->all());

      if(!empty($mensagensValidacao)){
          return response()->json(['error' => $mensagensValidacao->first()], 400);
      }        
      
      $pocoes = Pocoes::create($request->all());

      if($pocoes) return response()->json($pocoes, 201);
      
      return response()->json('ocorreu algum erro na base de dados, tente novamente mais tarde', 500);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pocao = Pocoes::find($id);
        if($pocao == null)
            return response()->json(['error' => 'Nao encontrado'], 404);
        return response()->json($pocao, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if( ! $request->isJson() ) return response()->json(['erro' => 'somente formato JSON é valido'], 415);
    
        $pocoes = Pocoes::find($id);
        if(!$pocoes) return response()->json(['erro' => 'pocao nao encontrada'], 404);

        $dados = $request->json()->all(); //pega os dados no formato de array

        if($request->json()->has('nome')) $pocoes->nome = $dados['nome'];
        if($request->json()->has('efeito')) $pocoes->efeito = $dados['efeito'];
        if($request->json()->has('preco')) $pocoes->preco = $dados['preco'];
        if($request->json()->has('precoRevenda')) $pocoes->precoRevenda = $dados['precoRevenda'];
        if($pocoes->save()) return response()->json($pocoes, 200);
        return response()->json(['erro' => 'problemas ao atualizar'], 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pocoes = Pocoes::find($id);
        if(!$pocoes) return response()->json('pocao nao encontrada',404);
        if($pocoes->delete()) return response()->json('pocao removida com sucesso', 200);
        return response()->json('problemas no banco de dados, volte semana que vem ou não', 500);
    }
}
