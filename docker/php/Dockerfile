# Utiliser une version stable de PHP (dernière version stable connue)
ARG PHP_VERSION=8.0.0
FROM php:$PHP_VERSION-fpm

# Définition des arguments
ARG PHP_USER_NAME=www-data
ARG PHP_USER_IDENTIFIER=1000
ARG PHP_USER_SHELL=/bin/bash
ARG PHP_USER_HOME_DIRECTORY=/home/php

# Créer un utilisateur système
RUN useradd --create-home --system --home-dir $PHP_USER_HOME_DIRECTORY --shell $PHP_USER_SHELL --uid $PHP_USER_IDENTIFIER $PHP_USER_NAME

# Installer les dépendances nécessaires, y compris dos2unix
RUN apt-get update && apt-get install -y \
   default-mysql-client \
   netcat \
   dos2unix \
   && docker-php-ext-install pdo_mysql


# Set working directory
WORKDIR /var/www

# Copier le fichier entrypoint
COPY entrypoint.sh /usr/local/bin/entrypoint.sh

# Convertir les fins de ligne du script en format Unix
RUN dos2unix /usr/local/bin/entrypoint.sh

# S'assurer que le script est exécutable
RUN chmod +x /usr/local/bin/entrypoint.sh

# Définir le point d'entrée correctement
ENTRYPOINT ["/bin/bash", "/usr/local/bin/entrypoint.sh"]
