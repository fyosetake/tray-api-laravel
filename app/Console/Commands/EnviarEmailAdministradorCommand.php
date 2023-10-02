<?php

use Illuminate\Console\Command;
use App\Services\EnviarEmailService;

class EnviarEmailAdministradorCommand extends Command
{
    protected $signature = 'enviar-email:administrador';
    protected $description = 'Envia e-mail para administrador diariamente às 23h59';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle(EnviarEmailService $emailService)
    {
        $data = now()->subDay()->format('Y-m-d');
        $emailService->enviarEmailAdministrador($data);
    }
}
