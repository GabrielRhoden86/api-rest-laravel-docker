
FROM php:8.2.5-apache

WORKDIR /var/www/html/teste-dev-php

RUN apt-get update && \
    apt-get install -y \
    git \
    libzip-dev \
    libpng-dev \
    libicu-dev \
    libpq-dev \
    libmagickwand-dev

# Instalação de extensões PHP
RUN docker-php-ext-install pdo_mysql zip exif pcntl bcmath gd
RUN a2enmod rewrite
RUN sed -i 's!/var/www/html!/var/www/html/teste-dev-php/public!g' /etc/apache2/sites-available/000-default.conf

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY . /var/www/html/teste-dev-php/
RUN composer install

# Garantir que os diretórios existam antes de aplicar chown
RUN mkdir -p /var/www/html/teste-dev-php/storage/logs/ \
    && mkdir -p /var/www/html/teste-dev-php/framework/sessions/ \
    && mkdir -p /var/www/html/teste-dev-php/storage/framework/views/ \
    && chown -R www-data:www-data /var/www/html/teste-dev-php/storage/logs/ \
    && chown -R www-data:www-data /var/www/html/teste-dev-php/framework/sessions/ \
    && chown -R www-data:www-data /var/www/html/teste-dev-php/storage/framework/views/ \
    && chown -R www-data:www-data /var/www/html/teste-dev-php/storage

# Adiciona os comandos solicitados
RUN cp .env.example .env
RUN php artisan key:generate
RUN php artisan optimize

EXPOSE 80
CMD ["apache2-foreground"]
