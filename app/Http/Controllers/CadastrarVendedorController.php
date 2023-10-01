<?php

namespace App\Http\Controllers;

use App\Services\CadastrarVendedorService;
use App\Services\ValidarRequestService;
use App\Models\Vendedores;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CadastrarVendedorController extends Controller
{
    private $cadastrarVendedorService;
    private $validarRequestService;

    public function __construct(CadastrarVendedorService $cadastrarVendedorService, ValidarRequestService $validarRequestService)
    {
        $this->cadastrarVendedorService = $cadastrarVendedorService;
        $this->validarRequestService = $validarRequestService;
    }

    public function cadastrarVendedor(Request $request)
    {
        $requestValida = $this->validarRequestService->validarRequest($request, new Vendedores);

        if ($requestValida === false) {
            return new Response('É necessário preencher todos os atributos corretamente', 400);
        }

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
