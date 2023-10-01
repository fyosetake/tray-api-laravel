<?php

use Illuminate\Http\Request;
use App\Http\Controllers\VendedorController;
use App\Services\CadastrarVendedorService;
use App\Services\ValidarRequestService;
use App\Services\EditarVendedorService;
use App\Services\ListarVendedoresService;
use App\Services\DeletarVendedorService;
use Illuminate\Http\Response;
use PHPUnit\Framework\TestCase;

class VendedorControllerTest extends TestCase
{
    private $controller;
    private $cadastrarVendedorService;
    private $validarRequestService;
    private $editarVendedorService;
    private $listarVendedoresService;
    private $deletarVendedorService;

    public function setUp(): void
    {
        $this->cadastrarVendedorService = $this->createMock(\App\Services\CadastrarVendedorService::class);
        $this->validarRequestService = $this->createMock(\App\Services\ValidarRequestService::class);
        $this->editarVendedorService = $this->createMock(\App\Services\EditarVendedorService::class);
        $this->listarVendedoresService = $this->createMock(\App\Services\ListarVendedoresService::class);
        $this->deletarVendedorService = $this->createMock(\App\Services\DeletarVendedorService::class);

        $this->controller = new VendedorController(
            $this->cadastrarVendedorService,
            $this->editarVendedorService,
            $this->listarVendedoresService,
            $this->deletarVendedorService,
            $this->validarRequestService
        );
    }

    /**
     * @dataProvider dadosParaCadastrarVendedor
     */
    public function testCadastrarVendedor($dadosVendedor, $validacao, $retornoServico, $codigoStatus, $respostaEsperada)
    {
        $request = new Request($dadosVendedor);
        
        $this->validarRequestService->expects($this->once())
            ->method('validarRequest')
            ->willReturn($validacao);
        
        $this->cadastrarVendedorService->expects($this->once())
            ->method('cadastrarVendedor')
            ->willReturn($retornoServico);

        $response = $this->controller->cadastrarVendedor($request);

        $this->assertEquals($codigoStatus, $response->getStatusCode());
        $this->assertEquals($respostaEsperada, json_decode($response->getContent(), true));
    }

    /**
     * @dataProvider dadosParaEditarVendedor
     */
    public function testEditarVendedor($dadosVendedor, $validacao, $retornoServico, $codigoStatus, $respostaEsperada)
    {
        $vendedorId = 1;
        $request = new Request($dadosVendedor);

        $this->validarRequestService->expects($this->once())
            ->method('validarRequest')
            ->willReturn($validacao);

        $this->editarVendedorService->expects($this->once())
            ->method('editarVendedor')
            ->with($vendedorId, $dadosVendedor)
            ->willReturn($retornoServico);

        $response = $this->controller->editarVendedor($request, $vendedorId);
        $this->assertSame($codigoStatus, $response->getStatusCode());
    }

    /**
     * @dataProvider dadosParaListarVendedores
     */
    public function testListarVendedores($dadosVendedores, $codigoStatus, $respostaEsperada)
    {
        $this->listarVendedoresService->expects($this->once())
            ->method('listarVendedores')
            ->willReturn($dadosVendedores);

        $response = $this->controller->listarVendedores();

        $this->assertEquals($codigoStatus, $response->getStatusCode());
        $this->assertEquals($respostaEsperada, json_decode($response->getContent(), true));
    }

    /**
     * @dataProvider dadosParaDeletarVendedor
     */
    public function testDeletarVendedor($vendedorId, $retornoServico, $codigoStatus, $respostaEsperada)
    {
        $this->deletarVendedorService->expects($this->once())
            ->method('deletarVendedor')
            ->with($vendedorId)
            ->willReturn($retornoServico);

        $response = $this->controller->deletarVendedor($vendedorId);

        $this->assertEquals($codigoStatus, $response->getStatusCode());
        $this->assertEquals($respostaEsperada, json_decode($response->getContent(), true));
    }

    public static function dadosParaCadastrarVendedor()
    {
        return [
            [
                ['nome' => 'Fernando Teste', 'email' => 'fernando.teste@email.com'],
                true,
                ['nome' => 'Fernando Teste', 'email' => 'fernando.teste@email.com'],
                201,
                ['success' => true, 'message' => 'Cadastro realizado!']
            ],
        ];
    }

    public static function dadosParaEditarVendedor()
    {
        return [
            [
                ['nome' => 'Novo Nome', 'email' => 'novo.email@example.com'],
                true,
                ['id' => 1, 'nome' => 'Novo Nome', 'email' => 'novo.email@example.com'],
                200,
                ['success' => true, 'message' => 'Vendedor alterado!']
            ],
        ];
    }

    public static function dadosParaListarVendedores()
    {
        return [
            [
                [['nome' => 'Vendedor1'], ['nome' => 'Vendedor2'], ['nome' => 'Vendedor3']],
                200,
                [['nome' => 'Vendedor1'], ['nome' => 'Vendedor2'], ['nome' => 'Vendedor3']]
            ],
        ];
    }

    public static function dadosParaDeletarVendedor()
    {
        return [
            [
                1,
                true,
                200,
                ['success' => true, 'message' => 'Vendedor excluído!']
            ],
        ];
    }
}