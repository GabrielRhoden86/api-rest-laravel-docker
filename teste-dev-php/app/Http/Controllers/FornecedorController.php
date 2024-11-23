<?php
namespace App\Http\Controllers;
use App\Repositories\Interfaces\FornecedoresRepositoryInterface;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\FornecedorRequest;
use App\Http\Requests\FornecedorRequestCreate;
use App\Http\Requests\FornecedorRequestUpdate;
use App\Models\Fornecedor;

class FornecedorController extends Controller
{
    protected $fornecedorRepository;

    public function __construct(FornecedoresRepositoryInterface $fornecedorRepository)
    {
        $this->fornecedorRepository = $fornecedorRepository;
    }

    public function index(FornecedorRequest $request): JsonResponse
    {
           $params = $request->validated();
           $fornecedores = $this->fornecedorRepository->getAll($params);
           return response()->json($fornecedores);
    }
    public function create(FornecedorRequestCreate $request)
    {
        $validatedData = $request->validated();
        $result = $this->fornecedorRepository->create($validatedData);
        return response()->json([
            "message" => "Fornecedor '{$result}' registrado com sucesso!",
        ], 201);
    }
    public function update(FornecedorRequestUpdate $request, $id)
    {
        $fornecedor = Fornecedor::findOrFail($id);
        $validatedData = $request->validated();
        $updatedFornecedor = $this->fornecedorRepository->update($fornecedor, $validatedData);
        return response()->json([
            "message" => "Dados fornecedor '{$updatedFornecedor}' atualizado com sucesso!",
        ], 200);
    }

}
