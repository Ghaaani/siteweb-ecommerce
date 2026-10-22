# E-commerce Website

A Laravel e-commerce site: public shop (home, shop by category, cart, checkout, about, contact) and an admin area to manage products, categories and the about page.

**Stack:** Laravel 10, PHP 8.1+, Blade, MySQL or SQLite, Vite.

## Run locally

```bash
composer install
cp .env.example .env
php artisan key:generate
```

Database — pick one:

- **MySQL:** create a database named `pfe_ecommerce` (or edit `DB_*` in `.env`).
- **SQLite (no server needed):** in `.env` set `DB_CONNECTION=sqlite`, remove the other `DB_*` lines, then `touch database/database.sqlite`.

```bash
php artisan migrate
php artisan db:seed        # optional demo categories, products, about + contact content
php artisan storage:link   # needed to display product images
php artisan serve
```

Open http://127.0.0.1:8000/ (shop). The admin pages (`/products`, `/product_categories`, `/aboutus`) require a login: set `ADMIN_EMAIL` and `ADMIN_PASSWORD` in `.env` before `php artisan db:seed` and use them at `/login`. If they are empty, no admin account is created.

## Tests

```bash
php artisan test
```

Tests run on in-memory SQLite and cover: every page rendering (empty and seeded database), adding to cart / quantity / removal, category and product create/update/delete with validation.

## Deploy on Railway

GitHub Pages cannot host this project (it is a PHP/Laravel app, Pages only serves static files). It is set up to run on [Railway](https://railway.com) with a `Dockerfile` (PHP 8.3 + Apache) and a MySQL database.

1. Generate an app key locally: `php artisan key:generate --show` (copy the `base64:...` value).
2. On Railway: **New Project → Deploy from GitHub repo →** this repository. Railway detects the `Dockerfile`.
3. In the same project: **New → Database → MySQL**.
4. In the web service's **Variables** tab, add these (`MySQL` is the name of your database service; use Railway's variable references for the database values):

   | Variable | Value |
   |---|---|
   | `APP_KEY` | the key from step 1 |
   | `APP_ENV` | `production` |
   | `APP_DEBUG` | `false` |
   | `FORCE_HTTPS` | `true` |
   | `DB_CONNECTION` | `mysql` |
   | `DB_HOST` | `${{MySQL.MYSQLHOST}}` |
   | `DB_PORT` | `${{MySQL.MYSQLPORT}}` |
   | `DB_DATABASE` | `${{MySQL.MYSQLDATABASE}}` |
   | `DB_USERNAME` | `${{MySQL.MYSQLUSER}}` |
   | `DB_PASSWORD` | `${{MySQL.MYSQLPASSWORD}}` |
   | `ADMIN_EMAIL` | your admin email |
   | `ADMIN_PASSWORD` | a long, unique password |
   | `APP_URL` | your public URL (after step 5) |

5. **Settings → Networking → Generate Domain** to get the public URL.
6. Deploy. On every start the container waits for the database, runs `php artisan migrate --force`, then `php artisan db:seed --force` (demo products and the admin account, safe to repeat), then starts Apache.

Notes:
- Changing `ADMIN_PASSWORD` and redeploying resets the admin password.
- Demo products deleted from the admin come back on the next deploy because the seeder re-creates them.
- Files uploaded from the admin are stored on the container disk and are lost on redeploy unless you attach a Railway volume mounted at `/var/www/html/storage/app/public`. The demo images are restored automatically.
- Railway's free credit is limited and changes over time; check its current pricing before relying on it.

## Known limitations

- **The cart is shared by all visitors.** It is stored in one database table with no per-visitor id, so everyone sees and edits the same cart. Fine for a demo, not for real customers.
- Checkout and contact forms are display-only (no order or message is stored).
