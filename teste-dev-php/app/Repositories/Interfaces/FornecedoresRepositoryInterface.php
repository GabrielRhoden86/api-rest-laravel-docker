<?php

namespace App\Repositories\Interfaces;
use App\Models\Fornecedor;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface FornecedoresRepositoryInterface
{
    public function create(array $data): Fornecedor;
    public function update(Fornecedor $fornecedor, array $data): Fornecedor;
    public function destroy(Fornecedor $fornecedor): Fornecedor;
    public function getAll(array $params = []): LengthAwarePaginator;
}
