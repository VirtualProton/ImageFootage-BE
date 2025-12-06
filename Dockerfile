# -------------------------
# 1) Base Image
# -------------------------
FROM php:7.4-fpm

# -------------------------
# 2) System Dependencies + Build Tools (IMPORTANT!)
# -------------------------
RUN apt-get update && apt-get install -y \
    git curl zip unzip nano ffmpeg \
    build-essential autoconf pkg-config \
    libpng-dev libjpeg-dev libfreetype6-dev \
    libonig-dev libxml2-dev libzip-dev \
    && docker-php-ext-configure gd --with-jpeg --with-freetype \
    && docker-php-ext-install pdo pdo_mysql gd mbstring tokenizer xml zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# -------------------------
# 3) MongoDB Extension
# -------------------------
RUN pecl install mongodb && echo "extension=mongodb.so" > /usr/local/etc/php/conf.d/mongodb.ini

# -------------------------
# 4) Install Composer
# -------------------------
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# -------------------------
# 5) Application Setup
# -------------------------
WORKDIR /var/www/html
COPY . .

RUN composer install --no-dev --optimize-autoloader --no-interaction
RUN php artisan key:generate || true

# -------------------------
# 6) Permissions
# -------------------------
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

EXPOSE 9000
CMD ["php-fpm"]
