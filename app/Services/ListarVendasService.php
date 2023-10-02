<?php

namespace App\Services;

use App\Repositories\VendasRepository;

class ListarVendasService
{
    private $vendasRepository;

    public function __construct(VendasRepository $vendasRepository)
    {
        $this->vendasRepository = $vendasRepository;
    }

    public function listarVendas($vendedor_id = null)
    {
        if ($vendedor_id !== null) {
            return $this->vendasRepository->listarVendasVendedor($vendedor_id);
        }

        return $this->vendasRepository->listarVendas();
    }
}