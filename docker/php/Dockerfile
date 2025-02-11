# Utiliser une version stable de PHP (dernière version stable connue)
ARG PHP_VERSION=8.4.3
FROM php:$PHP_VERSION-fpm

# Définition des arguments
ARG PHP_USER_NAME=php
ARG PHP_USER_IDENTIFIER=1000
ARG PHP_USER_SHELL=/bin/bash
ARG PHP_USER_HOME_DIRECTORY=/home/php

# Créer un utilisateur système
RUN useradd --create-home --system --home-dir $PHP_USER_HOME_DIRECTORY --shell $PHP_USER_SHELL --uid $PHP_USER_IDENTIFIER $PHP_USER_NAME

# Installer les dépendances nécessaires
RUN apt-get update && apt-get install -y \
   default-mysql-client \
   netcat \
   && docker-php-ext-install pdo_mysql

# Copier le fichier entrypoint et s'assurer qu'il est exécutable
COPY entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# Définir le point d'entrée correctement
ENTRYPOINT ["/bin/sh", "/usr/local/bin/entrypoint.sh"]
