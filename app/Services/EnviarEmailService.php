<?php

namespace App\Services;

use Illuminate\Support\Facades\Mail;
use App\Mail\VendasDiariasVendedorMailable;
use App\Mail\VendasDiariasAdministradorMailable;
use App\Repositories\VendasRepository;
use App\Repositories\VendedoresRepository;

class EnviarEmailService
{
    private $vendasRepository;
    private $vendedoresRepository;

    public function __construct(VendasRepository $vendasRepository, VendedoresRepository $vendedoresRepository)
    {
        $this->vendasRepository = $vendasRepository;
        $this->vendedoresRepository = $vendedoresRepository;
    }

    public function enviarEmailVendedor($data, $vendedor_id)
    {
        $totaisVendedor = $this->vendasRepository->obterTotaisVendedor($data, $vendedor_id);
        $emailVendedor = $this->vendedoresRepository->obterEmailVendedor($vendedor_id);

        Mail::to($emailVendedor)->send(new VendasDiariasVendedorMailable(...array_values($totaisVendedor)));
    }

    public function enviarEmailTodosVendedores($data)
    {
        $listaVendedores = $this->vendedoresRepository->listarVendedores();
            
        foreach ($listaVendedores as $vendedor) {
            $totaisVendedor = $this->vendasRepository->obterTotaisVendedor($data, $vendedor->vendedor_id);
            $emailVendedor = $this->vendedoresRepository->obterEmailVendedor($vendedor->vendedor_id);
            
            Mail::to($emailVendedor)->send(new VendasDiariasVendedorMailable(...array_values($totaisVendedor)));
        }
    }

    public function enviarEmailAdministrador($data)
    {
        $totalValor = $this->vendasRepository->obterValorTotalVendas($data);
        Mail::to('administrador@teste.com')->send(new VendasDiariasAdministradorMailable($totalValor));
    }
}