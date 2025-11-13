# Use official PHP 8.2 + Apache image
FROM php:8.2-apache

# Install system dependencies for PostgreSQL and common PHP extensions
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libzip-dev \
    unzip \
    zip \
    git \
    curl \
    && docker-php-ext-install pdo pdo_pgsql

# Enable Apache mod_rewrite for Laravel pretty URLs
RUN a2enmod rewrite

# Set working directory inside container
WORKDIR /var/www/html

# Copy project files into container
COPY . .

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php && mv composer.phar /usr/local/bin/composer

# Install dependencies (without dev packages)
RUN composer install --no-dev --optimize-autoloader

# Copy example environment file if .env doesn’t exist (useful for build)
RUN cp .env.example .env || true

# Clear and cache Laravel config
RUN php artisan config:clear && php artisan cache:clear && php artisan config:cache

# Generate app key if not set (safe to ignore error if already set)
RUN php artisan key:generate --force || true

# Run migrations and seed database (ignore errors during build)
RUN php artisan migrate --force || true
RUN php artisan db:seed --force || true

# Set folder permissions
RUN chown -R www-data:www-data storage bootstrap/cache

# Expose Apache port
EXPOSE 80

# Start Apache web server
CMD ["apache2-foreground"]
