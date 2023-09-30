<?php

namespace Tests\Unit\Services;

use App\Services\CadastrarVendaService;
use App\Repositories\VendasRepository;
use PHPUnit\Framework\TestCase;

class CadastrarVendaServiceTest extends TestCase
{
    /**
     * @dataProvider dataProviderCadastrarVenda
     */
    public function testCadastrarVendaComSucesso($dadosVenda, $resultadoEsperado)
    {
        $vendasRepositoryMock = $this->createMock(VendasRepository::class);
        $vendasRepositoryMock->expects($this->once())
            ->method('cadastrarVenda')
            ->willReturn($resultadoEsperado);

        $cadastrarVendaService = new CadastrarVendaService($vendasRepositoryMock);

        $resultado = $cadastrarVendaService->cadastrarVenda($dadosVenda);

        $this->assertEquals($resultadoEsperado, $resultado);
    }

    public static function dataProviderCadastrarVenda()
    {
        return [
            [
                ['vendedor_id' => 1, 'valor' => 100.50, 'data' => '2023-09-30'],
                true
            ],
        ];
    }
}
