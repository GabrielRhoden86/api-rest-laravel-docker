<?php

namespace App\Repositories\Interfaces;
use App\Models\Fornecedor;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface FornecedoresRepositoryInterface
{
    public function generate(array $data): Fornecedor;
    public function getAll(array $params = []): LengthAwarePaginator;
    public function modify(Fornecedor $fornecedor, array $data): Fornecedor;
    public function remove(Fornecedor $fornecedor): Fornecedor;

}
