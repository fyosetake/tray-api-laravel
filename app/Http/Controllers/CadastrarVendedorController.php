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
        $dadosVendedor = [
            'nome' => $request->input('nome'),
            'email' => $request->input('email'),
        ];

        try {
            $requestValida = $this->validarRequestService->validarRequest($request, new Vendedores);
            $vendedorCadastrado = $this->cadastrarVendedorService->cadastrarVendedor($dadosVendedor);
            return new Response(['success' => 'true', 'message' => 'Cadastro realizado!'], Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return new Response(['success' => 'false', 'message' => 'Ocorreu um erro!'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
