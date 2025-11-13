# -----------------------------
# 1. Use official PHP image with Apache
# -----------------------------
FROM php:8.2-apache

# -----------------------------
# 2. Install system dependencies
# -----------------------------
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    zip \
    curl && \
    docker-php-ext-install pdo pdo_mysql pdo_pgsql mbstring exif pcntl bcmath gd

# -----------------------------
# 3. Enable Apache Rewrite
# -----------------------------
RUN a2enmod rewrite

# -----------------------------
# 4. Copy project files to container
# -----------------------------
WORKDIR /var/www/html
COPY . .

# -----------------------------
# 5. Install Composer dependencies
# -----------------------------
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# -----------------------------
# 6. Set correct permissions for Laravel
# -----------------------------
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# -----------------------------
# 7. Set Apache logs to go to Render logs
# -----------------------------
RUN sed -i 's|ErrorLog .*|ErrorLog /dev/stderr|' /etc/apache2/apache2.conf && \
    sed -i 's|CustomLog .*|CustomLog /dev/stdout combined|' /etc/apache2/apache2.conf

# -----------------------------
# 8. Set environment variables for Laravel logging
# -----------------------------
ENV LOG_CHANNEL=stderr
ENV LOG_LEVEL=debug

# -----------------------------
# 9. Clear Laravel cache and generate key (safe even if key exists)
# -----------------------------
RUN php artisan config:clear || true && \
    php artisan cache:clear || true && \
    php artisan view:clear || true && \
    php artisan route:clear || true && \
    php artisan key:generate --force || true

# -----------------------------
# 10. Automatically run database migrations (no shell needed)
# -----------------------------
RUN php artisan migrate --force || true

# -----------------------------
# 11. Expose port and start Apache
# -----------------------------
EXPOSE 80
CMD ["apache2-foreground"]
