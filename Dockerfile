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

RUN mkdir -p /var/www/html/api-rest-laravel-docker/storage/logs/ \
    && mkdir -p /var/www/html/api-rest-laravel-docker/framework/sessions/ \
    && mkdir -p /var/www/html/api-rest-laravel-docker/storage/framework/views/ \
    && chown -R www-data:www-data /var/www/html/api-rest-laravel-docker/storage/logs/ \
    && chown -R www-data:www-data /var/www/html/api-rest-laravel-docker/framework/sessions/ \
    && chown -R www-data:www-data /var/www/html/api-rest-laravel-docker/storage/framework/views/ \
    && chown -R www-data:www-data /var/www/html/api-rest-laravel-docker/storage

RUN cp .env.example .env
RUN php artisan key:generate
RUN php artisan optimize

EXPOSE 80
CMD ["apache2-foreground"]
