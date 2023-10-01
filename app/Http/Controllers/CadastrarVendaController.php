<?php

namespace App\Http\Controllers;

use App\Services\CadastrarVendaService;
use App\Services\ValidarRequestService;
use App\Models\Vendas;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
        $requestValida = $this->validarRequestService->validarRequest($request, new Vendas);

        if ($requestValida === false) {
            return new Response('É necessário preencher todos os atributos corretamente', 400);
        }

        $dadosVenda = [
            'vendedor_id' => $request->input('vendedor_id'),
            'valor' => $request->input('valor'),
            'data' => $request->input('data')
        ];

        try {
            $vendaCadastrada = $this->cadastrarVendaService->cadastrarVenda($dadosVenda);
            return new Response($vendaCadastrada, 201);
        } catch (\Exception $e) {
            return new Response(['message' => 'Ocorreu um erro durante o cadastro da Venda', 'error' => $e->getMessage()], 500);
        }
    }
}