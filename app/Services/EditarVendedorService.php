<?php

namespace App\Services;

use App\Repositories\VendedoresRepository;
use \Exception;

class EditarVendedorService
{
    private $vendedoresRepository;

    public function __construct(VendedoresRepository $vendedoresRepository)
    {
        $this->vendedoresRepository = $vendedoresRepository;
    }

    public function editarVendedor($vendedor_id, array $dadosVendedor)
    {
        try {
            return $this->vendedoresRepository->editarVendedor($vendedor_id, $dadosVendedor);
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
