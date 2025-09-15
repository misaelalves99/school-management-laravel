# Caminho: Dockerfile
FROM php:8.2-apache

# Instalar dependências do sistema e PHP
RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip git \
    && docker-php-ext-install pdo pdo_mysql zip

# Ativar mod_rewrite
RUN a2enmod rewrite

# Definir DocumentRoot para a pasta public do Laravel
RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf \
    && sed -i 's!/var/www/!/var/www/html/public!g' /etc/apache2/apache2.conf

# Copiar projeto
COPY . /var/www/html
WORKDIR /var/www/html

# Instalar composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Instalar dependências Laravel sem scripts
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-scripts

# Criar pastas necessárias e definir permissões
RUN mkdir -p storage/framework/cache/data \
    && mkdir -p storage/framework/sessions \
    && mkdir -p storage/framework/views \
    && mkdir -p storage/logs \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Expor porta
EXPOSE 8080

# Start Apache
CMD ["apache2-foreground"]
