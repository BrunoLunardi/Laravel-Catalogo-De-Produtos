
--Criação do projeto (Escolha uma pasta e digite):

composer create-project laravel/laravel olaMundo

--Subir servidor local:

php artisan serve

--Criar models laravel com migration:

php artisan make:model NomeDaModel --migration

--Criar um controller

php artisan make:controller NomeDaControlller

--Configuração do Banco de Dados:

Arquivos .env (raiz do projeto - usado para teste local) e /config/database.php

--Instalação do bootstrap:

composer require twbs/bootstrap

--JQuery

https://code.jquery.com/jquery-3.4.1.min.js

--Instalar classe HTML no laravel. (laravelcollective mantém classes removida do core do Laravel):

composer require "laravelcollective/html":"^5.3.0"

--Atualizar pacotes:

composer update

--Instalar biblioteca HTTP Guzzle (envio de e-amil pelo laravel):

composer require guzzlehttp/guzzle
