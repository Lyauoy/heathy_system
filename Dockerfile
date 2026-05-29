FROM php:8.3-apache

RUN apt-get update && apt-get install -y \
    git unzip zip curl libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN composer install --no-dev --optimize-autoloader

RUN php artisan config:cache
RUN php artisan route:cache
RUN php artisan view:cache

RUN chown -R www-data:www-data storage bootstrap/cache

EXPOSE 80

CMD php artisan migrate --force && apache2-foreground
