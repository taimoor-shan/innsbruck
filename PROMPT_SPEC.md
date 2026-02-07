# WP-Tailwind Migration Spec: React to WordPress

## 1. Context & Role
- **Agent Role:** Senior WP Developer.
- **Goal:** Migrate React SPA component to [Insert Theme Name] (Tailwind-based).
- **Time Constraint:** < 3 Hours.

## 2. Technical Architecture
- **Theme Foundation:** Tailwind-first Bare Theme.
- **Component Strategy:** 1:1 Mapping.
  - React Component -> `template-parts/content-{name}.php`
  - React Props -> ACF Fields / WP Native Functions.
- **Styling:** Keep all Tailwind utility classes. Do NOT convert to Vanilla CSS.

## 3. Implementation Instructions
### Phase 1: Asset Integration
- Enqueue the theme's main stylesheet in `functions.php`.
- Ensure `tailwind.config.js` content array includes all PHP paths.

### Phase 2: Markup Translation
- Convert JSX `className` to HTML `class`.
- Replace `{props.title}` with `<?php echo get_field('title'); ?>` or `the_title()`.
- Use `get_template_directory_uri()` for all image/asset paths.

### Phase 3: WordPress Core Integration
- Wrap the main content in the "The Loop".
- Register a primary navigation menu to replace the static React navbar.
- Ensure `wp_head()` and `wp_footer()` are correctly placed.

## 4. Quality Guardrails
- **Security:** Use `esc_html()` on all dynamic strings.
- **Performance:** No unnecessary JS libraries; rely on Tailwind for UI.
- **Responsiveness:** Ensure Tailwind mobile-first prefixes (`md:`, `lg:`) are preserved.