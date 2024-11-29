#! /bin/bash

# modo de segurança
(php artisan down) || true

# pegando as alterações do inseridas no repositório que foram inseridas pelo código local
git pull origin main

# instalar composer
composer install --no-interaction --prefer-dist # usar somente no deploy inicial

php artisan optimize
php artisan config:clear

php artisan migrate --force ## usar somente no deploy inicial
php artisan db:seed --force ## usar somente no deploy inicial
php artisan up
