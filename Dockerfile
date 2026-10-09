FROM php:8.4-fpm-alpine

# Dependencias del sistema y librerías de PostgreSQL
RUN apk add --no-cache nginx postgresql-dev libpng-dev libzip-dev zip unzip bash

# Extensiones de PHP para PostgreSQL y matemáticas bancarias
RUN docker-php-ext-install pdo pdo_pgsql bcmath

# Composer oficial
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN composer install --no-dev --optimize-autoloader

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

COPY docker/nginx.conf /etc/nginx/http.d/default.conf

EXPOSE 10000

CMD php-fpm -D && nginx -g "daemon off;"