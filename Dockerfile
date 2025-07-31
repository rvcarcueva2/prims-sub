# Base PHP image
FROM php:8.2-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    unzip zip curl git libzip-dev libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy project files
COPY ./PRIMS /var/www

# Set permissions (ensure Laravel can write to storage & cache)
RUN chmod -R 775 storage bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Set environment (you may pass .env through Railway variables instead)
ENV APP_ENV=production
ENV PORT=8080

# Expose port
EXPOSE 8080

# Entrypoint: cache config and run migrations, then start Laravel
CMD php artisan config:cache \
 && php artisan migrate --force \
 && php artisan serve --host=0.0.0.0 --port=${PORT}
