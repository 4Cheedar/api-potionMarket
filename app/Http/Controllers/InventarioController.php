<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventario;
use Illuminate\Support\Facades\Validator;

class InventarioController extends Controller
{
/*     public function __construct()
    {
        $this->middleware('apicheck');
    } */
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inv = Inventario::all();
        return response()->json($inv, 200);
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
       
        $mensagensValidacao = Inventario::validacao($request->all());

        if(!empty($mensagensValidacao)){
            return response()->json(['error' => $mensagensValidacao->first()], 400);
        }        
        
        $inv = Inventario::create($request->all());

        if($inv) return response()->json($inv, 201);
        
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
        $inv = Inventario::find($id);
        if($inv == null)
            return response()->json(['error' => 'Nao encontrado'], 404);
        return response()->json($inv, 200);
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
    
        $inv = Inventario::find($id);
        if(!$inv) return response()->json(['erro' => 'inventario nao encontrado'], 404);

        $dados = $request->json()->all(); //pega os dados no formato de array

        if($request->json()->has('idpocao')) $inv->idpocao = $dados['idpocao'];
        if($request->json()->has('quantidade')) $inv->quantidade = $dados['quantidade'];
        if($inv->save()) return response()->json($inv, 200);
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
        $inv = Inventario::find($id);
        if(!$inv) return response()->json('inventario nao encontrado',404);
        if($inv->delete()) return response()->json('inventario removido com sucesso', 200);
        return response()->json('problemas no banco de dados, volte semana que vem ou não', 500);
    }
}
