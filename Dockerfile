# تحديد الـ Base Image
FROM php:8.2-fpm

# تثبيت التبعيات
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl \
    libzip-dev \
    libicu-dev \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl zip pdo_mysql mbstring exif pcntl bcmath gd

# تثبيت Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# إضافة صلاحية آمنة لملف Git
RUN git config --global --add safe.directory /var/www/html

# نسخ ملفات المشروع
WORKDIR /var/www/html
COPY . .

# إعداد الـ .env
RUN cp .env.example .env

# تثبيت Composer dependencies
RUN composer install --no-dev --optimize-autoloader

# إعداد الصلاحيات
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# تشغيل أوامر Laravel المطلوبة
RUN php artisan key:generate
RUN php artisan migrate --force

# كشف البورت
EXPOSE 17177

# أمر التشغيل الافتراضي
CMD ["php-fpm"]
