#!/bin/sh

echo "Aguardando o banco de dados..."
while ! nc -z mysql-db 3306; do
  sleep 1
done

echo "Banco de dados acessível, executando migrações e seeds"

php artisan migrate --force
php artisan db:seed --force

echo "Migrações e seeds concluídas, iniciando Apache"

apache2-foreground
