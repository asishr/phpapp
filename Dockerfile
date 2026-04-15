FROM composer:2 AS deps
WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --prefer-dist --no-interaction --optimize-autoloader

FROM php:8.2-apache
WORKDIR /var/www/html
COPY . /var/www/html
COPY --from=deps /app/vendor /var/www/html/vendor
EXPOSE 80
