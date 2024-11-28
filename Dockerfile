FROM php:8.2.5-apache

# Instalar dependências
RUN apt-get update && \
    apt-get install -y \
    git \
    libzip-dev \
    libpng-dev \
    libicu-dev \
    libpq-dev \
    libmagickwand-dev \
    nano

# Instalar extensões PHP
RUN docker-php-ext-install pdo_mysql zip exif pcntl bcmath gd

# Habilitar mod_rewrite no Apache
RUN a2enmod rewrite

# Configurar o Apache para usar a pasta pública do Laravel
RUN sed -i 's!/var/www/html!/var/www/html/api-rest-laravel-docker/public!g' /etc/apache2/sites-available/000-default.conf

# Instalar Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copiar o código da aplicação para o container
COPY . /var/www/html/api-rest-laravel-docker/
WORKDIR /var/www/html/api-rest-laravel-docker/

# Instalar dependências do Laravel
RUN composer install

# Configurar variáveis de ambiente e otimizar aplicação
RUN cp .env.example .env
RUN php artisan key:generate
RUN php artisan optimize

# Criar e configurar permissões das pastas de armazenamento e cache
RUN mkdir -p /var/www/html/api-rest-laravel-docker/storage/logs/ && \
    mkdir -p /var/www/html/api-rest-laravel-docker/storage/framework/sessions/ && \
    mkdir -p /var/www/html/api-rest-laravel-docker/storage/framework/views/ && \
    mkdir -p /var/www/html/api-rest-laravel-docker/bootstrap/cache && \
    mkdir -p /var/www/html/api-rest-laravel-docker/storage/framework/cache/data && \
    touch /var/www/html/api-rest-laravel-docker/storage/logs/laravel.log && \
    chown -R www-data:www-data /var/www/html/api-rest-laravel-docker/storage && \
    chown -R www-data:www-data /var/www/html/api-rest-laravel-docker/bootstrap/cache && \
    chown -R www-data:www-data /var/www/html/api-rest-laravel-docker/storage/framework/sessions && \
    chown -R www-data:www-data /var/www/html/api-rest-laravel-docker/storage/framework/views && \
    chown -R www-data:www-data /var/www/html/api-rest-laravel-docker/storage/logs/laravel.log && \
    chown -R www-data:www-data /var/www/html/api-rest-laravel-docker/storage/framework/cache/data

# Adicionar o script wait-for-db.sh
COPY wait-for-db.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/wait-for-db.sh

# Expor a porta do Apache
EXPOSE 80

# Executar migrações e seeds após o banco estar disponível
CMD ["sh", "-c", "wait-for-db.sh db && php artisan migrate && php artisan db:seed && apache2-foreground"]
