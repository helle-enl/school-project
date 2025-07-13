FROM webdevops/php-nginx:8.2

# Set working dir
WORKDIR /app

# Copy app source
COPY . /app

# Copy PHP config
COPY php.ini /opt/docker/etc/php/php.ini

# Copy start script
COPY start.sh /app/start.sh

# Make it executable BEFORE switching user
RUN chmod +x /app/start.sh

# Remove .env if it's present to force Laravel to use Render ENV vars
RUN rm -f /app/.env

# Composer install before switching user
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-scripts

# Fix file permissions
RUN chown -R application:application /app \
 && chmod -R ug+rw /app/storage /app/bootstrap/cache

# Set doc root
ENV WEB_DOCUMENT_ROOT=/app/public

# ENV vars for Laravel
ENV PHP_MEMORY_LIMIT=512M
ENV APP_ENV=production
ENV APP_DEBUG=false
ENV LOG_CHANNEL=stderr
ENV COMPOSER_ALLOW_SUPERUSER=1

# Only now switch to application
USER application

# Final command
CMD ["/app/start.sh"]
