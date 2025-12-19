############################
# 1) Frontend build (Node 14)
############################
FROM node:14.21.3 AS frontend-builder

WORKDIR /app
COPY package*.json ./
RUN npm install
COPY . .
RUN npm run production


############################
# 2) Backend (PHP 7.4)
############################
FROM php:7.4-apache

############################
# FIX DEBIAN EOL (ONLY PLACE)
############################
RUN rm -f /etc/apt/sources.list.d/* && \
    sed -i 's|deb.debian.org|archive.debian.org|g' /etc/apt/sources.list && \
    echo 'Acquire::Check-Valid-Until "false";' > /etc/apt/apt.conf.d/99no-check-valid && \
    apt-get update

############################
# System + PHP extensions
############################
RUN apt-get install -y \
    git curl zip unzip \
    libpng-dev libjpeg62-turbo-dev libfreetype6-dev && \
    docker-php-ext-configure gd \
        --with-freetype-dir=/usr/include/ \
        --with-jpeg-dir=/usr/include/ && \
    docker-php-ext-install pdo pdo_mysql mbstring gd && \
    apt-get clean && rm -rf /var/lib/apt/lists/*

############################
# Apache
############################
RUN a2enmod rewrite

############################
# Composer (PHP 7.x safe)
############################
RUN curl -sS https://getcomposer.org/installer | php \
    -- --version=2.2.21 \
    --install-dir=/usr/local/bin \
    --filename=composer

############################
# App setup
############################
WORKDIR /var/www/html
COPY . .
COPY --from=frontend-builder /app/public ./public

RUN composer install --ignore-platform-reqs

RUN chown -R www-data:www-data storage bootstrap/cache && \
    chmod -R 775 storage bootstrap/cache

############################
# DEV SAFETY
############################
CMD php artisan optimize:clear && apache2-foreground

EXPOSE 80
