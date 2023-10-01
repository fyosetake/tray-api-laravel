<?php

use Illuminate\Http\Request;
use App\Http\Controllers\EditarVendedorController;
use App\Services\EditarVendedorService;
use App\Services\ValidarRequestService;
use PHPUnit\Framework\TestCase;

class EditarVendedorControllerTest extends TestCase
{
    /**
     * @dataProvider dataProviderEditarVendedor
     */
    public function testEditarVendedor($dadosVendedor, $vendedor_id, $vendedorEncontrado, $statusCode, $responseContent)
    {
        $servicoEditarVendedor = $this->getMockBuilder(\App\Services\EditarVendedorService::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['editarVendedor'])
            ->getMock();

        $servicoValidarRequest = $this->getMockBuilder(\App\Services\ValidarRequestService::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['validarRequest'])
            ->getMock();
        
        $servicoValidarRequest->expects($this->once())
            ->method('validarRequest')
            ->willReturn(true);

        $servicoEditarVendedor->expects($this->once())
            ->method('editarVendedor')
            ->willReturn($vendedorEncontrado);

        $controller = new \App\Http\Controllers\EditarVendedorController($servicoEditarVendedor, $servicoValidarRequest);
        $request = new Request([], $dadosVendedor);
        $response = $controller->editarVendedor($request, $vendedor_id);

        $this->assertEquals($statusCode, $response->status());
        $this->assertSame($responseContent, json_decode($response->getContent(), true));
    }

    public static function dataProviderEditarVendedor()
    {
        return [
            [
                ['nome' => 'Novo Nome', 'email' => 'novo.email@example.com'],
                1,
                ['id' => 1, 'nome' => 'Novo Nome', 'email' => 'novo.email@example.com'],
                200,
                [
                    'success' => 'true',
                    'message' => 'Edição realizada!',
                ]
            ],
        ];
    }
}