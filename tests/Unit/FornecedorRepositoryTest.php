<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Fornecedor;
use App\Repositories\Fornecedores\FornecedorRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class FornecedorRepositoryTest extends TestCase
{
    /** @test */
    public function test_generate()
    {
        // Dados simulados
        $data = [
         "nome"=> "Junior P",
         "tipo_documento"=> "CPF",
         "contato"=> "41 991169014",
         "documento"=> "064.780.749-72",
         "endereco"=> "Rua Leonardo Javorski 15"
        ];

        $repository = new FornecedorRepository();
        $fornecedor = $repository->generate($data);
        $this->assertInstanceOf(Fornecedor::class, $fornecedor);
        $this->assertEquals($data['nome'], $fornecedor->nome);
        $this->assertEquals($data['documento'], $fornecedor->documento);
        $this->assertEquals($data['tipo_documento'], $fornecedor->tipo_documento);
        $this->assertEquals($data['contato'], $fornecedor->contato);
        $this->assertEquals($data['endereco'], $fornecedor->endereco);
        echo "Fornecedor: '" . $fornecedor->nome . "' criado com sucesso!\n";

    }

    /** @test */
    public function test_get_all()
    {
        $params = [
            'nome' => 'Fornecedor',
            'orderBy' => 'nome',
            'sort' => 'asc',
            'perPage' => 2,
        ];

        $repository = new FornecedorRepository();
        $result = $repository->getAll(params: $params);
        $this->assertInstanceOf(LengthAwarePaginator::class, $result);
        $this->assertNotEmpty($result->items());
        $this->assertEquals('Fornecedor', $result->items()[0]->nome);
    }


    /** @test */
    public function test_modify()
    {
        $fornecedor = Fornecedor::find(3);
        // Verifica se o fornecedor existe
        $this->assertNotNull($fornecedor, 'Fornecedor com ID 3 não encontrado.');
        $data = [
            'nome' => 'Marcio',
            'documento' => '987.654.321-10',
            'tipo_documento' => 'CNPJ',
            'contato' => '41-9999-9999',
            'endereco' => 'Rua Atualizada 200',
        ];
        $repository = new FornecedorRepository();
        $updatedFornecedor = $repository->modify($fornecedor, $data);
        // Verifica se o fornecedor foi atualizado corretamente
        $this->assertInstanceOf(Fornecedor::class, $updatedFornecedor);
        $this->assertEquals($data['nome'], $updatedFornecedor->nome);
        $this->assertEquals($data['documento'], $updatedFornecedor->documento);
        $this->assertEquals($data['tipo_documento'], $updatedFornecedor->tipo_documento);
        $this->assertEquals($data['contato'], $updatedFornecedor->contato);
        $this->assertEquals($data['endereco'], $updatedFornecedor->endereco);
        echo "Fornecedor: '" . $updatedFornecedor->nome . "' atualizado com sucesso!\n";

    }

    /** @test */
    public function test_remove()
    {
        //alterar id a cada teste
        $fornecedor = Fornecedor::find(20);
        $this->assertNotNull($fornecedor, 'Fornecedor com ID '.$fornecedor->id.' não encontrado.');
        $repository = new FornecedorRepository();
        $removedFornecedor = $repository->remove($fornecedor);
        $this->assertInstanceOf(Fornecedor::class, $removedFornecedor);
        $this->assertEquals($fornecedor->id, $removedFornecedor->id);
        $this->assertDatabaseMissing('fornecedores', [
            'id' => $fornecedor->id,
        ]);
        echo "Fornecedor removido: '". $removedFornecedor->nome ."'\n";
    }
}
