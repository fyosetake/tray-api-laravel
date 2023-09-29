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
}
