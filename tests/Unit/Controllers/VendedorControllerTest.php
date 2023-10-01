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

    public function testCadastrarVendedor()
    {
        $dadosVendedor = ['nome' => 'Fernando Teste', 'email' => 'fernando.teste@email.com'];
        $request = new Request($dadosVendedor);
        
        $this->validarRequestService->expects($this->once())
            ->method('validarRequest')
            ->willReturn(true);
        
        $this->cadastrarVendedorService->expects($this->once())
            ->method('cadastrarVendedor')
            ->willReturn($dadosVendedor);

        $response = $this->controller->cadastrarVendedor($request);

        $this->assertEquals(201, $response->getStatusCode());
        $this->assertEquals(['success' => true, 'message' => 'Cadastro realizado!'], json_decode($response->getContent(), true));
    }

    public function testEditarVendedor()
    {
        $vendedorId = 1;
        $dadosVendedor = ['nome' => 'Novo Nome', 'email' => 'novo.email@example.com'];
        $request = new Request($dadosVendedor);
        $vendedorEncontrado = ['id' => 1, 'nome' => 'Novo Nome', 'email' => 'novo.email@example.com'];

        $this->validarRequestService->expects($this->once())
            ->method('validarRequest')
            ->willReturn(true);

        $this->editarVendedorService->expects($this->once())
            ->method('editarVendedor')
            ->with($vendedorId, $dadosVendedor)
            ->willReturn($vendedorEncontrado);

        $response = $this->controller->editarVendedor($request, $vendedorId);
        $this->assertSame(200, $response->getStatusCode());
    }

    public function testListarVendedores()
    {
        $dadosVendedores = [['nome' => 'Vendedor1'], ['nome' => 'Vendedor2'], ['nome' => 'Vendedor3']];

        $this->listarVendedoresService->expects($this->once())
            ->method('listarVendedores')
            ->willReturn($dadosVendedores);

        $response = $this->controller->listarVendedores();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals($dadosVendedores, json_decode($response->getContent(), true));
    }

    public function testDeletarVendedor()
    {
        $vendedorId = 1;
        $vendedorDeletado = true;

        $this->deletarVendedorService->expects($this->once())
            ->method('deletarVendedor')
            ->with($vendedorId)
            ->willReturn($vendedorDeletado);

        $response = $this->controller->deletarVendedor($vendedorId);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(['success' => true, 'message' => 'Vendedor excluído!'], json_decode($response->getContent(), true));
    }
}