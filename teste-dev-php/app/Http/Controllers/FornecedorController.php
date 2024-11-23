<?php
namespace App\Http\Controllers;

use App\Repositories\Interfaces\FornecedoresRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class FornecedorController extends Controller
{
    protected $fornecedorRepository;

    public function __construct(FornecedoresRepositoryInterface $fornecedorRepository)
    {
        $this->fornecedorRepository = $fornecedorRepository;
    }

    public function index(Request $request): JsonResponse
    {
        $params = $request->only(['orderBy', 'sort', 'perPage','nome','tipo_documento','documento','endereco']);
        $fornecedores = $this->fornecedorRepository->all($params);
        return response()->json($fornecedores);
    }
}
