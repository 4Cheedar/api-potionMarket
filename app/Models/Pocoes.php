<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Pocoes extends Model
{
    protected $table = 'pocoes';
    protected $fillable = ['id', 'nome', 'efeito', 'preco', 'precoRevenda'];
    public $timestamps = false;

    /**
     * Realiza a validacao de dados para insercoes e atualizacoes de jogador
     * @param array $dados com os inputs da requisicao
     * @return mixed com mensagens de erro ou vazio se nenhuma regra for violada
     */
    public static function validacao($dados)
    {
        //validar campos obrigatorios
        $regrasValidacao = [
            'nome'          => 'required',
            'efeito'        => 'required',
            'preco'         => 'required|integer',
            'precoRevenda'  => 'required|integer' 
        ];

        $validator = Validator::make($dados, $regrasValidacao, $messages = [
                                    'required' => 'O campo :attribute é obrigatório',
                                    'integer'  => 'O campo :attribute só aceita números inteiros'
        ]);

        if($validator->fails()) return $validator->errors();
        return [];
    }
}
