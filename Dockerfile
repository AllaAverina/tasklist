FROM php:8.1-apache

RUN a2enmod rewrite

RUN docker-php-ext-install pdo pdo_mysql

WORKDIR /var/www

RUN chown -R www-data:www-data /var/www