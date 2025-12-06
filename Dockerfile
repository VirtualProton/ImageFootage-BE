# -------------------------
# 1) Base Image
# -------------------------
FROM php:7.4-fpm

# -------------------------
# 2) System Dependencies
# -------------------------
RUN apt-get update && apt-get install -y \
    git curl zip unzip nano libpng-dev libjpeg-dev libfreetype6-dev \
    libonig-dev libxml2-dev libzip-dev ffmpeg \
    && docker-php-ext-install pdo pdo_mysql mbstring tokenizer xml zip \
    && docker-php-ext-configure gd --with-jpeg --with-freetype \
    && docker-php-ext-install gd

# -------------------------
# 3) MongoDB Extension (Required)
# -------------------------
RUN pecl install mongodb \
    && echo "extension=mongodb.so" > /usr/local/etc/php/conf.d/mongodb.ini

# -------------------------
# 4) Install Composer
# -------------------------
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# -------------------------
# 5) Create Application Directory
# -------------------------
WORKDIR /var/www/html

# Copy project files
COPY . .

# -------------------------
# 6) Install Dependencies
# -------------------------
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Generate key if not exists
RUN php artisan key:generate || true

# -------------------------
# 7) Permissions
# -------------------------
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# -------------------------
# 8) Expose port
# -------------------------
EXPOSE 9000

# -------------------------
# 9) Start PHP-FPM
# -------------------------
CMD ["php-fpm"]
