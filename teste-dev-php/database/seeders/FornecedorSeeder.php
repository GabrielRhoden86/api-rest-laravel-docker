<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Fornecedor;

class FornecedorSeeder extends Seeder
{
    public function run()
    {
        Fornecedor::factory()->create([
            'nome' => 'Fornecedor Teste',
            'documento' => '12345678901',
            'tipo_documento' => 'CPF',
            'contato' => '123456789',
            'endereco' => 'Rua Teste, 123',
        ]);

        Fornecedor::factory()->count(50)->create();
    }
}
