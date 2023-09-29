<?php

namespace App\Http\Controllers;

use App\Services\CadastrarVendaService;
use App\Services\ListarVendasService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class VendasController extends Controller
{
    private $cadastrarVendaService;
    private $listarVendasService;

    public function __construct(CadastrarVendaService $cadastrarVendaService, ListarVendasService $listarVendasService)
    {
        $this->cadastrarVendaService = $cadastrarVendaService;
        $this->listarVendasService = $listarVendasService;
    }

    public function cadastrarVenda(Request $request)
    {
        $request->validate([
            'vendedor_id' => 'required',
            'valor' => 'required|numeric',
            'comissao' => 'required|numeric',
            'data' => 'required|date'
        ]);
        
        $dadosVenda = [
            'vendedor_id' => $request->input('vendedor_id'),
            'valor' => $request->input('valor'),
            'comissao' => $request->input('comissao'),
            'data' => $request->input('data')
        ];

        try {
            $vendaCadastrada = $this->cadastrarVendaService->cadastrarVenda($dadosVenda);
        } catch (\Exception $e) {
            return new Response(['message' => 'Ocorreu um erro durante o cadastro da Venda', 'error' => $e->getMessage()], 500);
        }

        return new Response($vendaCadastrada, 201);
    }

    public function listarVendas()
    {
        try {
            $vendas = $this->listarVendasService->listarVendas();
        } catch (\Exception $e) {
            return new Response(['error' => 'Ocorreu um erro ao listar as vendas: ' . $e->getMessage()], 500);
        }

        return new Response($vendas, 200);
    }

    public function listarVendasVendedor($vendedor_id)
    {
        try {
            $vendas = $this->listarVendasService->listarVendas($vendedor_id);
        } catch (\Exception $e) {
            return new Response(['error' => 'Ocorreu um erro ao listar as vendas: ' . $e->getMessage()], 500);
        }

        return new Response($vendas, 200);
    }
}