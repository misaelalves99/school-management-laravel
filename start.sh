#!/bin/sh

# Run migrations to ensure the database is ready
php artisan migrate --force

# Clear and cache configurations for production
php artisan config:clear
php artisan config:cache
php artisan route:cache

# Start Apache in the foreground
exec apache2-foreground
