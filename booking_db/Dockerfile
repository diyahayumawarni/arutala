# STAGE 1: "Bengkel" untuk membangun dependensi
FROM composer:2.7 AS builder
WORKDIR /app
COPY composer.json composer.lock ./
# Hapus --no-scripts agar Laravel bisa melakukan optimasi
RUN composer install --no-dev --no-interaction --optimize-autoloader --no-scripts
COPY . .

# STAGE 2: "Showroom" atau image final yang bersih
FROM php:8.2-fpm-alpine
WORKDIR /var/www/html

# Instal dependensi sistem, TERMASUK NODEJS & NPM
RUN apk add --no-cache \
    nodejs \
    npm \
    postgresql-dev \
    libpng-dev \
    libzip-dev \
    jpeg-dev \
    freetype-dev \
    oniguruma-dev

# Konfigurasi dan instal ekstensi gd yang lengkap
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd

# Instal ekstensi PHP umum lainnya yang dibutuhkan Laravel
RUN docker-php-ext-install pdo_pgsql mbstring exif pcntl bcmath zip

# Salin Composer executable agar bisa digunakan di dalam container
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Salin hanya hasil akhir (kode & vendor) dari stage builder
COPY --from=builder /app .
RUN chown -R www-data:www-data /var/www/html
EXPOSE 9000
CMD ["php-fpm"]
