<?php

use App\Http\Controllers\ListarVendasController;
use App\Services\ListarVendasService;
use PHPUnit\Framework\TestCase;

class ListarVendasControllerTest extends TestCase
{
    /**
     * @dataProvider dataProviderListarVendas
     */
    public function testListarVendas($vendedorId, $dadosVendas)
    {
        $servicoListarVendas = $this->getMockBuilder(ListarVendasService::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['listarVendas'])
            ->getMock();

        $servicoListarVendas->expects($this->once())
            ->method('listarVendas')
            ->with($vendedorId)
            ->willReturn($dadosVendas);

        $controller = new ListarVendasController($servicoListarVendas);
        $response = $controller->listarVendasVendedor($vendedorId);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals($dadosVendas, json_decode($response->getContent(), true));
    }

    public static function dataProviderListarVendas()
    {
        return [
            [1, ['venda1', 'venda2']],
            [2, ['venda3', 'venda4']],
        ];
    }
}
