<?php

namespace App\Http\Controllers;

use App\Services\CadastrarVendedorService;
use App\Services\ListarVendedoresService;
use App\Services\DeletarVendedorService;
use App\Services\EditarVendedorService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class VendedorController extends Controller
{
    private $cadastrarVendedorService;
    private $listarVendedoresService;
    private $deletarVendedorService;
    private $editarVendedorService;

    public function __construct(CadastrarVendedorService $cadastrarVendedores, ListarVendedoresService $listarVendedores, DeletarVendedorService $deletarVendedor, EditarVendedorService $editarVendedor)
    {
        $this->cadastrarVendedorService = $cadastrarVendedores;
        $this->listarVendedoresService = $listarVendedores;
        $this->deletarVendedorService = $deletarVendedor;
        $this->editarVendedorService = $editarVendedor;
    }

    public function cadastrarVendedor(Request $request)
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
            $vendedorCadastrado = $this->cadastrarVendedorService->cadastrarVendedor($dadosVendedor);
        } catch (\Exception $e) {
            return new Response(['message' => 'Ocorreu um erro durante o cadastro do Vendedor', 'error' => $e->getMessage()], 500);
        }

        return new Response($vendedorCadastrado, 201);
    }

    public function listarVendedores()
    {
        try {
            $vendedores = $this->listarVendedoresService->listarVendedores();
        } catch (\Exception $e) {
            return new Response(['error' => 'Ocorreu um erro ao listar os vendedores: ' . $e->getMessage()], 500);
        }

        return new Response($vendedores, 200);
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
            } else {
                return new Response(['error' => 'Vendedor não encontrado'], 404);
            }
        } catch (\Exception $e) {
            return new Response(['error' => 'Ocorreu um erro ao editar o vendedor: ' . $e->getMessage()], 500);
        }
    }
}