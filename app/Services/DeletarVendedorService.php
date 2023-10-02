<?php

namespace App\Services;

use App\Repositories\VendedoresRepository;

class DeletarVendedorService
{
    private $vendedoresRepository;

    public function __construct(VendedoresRepository $vendedoresRepository)
    {
        $this->vendedoresRepository = $vendedoresRepository;
    }

    public function deletarVendedor($vendedor_id)
    {
        return $this->vendedoresRepository->deletarVendedor($vendedor_id);
    }
}
