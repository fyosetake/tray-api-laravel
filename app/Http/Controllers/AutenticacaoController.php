<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\AutenticarUsuarioRequest;
use App\Services\UserService;

class AutenticacaoController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function autenticar(Request $request)
    {
        $credenciais = $request->only('email', 'password');
        $resultadoAutenticacao = $this->userService->autenticar($credenciais);

        if ($resultadoAutenticacao) {
            return new Response($resultadoAutenticacao, 200);
        }

        return new Response('Suas Credenciais são inválidas!', 401);
    }

    public function registrar(AutenticarUsuarioRequest $request)
    {
        try {
            $user = $this->userService->registrar($request->only('name', 'email', 'password'));

            $token = $user->createToken('appToken')->plainTextToken;

            return new Response(['token' => $token, 'user' => $user], 201);
        } catch (\Exception $e) {
            return new Response(['error' => $e->getMessage()], $e->getCode());
        }
    }
}
