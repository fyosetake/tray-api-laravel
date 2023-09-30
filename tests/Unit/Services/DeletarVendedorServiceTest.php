<?php

namespace Tests\Unit\Services;

use App\Services\DeletarVendedorService;
use App\Repositories\VendedoresRepository;
use PHPUnit\Framework\TestCase;

class DeletarVendedorServiceTest extends TestCase
{
    /**
     * @dataProvider dataProviderDeletarVendedor
     */
    public function testDeletarVendedor($vendedorId, $resultadoEsperado)
    {
        $vendedoresRepositoryMock = $this->createMock(VendedoresRepository::class);
        $vendedoresRepositoryMock->expects($this->once())
            ->method('deletarVendedor')
            ->with($vendedorId)
            ->willReturn($resultadoEsperado);

        $deletarVendedorService = new DeletarVendedorService($vendedoresRepositoryMock);

        $resultado = $deletarVendedorService->deletarVendedor($vendedorId);

        $this->assertEquals($resultadoEsperado, $resultado);
    }

    public static function dataProviderDeletarVendedor()
    {
        return [
            [1, true],
        ];
    }
}
