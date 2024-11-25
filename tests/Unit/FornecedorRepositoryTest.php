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
            'nome' => 'Fornecedor',
            'documento' => '123.456.789-20',
            'tipo_documento' => 'CPF',
            'contato' => '41-9916-9014',
            'endereco' => 'Rua Leonardo Javorski 105',
        ];
        $repository = new FornecedorRepository();
        $fornecedor = $repository->generate($data);

        $this->assertInstanceOf(Fornecedor::class, $fornecedor);
        $this->assertEquals($data['nome'], $fornecedor->nome);
        $this->assertEquals($data['documento'], $fornecedor->documento);
        $this->assertEquals($data['tipo_documento'], $fornecedor->tipo_documento);
        $this->assertEquals($data['contato'], $fornecedor->contato);
        $this->assertEquals($data['endereco'], $fornecedor->endereco);

        // Verifica se o fornecedor foi salvo no banco de dados
        $this->assertDatabaseHas('fornecedores', [
            'nome' => 'Fornecedor',
            'documento' => '123.456.789-20',
            'tipo_documento' => 'CPF',
            'contato' => '41-9916-9014',
            'endereco' => 'Rua Leonardo Javorski 105',
        ]);
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
        $result = $repository->getAll($params);
        $this->assertInstanceOf(LengthAwarePaginator::class, $result);
        $this->assertNotEmpty($result->items());
        $this->assertEquals('Fornecedor', $result->items()[0]->nome);
    }


    /** @test */
    public function test_modify()
    {
        // Supondo que já exista um fornecedor com ID 3 no banco de dados
        $fornecedor = Fornecedor::find(3);
        // Verifica se o fornecedor existe
        $this->assertNotNull($fornecedor, 'Fornecedor com ID 3 não encontrado.');

        $data = [
            'nome' => 'Fornecedor Atualizado',
            'documento' => '987.654.321-00',
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

        // Verifica se o fornecedor foi salvo no banco de dados
        $this->assertDatabaseHas('fornecedores', [
            'nome' => 'Fornecedor Atualizado',
            'documento' => '987.654.321-00',
            'tipo_documento' => 'CNPJ',
            'contato' => '41-9999-9999',
            'endereco' => 'Rua Atualizada 200',
        ]);
    }

    /** @test */
    public function test_remove()
    {
        // Supondo que já exista um fornecedor com ID 4 no banco de dados
        $fornecedor = Fornecedor::find(25);
        $this->assertNotNull($fornecedor, 'Fornecedor com ID 3 não encontrado.');
        $repository = new FornecedorRepository();
        $removedFornecedor = $repository->remove($fornecedor);

        // Verifica se o fornecedor foi removido corretamente
        $this->assertInstanceOf(Fornecedor::class, $removedFornecedor);
        $this->assertEquals($fornecedor->id, $removedFornecedor->id);
        // Verifica se o fornecedor não existe mais no banco de dados
        $this->assertDatabaseMissing('fornecedores', [
            'id' => $fornecedor->id,
        ]);
    }
}
