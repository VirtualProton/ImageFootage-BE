# Use PHP 8.2 base image, which is compatible with Laravel 9.
FROM php:8.2-apache

# Set environment variable for Apache document root configuration
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

# 1. Install System Dependencies and PHP Extensions
RUN apt-get update && apt-get install -y \
    libzip-dev unzip git \
    libfreetype6-dev libjpeg62-turbo-dev libpng-dev \
    # Clean up APT lists to reduce image size
    && rm -rf /var/lib/apt/lists/*

# Configure and install core PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql zip gd

# 🟢 FIX: Explicitly install the compatible MongoDB Driver (v1.18.0 is known to work with PHP 8.2 and library v3.9)
RUN pecl install mongodb-1.18.0 \
    && echo "extension=mongodb.so" > /usr/local/etc/php/conf.d/mongodb.ini

# 2. Configure Apache
# Enable Apache rewrite module
RUN a2enmod rewrite

# Allow Apache to use .htaccess files (AllowOverride All)
RUN sed -i 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf

# Set the document root to /var/www/html/public for Laravel
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/sites-available/000-default.conf /etc/apache2/apache2.conf

# 3. Application Setup
# Copy application code
COPY . /var/www/html

# Copy Composer binary from a dedicated image
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Run composer install now that the environment matches the composer.lock file
# (PHP 8.2, ext-mongodb 1.18.0)
RUN composer install --no-dev --prefer-dist --no-interaction --no-progress

# Set proper storage permissions for Laravel
RUN chown -R www-data:www-data storage bootstrap/cache && chmod -R 775 storage bootstrap/cache

# 4. Final Commands
EXPOSE 8001
CMD ["apache2-foreground"]
