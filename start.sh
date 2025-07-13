#!/bin/bash

echo "🎬 Starting Laravel..."

# Laravel needs no .env in container — use Render ENV
rm -f /app/.env

# Permissions fix
chown -R application:application /app
chmod -R ug+rw /app/storage /app/bootstrap/cache

# Laravel boot logic
php artisan config:clear
php artisan config:cache
php artisan migrate --force
php artisan route:cache
php artisan view:cache

# Start supervisord (nginx + php-fpm)
exec /opt/docker/bin/entrypoint supervisord
