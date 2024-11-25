<?php
namespace App\Repositories\BuscaDados;

use App\Repositories\Interfaces\BuscaCnpjRepositoryInterface;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
class BuscaCnpjRepository implements BuscaCnpjRepositoryInterface
{
    public function buscaCnpj($cnpj)
    {
        try {
            $response = Http::get("https://brasilapi.com.br/api/cnpj/v1/{$cnpj}");
            if ($response->successful()) {
                return $response->json();
            }
        } catch (\RuntimeException $e) {
            Log::error('Erro ao listar dados da empresa: ' . $e->getMessage());
            throw new \RuntimeException('Erro ao listar dados da empresa');
        }
    }
}
