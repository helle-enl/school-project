FROM webdevops/php-nginx:8.2

# Set memory limit
ENV PHP_MEMORY_LIMIT=512M


COPY . /var/www/html

# Override default PHP settings
COPY php.ini /etc/php5/fpm/conf.d/99-custom.ini
COPY php.ini /etc/php5/cli/conf.d/99-custom.ini
# Image config
ENV SKIP_COMPOSER 1
ENV WEBROOT /var/www/html/public
ENV PHP_ERRORS_STDERR 1
ENV RUN_SCRIPTS 1
ENV REAL_IP_HEADER 1

# Laravel config
ENV APP_ENV production
ENV APP_DEBUG false
ENV LOG_CHANNEL stderr

# Allow composer to run as root
ENV COMPOSER_ALLOW_SUPERUSER 1

CMD ["/start.sh"]
