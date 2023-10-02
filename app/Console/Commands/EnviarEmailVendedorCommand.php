<?php

use Illuminate\Console\Command;
use App\Services\EnviarEmailService;

class EnviarEmailVendedorCommand extends Command
{
    protected $signature = 'enviar-email:vendedor';
    protected $description = 'Envia e-mail para vendedor diariamente às 0hs';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle(EnviarEmailService $emailService)
    {
        $data = now()->subDay()->format('Y-m-d');
        $emailService->enviarEmailTodosVendedores($data);
    }
}
