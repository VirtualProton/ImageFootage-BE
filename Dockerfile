# -----------------------------
# 1️⃣ Frontend build (Node)
# -----------------------------
FROM node:14.21.3 AS frontend-builder

WORKDIR /app

# Copy only package files first for better cache
COPY package.json package-lock.json* ./

RUN npm install

# Now copy the rest of the app so Mix/Vite can access resources
COPY . .

# Adjust if your build script is different
RUN npm run production


# -----------------------------
# 2️⃣ PHP-FPM + Nginx (Runtime)
# -----------------------------
FROM php:7.4.33-fpm

WORKDIR /var/www/html

# System packages & PHP extensions
RUN apt-get update && apt-get install -y --no-install-recommends \
    nginx \
    git \
    curl \
    ca-certificates \
    zip \
    unzip \
    ffmpeg \
    chromium \
    fonts-dejavu-core \
    fonts-liberation \
    fonts-noto-core \
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

ENV CHROME_PATH=/usr/bin/chromium

# Extra PHP extensions (Redis, MongoDB)
RUN pecl install mongodb-1.16.1 redis-5.3.7 \
 && docker-php-ext-enable mongodb redis

# Copy composer binary into this image
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy application code
COPY . .

# Replace public/ with built frontend from Node stage
RUN rm -rf public/* \
 && mkdir -p public

COPY --from=frontend-builder /app/public ./public

# Install PHP dependencies (now using PHP 7.4 + extensions)
RUN composer install \
    --no-dev \
    --optimize-autoloader \
    --no-interaction \
    --no-progress

# Permissions for Laravel
RUN chown -R www-data:www-data /var/www/html \
 && chmod -R 775 storage bootstrap/cache

# Nginx config (make sure this file exists in your repo)
COPY docker/nginx.conf /etc/nginx/conf.d/default.conf

EXPOSE 80

# Start PHP-FPM in background and Nginx in foreground
CMD ["sh", "-c", "php-fpm -D && nginx -g 'daemon off;'"]
