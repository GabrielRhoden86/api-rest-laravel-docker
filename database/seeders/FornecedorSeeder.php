<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Fornecedor;
use App\Models\TestFornecedor;

class FornecedorSeeder extends Seeder
{
    public function run()
    {
        Fornecedor::factory()->cpf()->count(25)->create();
        Fornecedor::factory()->cnpj()->count(30)->create();
    }
}
