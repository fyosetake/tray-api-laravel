<?php

namespace App\Services;

use App\Repositories\VendedoresRepository;
use \Exception;

class ListarVendedoresService
{
    private $vendedoresRepository;

    public function __construct(VendedoresRepository $vendedoresRepository)
    {
        $this->vendedoresRepository = $vendedoresRepository;
    }

    public function listarVendedores()
    {
        return $this->vendedoresRepository->listarVendedores();
    }
}