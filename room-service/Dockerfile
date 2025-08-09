# Stage 1: Build dependencies
FROM composer:2.4 as builder

WORKDIR /app
COPY . .
RUN composer install --no-dev --no-scripts --optimize-autoloader

# Stage 2: Final image
FROM php:8.2-fpm-alpine

WORKDIR /var/www/html

# Install system dependencies, update apk, and install PHP extensions
RUN apk update && apk upgrade && \
    apk add --no-cache \
    git \
    curl \
    libpng-dev \
    libjpeg-turbo-dev \
    libzip-dev \
    zip \
    unzip \
    bash \
    oniguruma-dev \
    postgresql-dev && \
    docker-php-ext-install pdo pdo_pgsql gd exif opcache bcmath

# Copy composer from the builder stage to the final image
COPY --from=builder /usr/bin/composer /usr/local/bin/composer

# Copy application code and vendor from the builder stage
COPY --from=builder /app /var/www/html

# Set proper permissions for storage and bootstrap/cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port
EXPOSE 9000

# Start PHP-FPM
CMD ["php-fpm"]
