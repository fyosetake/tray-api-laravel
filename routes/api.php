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
    Route::get('/vendedor/listar', [VendedorController::class, 'listarVendedores']);
    Route::post('/vendedor/cadastrar', [VendedorController::class, 'cadastrarVendedor']);
    Route::post('/venda/cadastrar', [CadastrarVendaController::class, 'cadastrarVenda']);
    Route::get('/venda/listar', [ListarVendasController::class, 'listarVendas']);
    Route::get('/venda/listar/vendedor/{vendedor_id}', [ListarVendasController::class, 'listarVendasVendedor']);
    Route::delete('/vendedor/deletar/{vendedor_id}', [VendedorController::class, 'deletarVendedor']);
    Route::put('/vendedor/editar/{vendedor_id}', [VendedorController::class, 'editarVendedor']);
    Route::post('/email/enviar', [EnviarEmailController::class, 'enviarEmail']);
});