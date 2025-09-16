# ----------------------------
# Base PHP 8.2 + Apache
# ----------------------------
FROM php:8.2-apache

# ----------------------------
# Instalar extensões PHP e dependências do sistema
# ----------------------------
RUN apt-get update && apt-get install -y \
    libpng-dev libjpeg-dev libfreetype6-dev libzip-dev unzip git curl default-mysql-client nodejs npm \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql zip bcmath \
    && a2enmod rewrite

# ----------------------------
# Instalar Composer
# ----------------------------
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# ----------------------------
# Diretório de trabalho
# ----------------------------
WORKDIR /var/www/html

# ----------------------------
# Copiar composer e instalar dependências PHP
# ----------------------------
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --prefer-dist --no-interaction

# ----------------------------
# Copiar o restante do projeto e certs
# ----------------------------
COPY . .
COPY certs/ ./certs/

# ----------------------------
# Permissões e cache Laravel
# ----------------------------
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache \
    && php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache

# ----------------------------
# Compilar assets Vite/Tailwind
# ----------------------------
RUN npm install \
    && npm run build

# ----------------------------
# Apache: DocumentRoot e .htaccess
# ----------------------------
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|g' /etc/apache2/sites-available/000-default.conf \
    && sed -i '/<Directory \/var\/www\/html>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf \
    && echo "ServerName localhost" >> /etc/apache2/apache2.conf \
    && a2enmod rewrite

# ----------------------------
# Git safe directory
# ----------------------------
RUN git config --global --add safe.directory /var/www/html

# ----------------------------
# Porta dinâmica (Render Free)
# ----------------------------
ARG PORT=10000
ENV APACHE_LISTEN_PORT=${PORT}
RUN sed -i "s/80/${PORT}/g" /etc/apache2/ports.conf /etc/apache2/sites-available/000-default.conf

EXPOSE ${PORT}

# ----------------------------
# Start Apache
# ----------------------------
CMD ["apache2-foreground"]
