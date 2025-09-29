FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    git zip unzip libzip-dev libicu-dev libonig-dev \
 && docker-php-ext-install pdo pdo_mysql intl bcmath \
 && docker-php-ext-configure intl \
 && pecl install xdebug \
 && docker-php-ext-enable xdebug \
 && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html