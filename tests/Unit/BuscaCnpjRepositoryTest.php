<?php

namespace Tests\Integration;

use Tests\TestCase;
use App\Repositories\BuscaDados\BuscaCnpjRepository;
use Illuminate\Support\Facades\Http;

class BuscaCnpjRepositoryTest extends TestCase
{
    /** @test *//** @test */
    public function test_buscaCnpj()
    {
        Http::fake([
            'https://brasilapi.com.br/api/cnpj/v1/*' => Http::response([
                'cnpj' => '19131243000197',
                'razao_social' => 'Empresa Teste',
                'nome_fantasia' => 'Teste',
                'data_abertura' => '2000-01-01',
                // Adicione outros campos conforme necessário
            ], 200)
        ]);

        $repository = new BuscaCnpjRepository();
        $cnpj = '19131243000197';
        $response = $repository->buscaCnpj($cnpj);

        // Verifica se a resposta contém os dados esperados
        $this->assertEquals('19131243000197', $response['cnpj']);
        $this->assertEquals('Empresa Teste', $response['razao_social']);
        $this->assertEquals('Teste', $response['nome_fantasia']);
        $this->assertEquals('2000-01-01', $response['data_abertura']);
    }
}
