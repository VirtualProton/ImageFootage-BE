# -----------------------------
# 1️⃣ Frontend build (Node)
# -----------------------------
FROM node:14.21.3 AS frontend-builder

WORKDIR /app

# Only copy package files first for better layer caching
COPY package.json package-lock.json* ./

RUN npm install

# Now copy the rest of the app (for Mix/Vite to access resources)
COPY . .

# Build frontend assets (adjust if you use "build" instead of "production")
RUN npm run production


# -----------------------------
# 2️⃣ Composer dependencies
# -----------------------------
FROM composer:2 AS vendor-builder

WORKDIR /app

COPY composer.json composer.lock ./

# Install production dependencies only
RUN composer install \
    --no-dev \
    --optimize-autoloader \
    --no-interaction \
    --no-progress


# -----------------------------
# 3️⃣ PHP-FPM + Nginx (Runtime)
# -----------------------------
FROM php:7.4.33-fpm

WORKDIR /var/www/html

# System & PHP extensions
RUN apt-get update && apt-get install -y \
    nginx \
    git \
    curl \
    zip \
    unzip \
    ffmpeg \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
 && rm -f /etc/nginx/sites-enabled/default \
 && docker-php-ext-configure gd --with-freetype --with-jpeg \
 && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip \
 && rm -rf /var/lib/apt/lists/*

# Extra PHP extensions (Redis, MongoDB)
RUN pecl install mongodb-1.16.1 redis-5.3.7 \
 && docker-php-ext-enable mongodb redis

# Copy composer from builder (optional now, but handy if you need it later)
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy application code
COPY . .

# Overwrite public/ with built frontend from Node stage
RUN rm -rf public/* \
 && mkdir -p public \
 && true

COPY --from=frontend-builder /app/public ./public

# Copy vendor from composer stage
COPY --from=vendor-builder /app/vendor ./vendor

# Permissions for Laravel
RUN chown -R www-data:www-data /var/www/html \
 && chmod -R 775 storage bootstrap/cache

# Nginx config
COPY docker/nginx.conf /etc/nginx/conf.d/default.conf

EXPOSE 80

# Start PHP-FPM in background and Nginx in foreground
CMD ["sh", "-c", "php-fpm -D && nginx -g 'daemon off;'"]
