FROM webdevops/php-nginx:8.2

# Set working directory
WORKDIR /app

# Copy full app into the container
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

# Allow Composer to run as root (Render uses root)
ENV COMPOSER_ALLOW_SUPERUSER=1

# Install dependencies AFTER all files have been copied (important!)
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Optional: Laravel optimizations
RUN php artisan key:generate
RUN php artisan config:cache
RUN php artisan route:cache
RUN php artisan view:cache

# No CMD needed – webdevops/php-nginx already starts nginx + PHP-FPM
