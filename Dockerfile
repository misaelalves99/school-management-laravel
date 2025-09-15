# Caminho: Dockerfile
FROM php:8.2-apache

# ----------------------------------------
# Instalar dependências do sistema e extensões necessárias do Laravel
# ----------------------------------------
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    unzip \
    git \
    curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql zip bcmath \
    && a2enmod rewrite

# ----------------------------------------
# Instalar Composer
# ----------------------------------------
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# ----------------------------------------
# Definir diretório de trabalho
# ----------------------------------------
WORKDIR /var/www/html

# ----------------------------------------
# Copiar arquivos do projeto
# ----------------------------------------
COPY . .

# ----------------------------------------
# Instalar dependências do Laravel
# ----------------------------------------
RUN composer install --no-dev --optimize-autoloader

# ----------------------------------------
# Permissões de pasta (storage e bootstrap/cache precisam ser graváveis)
# ----------------------------------------
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# ----------------------------------------
# Evitar warning de ServerName no Apache
# ----------------------------------------
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# ----------------------------------------
# Expor porta e rodar container
# ----------------------------------------
EXPOSE 80

CMD php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache && \
    apache2-foreground
