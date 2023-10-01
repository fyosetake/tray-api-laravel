<?php

use Illuminate\Http\Request;
use App\Http\Controllers\CadastrarVendaController;
use App\Services\CadastrarVendaService;
use App\Services\ValidarRequestService;
use PHPUnit\Framework\TestCase;

class CadastrarVendaControllerTest extends TestCase
{
    /**
     * @dataProvider dataProviderCadastrarVenda
     */
    public function testCadastrarVenda($dadosVenda, $statusCode, $responseContent)
    {
        $servicoCadastrarVenda = $this->getMockBuilder(\App\Services\CadastrarVendaService::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['cadastrarVenda'])
            ->getMock();
        
        $servicoValidarRequest = $this->getMockBuilder(\App\Services\ValidarRequestService::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['validarRequest'])
            ->getMock();
        
        $servicoValidarRequest->expects($this->once())
            ->method('validarRequest')
            ->willReturn(true);
        
        $servicoCadastrarVenda->expects($this->once())
            ->method('cadastrarVenda')
            ->willReturn($dadosVenda);

        $controller = new \App\Http\Controllers\CadastrarVendaController($servicoCadastrarVenda, $servicoValidarRequest);
        $request = new Request([], $dadosVenda);
        $response = $controller->cadastrarVenda($request);

        $this->assertEquals($statusCode, $response->status());
        $this->assertSame($responseContent, json_decode($response->getContent(), true));
    }

    public static function dataProviderCadastrarVenda()
    {
        return [
            [
                ['vendedor_id' => 1, 'valor' => 100.50, 'data' => '2023-09-30'],
                201,
                ['vendedor_id' => 1, 'valor' => 100.50, 'data' => '2023-09-30']
            ],
            [
                ['vendedor_id' => 2, 'valor' => 1000, 'data' => '2023-11-15'],
                201,
                ['vendedor_id' => 2, 'valor' => 1000, 'data' => '2023-11-15']
            ],
            [
                ['vendedor_id' => 5, 'valor' => 1500, 'data' => '2023-09-30'],
                201,
                ['vendedor_id' => 5, 'valor' => 1500, 'data' => '2023-09-30']
            ],
        ];
    }
}