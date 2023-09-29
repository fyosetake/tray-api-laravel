<?php

namespace App\Services;

use App\Repositories\VendasRepository;
use \Exception;

class ListarVendasService
{
    private $vendasRepository;

    public function __construct(VendasRepository $vendasRepository)
    {
        $this->vendasRepository = $vendasRepository;
    }

    public function listarVendas()
    {
        try {
            return $this->vendasRepository->listarVendas();
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}