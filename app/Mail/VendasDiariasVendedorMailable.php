<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VendasDiariasVendedorMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $totalVendas;
    public $totalValor;
    public $totalComissao;

    /**
     * Create a new message instance.
     */
    public function __construct($totalVendas, $totalValor, $totalComissao)
    {
        $this->totalVendas = $totalVendas;
        $this->totalValor = $totalValor;
        $this->totalComissao = $totalComissao;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Relatório Diário de Vendas: Totais de Vendas, Valor e Comissão',
        );
    }

    /**
     * Get the message content definition.
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content(): Content
    {
        return new Content(
            view: 'VendasDiariasVendedor',
        );
    }
}
