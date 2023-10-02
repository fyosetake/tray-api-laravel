<?php

namespace App\Repositories;

use App\Models\Vendedores;

class VendedoresRepository
{
    public function cadastrarVendedor(array $dados)
    {
        return Vendedores::create($dados);
    }

    public function listarVendedores()
    {
        return Vendedores::all();
    }

    public function deletarVendedor($vendedor_id)
    {
        $vendedor = Vendedores::find($vendedor_id);

        if ($vendedor) {
            $vendedor->vendas()->delete();
            $vendedor->delete();

            return true;
        }

        return false;
    }

    public function editarVendedor($vendedor_id, array $dados)
    {
        $vendedor = Vendedores::find($vendedor_id);

        if ($vendedor) {
            $vendedor->update($dados);
            return $vendedor;
        }

        return null;
    }

    public function obterEmailVendedor($vendedor_id)
    {
        $vendedor = Vendedores::find($vendedor_id);
        return $vendedor->email ?? null;
    }
}