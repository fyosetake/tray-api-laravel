<?php

namespace App\Services;

use App\Repositories\VendasRepository;

class CadastrarVendaService
{
    private $vendasRepository;
    const PORCENTAGEM_COMISSAO = 0.085;

    public function __construct(VendasRepository $vendasRepository)
    {
        $this->vendasRepository = $vendasRepository;
    }

    private function calcularComissao(float $valor): float
    {
        return $valor * self::PORCENTAGEM_COMISSAO;
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

        return $this->vendasRepository->cadastrarVenda($dadosVenda);
    }
}