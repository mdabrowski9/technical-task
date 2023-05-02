FROM php:8.2-fpm

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN apt-get update
RUN apt-get install -y git zip zlib1g-dev libzip-dev zip && docker-php-ext-install zip pdo pdo_mysql

RUN pecl install xdebug && docker-php-ext-enable xdebug && pecl clear-cache

ADD xdebug.ini "$PHP_INI_DIR/conf.d/docker-php-ext-xdebug.ini"