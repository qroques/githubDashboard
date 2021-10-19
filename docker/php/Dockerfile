FROM composer:2.1 as composer

FROM php:8.0-fpm-buster

COPY --from=composer /usr/bin/composer /usr/bin/composer

RUN apt-get update && \
apt-get install -y \
libzip-dev \
libsqlite3-dev \
zip unzip

WORKDIR /usr/src/app

COPY --chown=1000:1000 . /usr/src/app

RUN PATH=$PATH:/usr/src/app/vendor/bin:bin

RUN composer install --no-scripts --prefer-dist \
 && rm -rf "$(composer config cache-dir)" "$(composer config data-dir)"
