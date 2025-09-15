# ----------------------------
# Dockerfile Laravel 12 + PHP 8.2 (Railway-ready)
# ----------------------------
FROM php:8.2-apache

# ----------------------------
# Instalar dependências e extensões do sistema
# ----------------------------
RUN apt-get update && apt-get install -y \
    libpng-dev libjpeg-dev libfreetype6-dev libzip-dev unzip git curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql zip bcmath \
    && a2enmod rewrite

# ----------------------------
# Instalar Composer
# ----------------------------
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# ----------------------------
# Criar diretório de trabalho
# ----------------------------
WORKDIR /var/www/html

# ----------------------------
# Copiar todos os arquivos do projeto
# ----------------------------
COPY . .

# ----------------------------
# Copiar certificado do Aiven
# ----------------------------
COPY certs/ca.pem /etc/secrets/ca.pem

# ----------------------------
# Ajustar DocumentRoot do Apache para /public
# ----------------------------
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|g' /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite

# ----------------------------
# Permissões para storage e bootstrap/cache
# ----------------------------
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# ----------------------------
# Evitar warning de ServerName
# ----------------------------
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# ----------------------------
# Instalar dependências do Laravel
# ----------------------------
RUN composer install --no-dev --optimize-autoloader

# ----------------------------
# Expor porta do Railway
# ----------------------------
EXPOSE 8080

# ----------------------------
# CMD final: limpar cache antigo, gerar cache novo e iniciar Apache
# ----------------------------
CMD php artisan config:clear && \
    php artisan route:clear && \
    php artisan view:clear && \
    php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache && \
    apache2-foreground
