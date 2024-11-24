<?php

namespace App\Repositories\Fornecedores;

use App\Models\Fornecedor;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Repositories\Interfaces\FornecedoresRepositoryInterface;

class FornecedorRepository implements FornecedoresRepositoryInterface
{
    public function create(array $data): Fornecedor
    {
        try {
            $fornecedor = Fornecedor::create([
                'nome' => $data['nome'],
                'documento' => $data['documento'],
                'tipo_documento' => $data['tipo_documento'],
                'contato' => $data['contato'],
                'endereco' => $data['endereco'] ?? null, // Endereço opcional
            ]);
            return $fornecedor;
        } catch (\RuntimeException $e) {
            Log::error('Erro ao criar um novo fornecedor', [
                'mensagem' => $e->getMessage(),
                'dados' => $data
            ]);
            throw new \RuntimeException('Erro ao criar um novo fornecedor. Tente novamente mais tarde.');
        }
    }

    public function getAll(array $params = []): LengthAwarePaginator
    {
        try {
            // Filtros da classe LengthAwarePaginator(Laravel)
            $orderBy = $params['orderBy'] ?? 'id';
            $sort = $params['sort'] ?? 'asc';
            $perPage = $params['perPage'] ?? 5;
            // Filtros que podem ser aplicados no endpoint
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
        } catch (\RuntimeException $e) {
            Log::error('Erro ao listar fornecedores: ' . $e->getMessage());
            throw new \RuntimeException('Erro ao atualizar fornecedor');
        }
    }

    public function update(Fornecedor $fornecedor, array $data): Fornecedor
    {
        try {
            $fornecedor->update($data);
            return $fornecedor;
         } catch (\RuntimeException $e) {
            Log::error('Erro ao atualizar fornecedor: ' . $e->getMessage(), [
                'fornecedor_id' => $fornecedor->id ?? null,
                'dados_fornecidos' => $data
            ]);
            throw new \RuntimeException('Erro ao atualizar fornecedor.');
        }
    }

    public function destroy(Fornecedor $fornecedor): Fornecedor
    {
        try {
            $fornecedor->delete();
            return $fornecedor;
        } catch (\RuntimeException $e) {
            Log::error('Erro ao excluir fornecedor: ' . $e->getMessage(), ['fornecedor' => $fornecedor->nome]);
            throw new \RuntimeException('Erro ao excluir fornecedor.');
        }
    }
}
