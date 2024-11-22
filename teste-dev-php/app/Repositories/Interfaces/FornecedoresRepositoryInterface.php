<?php

namespace App\Repositories\Interfaces;
use App\Models\Fornecedor;
interface FornecedoresRepositoryInterface
{
    public function create(array $data): Fornecedor;
    public function update(Fornecedor $fornecedor, array $data): Fornecedor;
    public function delete(Fornecedor $fornecedor): bool;
    public function find($id): ?Fornecedor;  //? null caso o fornecedor com o ID não seja encontrado
    public function findByCnpjCpf($cnpjCpf): ?Fornecedor;
}
