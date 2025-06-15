FROM php:8.1-fpm

# Instalar extensiones necesarias
RUN apt-get update && apt-get install -y \
    git zip unzip libzip-dev libonig-dev libpng-dev libjpeg-dev libfreetype6-dev \
    libxml2-dev libcurl4-openssl-dev libpq-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql zip mbstring exif pcntl bcmath gd xml curl

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Establecer directorio de trabajo
WORKDIR /var/www/html

# Copiar archivos del proyecto
COPY . .

# Instalar dependencias
RUN composer install --no-dev --optimize-autoloader

# Permisos para Laravel
RUN chown -R www-data:www-data storage bootstrap/cache

# Variables de entorno de Laravel
ENV APP_ENV=production
ENV APP_DEBUG=false

# Exponer el puerto de Laravel
EXPOSE 8000

# Comandos iniciales (migraciones, seeders y servidor)
CMD php artisan config:clear && \
    php artisan migrate --force && \
    php artisan db:seed --class=RoleSeeder --force && \
    php artisan db:seed --force && \
    php artisan serve --host=0.0.0.0 --port=8000
