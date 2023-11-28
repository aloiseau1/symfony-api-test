FROM php:8.2-rc-fpm

RUN apt-get update && \
    apt-get upgrade -y

#install some basic tools
RUN apt-get install -y \
        git \
        tree \
        vim \
        wget \
        zlib1g-dev \
        zip \
        subversion

RUN apt-get update \
    && apt-get install -qq -y --no-install-recommends \
    cron \
     vim \
     locales coreutils apt-utils git libicu-dev g++ libpng-dev libxml2-dev libzip-dev libonig-dev libxslt-dev;

RUN docker-php-ext-install pdo pdo_mysql zip 

RUN pecl install xdebug && docker-php-ext-enable xdebug

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/