FROM php:8.3-fpm-alpine

RUN apk add --no-cache sqlite-dev icu-dev libzip-dev zip git \
    && docker-php-ext-install pdo_sqlite intl zip pcntl

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# deps dulu (cache layer)
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-scripts --no-autoloader --prefer-dist

COPY . .
RUN composer dump-autoload --optimize \
    && chmod -R a+rX /var/www/html \
    && chown -R www-data:www-data storage bootstrap/cache database

USER www-data

EXPOSE 9000

CMD ["php-fpm"]
