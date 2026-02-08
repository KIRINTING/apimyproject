# 1. ใช้ PHP 8.2 ที่เสถียรสำหรับ Laravel 10
FROM php:8.2-fpm

# 2. ติดตั้ง Dependencies สำหรับ PHP และการออกเอกสาร (PDF/Thai Fonts)
RUN apt-get update && apt-get install -y \
    git curl libpng-dev libonig-dev libxml2-dev zip unzip \
    libfreetype6-dev libjpeg62-turbo-dev fontconfig

# 3. ติดตั้ง PHP Extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# 4. ติดตั้ง Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . /app

# 5. ติดตั้ง Library (ห้ามใส่ php artisan migrate ในนี้เด็ดขาด!)
RUN composer install --no-interaction --optimize-autoloader --no-dev

# 6. ตั้งค่าสิทธิ์โฟลเดอร์ให้ Laravel เขียนไฟล์ได้
RUN chown -R www-data:www-data /app/storage /app/bootstrap/cache

EXPOSE 8080