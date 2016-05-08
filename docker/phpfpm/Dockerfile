FROM php:7.0-fpm

# PHP additional extensions build & install
RUN apt-get update && apt-get install -y \
    libsqlite3-dev \
    libicu-dev \
    zlib1g-dev

RUN docker-php-ext-install \
    mbstring \
    pdo \
    pdo_mysql \
    pdo_sqlite \
    intl \
    zip
