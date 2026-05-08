#!/bin/sh
set -e

# Warm up Laravel's bootstrap caches on every container start.
php /var/www/html/artisan config:cache --no-ansi --quiet
php /var/www/html/artisan route:cache  --no-ansi --quiet
php /var/www/html/artisan view:cache   --no-ansi --quiet

# Hand off to frankenphp (the CMD from the Dockerfile)
exec "$@"
