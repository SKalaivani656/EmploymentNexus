# -----------------------------
# Laravel Dockerfile for Render (no shell access needed)
# -----------------------------
FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    git unzip libpng-dev libonig-dev libxml2-dev libpq-dev zip curl \
    && docker-php-ext-install pdo pdo_pgsql mbstring exif pcntl bcmath gd

RUN a2enmod rewrite

WORKDIR /var/www/html
COPY . .

COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

RUN sed -i 's|ErrorLog .*|ErrorLog /dev/stderr|' /etc/apache2/apache2.conf && \
    sed -i 's|CustomLog .*|CustomLog /dev/stdout combined|' /etc/apache2/apache2.conf

ENV LOG_CHANNEL=stderr
ENV LOG_LEVEL=debug

RUN php artisan config:clear || true && \
    php artisan cache:clear || true && \
    php artisan view:clear || true && \
    php artisan route:clear || true && \
    php artisan key:generate --force || true

# 👇 Auto-run database migrations
RUN php artisan migrate --force || true

EXPOSE 80
CMD ["apache2-foreground"]
