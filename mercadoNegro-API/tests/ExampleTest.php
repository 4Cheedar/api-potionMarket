<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->get('/');

        $this->assertEquals(
            $this->app->version(), $this->response->getContent()
        );
        // $this->withoutMiddleware();
    }

    public function testDeveRetornarErroRotaInexistente()
    {
      $this->get('qualquer-coisa', []);
      $this->seeStatusCode(404);
    }
    
}
