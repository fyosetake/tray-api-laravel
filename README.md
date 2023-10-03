# Tray API Laravel

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

git clone git@github.com:fyosetake/tray-api-laravel.git

```

2. Navegue até o diretório do projeto:

```bash

cd tray-api-laravel

```

3. Gere o arquivo '.env' à partir do '.env.example':

```bash

cp .env.example .env

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

```bash

docker ps

```

2. Os próximo comandos serão direcionados para o container, bastando executá-los no diretório do projeto.

3. Execute o 'composer install':

```bash

docker exec api-tray composer install

```

4. Execute o comando para gerar uma 'chave de aplicativo' Laravel:

```bash

docker exec api-tray php artisan key:generate

```

5. Execute o comando para rodar o cron:

```bash

docker exec api-tray cron

```

4. Execute o comando Artisan para rodar as Migrations:

```bash

docker exec api-tray php artisan migrate

```

5. Execute o comando Artisan para rodar as Seeders:

```bash

docker exec api-tray php artisan db:seed --class=VendaSeeder

docker exec api-tray php artisan db:seed --class=VendedorSeeder

```

6. Rode os testes unitários:

```bash

docker exec api-tray php artisan test

```

7. Inicie o servidor de desenvolvimento embutido no Laravel:

```bash

docker exec api-tray php artisan serve --host=0.0.0.0 --port=80

```

## Instruções de uso através da aplicação VUE

Conforme o desafio proposto, o acesso às APIS poderá ser feito através da aplicação VUE disponível neste repositório:

https://github.com/fyosetake/tray-api-vue

## Instruções de uso através do acesso direto aos endpoints via CURL

É possível também acessar individualmente os endpoints. Abaixo estão alguns exemplos:

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