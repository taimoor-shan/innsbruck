<?php
/**
 * Template Name: Listing Landing Page
 *
 * @package TailPress
 */

get_header();

// 1. Hero Data
$hero_title = get_the_title();
$hero_subtitle = get_the_excerpt();
$hero_image = get_the_post_thumbnail_url(get_the_ID(), 'full');

// Render Hero
get_template_part('template-parts/components/hero', null, [
    'image' => $hero_image,
    'title' => $hero_title,
    'subtitle' => '',
    'height' => 'h-[60vh]'
]);

// 2. Intro Content Section

?>

<section class="py-12 md:py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="entry-content max-w-4xl mx-auto">
            <?php the_content(); ?>
        </div>
    </div>
</section>

<?php
// 3. Features Section
$features_title = get_field('features_title') ?: 'Luxury Features & Amenities';
$features = get_field('features_content');

// Fallback features if empty (matches user provided HTML)
if (empty($features)) {
    $features = '<ul><li>Luxury Jacuzzi for 5 persons on private balcony</li><li>Smart TV with Premium sound system</li><li>Designer stone kitchen with Gaggenau appliances</li><li>Spacious living areas with designer furniture</li><li>King-size bed with walk-in closet</li><li>Towels & bed sheets provided</li><li>Large private balcony in both units</li><li>Climate control heating and cooling</li><li>High speed Wifi connectivity</li></ul>';
}
?>

<section class="py-12 md:py-20 bg-gray/5">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold mb-6 md:mb-12 text-center text-dark">
                <?php echo esc_html($features_title); ?>
            </h2>

            <?php if ($features):
                ?>

                <div class="myList">
                    <?php echo $features; ?>
                </div>

            <?php endif; ?>

        </div>
    </div>
</section>

<?php
// 4. Units Grid
// Get selected unit type term ID to filter
// 4. Units Grid
// Get selected unit type term ID to filter
$unit_type_term_id = get_field('unit_type_filter');
$unit_type_name = '';

$args = [
    'post_type' => 'accommodation',
    'posts_per_page' => -1,
];

if ($unit_type_term_id) {
    $term = get_term($unit_type_term_id, 'unit_type');
    if ($term && !is_wp_error($term)) {
        $unit_type_name = $term->name;
    }

    $args['tax_query'] = [
        [
            'taxonomy' => 'unit_type',
            'field' => 'term_id',
            'terms' => $unit_type_term_id,
        ]
    ];
}

$units_query = new WP_Query($args);
?>

<section class="py-12 md:py-20 bg-white">
    <div class="container mx-auto px-4">
        <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold mb-6 md:mb-12 text-center">Available
            <?php echo $unit_type_name ? esc_html($unit_type_name) : ''; ?> Units
        </h2>
        <?php get_template_part('template-parts/components/units-loop', null, ['query' => $units_query]); ?>
    </div>
</section>

<?php
get_footer();
