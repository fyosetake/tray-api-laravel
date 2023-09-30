<?php

namespace App\Http\Controllers;

use App\Services\EditarVendedorService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EditarVendedorController extends Controller
{
    private $editarVendedorService;

    public function __construct(EditarVendedorService $editarVendedorService)
    {
        $this->editarVendedorService = $editarVendedorService;
    }

    public function editarVendedor(Request $request, $vendedor_id)
    {
        $request->validate([
            'nome' => 'required',
            'email' => 'required|email',
        ]);

        $dadosVendedor = [
            'nome' => $request->input('nome'),
            'email' => $request->input('email'),
        ];

        try {
            $vendedorAtualizado = $this->editarVendedorService->editarVendedor($vendedor_id, $dadosVendedor);

            if ($vendedorAtualizado) {
                return new Response(['message' => 'Vendedor atualizado com sucesso', 'data' => $vendedorAtualizado], 200);
            }

            return new Response(['error' => 'Vendedor não encontrado'], 404);
        } catch (\Exception $e) {
            return new Response(['error' => 'Ocorreu um erro ao editar o vendedor: ' . $e->getMessage()], 500);
        }
    }
}