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

# 6. Install Composer packages (Update & Install) if composer.json exists
RUN if [ -f "composer.json" ]; then \
        composer install --no-scripts --no-autoloader --ignore-platform-reqs --no-interaction && \
        composer dump-autoload; \
    else \
        echo "composer.json not found. Skipping Composer install."; \
    fi

# 7. Set permissions for the web directory
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

# 8. Expose container ports
EXPOSE 9000

# 9. Run migrations and start PHP-FPM
CMD php artisan migrate --force && php artisan key:generate --force && php-fpm
