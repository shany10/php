#!/bin/bash

# Wait for MariaDB to be ready
until mysql -h mariadb -u $DATABASE_USER -p$DATABASE_PASSWORD $DATABASE_NAME -e "SELECT 1"; do
  echo "Waiting for mariadb..."
  sleep 2
done

# Run migrations
for migration in ./migrations/*.php; do
  echo "Running migration: $migration"
  php $migration
done

# Start the PHP application
exec php-fpm
