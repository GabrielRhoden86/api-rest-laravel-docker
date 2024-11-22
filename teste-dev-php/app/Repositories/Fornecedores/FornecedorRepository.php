<?php

namespace App\Repositories\Fornecedores;
use App\Models\Fornecedor;
use App\Repositories\Interfaces\FornecedoresRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;

class FornecedorRepository implements FornecedoresRepositoryInterface
{
    public function create(array $data): Fornecedor
    {
        $fornecedor = new Fornecedor();
        $fornecedor->save();
        return $fornecedor;
    }

    public function update(Fornecedor $fornecedor, array $data): Fornecedor
    {
        $fornecedor->save();
        return $fornecedor;
    }

    public function delete(Fornecedor $fornecedor): bool
    {
        $fornecedor->delete();
        return true;
    }

    public function find($id): Fornecedor|null
    {
        return Fornecedor::find($id);
    }

    public function findByCnpjCpf($id): Fornecedor|null
    {
        return Fornecedor::find(id: $id);
    }

}
