FROM php:8.3

RUN apt-get update \
  && apt-get install -y build-essential zlib1g-dev default-mysql-client curl gnupg procps vim git unzip libzip-dev libpq-dev \
  && docker-php-ext-install zip pdo_mysql pdo_pgsql pgsql

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"
RUN mv composer.phar /usr/local/bin/composer

ENV COMPOSER_ALLOW_SUPERUSER 1
ENV COMPOSER_HOME /composer
ENV PATH $PATH:/composer/vendor/bin
RUN composer config --global process-timeout 3600
RUN composer global require "laravel/installer"

WORKDIR /lark

COPY . .

RUN composer install

RUN php artisan serve