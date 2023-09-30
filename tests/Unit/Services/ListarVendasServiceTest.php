<?php

namespace Tests\Unit\Services;

use App\Services\ListarVendasService;
use App\Repositories\VendasRepository;
use PHPUnit\Framework\TestCase;

class ListarVendasServiceTest extends TestCase
{
    /**
     * @dataProvider dataProviderListarVendas
     */
    public function testListarVendas($vendedorId, $resultadoEsperado)
    {
        $vendasRepositoryMock = $this->createMock(VendasRepository::class);
        $vendasRepositoryMock->expects($this->once())
            ->method('listarVendasVendedor')
            ->with($vendedorId)
            ->willReturn($resultadoEsperado);

        $listarVendasService = new ListarVendasService($vendasRepositoryMock);

        $resultado = $listarVendasService->listarVendas($vendedorId);

        $this->assertEquals($resultadoEsperado, $resultado);
    }

    public static function dataProviderListarVendas()
    {
        return [
            [1, ['venda1', 'venda2']],
        ];
    }

    /**
     * @dataProvider dataProviderListarVendasGeral
     */
    public function testListarTodasAsVendas($resultadoEsperado)
    {
        $vendasRepositoryMock = $this->createMock(VendasRepository::class);
        $vendasRepositoryMock->expects($this->once())
            ->method('listarVendas')
            ->willReturn($resultadoEsperado);

        $listarVendasService = new ListarVendasService($vendasRepositoryMock);

        $resultado = $listarVendasService->listarVendas();

        $this->assertEquals($resultadoEsperado, $resultado);
    }

    public static function dataProviderListarVendasGeral()
    {
        return [
            [['venda1', 'venda2']],
        ];
    }
}
