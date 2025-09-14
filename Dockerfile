# ---------------------------
# Dockerfile para Laravel + Aiven + Render
# ---------------------------

# Imagem base PHP com Apache
FROM php:8.2-apache

# Instalar dependências e extensões necessárias
RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip git curl libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql zip gd bcmath mbstring xml \
    && a2enmod rewrite

# Copiar código da aplicação para o container
COPY . /var/www/html

# Definir diretório de trabalho
WORKDIR /var/www/html

# Instalar Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Instalar dependências do Laravel
RUN composer install --no-dev --optimize-autoloader

# Configurar permissões
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Cache do Laravel (config, rotas, views)
RUN php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache

# Expor porta 8080 (Render utiliza 8080)
EXPOSE 8080

# Comando para iniciar o Apache em foreground
CMD ["apache2-foreground"]