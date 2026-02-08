# 1. ใช้ PHP 8.2 FPM เป็น Base Image
FROM php:8.2-fpm

# 2. ติดตั้ง System Dependencies (รองรับ Zip, GD และ PDF)
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libfreetype6-dev \
    libjpeg62-turbo-dev

# 3. ติดตั้ง PHP Extensions ที่ Laravel ต้องการ
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# 4. ติดตั้ง Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 5. ตั้งค่า Directory ทำงาน
WORKDIR /app

# 6. คัดลอกไฟล์โปรเจกต์ทั้งหมด
COPY . /app

# 7. ติดตั้ง Library (โดยไม่รัน Script ที่ต้องใช้ Database)
RUN composer install --no-interaction --optimize-autoloader --no-dev

# 8. ตั้งค่าสิทธิ์การเข้าถึงโฟลเดอร์ Storage และ Cache
RUN chown -R www-data:www-data /app/storage /app/bootstrap/cache

# 9. เปิด Port (Railway จะกำหนด $PORT ให้เอง)
EXPOSE 8080

# หมายเหตุ: เราจะไม่ใส่คำสั่ง php artisan migrate หรือ php -S ที่นี่