#!/bin/sh
php artisan down --message="Sistema em manutenção!"

echo "Aguardando o banco de dados..."
timeout=60
elapsed=0
while ! nc -z mysql-db 3306; do
  sleep 1
  elapsed=$((elapsed + 1))
  if [ $elapsed -ge $timeout ]; then
    echo "Tempo limite excedido para a conexão com o banco de dados"
    exit 1
  fi
done
echo "Banco de dados acessível, executando migrações e seeds"

php artisan migrate --force
php artisan db:seed --force
echo "Migrações e seeds concluídas, iniciando Apache"

php artisan up

httpd-foreground
