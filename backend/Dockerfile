FROM php:8.2-apache

# 1. Install system dependencies
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libzip-dev \
    libicu-dev \
    unzip \
    git \
    curl \
    && docker-php-ext-install pdo_pgsql bcmath zip intl

# 2. Install Node.js (for building frontend assets)
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

# 3. Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 4. Set working directory
WORKDIR /var/www/html

# 5. Build arguments for environment variables
# (This allows us to leverage Render's build-time env vars if needed, though we usually use runtime env)

# 6. Configure Apache DocumentRoot to point to /public (Laravel standard)
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf

# 6.1 Explicitly allow .htaccess overrides
RUN echo '<Directory /var/www/html/public>\n\
    Options Indexes FollowSymLinks\n\
    AllowOverride All\n\
    Require all granted\n\
    </Directory>' > /etc/apache2/conf-available/laravel.conf \
    && a2enconf laravel

# 7. Enable Apache mod_rewrite
RUN a2enmod rewrite

# 8. Copy application code
COPY . .

# 9. Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction

# 10. Install Node dependencies and build assets
RUN npm install && npm run build

# 11. Set permissions for Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# 12. Configure entrypoint to handle migrations and caching on startup
# We'll use a custom script or just chain commands in CMD. 
# For simplicity, we'll embed a script.
RUN echo "#!/bin/sh\n" \
    "php artisan migrate --force\n" \
    "php artisan config:cache\n" \
    "php artisan route:cache\n" \
    "php artisan view:cache\n" \
    "apache2-foreground" > /usr/local/bin/start-container
RUN chmod +x /usr/local/bin/start-container

# 13. Expose port 80 (Render detects this)
EXPOSE 80

# 14. Start command
CMD ["/usr/local/bin/start-container"]
