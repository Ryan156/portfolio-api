FROM php:8.3-fpm-bookworm

RUN apt-get update && apt-get install -y \
    nginx \
    git \
    unzip \
    libpq-dev \
    libzip-dev \
    && docker-php-ext-install \
    pdo_pgsql \
    mbstring \
    bcmath \
    opcache \
    zip \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN composer install \
    --no-dev \
    --optimize-autoloader \
    --no-interaction

COPY .docker/nginx-site.conf /etc/nginx/sites-available/default

RUN chown -R www-data:www-data \
    storage \
    bootstrap/cache

RUN chmod +x render-build.sh

EXPOSE 80

CMD ["/var/www/html/render-build.sh"]
