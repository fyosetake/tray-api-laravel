<?php

namespace App\Services;

use App\Repositories\VendedoresRepository;

class EditarVendedorService
{
    private $vendedoresRepository;

    public function __construct(VendedoresRepository $vendedoresRepository)
    {
        $this->vendedoresRepository = $vendedoresRepository;
    }

    public function editarVendedor($vendedor_id, array $dadosVendedor)
    {
        return $this->vendedoresRepository->editarVendedor($vendedor_id, $dadosVendedor);
    }
}
