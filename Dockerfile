# 🟢 Use PHP 8.4 as required by your application libraries (Symfony, lcobucci/clock, etc.)
FROM php:8.4-apache

RUN apt-get update && apt-get install -y \
    libzip-dev unzip git \
    libfreetype6-dev libjpeg62-turbo-dev libpng-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql zip gd

# 🟢 Install MongoDB Driver 2.x (Required for PHP 8.4 compatibility)
RUN pecl install mongodb \
    && echo "extension=mongodb.so" > /usr/local/etc/php/conf.d/mongodb.ini

RUN a2enmod rewrite
RUN sed -i 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/sites-available/000-default.conf /etc/apache2/apache2.conf

COPY . /var/www/html
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
# 🟢 FIX: Use 'composer update' to force the MongoDB libraries (e.g., mongodb/mongodb) 
# to upgrade to a version compatible with the installed extension 2.1.4.
# This resolves the major version conflict reported in the previous log.
RUN composer update --no-dev --prefer-dist --no-interaction --no-progress

RUN chown -R www-data:www-data storage bootstrap/cache && chmod -R 775 storage bootstrap/cache

EXPOSE 8001
CMD ["apache2-foreground"]
