FROM webdevops/php-nginx:8.2

# Set working directory
WORKDIR /app

# Copy app code
COPY . /app

# Copy php.ini for config override
COPY php.ini /opt/docker/etc/php/php.ini

# Laravel public path
ENV WEB_DOCUMENT_ROOT=/app/public

# PHP memory + Laravel environment
ENV PHP_MEMORY_LIMIT=512M
ENV APP_ENV=production
ENV APP_DEBUG=false
ENV LOG_CHANNEL=stderr

# Composer as root
ENV COMPOSER_ALLOW_SUPERUSER=1

# --- SETUP ---

# Copy .env if you have a production one (Optional: comment this out if you generate it dynamically)
# COPY .env.example .env

# Install composer dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Laravel commands
RUN php artisan config:cache \
 && php artisan route:cache \
 && php artisan view:cache \
 && php artisan migrate --force
