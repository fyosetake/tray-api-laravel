<?php

use Illuminate\Http\Request;
use App\Http\Controllers\CadastrarVendedorController;
use App\Services\CadastrarVendedorService;
use App\Services\ValidarRequestService;
use PHPUnit\Framework\TestCase;

class CadastrarVendedorControllerTest extends TestCase
{
    /**
     * @dataProvider dataProviderCadastrarVendedor
     */
    public function testCadastrarVendedor($dadosVendedor, $statusCode, $responseContent)
    {
        $servicoCadastrarVendedor = $this->getMockBuilder(\App\Services\CadastrarVendedorService::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['cadastrarVendedor'])
            ->getMock();
        
        $servicoValidarRequest = $this->getMockBuilder(\App\Services\ValidarRequestService::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['validarRequest'])
            ->getMock();
        
        $servicoValidarRequest->expects($this->once())
            ->method('validarRequest')
            ->willReturn(true);
        
        $servicoCadastrarVendedor->expects($this->once())
            ->method('cadastrarVendedor')
            ->willReturn($dadosVendedor);

        $controller = new \App\Http\Controllers\CadastrarVendedorController($servicoCadastrarVendedor, $servicoValidarRequest);
        $request = new Request($dadosVendedor);
        $response = $controller->cadastrarVendedor($request);

        $this->assertEquals($statusCode, $response->status());
        $this->assertSame($responseContent, json_decode($response->getContent(), true));
    }

    public static function dataProviderCadastrarVendedor()
    {
        return [
            // Cenário: Dados válidos
            [
                ['nome' => 'Fernando Teste', 'email' => 'fernando.teste@email.com'],
                201,
                [
                    'success' => 'true',
                    'message' => 'Cadastro realizado!'
                ]
            ],
        ];
    }
}