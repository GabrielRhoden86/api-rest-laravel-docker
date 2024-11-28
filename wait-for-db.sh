#!/bin/sh

# Verificar se o banco de dados está acessível
host="$1"
shift
cmd="$@"

echo "Aguardando o banco de dados ($host) ficar disponível..."

until mysqladmin ping -h "$host" --silent; do
  >&2 echo "Banco de dados indisponível - tentando novamente..."
  sleep 2
done

>&2 echo "Banco de dados disponível - continuando execução"
exec $cmd
