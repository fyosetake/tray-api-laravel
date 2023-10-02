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
        $data = $request->input('data');
        $vendedor_id = $request->input('vendedor_id');
        $resultado = $this->emailService->enviarEmailVendedor($data, $vendedor_id);
        
        return $resultado;
    }
}