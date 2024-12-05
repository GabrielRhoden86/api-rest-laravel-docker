#!/bin/sh
set -e

# Coloca o sistema em modo de manutenção
php artisan down"

echo "Aguardando o banco de dados..."
timeout=60
elapsed=0

# Cria os diretórios necessários e define as permissões
mkdir -p /var/www/html/api-rest-laravel-docker/storage/logs/
mkdir -p /var/www/html/api-rest-laravel-docker/storage/framework/sessions/
mkdir -p /var/www/html/api-rest-laravel-docker/storage/framework/views/
mkdir -p /var/www/html/api-rest-laravel-docker/bootstrap/cache
mkdir -p /var/www/html/api-rest-laravel-docker/storage/framework/cache/data
touch /var/www/html/api-rest-laravel-docker/storage/logs/laravel.log
chown -R www-data:www-data /var/www/html/api-rest-laravel-docker/storage
chown -R www-data:www-data /var/www/html/api-rest-laravel-docker/bootstrap/cache
chown -R www-data:www-data /var/www/html/api-rest-laravel-docker/storage/framework/sessions
chown -R www-data:www-data /var/www/html/api-rest-laravel-docker/storage/framework/views
chown -R www-data:www-data /var/www/html/api-rest-laravel-docker/storage/logs/laravel.log
chown -R www-data:www-data /var/www/html/api-rest-laravel-docker/storage/framework/cache/data

# Aguarda o banco de dados estar acessível
while ! nc -z mysql-db 3306; do
  sleep 1
  elapsed=$((elapsed + 1))
  if [ $elapsed -ge $timeout ]; then
    echo "Tempo limite excedido para a conexão com o banco de dados"
    exit 1
  fi
done
echo "Banco de dados acessível, executando migrações e seeds"

# Executa migrações e seeds
php artisan migrate --force
php artisan db:seed --force
echo "Migrações e seeds concluídas, iniciando Apache"

# Tira o sistema do modo de manutenção
php artisan up

# Inicia o Apache
exec apache2-foreground
