# PRODUCT.md — E-commerce Website

## What this is
A self-contained e-commerce store (Laravel 10 + Blade + jQuery + Bootstrap 5). Visitors browse
the catalog, add to a cart, and pay with a credit/debit card (Stripe) or PayPal — sandbox/demo
mode when no keys are configured. Registered customers see their order history; an admin
manages the catalog and orders in a Bootstrap admin area.

**Demo data note:** the seeded catalog is placeholder content — categories say Chairs/Lamps/
Tables while product photos show phones. Copy in the UI stays product-agnostic; replace both
the seeds and the images when real inventory arrives.

## Who it serves
- **Shopper (customer)** — lands on the home page, filters the shop, opens a product, buys.
  Success = order placed and confirmed in a few clicks. Image: the shop's clean warm world.
- **Admin** — solo operator; success = fast catalog + order management.

## Surfaces & modes
| Surface | Mode | Notes |
|---|---|---|
| Home (/index) | Persuade | Static hero (no carousel), category + featured products, newsletter signup |
| Shop (/shop) | Operate | URL-state filters (category, q), product grid |
| Product (/single_product/{id}) | Operate | Add to cart / buy now / wishlist |
| Cart, checkout | Operate | No fake features; errors inline |
| Order complete / account / wishlist | Operate | Read + act |
| Admin (/products, /orders, …) | Operate | Bootstrap admin layout |

## Rules captured from the owner
- **Every visible control must actually work** — no fake coupons, quotes, or mock
  newsletters. If a feature has no backend, it is removed or given one.
- PayPal + credit card checkout; demo mode when keys are absent.
- Performance budget: no triple-loaded libraries, no 404 assets, no animation-gated CTAs.
- Accent colors: sage green + bronze on warm parchment; Inter for UI copy.

## Out of scope / not owned here
- Multi-currency, real shipping rates, discount engines, marketplace features.
- The admin template (Quixkit) may keep its own legacy styling.
