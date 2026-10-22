# DESIGN.md — E-commerce Website

Design tokens live in `public/client/css/custom.css`. This file is the contract; edit tokens
there and update this list together.

## World
Warm parchment surfaces, deep ink text, sage-green actions, bronze accents. Photography
carries the emotion; UI stays quiet so products read at a glance.

## Tokens
- Surfaces: `--ecom-bg #faf8f4`, `--ecom-surface #ffffff`, `--ecom-line #e9e2d6`
- Ink: `--ecom-ink #1b1a17`, `--ecom-muted #6e675c` (≥4.5:1 on bg), placeholders `#7d7466`
- Brand: `--ecom-primary #2f5d50` (actions, badges), `--ecom-primary-dark #24463d`,
  `--ecom-accent #c08552` (small accents only — never white text on it, use ink or place on ink),
  `--ecom-accent-dark #a8661f`
- State: `--ecom-success #2e7d4f`, `--ecom-danger #b3372f`
- Radii: `--ecom-radius 14px`, `--ecom-radius-sm 10px`, pills `999px`
- Shadows: `--ecom-shadow-sm/md` — always with y-offset + blur, never flat halos
- Type: Inter (`--ecom-font`), body 14.5–15px, `.ecom-hero-title` clamp(2.2rem…3.4rem);
  totals and price columns use `tabular-nums`
- Buttons: primary = ink pill → hover sage (`#2f5d50`), `translateY(-2px)` + shadow on hover;
  focus-visible ring `2px --ecom-accent` offset 2px on ALL links & buttons

## Motion (authored once)
- Entrance: one hero moment — `.ecom-rise` 0.6s `cubic-bezier(.22,1,.36,1)`, no chained delays;
  CTA is interactive within ~1s of paint
- Hover: card lift `translateY(-4px)`, image scale 1.04, 0.3–0.35s same ease
- Feedback: toasts slide+fade; at least one `aria-live` region per async surface
- Reduced motion: keep state change (instant swap) — never a global 0.01ms kill that
  erases feedback; disable only decorative loops

## Components
- Product card: `.product-item` surface + 1px line border, badge top-left (white on
  `--ecom-primary`), wishlist heart top-right (`.ecom-wish`, `.is-active` = danger fill),
  action row `.ecom-btn-add` / `.ecom-btn-buy`
- Status pills `.ecom-status--*`; toasts `.ecom-toast--success|error` inside
  `#ecom-toast-container[role=status][aria-live=polite]`
- Form controls: 1.5px line border, focus ring 4px rgba(47,93,80,.14); VISIBLE labels on
  checkout; `…` in placeholders; autocomplete on every identity field

## Frame rules
- `<main id="main-content">` + skip link; exactly one `h1` per page; kickers as styled
  `<p>` not headings (no eyebrow ban workaround via h6)
- Per-page `<title>` and meta description via `@section('title'/'meta')`
- Images: real `width`/`height`, `loading="lazy" decoding="async"` below the fold,
  hero `fetchpriority="high"`
- Browser chrome themed: `::selection`, `::marker`, focus rings, scroll on modals
