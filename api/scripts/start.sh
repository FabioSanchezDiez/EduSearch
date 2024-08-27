#!/usr/bin/env bash

echo "Running composer"
composer install --optimize-autoloader

echo "Caching config..."
APP_ENV=prod APP_DEBUG=0 php bin/console cache:clear

echo "Running database migrations..."
APP_ENV=prod php bin/console doctrine:migrations:migrate -n

echo "Generating jwt keypair..."
APP_ENV=prod php bin/console lexik:jwt:generate-keypair --skip-if-exists