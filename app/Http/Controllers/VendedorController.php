<?php

namespace App\Http\Controllers;

use App\Services\CadastrarVendedorService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class VendedorController extends Controller
{
    private $cadastrarVendedorService;

    public function __construct(CadastrarVendedorService $vendedoresService)
    {
        $this->cadastrarVendedorService = $vendedoresService;
    }

    public function cadastrarVendedor(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'email' => 'required|email',
        ]);

        $dadosVendedor = [
            'nome' => $request->input('nome'),
            'email' => $request->input('email'),
        ];

        try {
            $vendedorCadastrado = $this->cadastrarVendedorService->cadastrarVendedor($dadosVendedor);
        } catch (\Exception $e) {
            return new Response(['message' => 'Ocorreu um erro durante o cadastro do Vendedor', 'error' => $e->getMessage()], 500);
        }

        return new Response($vendedorCadastrado, 201);
    }
}