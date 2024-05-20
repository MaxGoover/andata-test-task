ARG PHP_VERSION

FROM php:${PHP_VERSION}-fpm

RUN docker-php-ext-install mysqli

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
