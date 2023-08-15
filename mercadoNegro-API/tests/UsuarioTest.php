<?php

use Laravel\Lumen\Testing\DatabaseTransactions;

class UsuarioTest extends TestCase
{

    use DatabaseTransactions;

    private $estruturaDocumento;

    protected function setUp() : void
    {
        parent::setUp();
        $this->estruturaDocumento = [
            'id',
            'email',
            'senha'
        ];
       
    }

    public function testDeveRetornarQuandoCriarUmUsuario()
    {
        $dados = [
            'email' => 'iagu@gmail.com',
            'senha' => '12345',
        ];

        $this->withoutMiddleware();
        $this->json('POST', '/autenticar', $dados, [])
                    ->seeStatusCode(201);
    }

    public function testDeveRetornarErroCampoObrigatorio()
    {
        $dados = [
            'email' => 'iagu@gmail.com.br'
        ];
        $this->withoutMiddleware();
        $this->json('POST', '/autenticar', $dados, [])
                    ->seeStatusCode(400)
                    ->seeJsonStructure(['error']);
    }

}