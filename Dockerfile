# Use the official PHP-Apache image
FROM php:8.2-apache

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
    git zip unzip curl libpng-dev libonig-dev libxml2-dev libzip-dev libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql mbstring exif pcntl bcmath gd zip

RUN a2enmod rewrite

COPY . .

# --- FIX #1: set DocumentRoot in default site ---
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# --- FIX #2: set DocumentRoot in apache2.conf (REQUIRED!) ---
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/apache2.conf

# Permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage /var/www/html/bootstrap/cache

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

RUN composer install --no-dev --optimize-autoloader --no-interaction

# Node install
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

# Fix openssl error
ENV NODE_OPTIONS=--openssl-legacy-provider

RUN npm install && npm run prod

RUN php artisan config:clear || true \
    && php artisan cache:clear || true \
    && php artisan route:clear || true \
    && php artisan view:clear || true

RUN if [ ! -f .env ]; then cp .env.example .env; fi

RUN php artisan key:generate --force || true

CMD bash -c "echo 'Waiting for database...' && \
    sleep 10 && \
    php artisan migrate --force && \
    apache2-foreground"
