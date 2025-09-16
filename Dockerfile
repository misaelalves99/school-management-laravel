# ----------------------------
# Base PHP + Apache
# ----------------------------
FROM php:8.2-apache

# ----------------------------
# Instalar extensões e dependências
# ----------------------------
RUN apt-get update && apt-get install -y \
    libpng-dev libjpeg-dev libfreetype6-dev libzip-dev unzip git curl default-mysql-client \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql zip bcmath \
    && a2enmod rewrite

# ----------------------------
# Composer
# ----------------------------
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# ----------------------------
# Diretório de trabalho
# ----------------------------
WORKDIR /var/www/html

# ----------------------------
# Copiar composer e instalar dependências
# ----------------------------
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --prefer-dist --no-interaction --no-scripts

# ----------------------------
# Copiar resto do projeto e certs
# ----------------------------
COPY . .
COPY certs/ ./certs/

# ----------------------------
# Apache: DocumentRoot e .htaccess
# ----------------------------
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|g' /etc/apache2/sites-available/000-default.conf \
    && sed -i '/<Directory \/var\/www\/html>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf \
    && a2enmod rewrite

# ----------------------------
# Permissões
# ----------------------------
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# ----------------------------
# Evitar warning ServerName
# ----------------------------
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# ----------------------------
# Git safe directory (Windows / Railway)
# ----------------------------
RUN git config --global --add safe.directory /var/www/html

# ----------------------------
# Porta dinâmica do Railway
# ----------------------------
ARG PORT=8080
ENV APACHE_LISTEN_PORT=${PORT}
RUN sed -i "s/80/${PORT}/g" /etc/apache2/ports.conf /etc/apache2/sites-available/000-default.conf

EXPOSE ${PORT}

# ----------------------------
# Start Apache
# ----------------------------
CMD ["apache2-foreground"]
