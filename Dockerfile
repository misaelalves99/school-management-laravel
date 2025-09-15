FROM php:8.2-apache

# -----------------------------
# Install system dependencies and Laravel extensions
# -----------------------------
RUN apt-get update && apt-get install -y \
    libpng-dev libjpeg-dev libfreetype6-dev libzip-dev unzip git curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql zip bcmath \
    && a2enmod rewrite

# -----------------------------
# Install Composer
# -----------------------------
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# -----------------------------
# Set working directory
# -----------------------------
WORKDIR /var/www/html

# -----------------------------
# Copy project files
# -----------------------------
COPY . .

# -----------------------------
# Configure Apache to serve Laravel /public
# -----------------------------
# Remove the default Apache config file
RUN rm /etc/apache2/sites-enabled/000-default.conf

# Copy and enable our custom Laravel config
COPY laravel.conf /etc/apache2/sites-available/laravel.conf
RUN a2ensite laravel.conf

# -----------------------------
# Permissions for storage and bootstrap/cache
# -----------------------------
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# -----------------------------
# Install Laravel dependencies
# -----------------------------
RUN composer install --no-dev --optimize-autoloader

# -----------------------------
# Run database migrations
# -----------------------------
RUN php artisan migrate --force

# -----------------------------
# Expose Railway HTTP port
# -----------------------------
ENV APACHE_LISTEN_PORT=8080
EXPOSE 8080

# -----------------------------
# CMD final: roda o start.sh
# -----------------------------
RUN chmod +x start.sh
CMD ["./start.sh"]
