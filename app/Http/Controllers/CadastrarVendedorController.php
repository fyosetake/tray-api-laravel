<?php

namespace App\Http\Controllers;

use App\Services\CadastrarVendedorService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CadastrarVendedorController extends Controller
{
    private $cadastrarVendedorService;

    public function __construct(CadastrarVendedorService $cadastrarVendedorService)
    {
        $this->cadastrarVendedorService = $cadastrarVendedorService;
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
            return new Response($vendedorCadastrado, 201);
        } catch (\Exception $e) {
            return new Response(['message' => 'Ocorreu um erro durante o cadastro do Vendedor', 'error' => $e->getMessage()], 500);
        }
    }
}
