# Caminho: Dockerfile
FROM php:8.2-apache

# Instalar dependências
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
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-scripts

# Ajustar permissões (correto)
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Expor porta
EXPOSE 8080

# Start Apache
CMD ["apache2-foreground"]
