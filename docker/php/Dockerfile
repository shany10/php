# Use a specific PHP version
ARG PHP_VERSION=8.4.3
FROM php:$PHP_VERSION-fpm

# ARGs for user creation
ARG PHP_USER_NAME=php
ARG PHP_USER_IDENTIFIER=1000
ARG PHP_USER_SHELL=/bin/bash
ARG PHP_USER_HOME_DIRECTORY=/home/php

# Create PHP user
RUN useradd --create-home --system --home-dir $PHP_USER_HOME_DIRECTORY --shell $PHP_USER_SHELL --uid $PHP_USER_IDENTIFIER $PHP_USER_NAME

# Install MySQL client and necessary extensions
RUN apt-get update && apt-get install -y default-mysql-client \
    && docker-php-ext-install pdo_mysql

# Set working directory
WORKDIR /var/www

# Entry point script to run migrations and start app
COPY entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/entrypoint.sh

ENTRYPOINT ["entrypoint.sh"]
