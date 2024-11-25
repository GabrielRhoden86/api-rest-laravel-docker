<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Fornecedor;

class FornecedorControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test *//** @test */
public function it_can_create_a_fornecedor()
{
    $data = [
        'nome' => 'Fornecedor Teste',
        'documento' => '123.456.789-01', // Formato CPF
        'tipo_documento' => 'CPF',
        'contato' => 'test@example.com',
        'endereco' => 'Endereço Teste'
    ];

    $response = $this->postJson('/api/fornecedores', $data);

    $response->assertStatus(201)
             ->assertJson(['message' => "Fornecedor 'Fornecedor Teste' registrado com sucesso!"]);

    $this->assertDatabaseHas('fornecedores', ['nome' => 'Fornecedor Teste']);
}


    /** @test *//** @test */
/** @test */
/** @test */
public function it_can_read_fornecedores()
{
    Fornecedor::factory()->count(3)->create();
    $response = $this->getJson('/api/fornecedores');
    $response->assertStatus(200)
             ->assertJsonStructure([
                 'data' => [
                     '*' => ['id', 'nome', 'documento', 'tipo_documento', 'contato', 'endereco', 'created_at', 'updated_at']
                 ],
                 'links',
                 'meta'
             ]);
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
        $response = $this->patchJson("/api/fornecedores/{$fornecedor->id}", $data);
        $response->assertStatus(200)
                 ->assertJson(['message' => "Dados do fornecedor 'Fornecedor Atualizado' atualizados com sucesso!"]);
        $this->assertDatabaseHas('fornecedores', ['nome' => 'Fornecedor Atualizado']);
    }

    /** @test */
    public function it_can_delete_a_fornecedor()
    {
        $fornecedor = Fornecedor::factory()->create();

        $response = $this->deleteJson("/api/fornecedores/{$fornecedor->id}");

        $response->assertStatus(200)
                 ->assertJson(['message' => "Registro do fornecedor '{$fornecedor->nome}' excluído com sucesso!"]);

        $this->assertDatabaseMissing('fornecedores', ['id' => $fornecedor->id]);
    }
}
