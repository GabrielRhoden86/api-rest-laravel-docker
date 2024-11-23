<?php
namespace App\Repositories\Fornecedores;
use App\Models\Fornecedor;
use App\Repositories\Interfaces\FornecedoresRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class FornecedorRepository implements FornecedoresRepositoryInterface
{
    public function create(array $data): String
    {
        $fornecedor = new Fornecedor();
        $fornecedor->nome = $data['nome'];
        $fornecedor->documento = $data['documento'];
        $fornecedor->tipo_documento = $data['tipo_documento'];
        $fornecedor->contato = $data['contato'];
        //Campo endereco obrigatório pode ser retornar null
        $fornecedor->endereco = $data['endereco'] ?? null;
        $fornecedor->save();
        return $fornecedor->nome;
    }

    public function update(Fornecedor $fornecedor, array $data): Fornecedor
    {
        $fornecedor = new Fornecedor();
        $fornecedor->nome = $data['nome'];
        $fornecedor->documento = $data['documento'];
        $fornecedor->tipo_documento = $data['tipo_documento'];
        $fornecedor->contato = $data['contato'];
        //Campo endereco obrigatório pode ser retornar null
        $fornecedor->endereco = $data['endereco'];
        $fornecedor->save();
        return  $fornecedor->nome ;
    }

    public function delete(Fornecedor $fornecedor): bool
    {
        $fornecedor->delete();
        return true;
    }

    public function getAll(array $params = []): LengthAwarePaginator
    {
        // Filtros da classe LengthAwarePaginator(Laravel)
        $orderBy = $params['orderBy'] ?? 'id';
        $sort = $params['sort'] ?? 'asc';
        $perPage = $params['perPage'] ?? 10;

        // Filtros que podem ser aplicados
        $filters = [
            'nome' => $params['nome'] ?? null,
            'tipo_documento' => $params['tipo_documento'] ?? null,
            'documento' => $params['documento'] ?? null,
            'endereco' => $params['endereco'] ?? null,
        ];
        $query = Fornecedor::query();

        // Aplicar filtros dinamicamente caso o parâmetro esteja presente no endpoint
        foreach ($filters as $field => $value) {
            if ($value) {
                if (in_array($field, ['nome', 'documento', 'endereco'])) {
                    $query->where($field, 'like', '%' . $value . '%');
                } else {
                    $query->where($field, $value);
                }
            }
        }
        return $query->orderBy($orderBy, $sort)->paginate($perPage);
    }

    public function findByCnpjCpf($cnpjCpf): ?Fornecedor
    {
        return Fornecedor::where('documento', $cnpjCpf)->first();
    }

}
