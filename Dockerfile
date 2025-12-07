FROM php:8.4-apache

# Install GD & dependencies
RUN apt-get update && apt-get install -y \
    libzip-dev unzip git \
    libfreetype6-dev libjpeg62-turbo-dev libpng-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql zip gd

# Install MongoDB Driver v1.21.3 (compatible with composer.lock)
RUN curl -L -o mongodb.tgz "https://pecl.php.net/get/mongodb-1.21.3.tgz" \
    && tar -xzf mongodb.tgz \
    && cd mongodb-1.21.3 \
    && phpize && ./configure && make && make install \
    && echo "extension=mongodb.so" > /usr/local/etc/php/conf.d/mongodb.ini \
    && cd .. && rm -rf mongodb-1.21.3 mongodb.tgz

RUN a2enmod rewrite
RUN sed -i 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/sites-available/000-default.conf /etc/apache2/apache2.conf

COPY . /var/www/html
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
RUN composer install --no-dev --prefer-dist --no-interaction --no-progress

RUN chown -R www-data:www-data storage bootstrap/cache && chmod -R 775 storage bootstrap/cache

EXPOSE 8001
CMD ["apache2-foreground"]
