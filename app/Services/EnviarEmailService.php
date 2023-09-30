<?php

namespace App\Services;

use Illuminate\Support\Facades\Mail;
use App\Mail\VendasDiariasVendedorMailable;
use App\Mail\VendasDiariasAdministradorMailable;

class EnviarEmailService
{
    public function enviarEmail($emailDestinatario, $perfilDestinatario)
    {
        if ($perfilDestinatario === 'Vendedor') {
            //Mail::to($emailDestinatario)->send(new VendasDiariasVendedorMailable());

            return "E-mail enviado com sucesso para o Vendedor!";
        }

        //Mail::to($emailDestinatario)->send(new VendasDiariasAdministradorMailable());

        return "E-mail enviado com sucesso para o Administrador!";
    }
}