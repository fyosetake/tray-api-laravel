<?php

namespace App\Services;

use App\Repositories\VendedoresRepository;
use \Exception;

class DeletarVendedorService
{
    private $vendedoresRepository;

    public function __construct(VendedoresRepository $vendedoresRepository)
    {
        $this->vendedoresRepository = $vendedoresRepository;
    }

    public function deletarVendedor($vendedor_id)
    {
        try {
            return $this->vendedoresRepository->deletarVendedor($vendedor_id);
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
