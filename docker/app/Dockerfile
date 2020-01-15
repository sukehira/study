FROM php:7.2-apache

RUN apt-get update && apt-get install -y \
  vim \
  less \
  imagemagick libmagickwand-dev \
&& pecl install imagick \
&& docker-php-ext-enable imagick \
&& docker-php-ext-install pdo_mysql
RUN pecl install xdebug \
   && docker-php-ext-enable xdebug