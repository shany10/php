#!/bin/bash

# Attendre que la base de données soit prête
echo "En attente que la base de données soit prête..."
until php -r "
    try {
        new PDO('mysql:host=mariadb;dbname=$DATABASE_NAME', '$DATABASE_USER', '$DATABASE_PASSWORD');
        exit(0);
    } catch (PDOException \$e) {
        exit(1);
    }
" >/dev/null 2>&1; do
  sleep 5
done
echo "La base de données est prête !"

# Vérifier et exécuter les migrations (si des fichiers de migration existent)
if [ -d "./migrations" ] && [ $(ls ./migrations/*.php 2>/dev/null | wc -l) -gt 0 ]; then
    echo "Exécution des migrations..."
    for migration_file in ./migrations/*.php; do
        echo "Exécution de la migration : $migration_file"
        php "$migration_file" || { echo "Erreur lors de la migration"; exit 1; }
    done
    echo "Migrations terminées!"
else
    echo "Aucune migration à exécuter."
fi

# Démarrer PHP-FPM après les migrations (ou directement si aucune migration)
echo "Démarrage de PHP-FPM..."
exec php-fpm
