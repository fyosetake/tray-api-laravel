<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListarVendedoresController;
use App\Http\Controllers\CadastrarVendedorController;
use App\Http\Controllers\DeletarVendedorController;
use App\Http\Controllers\EditarVendedorController;
use App\Http\Controllers\CadastrarVendaController;
use App\Http\Controllers\ListarVendasController;
use App\Http\Controllers\EnviarEmailController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/cadastrarVendedor', [CadastrarVendedorController::class, 'cadastrarVendedor']);

Route::get('/listarVendedores', [ListarVendedoresController::class, 'listarVendedores']);

Route::post('/cadastrarVenda', [CadastrarVendaController::class, 'cadastrarVenda']);

Route::get('/listarVendas', [ListarVendasController::class, 'listarVendas']);

Route::get('/listarVendas/Vendedor/{vendedor_id}', [ListarVendasController::class, 'listarVendasVendedor']);

Route::delete('/deletarVendedor/{vendedor_id}', [DeletarVendedorController::class, 'deletarVendedor']);

Route::put('/editarVendedor/{vendedor_id}', [EditarVendedorController::class, 'editarVendedor']);

Route::post('/enviarEmail', [EnviarEmailController::class, 'enviarEmail']);