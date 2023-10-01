<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListarVendedoresController;
use App\Http\Controllers\CadastrarVendedorController;
use App\Http\Controllers\DeletarVendedorController;
use App\Http\Controllers\EditarVendedorController;
use App\Http\Controllers\CadastrarVendaController;
use App\Http\Controllers\ListarVendasController;
use App\Http\Controllers\EnviarEmailController;
use App\Http\Controllers\AutenticacaoController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/autenticar', [AutenticacaoController::class, 'autenticar']);

Route::post('/registrar', [AutenticacaoController::class, 'registrar']);

Route::middleware('auth:sanctum')->get('/listarVendedores', [ListarVendedoresController::class, 'listarVendedores']);

Route::middleware('auth:sanctum')->post('/cadastrarVendedor', [CadastrarVendedorController::class, 'cadastrarVendedor']);

Route::middleware('auth:sanctum')->post('/cadastrarVenda', [CadastrarVendaController::class, 'cadastrarVenda']);

Route::middleware('auth:sanctum')->get('/listarVendas', [ListarVendasController::class, 'listarVendas']);

Route::middleware('auth:sanctum')->get('/listarVendas/Vendedor/{vendedor_id}', [ListarVendasController::class, 'listarVendasVendedor']);

Route::middleware('auth:sanctum')->delete('/deletarVendedor/{vendedor_id}', [DeletarVendedorController::class, 'deletarVendedor']);

Route::middleware('auth:sanctum')->put('/editarVendedor/{vendedor_id}', [EditarVendedorController::class, 'editarVendedor']);

Route::middleware('auth:sanctum')->post('/enviarEmail', [EnviarEmailController::class, 'enviarEmail']);