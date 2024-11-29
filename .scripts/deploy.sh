#! /bin/bash

# modo de segurança
(php artisan down --message="Sistema em manutenção!") || true

# pegando as alterações do inseridas no repositório que foram inseridas pelo código local
git pull origin main

# instalar composer
composer install --no-dev --no-interaction --prefer-dist --optimize-autloader

php artisan optimize
php artisan config:clear

php artisan migrate --force
php artisan db:seed --force
php artisan up
