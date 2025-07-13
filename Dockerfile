FROM webdevops/php-nginx:8.2

# Set working directory
WORKDIR /app

# Copy composer files early to cache dependencies
COPY composer.json composer.lock ./

# Install PHP dependencies (prod mode, optimized autoload)
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Now copy the rest of your app files
COPY . /app

# Set PHP memory limit
ENV PHP_MEMORY_LIMIT=512M

# Override default PHP settings (correct path for this image)
COPY php.ini /opt/docker/etc/php/php.ini

# Laravel public path for Nginx
ENV WEB_DOCUMENT_ROOT=/app/public

# Laravel runtime environment
ENV APP_ENV=production
ENV APP_DEBUG=false
ENV LOG_CHANNEL=stderr

# Allow composer to run as root (Render runs as root)
ENV COMPOSER_ALLOW_SUPERUSER=1

# Optional: run artisan commands on container boot (uncomment if needed)
RUN php artisan config:cache
RUN php artisan route:cache
RUN php artisan view:cache
RUN php artisan key:generate

# No CMD required; webdevops handles PHP-FPM + Nginx
