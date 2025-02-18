#!/bin/bash 

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

if [ -d "./migrations" ] && [ $(ls ./migrations/*.php 2>/dev/null | wc -l) -gt 0 ]; then
    echo "Exécution des migrations..."
    for migration_file in ./migrations/*.php; do
        echo -e "\nExécution de la migration : $migration_file"
        php "$migration_file" || { echo "Erreur lors de la migration"; exit 1; }
    done
    echo -e "\nMigrations terminées!"
else
    echo "Aucune migration à exécuter."
fi

echo "Démarrage de PHP-FPM..."
exec php-fpm

