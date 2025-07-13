FROM webdevops/php-nginx:8.2

WORKDIR /app

# Copy app
COPY . /app

# Copy custom PHP config
COPY php.ini /opt/docker/etc/php/php.ini

# Set Laravel public dir
ENV WEB_DOCUMENT_ROOT=/app/public

# Environment config
ENV PHP_MEMORY_LIMIT=512M
ENV APP_ENV=production
ENV APP_DEBUG=true
ENV LOG_CHANNEL=stderr
ENV COMPOSER_ALLOW_SUPERUSER=1

# Install PHP dependencies (no scripts yet)
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-scripts

# Do NOT run artisan commands here
# Let them run at container start where .env exists
