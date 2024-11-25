<?php

namespace App\Repositories\Interfaces;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface BuscaCnpjRepositoryInterface
{
    public function buscaCnpj($cnpj);
}
