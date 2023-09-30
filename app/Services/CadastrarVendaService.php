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

    private function calcularComissao(float $valor): float
    {
        return $valor * 0.085;
    }

    public function cadastrarVenda(array $dados)
    {        
        $dados['comissao'] = $this->calcularComissao($dados['valor']);

        $dadosVenda = [
            'vendedor_id' => $dados['vendedor_id'],
            'valor' => $dados['valor'],
            'data' => $dados['data'],
            'comissao' => $dados['comissao']
        ];

        try {
            return $this->vendasRepository->cadastrarVenda($dadosVenda);
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}