<?php

namespace App\Http\Controllers;

use App\Services\CadastrarVendaService;
use App\Services\ValidarRequestService;
use App\Models\Vendas;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use LDAP\Result;

class CadastrarVendaController extends Controller
{
    private $cadastrarVendaService;
    private $validarRequestService;

    public function __construct(CadastrarVendaService $cadastrarVendaService, ValidarRequestService $validarRequestService)
    {
        $this->cadastrarVendaService = $cadastrarVendaService;
        $this->validarRequestService = $validarRequestService;
    }

    public function cadastrarVenda(Request $request)
    {
        $dadosVenda = [
            'vendedor_id' => $request->input('vendedor_id'),
            'valor' => $request->input('valor'),
            'data' => $request->input('data')
        ];

        try {
            $requestValida = $this->validarRequestService->validarRequest($request, new Vendas);
            $vendaCadastrada = $this->cadastrarVendaService->cadastrarVenda($dadosVenda);
            return new Response(['success' => 'true', 'message' => 'Cadastro realizado!'], Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return new Response(['success' => 'false', 'message' => 'Ocorreu um erro!'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}