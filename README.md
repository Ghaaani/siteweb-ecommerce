# siteweb-ecommerce

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

Open http://127.0.0.1:8000/index (shop) — admin pages: `/products`, `/product_categories`, `/aboutus`.

## Tests

```bash
php artisan test
```

Tests run on in-memory SQLite and cover: every page rendering (empty and seeded database), adding to cart / quantity / removal, category and product create/update/delete with validation.

## Known limitations

- **The admin routes are not protected by authentication.** Anyone who knows the URLs can create or delete products. Add a login before any public deployment.
- Checkout and contact forms are display-only (no order or message is stored).
