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

            if ($vendedorDeletado) {
                return new Response(['message' => 'Vendedor deletado com sucesso'], 200);
            } else {
                return new Response(['error' => 'Vendedor não encontrado'], 404);
            }
        } catch (\Exception $e) {
            return new Response(['error' => 'Ocorreu um erro ao deletar o vendedor: ' . $e->getMessage()], 500);
        }
    }
}