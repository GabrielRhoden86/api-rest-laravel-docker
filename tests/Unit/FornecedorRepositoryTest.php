<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Repositories\Fornecedores\FornecedorRepository;
use App\Models\Fornecedor;

class FornecedorRepositoryTest extends TestCase
{
    use RefreshDatabase;

    protected $fornecedorRepository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->fornecedorRepository = new FornecedorRepository();
    }

    /** @test */
    public function it_can_create_a_fornecedor()
    {
        $data = [
            'nome' => 'Fornecedor Teste',
            'documento' => '12345678901',
            'tipo_documento' => 'CPF',
            'contato' => 'test@example.com',
            'endereco' => 'Endereço Teste'
        ];

        $fornecedor = $this->fornecedorRepository->create($data);

        $this->assertInstanceOf(Fornecedor::class, $fornecedor);
        $this->assertDatabaseHas('fornecedores', ['nome' => 'Fornecedor Teste']);
    }

    /** @test */
    public function it_can_update_a_fornecedor()
    {
        $fornecedor = Fornecedor::factory()->create();

        $data = [
            'nome' => 'Fornecedor Atualizado',
            'documento' => $fornecedor->documento,
            'tipo_documento' => $fornecedor->tipo_documento,
            'contato' => 'updated@example.com',
            'endereco' => 'Endereço Atualizado'
        ];

        $updatedFornecedor = $this->fornecedorRepository->update($fornecedor, $data);

        $this->assertInstanceOf(Fornecedor::class, $updatedFornecedor);
        $this->assertDatabaseHas('fornecedores', ['nome' => 'Fornecedor Atualizado']);
    }

    /** @test */
    public function it_can_delete_a_fornecedor()
    {
        $fornecedor = Fornecedor::factory()->create();

        $deletedFornecedor = $this->fornecedorRepository->destroy($fornecedor);

        $this->assertInstanceOf(Fornecedor::class, $deletedFornecedor);
        $this->assertDatabaseMissing('fornecedores', ['id' => $fornecedor->id]);
    }

    /** @test */
    public function it_can_read_fornecedores()
    {
        Fornecedor::factory()->count(3)->create();

        $params = ['orderBy' => 'id', 'sort' => 'asc', 'perPage' => 2];
        $fornecedores = $this->fornecedorRepository->read($params);

        $this->assertInstanceOf(\Illuminate\Contracts\Pagination\LengthAwarePaginator::class, $fornecedores);
        $this->assertEquals(2, $fornecedores->perPage());
    }
}
