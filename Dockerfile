### ---------- Frontend build ----------
FROM node:14.21.3 AS frontend-builder

WORKDIR /app
COPY package*.json ./
RUN npm install
COPY . .
RUN npm run production


### ---------- Backend ----------
FROM php:7.4.33-fpm

WORKDIR /var/www/html

# System deps
RUN apt-get update && apt-get install -y \
    git curl zip unzip ffmpeg \
    libpng-dev libjpeg62-turbo-dev libfreetype6-dev \
    libonig-dev libxml2-dev libzip-dev \
    && rm -rf /var/lib/apt/lists/*

# PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql mbstring bcmath gd zip opcache

# Composer
COPY --from=composer:2.2 /usr/bin/composer /usr/bin/composer

# Backend deps
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-interaction

# App source
COPY . .

# Copy compiled frontend assets
COPY --from=frontend-builder /app/public /var/www/html/public

# Permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

EXPOSE 9000
CMD ["php-fpm"]
