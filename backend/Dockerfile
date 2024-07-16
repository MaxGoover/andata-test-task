ARG PHP_VERSION

FROM php:${PHP_VERSION}-fpm
COPY composer.lock composer.json /var/www/api/
WORKDIR /var/www/api/

RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    locales \
    locales-all

RUN docker-php-ext-install pdo_mysql \
    gettext

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY . /var/www/api

EXPOSE 9000
CMD ["php-fpm"]