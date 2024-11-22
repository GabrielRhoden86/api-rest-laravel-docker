<?php
namespace Database\Factories;

use App\Models\Fornecedor;
use Illuminate\Database\Eloquent\Factories\Factory;

class FornecedorFactory extends Factory
{
    protected $model = Fornecedor::class;

    public function definition()
    {
        return [
            'nome' => $this->faker->name,
            'documento' => $this->faker->unique()->numerify('###########'), // CPF ou CNPJ fictício
            'tipo_documento' => $this->faker->randomElement(['CNPJ', 'CPF']),
            'contato' => $this->faker->phoneNumber,
            'endereco' => $this->faker->address,
        ];
    }
}
