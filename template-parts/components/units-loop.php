<?php
/**
 * Component: Units Loop
 *
 * @package TailPress
 * @param array $args Arguments for the loop.
 *  - query: (WP_Query) Optional. A custom WP_Query object to use. If not provided, uses the global query.
 *  - posts_per_page: (int) Optional. If creating a new query inside (not implemented here for simplicity, best to pass query object).
 *  - class: (string) Optional. CSS classes for the grid container.
 */

$query = $args['query'] ?? null;
$grid_class = $args['class'] ?? 'grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-8 max-w-5xl mx-auto';

// Check if we have a custom query, otherwise use global default
$is_custom_query = false;
if ($query instanceof WP_Query) {
    $is_custom_query = true;
} else {
    // Rely on global loop
    global $wp_query;
    $query = $wp_query;
}

if ($query->have_posts()): ?>
    <div class="<?php echo esc_attr($grid_class); ?>">
        <?php while ($query->have_posts()):
            $query->the_post(); ?>
            <div class="h-full">
                <?php get_template_part('template-parts/components/card-unit', null, array('post_id' => get_the_ID())); ?>
            </div>
        <?php endwhile; ?>
    </div>

    <?php
    // Only show pagination for main query or if explicitly requested (could add arg for pagination)
    if (!$is_custom_query) {
        echo '<div class="mt-12">';
        the_posts_navigation();
        echo '</div>';
    } else {
        // Restore original post data if custom query
        wp_reset_postdata();
    }
    ?>

<?php else: ?>
    <?php if (!$is_custom_query): ?>
        <div class="text-center py-20">
            <h3 class="text-2xl font-bold text-dark">No properties found.</h3>
            <p class="text-gray mt-2">Check back later for updates.</p>
        </div>
    <?php endif; ?>
<?php endif; ?>