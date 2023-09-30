<?php

namespace Tests\Unit\Services;

use App\Services\CadastrarVendedorService;
use App\Repositories\VendedoresRepository;
use PHPUnit\Framework\TestCase;

class CadastrarVendedorServiceTest extends TestCase
{
    /**
     * @dataProvider dataProviderCadastrarVendedor
     */
    public function testCadastrarVendedorComSucesso($dadosVendedor, $resultadoEsperado)
    {
        $vendedoresRepositoryMock = $this->createMock(VendedoresRepository::class);
        $vendedoresRepositoryMock->expects($this->once())
            ->method('cadastrarVendedor')
            ->willReturn($resultadoEsperado);

        $cadastrarVendedorService = new CadastrarVendedorService($vendedoresRepositoryMock);

        $resultado = $cadastrarVendedorService->cadastrarVendedor($dadosVendedor);

        $this->assertEquals($resultadoEsperado, $resultado);
    }

    public static function dataProviderCadastrarVendedor()
    {
        return [
            [
                ['nome' => 'Fernando Teste', 'email' => 'fernando@teste.com'],
                ['id' => 1, 'nome' => 'Fernando Teste', 'email' => 'fernando@teste.com']
            ],
            [
                ['nome' => 'Francine Teste', 'email' => 'francine@teste.com'],
                ['id' => 1, 'nome' => 'Fernando Teste', 'email' => 'fernando@teste.com']
            ],
            [
                ['nome' => 'Bento Teste', 'email' => 'bento@teste.com'],
                ['id' => 1, 'nome' => 'Fernando Teste', 'email' => 'fernando@teste.com']
            ],
        ];
    }
}
