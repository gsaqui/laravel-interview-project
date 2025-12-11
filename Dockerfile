ARG PHP_BASE_IMAGE_TAG=8.4.15-apache
FROM php:${PHP_BASE_IMAGE_TAG}

ENV MAIN_DEPENDENCIES='vim curl gcc make autoconf libc-dev zlib1g-dev pkg-config procps'
ENV DEPENDENCY_PACKAGES='apt-utils zip unzip git libmemcached-dev libmemcached11 libmagickwand-dev librabbitmq-dev libzip-dev libpng-dev libjpeg-dev libfreetype6-dev'

RUN apt-get clean \
    && apt-get update \
    && apt-get install --no-install-recommends ${MAIN_DEPENDENCIES} ${DEPENDENCY_PACKAGES} --no-install-suggests -q -y gnupg2 dirmngr wget apt-transport-https lsb-release ca-certificates \
    && docker-php-ext-install pdo pdo_mysql zip bcmath \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd \
    # Clean up
    && rm -rf /tmp/pear/* /tmp/*  /var/tmp/* /var/lib/apt/lists/* \
    && apt-get clean && apt-get autoremove \
    && docker-php-source delete


WORKDIR /var/www/html
COPY . /var/www/html

# install composer from Composer's official Docker image
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

#
# Installing the APP (Composer)
#
COPY composer.json composer.json
COPY composer.lock composer.lock
RUN git config --global --add safe.directory /var/www/html
RUN composer install  \
    --ignore-platform-reqs \
    --no-ansi \
    --no-autoloader \
    --no-dev \
    --no-interaction \
    --no-scripts

#
# Apache Configuration
#
RUN a2enmod rewrite && \
    sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf && \
    sed -i 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf

#
# Configuration & Permissions
#
RUN mkdir -p /var/www/html/storage/app/public && \
    mkdir -p /var/www/html/storage/logs/ && \
    mkdir -p /var/www/html/storage/framework/cache/data && \
    mkdir -p /var/www/html/storage/framework/sessions && \
    mkdir -p /var/www/html/storage/framework/views && \
    mkdir -p /var/www/html/bootstrap/cache && \
    touch /var/www/html/storage/logs/laravel.log && \
    chown -R www-data:www-data /var/www/html && \
    chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 80