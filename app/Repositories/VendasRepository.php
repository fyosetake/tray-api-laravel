<?php

namespace App\Repositories;

use App\Models\Vendas;
use Carbon\Carbon;

class VendasRepository
{
    public function cadastrarVenda(array $dados)
    {
        return Vendas::create($dados);
    }

    public function listarVendas()
    {
        return Vendas::all();
    }

    public function listarVendasVendedor($vendedor_id)
    {
        return Vendas::where('vendedor_id', $vendedor_id)->get();
    }

    public function obterValorTotalVendas($data)
    {
        $dataFormatada = Carbon::parse($data)->format('Y-m-d');

        return Vendas::whereDate('created_at', $dataFormatada)->sum('valor');
    }

    public function obterTotaisVendedor($data, $vendedor_id): array
    {
        $dataFormatada = Carbon::parse($data)->format('Y-m-d');
        
        $totalVendas = Vendas::whereDate('data', $dataFormatada)
                            ->where('vendedor_id', $vendedor_id)
                            ->sum('valor');

        $totalComissao = Vendas::whereDate('data', $dataFormatada)
                            ->where('vendedor_id', $vendedor_id)
                            ->sum('comissao');

        $quantidadeVendas = Vendas::whereDate('data', $dataFormatada)
                                ->where('vendedor_id', $vendedor_id)
                                ->count();
        
        return [
            'quantidadeVendas' => $quantidadeVendas,
            'totalVendas' => $totalVendas,
            'totalComissao' => $totalComissao
        ];
    }
}