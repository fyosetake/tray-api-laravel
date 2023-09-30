<?php

use Illuminate\Http\Request;
use App\Http\Controllers\CadastrarVendedorController;
use App\Services\CadastrarVendedorService;
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
        
        $servicoCadastrarVendedor->expects($this->once())
            ->method('cadastrarVendedor')
            ->willReturn($dadosVendedor);

        $controller = new \App\Http\Controllers\CadastrarVendedorController($servicoCadastrarVendedor);
        $request = new Request($dadosVendedor);
        $response = $controller->cadastrarVendedor($request);

        $this->assertEquals($statusCode, $response->status());
        $this->assertSame($responseContent, json_decode($response->getContent(), true));
    }

    public static function dataProviderCadastrarVendedor()
    {
        return [
            [
                ['nome' => 'Fernando Teste', 'email' => 'fernando.teste@email.com'],
                201,
                ['nome' => 'Fernando Teste', 'email' => 'fernando.teste@email.com']
            ],
        ];
    }
}
