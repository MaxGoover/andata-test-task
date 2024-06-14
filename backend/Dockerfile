ARG PHP_VERSION

FROM php:${PHP_VERSION}-fpm
COPY composer.lock composer.json /var/www/api/
WORKDIR /var/www/api/

RUN docker-php-ext-install pdo_mysql

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
COPY . /var/www/api

EXPOSE 9000
CMD ["php-fpm"]