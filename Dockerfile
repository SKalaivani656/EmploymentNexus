# Use the official PHP-Apache image
FROM php:8.2-apache

# Set working directory
WORKDIR /var/www/html

# Install required PHP extensions and system dependencies
RUN apt-get update && apt-get install -y \
    git zip unzip curl libpng-dev libonig-dev libxml2-dev libzip-dev libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql mbstring exif pcntl bcmath gd zip

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Copy project files to container
COPY . .

# Set Apache document root to Laravel public folder
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Fix permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage /var/www/html/bootstrap/cache

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Install Laravel dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction

# ----------------------------------------------------
# Install Node.js (for Laravel Mix)
# ----------------------------------------------------
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

# Fix Webpack error (OpenSSL issue)
ENV NODE_OPTIONS=--openssl-legacy-provider

# Install NPM packages + build assets
RUN npm install && npm run prod
# ----------------------------------------------------

# Clear caches
RUN php artisan config:clear || true && php artisan cache:clear || true && \
    php artisan route:clear || true && php artisan view:clear || true

# Create .env if not exists
RUN if [ ! -f .env ]; then cp .env.example .env; fi

# Generate key
RUN php artisan key:generate --force || true

# Run migrations then start Apache
CMD bash -c "echo 'Waiting for database...' && \
    sleep 10 && \
    php artisan migrate --force && \
    apache2-foreground"
