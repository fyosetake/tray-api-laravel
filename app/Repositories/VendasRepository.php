<?php

namespace App\Repositories;

use App\Models\Venda;

class VendasRepository
{
    public function cadastrarVenda(array $dados)
    {
        return Venda::create($dados);
    }
}