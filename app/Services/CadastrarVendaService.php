<?php

namespace App\Services;

use App\Repositories\VendasRepository;
use \Exception;

class CadastrarVendaService
{
    private $vendasRepository;

    public function __construct(VendasRepository $vendasRepository)
    {
        $this->vendasRepository = $vendasRepository;
    }

    public function cadastrarVenda(array $dados)
    {
        try {
            return $this->vendasRepository->cadastrarVenda($dados);
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}