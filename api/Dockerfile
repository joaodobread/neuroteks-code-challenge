FROM php:7.2-apache

WORKDIR /var/www/html

RUN a2enmod rewrite
RUN a2enmod headers

RUN docker-php-ext-install pdo pdo_mysql

COPY ./ /var/www/html
