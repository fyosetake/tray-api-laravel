<?php

use Illuminate\Http\Request;
use App\Http\Controllers\CadastrarVendaController;
use App\Services\CadastrarVendaService;
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
        
        $servicoCadastrarVenda->expects($this->once())
            ->method('cadastrarVenda')
            ->willReturn($dadosVenda);

        $controller = new \App\Http\Controllers\CadastrarVendaController($servicoCadastrarVenda);
        $request = new Request([], $dadosVenda); // Passa os dados diretamente no corpo da requisição
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
        ];
    }
}
