FROM php:7.4-apache

WORKDIR /var/www/html

COPY . .

RUN mkdir -p /data && chown -R www-data:www-data /data

