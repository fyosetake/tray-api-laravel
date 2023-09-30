<?php

namespace App\Http\Controllers;

use App\Services\EnviarEmailService;
use Illuminate\Http\Request;

class EnviarEmailController extends Controller
{
    private $emailService;

    public function __construct(EnviarEmailService $emailService)
    {
        $this->emailService = $emailService;
    }

    public function enviarEmail(Request $request)
    {
        $emailDestinatario = $request->input('email');
        $perfilDestinatario = $request->input('perfil');
        $resultado = $this->emailService->enviarEmail($emailDestinatario, $perfilDestinatario);
        
        return $resultado;
    }
}
