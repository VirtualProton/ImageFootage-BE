############################
# 1) Build frontend (Node 14.21.3)
############################
FROM node:14.21.3 AS frontend-builder

WORKDIR /app
COPY package*.json ./
RUN npm install
COPY . .
RUN npm run production


############################
# 2) Legacy Base + Patch Buster Repos
############################
FROM php:7.4-apache

# Fix broken apt sources
RUN sed -i 's|deb.debian.org|archive.debian.org|g' /etc/apt/sources.list && \
    sed -i 's|security.debian.org|archive.debian.org|g' /etc/apt/sources.list && \
    echo "Acquire::Check-Valid-Until false;" > /etc/apt/apt.conf.d/99no-check-valid && \
    apt-get update

# Required PHP extensions
RUN apt-get install -y \
    git curl zip unzip libpng-dev libjpeg62-turbo-dev libfreetype6-dev && \
    docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ && \
    docker-php-ext-install pdo pdo_mysql mbstring gd

RUN a2enmod rewrite
WORKDIR /var/www/html

COPY . .
COPY --from=frontend-builder /app/public ./public

# Install Composer 2.2 (supports PHP 7.1)
RUN curl -sS https://getcomposer.org/installer | php -- --version=2.2.21 --install-dir=/usr/local/bin --filename=composer

RUN composer install --no-dev --optimize-autoloader --ignore-platform-reqs

RUN chown -R www-data:www-data storage bootstrap/cache && chmod -R 755 storage bootstrap/cache

EXPOSE 80
CMD ["apache2-foreground"]
