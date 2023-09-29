<?php

namespace App\Repositories;

use App\Models\Venda;

class VendasRepository
{
    public function cadastrarVenda(array $dados)
    {
        return Venda::create($dados);
    }

    public function listarVendas()
    {
        return Venda::all();
    }

    public function listarVendasVendedor($vendedor_id)
    {
        return Venda::where('vendedor_id', $vendedor_id)->get();
    }
}