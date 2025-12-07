# Use PHP 8.4
FROM php:8.4-apache

# Install GD
RUN apt-get update && apt-get install -y \
    libzip-dev unzip git \
    libfreetype6-dev libjpeg62-turbo-dev libpng-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql zip gd

# 🔥 Install MongoDB driver v1.21.3 (manual source build)
RUN apt-get update && apt-get install -y autoconf pkg-config libssl-dev libcurl4-openssl-dev
RUN git clone --branch 1.21.3 https://github.com/mongodb/mongo-php-driver.git mongo-driver \
    && cd mongo-driver \
    && phpize && ./configure --with-mongodb-ssl \
    && make -j$(nproc) && make install \
    && echo "extension=mongodb.so" > /usr/local/etc/php/conf.d/mongodb.ini \
    && cd .. && rm -rf mongo-driver

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
