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
        $dadosVendedor = [
            'nome' => $request->input('nome'),
            'email' => $request->input('email'),
        ];

        try {
            $requestValida = $this->validarRequestService->validarRequest($request, new Vendedores);
            $vendedorAtualizado = $this->editarVendedorService->editarVendedor($vendedor_id, $dadosVendedor);
            return new Response(['success' => 'true', 'message' => 'Edição realizada!'], Response::HTTP_OK);
        } catch (\Exception $e) {
            return new Response(['success' => 'false', 'message' => 'Ocorreu um erro!'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}