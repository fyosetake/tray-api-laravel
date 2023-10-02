<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VendedorController;
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

Route::post('/autenticar', [AutenticacaoController::class, 'autenticar']);
Route::post('/registrar', [AutenticacaoController::class, 'registrar']);

Route::middleware('auth:sanctum')->group(function() {
    Route::get('/listarVendedores', [VendedorController::class, 'listarVendedores']);
    Route::post('/cadastrarVendedor', [VendedorController::class, 'cadastrarVendedor']);
    Route::post('/cadastrarVenda', [CadastrarVendaController::class, 'cadastrarVenda']);
    Route::get('/listarVendas', [ListarVendasController::class, 'listarVendas']);
    Route::get('/listarVendas/Vendedor/{vendedor_id}', [ListarVendasController::class, 'listarVendasVendedor']);
    Route::delete('/deletarVendedor/{vendedor_id}', [VendedorController::class, 'deletarVendedor']);
    Route::put('/editarVendedor/{vendedor_id}', [VendedorController::class, 'editarVendedor']);
    Route::post('/enviarEmail', [EnviarEmailController::class, 'enviarEmail']);
});