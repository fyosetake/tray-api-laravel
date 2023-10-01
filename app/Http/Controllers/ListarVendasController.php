<?php

namespace App\Http\Controllers;

use App\Services\ListarVendasService;
use Illuminate\Http\Response;
use LDAP\Result;

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
            return new Response($vendas, Response::HTTP_OK);
        } catch (\Exception $e) {
            return new Response(['error' => 'Ocorreu um erro!'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function listarVendasVendedor($vendedor_id)
    {
        try {
            $vendas = $this->listarVendasService->listarVendas($vendedor_id);
            return new Response($vendas, Response::HTTP_OK);
        } catch (\Exception $e) {
            return new Response(['error' => 'Ocorreu um erro!'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}