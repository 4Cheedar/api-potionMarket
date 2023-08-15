<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Inventario extends Model
{
    protected $table = 'inventario';
    protected $fillable = ['id', 'idpocao', 'quantidade'];
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
            'idpocao'       => 'required|integer',
            'quantidade'    => 'required|integer',
        ];

        $validator = Validator::make($dados, $regrasValidacao, $messages = [
                                    'required' => 'O campo :attribute é obrigatório',
                                    'integer'  => 'O campo :attribute só aceita números inteiros'
        ]);

        if($validator->fails()) return $validator->errors();
        return [];
    }
}
