# Use PHP 8.4 (required by symfony/filesystem and var-exporter)
FROM php:8.4-apache

# Install GD + system libs
RUN apt-get update && apt-get install -y \
    libzip-dev unzip git \
    libfreetype6-dev libjpeg62-turbo-dev libpng-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql zip gd

# Install MongoDB PHP extension (required by mongodb/mongodb)
RUN pecl install mongodb \
    && echo "extension=mongodb.so" > /usr/local/etc/php/conf.d/mongodb.ini

# Enable mod_rewrite + AllowOverride
RUN a2enmod rewrite
RUN sed -i 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf

# Set public folder as document root
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/sites-available/000-default.conf /etc/apache2/apache2.conf

# Copy project files
COPY . /var/www/html

# Composer copy
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Install backend dependencies properly
RUN composer install --no-dev --prefer-dist --no-interaction --no-progress

# Permissions
RUN chown -R www-data:www-data storage bootstrap/cache && \
    chmod -R 775 storage bootstrap/cache

EXPOSE 8001

CMD ["apache2-foreground"]
