FROM php:7.0-cli

# PHP additional extensions build & install
RUN apt-get update && apt-get install -y \
    libsqlite3-dev \
    libicu-dev \
    zlib1g-dev \
    libxml2-dev

RUN docker-php-ext-install \
    mbstring \
    simplexml \
    pdo \
    pdo_mysql \
    pdo_sqlite \
    intl \
    zip

# Composer install
RUN php -r "readfile('https://getcomposer.org/installer');" | php
RUN mv composer.phar /usr/local/bin/composer
RUN chmod +x /usr/local/bin/composer

# PHPUnit install
RUN curl https://phar.phpunit.de/phpunit.phar -o /usr/local/bin/phpunit
RUN chmod +x /usr/local/bin/phpunit

# PHP-CS-Fixer install
RUN curl http://get.sensiolabs.org/php-cs-fixer.phar -o /usr/local/bin/php-cs-fixer
RUN chmod +x /usr/local/bin/php-cs-fixer

# Misc additional tools install
RUN apt-get install -y git
