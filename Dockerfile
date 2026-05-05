FROM php:8.2-fpm

RUN apt-get update && apt-get install -y --no-install-recommends \
    git unzip libzip-dev \
    && docker-php-ext-install pdo pdo_mysql zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Копируем composer.json из www/
COPY www/composer.json ./

RUN composer install --no-dev --optimize-autoloader

# Копируем остальной код
COPY www/ /var/www/html/

CMD ["php-fpm"]