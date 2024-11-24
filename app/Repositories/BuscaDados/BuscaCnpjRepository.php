<?php
namespace App\Repositories\Fornecedores;

use App\Models\Fornecedor;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Repositories\Interfaces\BuscaCnpjRepositoryInterface;
use Illuminate\Support\Facades\Http;

class BuscaCnpjRepository implements BuscaCnpjRepositoryInterface
{
    public function read($cnpj)
    {
        try {
            $response = Http::get("https://brasilapi.com.br/api/cnpj/v1/{$cnpj}");
            return $response;

        } catch (\RuntimeException $e) {
            Log::error('Erro ao listar dados da empresa: ' . $e->getMessage());
            throw new \RuntimeException('Erro ao listar da empresa');
        }
    }
}
