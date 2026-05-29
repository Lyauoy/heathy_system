FROM php:8.3-cli

RUN apt-get update && apt-get install -y \
    git unzip zip curl libpq-dev nodejs npm \
    && docker-php-ext-install pdo pdo_pgsql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .

RUN composer install --no-dev --optimize-autoloader

<<<<<<< HEAD
RUN php artisan config:clear
RUN php artisan config:cache
RUN php artisan route:cache
RUN php artisan view:cache
=======
RUN npm install && npm run build
>>>>>>> ba6491f (add dockerfile)

RUN cp .env.example .env

RUN php artisan key:generate

EXPOSE 10000

CMD php artisan serve --host=0.0.0.0 --port=10000
