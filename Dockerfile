FROM webdevops/php-nginx:8.2

WORKDIR /app

# Copy app source
COPY . /app

# Copy PHP config
COPY php.ini /opt/docker/etc/php/php.ini

# Copy start script
COPY start.sh /app/start.sh
RUN chmod +x /app/start.sh

# Set Laravel doc root
ENV WEB_DOCUMENT_ROOT=/app/public

# ENV variables (Laravel, PHP)
ENV PHP_MEMORY_LIMIT=512M
ENV APP_ENV=production
ENV APP_DEBUG=false
ENV LOG_CHANNEL=stderr
ENV COMPOSER_ALLOW_SUPERUSER=1

# Install PHP dependencies (no scripts)
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-scripts

# Final permissions
RUN chown -R application:application /app

USER application

# Run custom start script instead of default CMD
CMD ["/app/start.sh"]
