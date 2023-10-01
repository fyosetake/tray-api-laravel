<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function registrar(array $dados)
    {
        $usuarioCadastrado = $this->userRepository->findByEmail($dados['email']);

        if ($usuarioCadastrado) {
            throw new \Exception('Este e-mail já foi registrado', 400);
        }

        $dados['password'] = Hash::make($dados['password']);

        return $this->userRepository->create($dados);
    }

    public function autenticar(array $credenciais)
    {
        $user = $this->userRepository->findByCredentials($credenciais);

        if ($user && Auth::attempt($credenciais)) {
            $token = $user->createToken('appToken')->plainTextToken;
            return ['token' => $token, 'user' => $user];
        }

        return null;
    }
}