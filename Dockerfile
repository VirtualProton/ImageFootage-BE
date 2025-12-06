# ===============================
# 🚀 Laravel 5.8 + PHP 7.1 + Apache
# ===============================

FROM php:7.1-apache

# Set working directory
WORKDIR /var/www/html

# Enable Apache rewrite (Laravel needs this)
RUN a2enmod rewrite

# Install required dependencies & PHP extensions
RUN apt-get update && apt-get install -y \
    git unzip libpng-dev libjpeg-dev libfreetype6-dev libzip-dev libicu-dev libxml2-dev ffmpeg \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd zip intl mbstring pdo_mysql xml pcntl bcmath \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:1.10 /usr/bin/composer /usr/bin/composer
# (Composer v2 breaks on PHP7.1 — v1.10 is correct)

# Copy project into container
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Generate optimized autoload
RUN composer dump-autoload --optimize

# Ensure storage & cache permissions
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Expose Laravel application port
EXPOSE 80

# Start Apache server
CMD ["apache2-foreground"]
