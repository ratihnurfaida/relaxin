FROM dunglas/frankenphp:php8.5

# Install dependencies
RUN install-php-extensions \
    intl \
	bz2 \
	gd \
	zip \
	opcache \
    mysqli \
	pdo_mysql

# Install Node (sementara untuk build saja)
RUN apt-get update && apt-get install -y nodejs npm

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

# Copy file
COPY . .

# Install PHP deps
RUN composer install --no-dev --optimize-autoloader

# Build frontend
RUN npm install && npm run build

# Hapus node_modules biar ringan
RUN rm -rf node_modules

# RUN mkdir -p ${WORKDIR}/storage/app/database
# Permission
RUN chown -R www-data:www-data storage bootstrap/cache
    # && chmod -R 775 storage bootstrap/cache

# Optimize Laravel
RUN php artisan storage:link \
    && php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache

# EXPOSE 80 443 443/udp

# CMD ["php", "artisan", "octane:frankenphp", "--host=0.0.0.0", "--port=80"]
CMD ["frankenphp", "run", "--config", "/etc/caddy/Caddyfile"]