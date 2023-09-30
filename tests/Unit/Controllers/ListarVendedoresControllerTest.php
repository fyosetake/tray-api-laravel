<?php

use App\Http\Controllers\ListarVendedoresController;
use App\Services\ListarVendedoresService;
use PHPUnit\Framework\TestCase;

class ListarVendedoresControllerTest extends TestCase
{
    /**
     * @dataProvider dataProviderListarVendedores
     */
    public function testListarVendedores($dadosVendedores)
    {
        $servicoListarVendedores = $this->getMockBuilder(ListarVendedoresService::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['listarVendedores'])
            ->getMock();

        $servicoListarVendedores->expects($this->once())
            ->method('listarVendedores')
            ->willReturn($dadosVendedores);

        $controller = new ListarVendedoresController($servicoListarVendedores);
        $response = $controller->listarVendedores();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals($dadosVendedores, json_decode($response->getContent(), true));
    }

    public static function dataProviderListarVendedores()
    {
        return [
            [['vendedor1', 'vendedor2', 'vendedor3']],
            [['vendedor4', 'vendedor5', 'vendedor6']],
            [['vendedor7', 'vendedor8', 'vendedor9']],
            [['vendedor10', 'vendedor11', 'vendedor12']],
            [['vendedor13', 'vendedor14', 'vendedor15']],
        ];
    }
}
