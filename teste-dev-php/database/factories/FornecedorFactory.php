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
            'documento' => $this->faker->randomElement([
                $this->faker->numerify('##.###.###/0001-##'), //CNPJ
                $this->faker->numerify('###.###.###-##'), // CPF
            ]),

            'tipo_documento' => 'CNPJ',
            'contato' => $this->faker->phoneNumber,
            'endereco' => $this->faker->address,
        ];
    }
}
