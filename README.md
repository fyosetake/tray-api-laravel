# Tray-retail-sales-pro

Este é um projeto em Laravel que contém APIs para operações relacionadas ao cadastro de Vendedores e Vendas com base de dados MySQL.

## Pré-requisitos

- [Laravel](https://laravel.com/)
- [PHP](https://www.php.net/)
- [Composer](https://getcomposer.org/)
- [Docker](https://www.docker.com/)

## Versões utilizadas

- PHP 8.2.10
- Laravel v10.24.0
- Composer version 2.5.8
- Docker version 24.0.6 (build ed223bc)

## Instalação

1. Clone o repositório:

```bash

git clone git@github.com:fyosetake/tray-retail-sales-pro.git

```

2. Navegue até o diretório do projeto:

```bash

cd tray-retail-sales-pro

```

3. Instale as dependências do Composer:

```bash

composer install

```

## Construa as imagens e inicie os Containeres no Docker

1. Construa as imagens da aplicação Laravel e do Banco de dados MySQL:

```bash

docker-compose build

```

2. Inicie os Containeres:

```bash

docker-compose up -dV

```

## Execute as Migrations

Para executar as Migrations, acesse o container do Laravel:

1. Certifique-se de que o container esteja em execução.

2. No terminal, execute o seguinte comando para obter o CONTAINER ID da aplicação Laravel:

```bash

docker ps

```

3. Acesse o container do Laravel:

```bash

docker exec -it {CONTAINER ID} bash

```

4. No container, execute o comando Artisan para rodar as Migrations:

```bash

php artisan migrate

```

5. No container, execute o comando Artisan para rodar os Seeders:

```bash

php artisan make:seeder VendaSeeder

```

```bash

php artisan make:seeder VendedorSeeder

```

## Instruções para testes

Para rodar os testes de unidade, basta executar o seguinte comando:

```bash

php artisan test

```

## Instruções de uso

Conforme o desafio proposto, o uso pode ser assim definido:

1. Listar Vendas:

```bash

curl -i -H "Authorization: Bearer {token}" -X GET http://localhost:80/api/listarVendas

```

2. Listar Vendedores:

```bash

curl -i -H "Authorization: Bearer {token}" -X GET http://localhost:80/api/listarVendedores

```

3. Listar as Vendas de um Vendedor:

```bash

curl -i -H "Authorization: Bearer {token}" -X GET http://localhost:80/api/listarVendas/Vendedor/{vendedor_id}

```

4. Cadastrar uma Venda:

```bash

curl -i -X POST -H "Content-Type: application/json" -H "Authorization: Bearer {token}"  
-d '{"vendedor_id": 1, "valor": 10000, "data": "2023-09-30"}' http://localhost:80/api/cadastrarVenda

```

5. Cadastrar um Vendedor:

```bash

curl -i -X POST -H "Content-Type: application/json" -H "Authorization: Bearer {token}"  
-d '{"nome":"Fernando Yosetake", "email":"fyosetake@gmail.com"}' http://localhost:80/api/cadastrarVendedor

```

6. Excluir um Vendedor:

```bash

curl -i -X DELETE -H "Authorization: Bearer {token}" http://localhost:80/api/deletarVendedor/1

```

7. Editar um Vendedor:

```bash

curl -i -X PUT -H "Content-Type: application/json" -H "Authorization: Bearer {token}"  
-d '{"nome":"Fernando Yosetake", "email":"fyosetake@gmail.com"}' http://localhost:80/api/editarVendedor/20

```

7. Enviar e-mail para Vendedor ou Administrador:

```bash

curl -i -X POST -H "Content-Type: application/json" -H "Authorization: Bearer {token}"  
-d '{"email":"fyosetake@gmail.com", "perfil":"Administrador"}' http://localhost:80/api/enviarEmail

```