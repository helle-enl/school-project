#!/bin/bash

echo "🎬 Starting Laravel..."

# Laravel config build
php artisan config:clear || true
php artisan config:cache || true
php artisan migrate --force || true
php artisan route:cache || true
php artisan view:cache || true

# Start supervisord (nginx + php-fpm)
exec /opt/docker/bin/entrypoint supervisord
