FROM php:7.4-fpm

RUN apt-get update && apt-get install -y \
    git curl zip unzip nginx libpng-dev libjpeg62-turbo-dev libfreetype6-dev \
    libonig-dev libzip-dev libxml2-dev ffmpeg supervisor && \
    docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install pdo pdo_mysql gd mbstring xml zip

# Use Composer 2.2 LTS (supports old Laravel)
COPY --from=composer:2.2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . .

# Install dependencies ✨ (now secure-block bypass is inside composer.json)
RUN composer install --no-interaction --prefer-dist --optimize-autoloader --ignore-platform-reqs

# Cache optimizations
RUN php artisan config:cache && php artisan route:cache && php artisan view:cache || true

# Copy Nginx config
COPY deploy/nginx.conf /etc/nginx/conf.d/default.conf

EXPOSE 80
CMD ["sh", "-c", "php-fpm & nginx -g 'daemon off;'"]
