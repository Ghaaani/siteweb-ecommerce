#!/bin/sh
set -e

if [ -z "$APP_KEY" ]; then
    echo "APP_KEY is not set. Generate one with: php artisan key:generate --show" >&2
    exit 1
fi

# Railway provides PORT; Apache must listen on it.
PORT="${PORT:-8080}"
sed -ri "s/Listen 80$/Listen ${PORT}/" /etc/apache2/ports.conf
sed -ri "s/<VirtualHost \*:80>/<VirtualHost *:${PORT}>/" /etc/apache2/sites-available/000-default.conf

# Wait for the database, then migrate (retry: the DB may still be starting).
i=0
until php artisan migrate --force; do
    i=$((i+1))
    if [ "$i" -ge 15 ]; then
        echo "Database not reachable after $i attempts, giving up." >&2
        exit 1
    fi
    echo "Migration failed, retrying in 4s ($i/15)..."
    sleep 4
done

# Idempotent: demo content + admin account (from ADMIN_EMAIL / ADMIN_PASSWORD)
php artisan db:seed --force
php artisan storage:link --force >/dev/null 2>&1 || true
chown -R www-data:www-data storage bootstrap/cache

exec apache2-foreground
