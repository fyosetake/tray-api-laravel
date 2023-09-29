<?php

namespace App\Repositories;

use App\Models\Vendas;

class VendasRepository
{
    public function cadastrarVenda(array $dados)
    {
        return Vendas::create($dados);
    }

    public function listarVendas()
    {
        return Vendas::all();
    }

    public function listarVendasVendedor($vendedor_id)
    {
        return Vendas::where('vendedor_id', $vendedor_id)->get();
    }
}