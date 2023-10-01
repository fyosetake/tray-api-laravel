<?php

namespace App\Services;

use App\Repositories\VendedoresRepository;
use \Exception;

class CadastrarVendedorService
{
    private $vendedoresRepository;

    public function __construct(VendedoresRepository $vendedoresRepository)
    {
        $this->vendedoresRepository = $vendedoresRepository;
    }

    public function cadastrarVendedor(array $dados)
    {
        return $this->vendedoresRepository->cadastrarVendedor($dados);
    }
}
