FROM webdevops/php-nginx:8.2

WORKDIR /app

COPY . /app

COPY php.ini /opt/docker/etc/php/php.ini
COPY start.sh /app/start.sh
RUN chmod +x /app/start.sh

# Remove local .env so Laravel uses Render ENV
RUN rm -f /app/.env

RUN composer install --no-dev --optimize-autoloader --no-interaction --no-scripts

# Fix permissions at build time
RUN chown -R application:application /app \
 && chmod -R ug+rw /app/storage /app/bootstrap/cache

# Laravel-specific ENV
ENV WEB_DOCUMENT_ROOT=/app/public
ENV PHP_MEMORY_LIMIT=512M
ENV APP_ENV=production
ENV APP_DEBUG=false
ENV LOG_CHANNEL=stderr
ENV COMPOSER_ALLOW_SUPERUSER=1

# Let Render run it as whatever user it wants — don’t force it
CMD ["/app/start.sh"]
