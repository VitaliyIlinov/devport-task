#https://hub.docker.com/_/php
FROM php:8.2-fpm
MAINTAINER vitaliy ilinov <ilinov123@gmail.com>

ARG XDEBUG="off"

WORKDIR /var/www

ENV DEBIAN_FRONTEND noninteractive

# Install and enable additional extensions
COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/bin/
## https://github.com/mlocati/docker-php-extension-installer
RUN install-php-extensions @composer \
    gd \
    exif \
    imagick \
    zip \
    opcache \
    memcached \
    pcntl \
    redis \
    pdo_mysql \
    && mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

# xdebug
RUN if [ "$XDEBUG" = "on" ] ;  \
    then pecl install xdebug && docker-php-ext-enable xdebug \
        && echo "xdebug.mode = develop,debug" >> /usr/local/etc/php/conf.d/xdebug.ini \
        && echo "xdebug.discover_client_host=1" >> /usr/local/etc/php/conf.d/xdebug.ini \
        && echo "xdebug.start_with_request=yes" >> /usr/local/etc/php/conf.d/xdebug.ini \
        && echo "xdebug.client_host=host.docker.internal" >> /usr/local/etc/php/conf.d/xdebug.ini; \
    fi

# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    locales \
    nano \
    zip \
    unzip \
    wget \
    default-mysql-client \
    curl \
    && apt-get -y autoremove \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*
