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
# Configurar Apache para servir Laravel /public
# -----------------------------
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# -----------------------------
# Permissões para storage e bootstrap/cache
# -----------------------------
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# -----------------------------
# Instalar dependências do Laravel
# -----------------------------
RUN composer install --no-dev --optimize-autoloader

# -----------------------------
# Executar migrações do banco de dados
# O --force é necessário em ambientes de produção para rodar sem confirmação
# -----------------------------
RUN php artisan migrate --force

# -----------------------------
# Expor porta HTTP do Railway e usar a variável PORT
# -----------------------------
ENV APACHE_LISTEN_PORT=8080
EXPOSE 8080

# -----------------------------
# CMD final: roda Apache e passa a porta via argumento
# -----------------------------
CMD ["apache2-foreground"]