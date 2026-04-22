# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Overview

This is a WordPress site for **St. Edwards Alumni** (`stedwardsalumni.com`). The `wp-config.php` is ddev-managed — do not edit it directly. Database table prefix is `rg5x_`.

## Development Commands

```bash
# Start local environment (ddev)
ddev start
ddev launch

# WP-CLI via ddev
ddev wp <command>          # e.g., ddev wp cache flush
ddev wp plugin list
ddev wp theme list

# Flush caches after theme/plugin changes (W3 Total Cache is active)
ddev wp w3-total-cache flush all

# Composer (for mim-theme-plugin)
cd wp-content/plugins/mim-theme-plugin && composer install
composer dump-autoload      # after adding new PHP classes under includes/
```

## Architecture

### Active Theme: `digital-marketing-freelancer` (v2.2.2)

This is a **Full Site Editing (FSE) block theme** — no PHP template files, layout is defined in HTML:

- `templates/*.html` — page templates (front-page, archive, single, sidebar variants, etc.)
- `parts/*.html` — template parts (header, footer, header-banner, inner-banner, sidebar) — each composed using `<!-- wp:pattern {"slug":"digital-marketing-freelancer/..."} /-->`
- `inc/patterns/*.php` — block patterns registered via `inc/block-patterns.php`; these are the actual HTML markup for major site sections
- `theme.json` — design tokens: color palette (black bg, white fg, teal `#108f89`, orange `#f7a211`), typography (Poppins + Inter, both self-hosted), 1200px content width
- `styles/*.json` — 6 color scheme variations (forest-moss, midnight-bliss, ocean-wave, red-green, royal-plum, sunset-blush)
- `assets/` — FontAwesome, WOW.js scroll animations, custom JS/CSS, self-hosted Poppins and Inter fonts

**Key editing pattern**: to change a section's markup, edit the pattern file in `inc/patterns/` (e.g., `header-default.php`, `footer-default.php`). To change design tokens (colors, fonts, spacing), edit `theme.json`.

### Custom Plugin: `mim-theme-plugin` (v3.1)

Located at `wp-content/plugins/mim-theme-plugin/`. PSR-4 autoloaded under `MimTheme\Plugin\` namespace.

**Entry point**: `mim-theme-plugin.php` → singleton `MimTheme_Plugin` → initializes `Admin` and `Frontend` classes.

| Component | Location | Purpose |
|---|---|---|
| `Admin\CustomPosts` | `includes/Admin/CustomPosts.php` | Registers `portfolio` CPT and `portfolio-category` taxonomy |
| `Admin\Widgets` | `includes/Admin/Widgets.php` | Registers sidebar widgets (social follow: Facebook, Twitter, FollowMe, NewsLetter) |
| `Admin\Menu` | `includes/Admin/Menu.php` | Adds "Mim Theme" admin menu with Welcome/Item Registration/Auto Setup/System Status subpages |
| `Admin\Mim_Functions` | `includes/Admin/Mim_Functions.php` | Utility helpers: taxonomy lists, post lists (used by Elementor widgets) |
| `Elementor\ElementorWidgetSettings` | `includes/Elementor/` | Registers all custom Elementor widgets (conditionally loaded if Elementor is active) |

**Custom Elementor widgets** (`includes/Elementor/Widgets/`): About, Blog, Contacts, Experience, Hero, PortfolioFilter, PostsGrid, Pricing, Service, TestimonialCarousel, Timeline.

When adding a new Elementor widget: create `includes/Elementor/Widgets/MyWidget.php`, register it in `ElementorWidgetSettings::init_widgets()`.

### Key Installed Plugins

| Plugin | Purpose |
|---|---|
| Elementor | Page builder — most content pages are built with this |
| The Events Calendar | Events management |
| Contact Form 7 | Contact forms |
| Slim SEO | SEO meta/schema |
| W3 Total Cache | Caching (flush after code changes) |
| Smart Slider 3 | Hero/feature sliders |
| Robo Gallery | Image galleries |
| Unyson Framework | Theme options framework |
| All-in-One WP Migration | Backup/migration |

### Must-Use Plugin

`wp-content/mu-plugins/automation-by-installatron.php` — auto-installed by Installatron; do not remove.
