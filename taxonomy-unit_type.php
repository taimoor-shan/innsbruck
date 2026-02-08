<?php
/**
 * 
 * Template Name: Unit Type Archive
 * The template for displaying Unit Type archive pages.
 *
 * @package TailPress
 */

get_header();

$term = get_queried_object();
$hero_bg = get_field('hero_image', $term) ?: 'https://storage.googleapis.com/download/storage/v1/b/prd-shared-services.firebasestorage.app/o/h2m-assets%2Fb4cef5120d7ca8c5d3e060b4da4044d5a07da822.jpg?generation=1770502588636374&alt=media'; // Fallback
?>

<!-- Hero Section (Editable via Term Archive) -->
<!-- Hero Section (Editable via Term Archive) -->
<?php get_template_part('template-parts/components/hero', null, [
    'image' => $hero_bg,
    'title' => get_query_var('term') ? single_term_title('', false) : single_month_title('', false), // Handle potential non-term queries if any, though this is a taxonomy template. single_term_title echoes by default so we need false. Wait, single_term_title() returns string if display is false? Yes.
    'subtitle' => term_description(),
    'height' => 'h-[50vh]'
]); ?>

<!-- Main Content & Grid -->
<section class="bg-white pt-20 pr-0 pb-20 pl-0">
    <div class="container mx-auto px-4">

        <!-- Optional: Extra Description / Amenities from ACF on Term -->
        <?php if ($extra_desc = get_field('full_description', $term)): ?>
            <div class="max-w-3xl mx-auto text-center mb-16 text-lg text-gray">
                <?php echo wp_kses_post($extra_desc); ?>
            </div>
        <?php endif; ?>

        <?php get_template_part('template-parts/components/units-loop'); ?>

    </div>
</section>

<?php
get_footer();
