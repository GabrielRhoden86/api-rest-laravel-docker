<?php

namespace App\Repositories\Interfaces;
use App\Models\Fornecedor;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface FornecedoresRepositoryInterface
{
    public function create(array $data): String;
    public function update(Fornecedor $fornecedor, array $data): Fornecedor;
    public function delete(Fornecedor $fornecedor): bool;
    public function getAll(array $params = []): LengthAwarePaginator;
    public function findByCnpjCpf($cnpjCpf): ?Fornecedor;
}
