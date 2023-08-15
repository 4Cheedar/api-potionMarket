<?php

use Laravel\Lumen\Testing\DatabaseTransactions;

class InventarioTest extends TestCase
{

    use DatabaseTransactions;

    private $estruturaDocumento;

    protected function setUp() : void
    {
        parent::setUp();
        $this->estruturaDocumento = [
            'id',
            'idpocao',
            'quantidade'
        ];
       
    }

    public function testDeveRetornarTodosOsInventarios()
    {
        $this->withoutMiddleware();
        $this->get('inventario',[]);
        $this->seeStatusCode(200);
        $this->seeJsonStructure([
            [
                'id',
                'idpocao',
                'quantidade'
            ]
        ]);

    }

    public function testDeveRetornarUmInventario()
    {
        $this->withoutMiddleware();
        $this->get('inventario/1',[]);
        $this->seeStatusCode(200);
        $this->seeJsonStructure([
            'id',
            'idpocao',
            'quantidade'
        ]);
    }

    public function testDeveRetornarNaoEncontradoIDInexistente()
    {
        $this->withoutMiddleware();
        $this->get('inventario/0',[]);
        $this->seeStatusCode(404);
        $this->seeJsonStructure([
            'error'
        ]);
    }

    public function testDeveRetornarQuandoCriarUmInventario()
    {
        $dados = [
            'idpocao' => 3,
            'quantidade' => 2,
        ];

        $this->withoutMiddleware();
        $this->json('POST', '/inventario', $dados, [])
                    ->seeJson($dados)
                    ->seeStatusCode(201);
    }

    public function testDeveRetornarErroCampoObrigatorio()
    {
        $dados = [
            'idpocao' => 2
        ];
        $this->withoutMiddleware();
        $this->json('POST', '/inventario', $dados, [])
                    ->seeStatusCode(400)
                    ->seeJsonStructure(['error']);
    }

    public function testDeveRetornarAtualizarInventario()
    {
        $dados = [
            'quantidade' => 3,
        ];
        $this->withoutMiddleware();
        $this->json('PUT', '/inventario/2', $dados, [])
                    ->seeStatusCode(200)
                    ->seeJson($dados);
    }

    public function testDeveRetornarQuandoExcluirInventario()
    {
        $this->withoutMiddleware();
        $this->json('DELETE', '/inventario/3', [], [])
                    ->seeStatusCode(200)
                    ->seeJson(["inventario removido com sucesso"]);
    }

    public function testDeveRetornarExcluirUmaPocaoInexistente()
    {
        $this->withoutMiddleware();
        $this->json('DELETE', '/inventario/0', [], [])
                    ->seeStatusCode(404)
                    ->seeJson(["inventario nao encontrado"]);
    }
    
}