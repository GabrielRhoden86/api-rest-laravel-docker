<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\BuscaCnpjRepositoryInterface;
use App\Http\Requests\BuscaCnpjRequest;
class BuscaCnpjController extends Controller
{
    protected $cnpj;
    public function __construct(BuscaCnpjRepositoryInterface $cnpj)
    {
        $this->cnpj = $cnpj;
    }
    public function buscaCnpj(BuscaCnpjRequest $request, $cnpj)
    {    $request->validated();
        $data = $this->cnpj->read($cnpj);
        return response()->json($data, 200);
    }
}
