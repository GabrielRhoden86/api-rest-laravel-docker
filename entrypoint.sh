#!/bin/sh

# Espera o banco de dados estar acessível
echo "Aguardando o banco de dados..."
while ! nc -z db 3306; do
  sleep 1
done

# Executa as migrações e seeds
php artisan migrate --force
php artisan db:seed --force

# Inicia o Apache
apache2-foreground
