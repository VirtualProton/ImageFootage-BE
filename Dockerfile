# --------------------------------------
# 1) Base PHP Image for Laravel 5 + PHP 7.4
# --------------------------------------
FROM php:7.4-fpm

# Install System Dependencies
RUN apt-get update && apt-get install -y \
    git curl zip unzip nginx libpng-dev libjpeg62-turbo-dev libfreetype6-dev \
    libonig-dev libzip-dev libxml2-dev ffmpeg supervisor && \
    docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install pdo pdo_mysql gd mbstring xml zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# --------------------------------------
# 2) Copy project into container
# --------------------------------------
WORKDIR /var/www/html
COPY . .

# Install deps
RUN composer config --no-plugins allow-plugins true && \
    composer config security.audit false && \
    composer install --no-interaction --prefer-dist --optimize-autoloader --ignore-platform-reqs



# Cache optimize
RUN php artisan config:clear && php artisan config:cache && \
    php artisan route:cache && php artisan view:cache

# --------------------------------------
# 3) Copy Nginx Config
# --------------------------------------
COPY deploy/nginx.conf /etc/nginx/conf.d/default.conf

EXPOSE 80

CMD php-fpm -D && nginx -g "daemon off;"
