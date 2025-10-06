FROM php:8.3-fpm-alpine

RUN apk add --no-cache bash git curl libzip-dev oniguruma-dev icu-dev mysql-client \
	&& docker-php-ext-install pdo pdo_mysql intl mbstring zip

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html