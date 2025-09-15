FROM php:8.2-apache

# Instalar extensões e dependências
RUN apt-get update && apt-get install -y \
    libpng-dev libjpeg-dev libfreetype6-dev libzip-dev unzip git curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql zip bcmath \
    && a2enmod rewrite

# Instalar Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Criar diretório de trabalho
WORKDIR /var/www/html

# Copiar arquivos
COPY . .

# Copiar certificado do Aiven
COPY certs/ca.pem /etc/secrets/ca.pem

# DocumentRoot Apache para /public
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Permissões
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Evitar warning de ServerName
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Instalar dependências Laravel
RUN composer install --no-dev --optimize-autoloader

# Expor porta
EXPOSE 8080

# CMD final
CMD php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache && \
    apache2-foreground
