<?php

namespace Tests\Unit\Services;

use App\Services\ListarVendedoresService;
use App\Repositories\VendedoresRepository;
use PHPUnit\Framework\TestCase;

class ListarVendedoresServiceTest extends TestCase
{
    /**
     * @dataProvider dataProviderListarVendedores
     */
    public function testListarVendedores($vendedores, $resultadoEsperado)
    {
        $vendedoresRepositoryMock = $this->createMock(VendedoresRepository::class);
        $vendedoresRepositoryMock->expects($this->once())
            ->method('listarVendedores')
            ->willReturn($vendedores);

        $listarVendedoresService = new ListarVendedoresService($vendedoresRepositoryMock);

        $resultado = $listarVendedoresService->listarVendedores();

        $this->assertEquals($resultadoEsperado, $resultado);
    }

    public static function dataProviderListarVendedores()
    {
        return [
            [
                ['vendedor1', 'vendedor2', 'vendedor3'],
                ['vendedor1', 'vendedor2', 'vendedor3']
            ],
        ];
    }
}
