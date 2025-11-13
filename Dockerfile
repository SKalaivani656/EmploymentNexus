# Use official PHP image
FROM php:8.2-apache

# Install system dependencies for PostgreSQL and MySQL
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libzip-dev \
    unzip \
    zip \
    git \
    curl \
    && docker-php-ext-install pdo pdo_mysql pdo_pgsql

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy all files
COPY . .

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php && mv composer.phar /usr/local/bin/composer

# Install dependencies
RUN composer install --no-dev --optimize-autoloader

# Set permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Run migrations and seed database (ignore errors)
RUN php artisan migrate --force || true
RUN php artisan db:seed --force || true

# Expose port 80
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
