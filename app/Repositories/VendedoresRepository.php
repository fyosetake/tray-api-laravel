<?php

namespace App\Repositories;

use App\Models\Vendedor;

class VendedoresRepository
{
    public function cadastrarVendedor(array $dados)
    {
        return Vendedor::create($dados);
    }

    public function listarVendedores()
    {
        return Vendedor::all();
    }

    public function deletarVendedor($vendedor_id)
    {
        $vendedor = Vendedor::find($vendedor_id);

        if ($vendedor) {
            $vendedor->vendas()->delete();
            $vendedor->delete();

            return true;
        }

        return false;
    }

    public function editarVendedor($vendedor_id, array $dados)
    {
        $vendedor = Vendedor::find($vendedor_id);

        if ($vendedor) {
            $vendedor->update($dados);
            return $vendedor;
        }

        return null;
    }
}