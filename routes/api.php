<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\BuscaCnpjController;


Route::post('/fornecedores', [FornecedorController::class, 'create']);
Route::get('/fornecedores', [FornecedorController::class, 'read']);
Route::patch('/fornecedores/{id}', [FornecedorController::class, 'update']);
Route::delete('/fornecedores/{id}', [FornecedorController::class, 'destroy']);

Route::get('/consulta/{cnpj}', [BuscaCnpjController::class, 'buscaCnpj']);
