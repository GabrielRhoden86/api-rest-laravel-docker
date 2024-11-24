<?php
namespace Database\Factories;

use App\Models\Fornecedor;
use Illuminate\Database\Eloquent\Factories\Factory;

class FornecedorFactory extends Factory
{
    protected $model = Fornecedor::class;

    public function definition()
    {
        // Definição padrão pode ser neutra ou um dos dois casos, por exemplo, CPF:
        return $this->cpfDefinition();
    }

    // Método para gerar CPF
    public function cpf()
    {
        return $this->state(function (array $attributes) {
            return [
                'documento' => $this->faker->numerify('###.###.###-##'), // Gerar CPF
                'tipo_documento' => 'CPF', // Definir tipo como CPF
            ];
        });
    }

    // Método para gerar CNPJ
    public function cnpj()
    {
        return $this->state(function (array $attributes) {
            return [
                'documento' => $this->faker->numerify('##.###.###/0001-##'), // Gerar CNPJ
                'tipo_documento' => 'CNPJ', // Definir tipo como CNPJ
            ];
        });
    }

    protected function cpfDefinition()
    {
        return [
            'nome' => $this->faker->name,
            'documento' => $this->faker->numerify('###.###.###-##'),
            'tipo_documento' => 'CPF',
            'contato' => $this->faker->phoneNumber,
            'endereco' => $this->faker->address,
        ];
    }

    protected function cnpjDefinition()
    {
        return [
            'nome' => $this->faker->name,
            'documento' => $this->faker->numerify('##.###.###/0001-##'),
            'tipo_documento' => 'CNPJ',
            'contato' => $this->faker->phoneNumber,
            'endereco' => $this->faker->address,
        ];
    }
}
