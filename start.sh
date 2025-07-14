#!/bin/bash

echo "🎬 Starting Laravel..."

# Laravel boot commands
php artisan config:clear || true
php artisan config:cache || true
php artisan migrate --force || true
php artisan route:cache || true
php artisan view:cache || true

# Keep container alive by starting nginx + php-fpm
exec supervisord -n
