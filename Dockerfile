FROM php:8.2-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    unzip zip curl libzip-dev libpng-dev libonig-dev libxml2-dev git \
    && docker-php-ext-install pdo pdo_mysql zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy project files
COPY ./PRIMS /var/www

# Install dependencies
RUN composer install --no-dev --optimize-autoloader

# Set proper permissions
RUN chmod -R 775 storage bootstrap/cache

# Set Laravel app key (optional: safer to use ENV + php artisan key:generate at runtime)
# RUN php artisan key:generate

# Expose port (Railway will set PORT)
EXPOSE 8080

# Start Laravel server on Railway-assigned port
CMD php artisan serve --host=0.0.0.0 --port=${PORT:-8080}
