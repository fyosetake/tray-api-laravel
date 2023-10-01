<?php

namespace App\Http\Controllers;

use App\Services\CadastrarVendedorService;
use App\Services\EditarVendedorService;
use App\Services\ListarVendedoresService;
use App\Services\DeletarVendedorService;
use App\Services\ValidarRequestService;
use App\Models\Vendedores;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class VendedorController extends Controller
{
    private $cadastrarVendedorService;
    private $editarVendedorService;
    private $listarVendedoresService;
    private $deletarVendedorService;
    private $validarRequestService;

    public function __construct(
        CadastrarVendedorService $cadastrarVendedorService,
        EditarVendedorService $editarVendedorService,
        ListarVendedoresService $listarVendedoresService,
        DeletarVendedorService $deletarVendedorService,
        ValidarRequestService $validarRequestService
    ) {
        $this->cadastrarVendedorService = $cadastrarVendedorService;
        $this->editarVendedorService = $editarVendedorService;
        $this->listarVendedoresService = $listarVendedoresService;
        $this->deletarVendedorService = $deletarVendedorService;
        $this->validarRequestService = $validarRequestService;
    }

    public function cadastrarVendedor(Request $request)
    {
        $dadosVendedor = [
            'nome' => $request->input('nome'),
            'email' => $request->input('email'),
        ];

        try {
            $requestValida = $this->validarRequestService->validarRequest($request, new Vendedores);
            $vendedorCadastrado = $this->cadastrarVendedorService->cadastrarVendedor($dadosVendedor);
            return new Response(['success' => true, 'message' => 'Cadastro realizado!'], Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return new Response(['success' => false, 'message' => 'Ocorreu um erro!'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
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
            return new Response(['success' => true, 'message' => 'Vendedor alterado!'], Response::HTTP_OK);
        } catch (\Exception $e) {
            return new Response(['success' => false, 'message' => 'Ocorreu um erro!'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function listarVendedores()
    {
        try {
            $vendedores = $this->listarVendedoresService->listarVendedores();
            return new Response($vendedores, Response::HTTP_OK);
        } catch (\Exception $e) {
            return new Response(['success' => false, 'message' => 'Ocorreu um erro!'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function deletarVendedor($vendedor_id)
    {
        try {
            $vendedorDeletado = $this->deletarVendedorService->deletarVendedor($vendedor_id);
            return new Response(['success' => true, 'message' => 'Vendedor excluído!'], Response::HTTP_OK);
        } catch (\Exception $e) {
            return new Response(['success' => false, 'message' => 'Ocorreu um erro!'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
