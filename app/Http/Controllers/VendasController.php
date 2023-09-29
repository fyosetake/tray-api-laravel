<?php

namespace App\Http\Controllers;

use App\Services\CadastrarVendaService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class VendasController extends Controller
{
    private $cadastrarVendaService;

    public function __construct(CadastrarVendaService $cadastrarVendaService)
    {
        $this->cadastrarVendaService = $cadastrarVendaService;
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
}