FROM php:8.4-fpm-alpine

# Dependencias del sistema, librerías de PostgreSQL y Node.js para Vite
RUN apk add --no-cache nginx postgresql-dev libpng-dev libzip-dev zip unzip bash nodejs npm

# Extensiones de PHP
RUN docker-php-ext-install pdo pdo_pgsql bcmath

# Composer oficial
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

# Dependencias PHP
RUN composer install --no-dev --optimize-autoloader

# Compilación de assets de Vite / Tailwind
RUN npm install && npm run build

# Permisos de almacenamiento y caché
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/public/build

# Configuración Nginx
COPY docker/nginx.conf /etc/nginx/http.d/default.conf

EXPOSE 10000

CMD php-fpm -D && nginx -g "daemon off;"