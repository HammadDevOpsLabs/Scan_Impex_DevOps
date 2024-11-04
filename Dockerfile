# 1. Use PHP 8.2 with FPM
FROM php:8.2-fpm

# 2. Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# 3. Install required PHP extensions
RUN apt-get update && \
    apt-get install -y \
        libzip-dev \
        zlib1g-dev \
        libicu-dev \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl zip

# 4. Set the working directory
WORKDIR /var/www/html

# 5. Copy project files
COPY . .
COPY .env.example /var/www/html/.env
# 6. Install Composer packages (Update & Install)
RUN composer update --no-scripts --no-autoloader --ignore-platform-reqs --no-interaction && \
    composer install --no-scripts --no-autoloader --ignore-platform-reqs --no-interaction

# 7. Generate the autoloader and run post-create-project script
RUN composer dump-autoload && composer run-script post-create-project-cmd

# 8. Set permissions for the web directory
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html
# 9. Expose container ports
EXPOSE 9000
CMD php artisan migrate --force && php artisan key:generate --force
CMD ["php-fpm"]
