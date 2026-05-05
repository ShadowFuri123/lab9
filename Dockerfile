FROM php:8.2-fpm

# Установка зависимостей
RUN apt-get update && apt-get install -y --no-install-recommends \
    git unzip libzip-dev \
    && docker-php-ext-install pdo pdo_mysql zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Установка Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Копируем composer.json ДО копирования всего кода (для кэширования слоёв)
COPY composer.json ./

# Устанавливаем зависимости
RUN composer install --no-dev --optimize-autoloader

# Копируем исходный код
COPY www/ /var/www/html/

CMD ["php-fpm"]