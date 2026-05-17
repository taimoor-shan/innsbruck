# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Commands

```bash
npm run dev      # Start Vite dev server (HMR on :3000, needs WP at :8000)
npm run build    # Production build → dist/
```

No PHP tests or linting are configured. The theme runs inside WordPress — there is no standalone PHP execution.

## Architecture

This is a **WordPress theme** ("delta", domain: `tailpress`) built on the [TailPress](https://tailpress.io) boilerplate — Tailwind CSS v4 + Vite + WordPress.

### Theme foundation: tailpress/framework (`vendor/tailpress/framework/`)

`functions.php` bootstraps via `tailpress()` which returns a singleton `TailPress\Framework\Theme` configured with:

- **Asset pipeline:** `ViteCompiler` compiles `resources/css/app.css` and `resources/js/app.js`. Stable output names (`assets/[name].js`) so PHP doesn't need a manifest reader. Editor stylesheet at `resources/css/editor-style.css`.
- **Menu system:** One nav location (`primary`). Custom `menu_type` arg (`header`, `footer`, `mobile`) controls Tailwind class injection via `nav_menu_css_class` and `nav_menu_link_attributes` filters.
- **Theme support:** `title-tag`, `custom-logo`, `post-thumbnails`, `align-wide`, `wp-block-styles`, `responsive-embeds`, `html5` (search-form, comment-form, comment-list, gallery, caption).

### Content model

Two custom post types registered from `functions.php`:

| CPT | Slug | Taxonomies | Notes |
|-----|------|------------|-------|
| Property | `accommodation` | `property_type` (hierarchical), `property_status` (hierarchical) | `show_in_rest: true`, has archive, supports excerpt |
| Project | `project` | `project_stage` (hierarchical, admin-only terms) | `show_in_rest: true`, no archive |

Custom ordering: when `sort_sold_last` query var is set, a `posts_orderby` filter pushes sold-status properties to the end via a `wpdb` subquery.

### ACF field groups (inc/class-tailpress-acf.php)

`TailPress_ACF` registers 5 field groups on `acf/init`:

1. **Homepage** — hero video, trust section (repeater), properties section title/subtitle, CTA. Location: `front-page.php` template.
2. **Listing Landing** — WYSIWYG features, property_type filter. Location: `listing-landing.php` template.
3. **Property Type terms** — hero image, card image, full description. Location: `property_type` taxonomy.
4. **Property Details** — featured flag, price (number), street address, city/state, size (m²), bedrooms, bathrooms, document, layout image, lat/lng. Location: `accommodation` CPT.
5. **Project Details** — address, city, year, area, units, type, timeline, investment document (PDF), CTA link. Location: `project` CPT.

Always check `acf_add_local_field_group` before touching field definitions — these are PHP-registered, not stored in the DB.

### Template hierarchy and component system

Pages load content through `template-parts/content-*.php`, which in turn use components from `template-parts/components/`:

| Component | Purpose |
|-----------|---------|
| `hero.php` | Reusable hero with optional video background, image fallback, title/subtitle, and injected button content |
| `button.php` | Multi-style button (primary, outline, white-solid, dark-solid, ghost, outline-card, etc.) with icon support |
| `properties-loop.php` | Reusable `WP_Query` loop for properties. Accepts args: `property_type`, `property_status`, `featured`, `posts_per_page`, `columns`, `show_pagination`, `paged`. Used by homepage, AJAX filter, and taxonomy archives. |
| `card-unit.php` | Single property card |
| `card-benefit.php` | Benefit card (icon + title + description) |
| `card-skeleton.php` | Loading skeleton |
| `units-loop.php` | Deprecated/alternative units loop |

Page templates in `page-templates/`:
- `front-page.php` → `content-home.php` (homepage with hero, benefits, trust accordion, featured properties, CTA)
- `projects.php` → projects listing with philosophy, grid, lead form
- `listing-landing.php` → filtered property listing with features WYSIWYG
- `contact-us.php` → contact form page
- `all-properties.php` → full property archive with filters

### JavaScript

`resources/js/app.js` initializes **Alpine.js** (with collapse plugin) and **Swiper.js** (with Navigation module). Both are exposed on `window` so they can be used inline in PHP templates.

### CSS structure (Tailwind v4)

`resources/css/app.css` imports: `tailwindcss` (the new v4 `@import` syntax) → `theme.css` → `utilities.css` → `custom.css` (in `utilities` layer). Sources scan all PHP files in the theme and the framework. Base layer defines typography defaults (h1-h6, p, a, ol). `safelist.txt` ensures WP block classes aren't purged.

### Contact info

Managed via the **Customizer** (`inc/customizer.php`): address, phone, WhatsApp label, email. Accessed in templates via `get_theme_mod('contact_address')` etc.

### AJAX

`wp_ajax_filter_properties` / `wp_ajax_nopriv_filter_properties` returns server-rendered property HTML. It delegates to `properties-loop.php` via `get_template_part` and returns the output via `wp_send_json_success`.

### Namespaced classes (src/)

- `TailPress\Pagination` — pagination link generation
- `TailPress\Walkers\CommentWalker` — custom comment walker

Autoloaded via Composer PSR-4: `"TailPress\\": "src/"`.

## Knowledge graph (graphify)

A graphify knowledge graph exists in `graphify-out/` (built from the theme's code, docs, and icons — vendor excluded). Use it to answer architecture questions without re-reading every file:

```bash
/graphify query "how does X work"      # BFS — broad context around a concept
/graphify query "how does X work" --dfs  # DFS — trace a specific dependency chain
/graphify path "ConceptA" "ConceptB"    # shortest path between two concepts
/graphify explain "ConceptName"         # everything connected to one node
```

Key graph stats: 117 nodes, 84 edges, 41 communities. God nodes (most-connected): **Innsbruck City Apartments Homepage** (9 edges), **React to WordPress Migration Architecture** (8 edges), **Architecture Decisions Table** (7 edges), **Pagination** (6 edges). The report is at `graphify-out/GRAPH_REPORT.md` and the interactive viz at `graphify-out/graph.html`.

The `.graphifyignore` file excludes `vendor/`, `graphify-out/`, `dist/`, and `node_modules/` from re-extraction. Run `/graphify --update` after significant code changes to refresh the graph.

## Agent state management

Per `.agent/rules/workflows/state-management.md`: after every task, update `docs/state.md` (the project blackboard). Commit with prefix `agent(state):`. Never update state.md directly on `master` — use feature branches. On session start, read `git log -p docs/state.md` for context.
