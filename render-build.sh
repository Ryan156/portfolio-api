#!/usr/bin/env bash

set -o errexit

composer install --no-dev --optimize-autoloader --no-interaction

php artisan config:clear
php artisan route:clear
php artisan view:clear

php artisan migrate --force

php artisan config:cache
php artisan route:cache
php artisan view:cache

php-fpm -D
nginx -g "daemon off;"
