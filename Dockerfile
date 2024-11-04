# 1. Use PHP 8.2 with FPM
FROM php:8.2-fpm

# 2. Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# 3. Install required PHP extensions
RUN apt-get update -qq && \
    apt-get install -y -qq \
        libzip-dev \
        zlib1g-dev \
        libicu-dev \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# 4. Set the working directory
WORKDIR /var/www/html

# 5. Copy project files
COPY . .

# 6. Copy the .env file
COPY .env.example /var/www/html/.env

# 7. Install Composer packages (Update & Install)
RUN composer update --no-scripts --no-autoloader --ignore-platform-reqs --no-interaction && \
    composer install --no-scripts --no-autoloader --ignore-platform-reqs --no-interaction && \
    composer dump-autoload --optimize

# 8. Set permissions for the web directory
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

# 9. Expose container ports
EXPOSE 9000

# 10. CMD to run migrations, generate key, and start PHP-FPM
CMD php artisan migrate --force && php artisan key:generate --force && php-fpm
