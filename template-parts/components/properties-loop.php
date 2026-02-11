<?php
/**
 * Component: Properties Loop
 *
 * Reusable loop for displaying properties (originally 'units').
 *
 * @package TailPress
 * @param array $args
 *  - query: (WP_Query) Optional custom query.
 *  - property_type: (string) Slug of property_type to filter by.
 *  - property_status: (string) Slug of property_status to filter by.
 *  - featured: (bool) Whether to show only featured properties.
 *  - posts_per_page: (int) Default 6.
 *  - columns: (int) Grid columns (default 3).
 *  - class: (string) Wrapper classes.
 *  - show_pagination: (bool) Default false.
 */

$defaults = [
    'query' => null,
    'property_type' => '',
    'property_status' => '',
    'featured' => false,
    'posts_per_page' => 6,
    'columns' => 3,
    'class' => '',
    'show_pagination' => false,
    'paged' => 1
];

$args = wp_parse_args($args, $defaults);
$query = $args['query'];

// Build Query if not provided
if (!$query) {
    $query_args = [
        'post_type' => 'accommodation',
        'posts_per_page' => $args['posts_per_page'],
        'paged' => $args['paged'] ?: (get_query_var('paged') ?: 1), // Use arg, or global var, or 1
        'post_status' => 'publish',
        'orderby' => 'menu_order date',
        'order' => 'ASC',
    ];

    $tax_query = [];

    if ($args['property_type']) {
        $tax_query[] = [
            'taxonomy' => 'property_type',
            'field' => 'slug',
            'terms' => $args['property_type'],
        ];
    }

    if ($args['property_status']) {
        $tax_query[] = [
            'taxonomy' => 'property_status',
            'field' => 'slug',
            'terms' => $args['property_status'],
        ];
    }

    if (!empty($tax_query)) {
        $query_args['tax_query'] = $tax_query;
        if (count($tax_query) > 1) {
            $query_args['tax_query']['relation'] = 'AND';
        }
    }

    if ($args['featured']) {
        $query_args['meta_key'] = 'featured';
        $query_args['meta_value'] = '1';
    }

    $query = new WP_Query($query_args);
}

// Grid Classes
$cols = $args['columns'];
$grid_class = $args['class'] ?: "grid grid-cols-1 md:grid-cols-2 lg:grid-cols-{$cols} gap-8";

if ($query->have_posts()):
    ?>
    <div class="<?php echo esc_attr($grid_class); ?>">
        <?php while ($query->have_posts()):
            $query->the_post(); ?>
            <div class="h-full">
                <?php
                // Using existing card-unit template (conceptually card-property)
                get_template_part('template-parts/components/card-unit', null, ['post_id' => get_the_ID()]);
                ?>
            </div>
        <?php endwhile; ?>
    </div>

    <?php if ($args['show_pagination']): ?>
        <div class="mt-12">
            <?php
            $big = 999999999; // need an unlikely integer
            echo paginate_links(array(
                'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                'format' => '?paged=%#%',
                'current' => max(1, get_query_var('paged')),
                'total' => $query->max_num_pages,
                'prev_text' => __('&laquo; Previous', 'tailpress'),
                'next_text' => __('Next &raquo;', 'tailpress'),
            ));
            ?>
        </div>
    <?php endif; ?>

    <?php wp_reset_postdata(); ?>

<?php else: ?>
    <div class="text-center py-12">
        <p class="text-gray text-lg">No properties found matching your criteria.</p>
    </div>
<?php endif; ?>