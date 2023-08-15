<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class UsuarioAPI extends Model
{
    protected $table = 'usuario_api';

    /**
     * Realiza a validacao de dados para insercoes e atualizacoes de usuario da api
     * @param array $dados com os inputs da requisicao
     * @return mixed com mensagens de erro ou vazio se nenhuma regra for violada
     */
    public static function validacao($dados)
    {
        //validar campos obrigatorios
        $regrasValidacao = [
            'email'   => 'required|email:rfc,dns',
            'senha'   => 'required', 
        ];

        $validator = Validator::make($dados, $regrasValidacao, $messages = [
                                    'required' => 'O campo :attribute é obrigatório',
                                    'email'    => 'O e-mail informado não é válido'
        ]);

        if($validator->fails()) return $validator->errors();
        return [];
    }
}
