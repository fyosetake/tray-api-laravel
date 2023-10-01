<?php

namespace App\Http\Controllers;

use App\Services\DeletarVendedorService;
use Illuminate\Http\Response;

class DeletarVendedorController extends Controller
{
    private $deletarVendedorService;

    public function __construct(DeletarVendedorService $deletarVendedorService)
    {
        $this->deletarVendedorService = $deletarVendedorService;
    }

    public function deletarVendedor($vendedor_id)
    {
        try {
            $vendedorDeletado = $this->deletarVendedorService->deletarVendedor($vendedor_id);
            return new Response(['success' => 'true', 'message' => 'Exclusão realizada!'], Response::HTTP_OK);
        } catch (\Exception $e) {
            return new Response(['success' => 'false', 'message' => 'Ocorreu um erro!'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}