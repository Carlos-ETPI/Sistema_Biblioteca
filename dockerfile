FROM php:8.1-fpm

RUN apt-get update && apt-get install -y \
    git zip unzip libzip-dev libonig-dev libpng-dev libjpeg-dev libfreetype6-dev libxml2-dev libcurl4-openssl-dev \
    && docker-php-ext-install pdo_mysql zip mbstring exif pcntl bcmath gd xml curl

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN composer install --no-dev --optimize-autoloader

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 8000

CMD php artisan migrate --force && \
    php artisan db:seed --class=RoleSeeder --force && \
    php artisan db:seed --force && \
    php artisan serve --host=0.0.0.0 --port=8000
