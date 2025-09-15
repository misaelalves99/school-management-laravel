#!/bin/bash

# Run database migrations
php artisan migrate --force

# Clear and cache configurations for production
php artisan config:cache
php artisan route:cache

# Ensure Apache is configured to use port 8080
echo "Listen 8080" >> /etc/apache2/ports.conf
sed -i 's/VirtualHost \*:80/VirtualHost \*:8080/g' /etc/apache2/sites-available/*.conf
sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/*.conf

# Start Apache in the foreground
apache2-foreground