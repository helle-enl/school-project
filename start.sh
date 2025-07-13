#!/bin/bash

# Fail on errors
set -e

# Setup Laravel
echo "Running Laravel setup..."
php artisan config:clear
php artisan key:generate --force
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Start PHP-FPM (used by webdevops/php-nginx)
echo "Starting PHP-FPM..."
php-fpm
