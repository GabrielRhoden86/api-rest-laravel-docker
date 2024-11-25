<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\BuscaCnpjController;

//Rate Limiting para evitar ataques DDOs
Route::middleware(['throttle:60,1'])->group(function () {
    Route::post('/fornecedores', [FornecedorController::class, 'create']);
    Route::get('/fornecedores', [FornecedorController::class, 'read']);
    Route::patch('/fornecedores/{id}', [FornecedorController::class, 'update']);
    Route::delete('/fornecedores/{id}', [FornecedorController::class, 'deleteItem']);
    Route::get('/consulta/{cnpj}', [BuscaCnpjController::class, 'buscaCnpj']);
});
