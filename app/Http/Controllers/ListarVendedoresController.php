<?php

namespace App\Http\Controllers;

use App\Services\ListarVendedoresService;
use Illuminate\Http\Response;

class ListarVendedoresController extends Controller
{
    private $listarVendedoresService;

    public function __construct(ListarVendedoresService $listarVendedoresService)
    {
        $this->listarVendedoresService = $listarVendedoresService;
    }

    public function listarVendedores()
    {
        try {
            $vendedores = $this->listarVendedoresService->listarVendedores();
            return new Response($vendedores, Response::HTTP_OK);
        } catch (\Exception $e) {
            return new Response(['error' => 'Ocorreu um erro!'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}