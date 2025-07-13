FROM webdevops/php-nginx:8.2

# Set working directory
WORKDIR /app

# Copy app files
COPY . /app

# Override PHP memory limit
ENV PHP_MEMORY_LIMIT=512M

# Override default PHP settings (correct path for this image)
COPY php.ini /opt/docker/etc/php/php.ini

# Set Laravel public path for Nginx
ENV WEB_DOCUMENT_ROOT=/app/public

# Laravel runtime environment
ENV APP_ENV=production
ENV APP_DEBUG=false
ENV LOG_CHANNEL=stderr

# Allow composer to run as root (if needed)
ENV COMPOSER_ALLOW_SUPERUSER=1

# NO CMD needed - image handles PHP-FPM + Nginx
