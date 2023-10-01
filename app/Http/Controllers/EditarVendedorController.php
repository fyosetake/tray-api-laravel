<?php

namespace App\Http\Controllers;

use App\Services\EditarVendedorService;
use App\Services\ValidarRequestService;
use App\Models\Vendedores;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EditarVendedorController extends Controller
{
    private $editarVendedorService;
    private $validarRequestService;

    public function __construct(EditarVendedorService $editarVendedorService, ValidarRequestService $validarRequestService)
    {
        $this->editarVendedorService = $editarVendedorService;
        $this->validarRequestService = $validarRequestService;
    }

    public function editarVendedor(Request $request, $vendedor_id)
    {
        $requestValida = $this->validarRequestService->validarRequest($request, new Vendedores);

        if ($requestValida === false) {
            return new Response('É necessário preencher todos os atributos corretamente', 400);
        }

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