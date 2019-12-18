FROM php:7.2-apache

RUN apt-get update && apt-get install -y \
  vim \
  less \
&& docker-php-ext-install pdo_mysql
RUN pecl install xdebug \
   && docker-php-ext-enable xdebug