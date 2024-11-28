FROM php:8.2.5-apache

RUN apt-get update && \
    apt-get install -y \
    git \
    libzip-dev \
    libpng-dev \
    libicu-dev \
    libpq-dev \
    libmagickwand-dev \
    nano

RUN docker-php-ext-install pdo_mysql zip exif pcntl bcmath gd
RUN a2enmod rewrite
RUN sed -i 's!/var/www/html!/var/www/html/api-rest-laravel-docker/public!g' /etc/apache2/sites-available/000-default.conf

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY . /var/www/html/api-rest-laravel-docker/
WORKDIR /var/www/html/api-rest-laravel-docker/
RUN composer install

RUN cp .env.example .env
RUN php artisan key:generate
RUN php artisan optimize

RUN mkdir -p /var/www/html/api-rest-laravel-docker/storage/logs/
RUN mkdir -p /var/www/html/api-rest-laravel-docker/storage/framework/sessions/
RUN mkdir -p /var/www/html/api-rest-laravel-docker/storage/framework/views/
RUN mkdir -p /var/www/html/api-rest-laravel-docker/bootstrap/cache
RUN mkdir -p /var/www/html/api-rest-laravel-docker/storage/framework/cache/data
RUN touch /var/www/html/api-rest-laravel-docker/storage/logs/laravel.log
RUN chown -R www-data:www-data /var/www/html/api-rest-laravel-docker/storage
RUN chown -R www-data:www-data /var/www/html/api-rest-laravel-docker/bootstrap/cache
RUN chown -R www-data:www-data /var/www/html/api-rest-laravel-docker/storage/framework/sessions
RUN chown -R www-data:www-data /var/www/html/api-rest-laravel-docker/storage/framework/views
RUN chown -R www-data:www-data /var/www/html/api-rest-laravel-docker/storage/logs/laravel.log
RUN chown -R www-data:www-data /var/www/html/api-rest-laravel-docker/storage/framework/cache/data

RUN php artisan migrate
RUN php artisan db:seed

EXPOSE 80

# Executar migrações e seeds após o banco estar disponível
CMD ["sh", "-c", "php artisan migrate && php artisan db:seed && apache2-foreground"]
