#!/bin/sh

set -e

mkdir -p /var/www/public/css
mkdir -p /var/www/templates_c
chmod -R 775 /var/www/templates_c
chown -R www-data:www-data /var/www/templates_c

echo "Installing composer dependencies..."
composer install --no-interaction --prefer-dist

echo "Compiling SCSS..."
sass /var/www/assets/scss:/var/www/public/css --no-source-map --style=compressed
echo "SCSS compiled"

echo "Seeding database..."
php /var/www/config/fixtures.php
echo "Database seeded"

exec "$@"