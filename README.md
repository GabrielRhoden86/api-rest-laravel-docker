# API Rest para Cadastro de Fornecedores

Esta API permite o cadastro de fornecedores, permitindo a busca por CNPJ ou CPF, utilizando Laravel no backend.

## CRUD de Fornecedores

Através do padrão de projeto Repository, utilizando a interface `FornecedoresRepositoryInterface.php` e o repositório `FornecedoresRepository.php`, é possível atingir modularidade e escalabilidade na aplicação. Isso permite uma separação clara entre a lógica de negócios e a lógica de acesso a dados, facilitando a manutenção e a expansão do sistema.

## Estrutura do Projeto

```plaintext
app/
├── Providers/
│   └── RepositoryServiceProvider.php
|
├── Repositories/
|   |
│   |── BuscarDados/
|   |  └── BuscaDadosRepository.php
|   |
│   ├── Fornecedores/
│   │   └── FornecedoresRepository.php
|   |
│   ├── Interfaces/
│   │   ├── FornecedoresRepositoryInterface.php
│   │   └── BuscaDadosRepositoryInterface.php


## Deploy via Docker
Após baixar o projeto do repositório (GitHub), execute os seguintes comandos:

docker-compose up --build -d

## Realizar as Migrations no Container
php artisan migrate
php artisan db:seed

## Seeders
Executando seeders para criação de fornecedores fake para teste:
