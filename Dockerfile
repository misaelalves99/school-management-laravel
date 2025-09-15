# Caminho: Dockerfile
FROM php:8.2-apache

# -----------------------------
# Instalar dependências do sistema e extensões do Laravel
# -----------------------------
RUN apt-get update && apt-get install -y \
    libpng-dev libjpeg-dev libfreetype6-dev libzip-dev unzip git curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql zip bcmath \
    && a2enmod rewrite

# -----------------------------
# Instalar Composer
# -----------------------------
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# -----------------------------
# Definir diretório de trabalho
# -----------------------------
WORKDIR /var/www/html

# -----------------------------
# Copiar arquivos do projeto
# -----------------------------
COPY . .

# -----------------------------
# DocumentRoot do Apache para Laravel /public
# -----------------------------
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# -----------------------------
# Permissões para storage e bootstrap/cache
# -----------------------------
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# -----------------------------
# Evitar warning de ServerName no Apache
# -----------------------------
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# -----------------------------
# Instalar dependências do Laravel
# -----------------------------
RUN composer install --no-dev --optimize-autoloader

# -----------------------------
# Expor porta dinâmica do Railway
# -----------------------------
EXPOSE 8080

# -----------------------------
# CMD final: copia .env, gera APP_KEY, cache Laravel e roda Apache
# -----------------------------
CMD cp .env.example .env 2>/dev/null || true && \
    php artisan key:generate --force && \
    php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache && \
    apache2-foreground
