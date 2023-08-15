<?php

use Laravel\Lumen\Testing\DatabaseTransactions;

class PocaoTest extends TestCase
{

    use DatabaseTransactions;

    private $estruturaDocumento;

    protected function setUp() : void
    {
        parent::setUp();
        $this->estruturaDocumento = [
            'id',
            'nome',
            'efeito',
            'preco',
            'precoRevenda'
        ];
       
    }

    public function testDeveRetornarErroRotaInexistente()
    {
        $this->get('qualquer-coisa',[]);
        $this->seeStatusCode(404);
    }

    public function testDeveRetornarTodasAsPocoes()
    {
        $this->withoutMiddleware();
        $this->get('pocoes',[]);
        $this->seeStatusCode(200);
        $this->seeJsonStructure([
            [
                'id',
                'nome',
                'efeito',
                'preco',
                'precoRevenda'
            ]
        ]);

    }

    public function testDeveRetornarUmaPocao()
    {
        $this->withoutMiddleware();
        $this->get('pocoes/1',[]);
        $this->seeStatusCode(200);
        $this->seeJsonStructure([
            'id',
            'nome',
            'efeito',
            'preco',
            'precoRevenda'
        ]);
    }

    public function testDeveRetornarNaoEncontradoIDInexistente()
    {
        $this->withoutMiddleware();
        $this->get('pocoes/0',[]);
        $this->seeStatusCode(404);
        $this->seeJsonStructure([
            'error'
        ]);
    }

    public function testDeveRetornarQuandoCriarUmaPocao()
    {
        $dados = [
            'nome' => 'Respiracao Aquatica',
            'efeito' => "Permite quer o beber respirar em baixo da agua",
            'preco' => 210,
            'precoRevenda' => 320
        ];

        $this->withoutMiddleware();
        $this->json('POST', '/pocoes', $dados, [])
                    ->seeJson($dados)
                    ->seeStatusCode(201);
    }

    public function testDeveRetornarErroCampoObrigatorio()
    {
        $dados = [
            'nome' => 'Respiracao Aquatica'
        ];
        $this->withoutMiddleware();
        $this->json('POST', '/pocoes', $dados, [])
                    ->seeStatusCode(400)
                    ->seeJsonStructure(['error']);
    }

    public function testDeveRetornarAtualizarPocao()
    {
        $dados = [
            'nome' => 'Respiracao Aquatica 2',
            'preco' => 310,
            'precoRevenda' => 380
        ];
        $this->withoutMiddleware();
        $this->json('PUT', '/pocoes/2', $dados, [])
                    ->seeStatusCode(200)
                    ->seeJson($dados);
    }

    public function testDeveRetornarQuandoExcluirPocao()
    {
        $this->withoutMiddleware();
        $this->json('DELETE', '/pocoes/3', [], [])
                    ->seeStatusCode(200)
                    ->seeJson(["pocao removida com sucesso"]);
    }

    public function testDeveRetornarExcluirUmaPocaoInexistente()
    {
        $this->withoutMiddleware();
        $this->json('DELETE', '/pocoes/0', [], [])
                    ->seeStatusCode(404)
                    ->seeJson(["pocao nao encontrada"]);
    }

    
}