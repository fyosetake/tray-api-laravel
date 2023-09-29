<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VendedorController;
use App\Http\Controllers\VendasController;

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

Route::post('/cadastrarVendedor', [VendedorController::class, 'cadastrarVendedor']);

Route::get('/listarVendedores', [VendedorController::class, 'listarVendedores']);

Route::post('/cadastrarVenda', [VendasController::class, 'cadastrarVenda']);

Route::get('/listarVendas', [VendasController::class, 'listarVendas']);

Route::get('/listarVendas/Vendedor/{vendedor_id}', [VendasController::class, 'listarVendasVendedor']);

Route::delete('/deletarVendedor/{vendedor_id}', [VendedorController::class, 'deletarVendedor']);

Route::put('/editarVendedor/{vendedor_id}', [VendedorController::class, 'editarVendedor']);