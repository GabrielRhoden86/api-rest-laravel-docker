#! /bin/bash

# modo de segurança
(php artisan down) || true

# pegando as alterações do inseridas no repositório que foram inseridas pelo código local
git pull origin main
php artisan optimize
php artisan up
