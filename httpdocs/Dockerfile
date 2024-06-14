FROM php:8.2-apache as web

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

COPY . /var/www/html

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    libpng-dev \
    libjpeg-dev \
    && docker-php-ext-configure gd --with-jpeg \
    && docker-php-ext-install gd \
    && apt-get clean && rm -rf /var/lib/apt/lists/* \
    && a2enmod rewrite \
    && docker-php-ext-install pdo_mysql zip \
    && sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
    && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf \
    && chmod -R 755 storage \
    && mkdir -p bootstrap/cache && chmod -R 777 bootstrap/ \
    && mkdir -p framework/sessions \
    && mkdir -p framework/views \
    && mkdir -p framework/cache \
    && chmod -R 775 framework
    
RUN curl -sLS https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs \
    && npm install -g npm \
    && npm install \
    && npm run build \
    && npx update-browserslist-db@latest
    
# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer


RUN mkdir -p bootstrap/cache && chmod -R 777 bootstrap/

RUN composer install --no-cache \
    && chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache