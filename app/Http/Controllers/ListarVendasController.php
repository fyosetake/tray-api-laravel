<?php

namespace App\Http\Controllers;

use App\Services\ListarVendasService;
use Illuminate\Http\Response;

class ListarVendasController extends Controller
{
    private $listarVendasService;

    public function __construct(ListarVendasService $listarVendasService)
    {
        $this->listarVendasService = $listarVendasService;
    }

    public function listarVendas()
    {
        try {
            $vendas = $this->listarVendasService->listarVendas();
            return new Response($vendas, 200);
        } catch (\Exception $e) {
            return new Response(['error' => 'Ocorreu um erro ao listar as vendas: ' . $e->getMessage()], 500);
        }
    }

    public function listarVendasVendedor($vendedor_id)
    {
        try {
            $vendas = $this->listarVendasService->listarVendas($vendedor_id);
            return new Response($vendas, 200);
        } catch (\Exception $e) {
            return new Response(['error' => 'Ocorreu um erro ao listar as vendas: ' . $e->getMessage()], 500);
        }
    }
}