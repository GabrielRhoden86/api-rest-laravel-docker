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

    public function create(FornecedorRequestCreate $request): JsonResponse
    {
        $validatedData = $request->validated();
        $result = $this->fornecedorRepository->generate($validatedData);
        return response()->json([
            "message" => "Fornecedor '{$result->nome}' registrado com sucesso!",
        ], 201);
    }

        public function read(FornecedorRequest $request): JsonResponse {
        $params = $request->validated();
        $fornecedores = $this->fornecedorRepository->getAll($params);
        if ($fornecedores->isEmpty()) {
            return response()->json([ "message" => "Nenhum fornecedor encontrado.", ], 200);
         }
            return response()->json($fornecedores, 200);
    }

    public function update(FornecedorRequestUpdate $request, $id): JsonResponse
    {
        $fornecedor = Fornecedor::findOrFail($id);
        $validatedData = $request->validated();
        $updatedFornecedor = $this->fornecedorRepository->modify($fornecedor, $validatedData);
        return response()->json([
            "message" => "Dados do fornecedor '{$updatedFornecedor->nome}' atualizados com sucesso!"
        ], 200);
    }
    public function deleteItem($id): JsonResponse
    {
            $fornecedor = Fornecedor::findOrFail($id);
            $this->fornecedorRepository->remove($fornecedor);
            return response()->json([
                "message" => "Fornecedor excluído com sucesso."
            ], 200);

    }
}
