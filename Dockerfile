# ==============================================================
# Stage 1 — Vendor Builder
# ==============================================================
FROM composer:2.7 AS vendor

WORKDIR /app

# Copy manifest files first
COPY composer.json composer.lock ./

RUN composer install \
    --no-dev \
    --no-interaction \
    --prefer-dist \
    --optimize-autoloader \
    --no-scripts

COPY . .

# Fire post-install hooks
RUN composer run-script post-autoload-dump --no-interaction 2>/dev/null || true

# ==============================================================
# Stage 2 — Production (FrankenPHP)
# ==============================================================
FROM dunglas/frankenphp:1-php8.3 AS production

# install-php-extensions
RUN install-php-extensions \
    pdo_mysql \
    zip \
    opcache \
    pcntl

# PHP production hardening
COPY docker/php/php.ini     /usr/local/etc/php/conf.d/99-laravel.ini
COPY docker/php/opcache.ini /usr/local/etc/php/conf.d/99-opcache.ini

# Caddy / FrankenPHP virtual host
COPY docker/caddy/Caddyfile /etc/caddy/Caddyfile

# Hard-code safe production defaults
ENV APP_ENV=production \
    APP_DEBUG=false \
    LOG_CHANNEL=stderr \
    LOG_LEVEL=error \
    SERVER_NAME=":80"

WORKDIR /var/www/html

# ── Copy only what Laravel needs at runtime ──────────────────
COPY --from=vendor --chown=www-data:www-data /app/app        ./app
COPY --from=vendor --chown=www-data:www-data /app/bootstrap  ./bootstrap
COPY --from=vendor --chown=www-data:www-data /app/config     ./config
COPY --from=vendor --chown=www-data:www-data /app/database   ./database
COPY --from=vendor --chown=www-data:www-data /app/public     ./public
COPY --from=vendor --chown=www-data:www-data /app/resources  ./resources
COPY --from=vendor --chown=www-data:www-data /app/routes     ./routes
COPY --from=vendor --chown=www-data:www-data /app/storage    ./storage
COPY --from=vendor --chown=www-data:www-data /app/vendor     ./vendor
COPY --from=vendor --chown=www-data:www-data /app/artisan    ./artisan
COPY --from=vendor --chown=www-data:www-data /app/composer.json  ./composer.json
COPY --from=vendor --chown=www-data:www-data /app/composer.lock  ./composer.lock

# FrankenPHP worker bootstrap
COPY --chown=www-data:www-data docker/php/worker.php ./worker.php

# Ensure all writable Laravel directories exist with correct perms.
RUN mkdir -p \
        storage/framework/cache/data \
        storage/framework/sessions \
        storage/framework/views \
        storage/logs \
        bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

COPY docker/php/entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

EXPOSE 80 443 443/udp

ENTRYPOINT ["docker-entrypoint.sh"]
CMD ["frankenphp", "run", "--config", "/etc/caddy/Caddyfile"]
