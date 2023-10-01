<?php

use App\Http\Controllers\DeletarVendedorController;
use App\Services\DeletarVendedorService;
use Illuminate\Http\Response;
use PHPUnit\Framework\TestCase;

class DeletarVendedorControllerTest extends TestCase
{
    /**
     * @dataProvider dataProviderDeletarVendedor
     */
    public function testDeletarVendedor($vendedorId, $vendedorDeletado, $statusCode, $responseContent)
    {
        $servicoDeletarVendedor = $this->getMockBuilder(\App\Services\DeletarVendedorService::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['deletarVendedor'])
            ->getMock();
        
        $servicoDeletarVendedor->expects($this->once())
            ->method('deletarVendedor')
            ->with($vendedorId)
            ->willReturn($vendedorDeletado);

        $controller = new \App\Http\Controllers\DeletarVendedorController($servicoDeletarVendedor);
        $response = $controller->deletarVendedor($vendedorId);

        $this->assertEquals($statusCode, $response->getStatusCode());
        $this->assertSame($responseContent, json_decode($response->getContent(), true));
    }

    public static function dataProviderDeletarVendedor()
    {
        return [
            [1, true, 200, [
                'success' => 'true',
                'message' => 'Exclusão realizada!',]],
        ];
    }
}
