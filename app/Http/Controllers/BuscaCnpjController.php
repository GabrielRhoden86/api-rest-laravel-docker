<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\BuscaCnpjRepositoryInterface;
use Illuminate\Http\Request;

class BuscaCnpjController extends Controller
{
    protected $cnpj;
    public function __construct(BuscaCnpjRepositoryInterface $cnpj)
    {
        $this->cnpj = $cnpj;
    }
    public function buscaCnpj($cnpj)
    {
        $data = $this->cnpj->read($cnpj);
        return response()->json($data, 200);
    }
}
