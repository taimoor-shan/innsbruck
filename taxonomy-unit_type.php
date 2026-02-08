<?php
/**
 * The template for displaying Unit Type archive pages.
 *
 * @package TailPress
 */

get_header();

$term = get_queried_object();
$hero_bg = get_field('hero_image', $term) ?: 'https://storage.googleapis.com/download/storage/v1/b/prd-shared-services.firebasestorage.app/o/h2m-assets%2Fb4cef5120d7ca8c5d3e060b4da4044d5a07da822.jpg?generation=1770502588636374&alt=media'; // Fallback
?>

<!-- Hero Section (Editable via Term Archive) -->
<section class="items-center flex h-[50vh] justify-center overflow-hidden relative">
    <div class="bg-center bg-cover absolute left-0 top-0 right-0 bottom-0"
        style="background-image: url('<?php echo esc_url($hero_bg); ?>');">
        <div class="absolute left-0 top-0 right-0 bottom-0"
            style="background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.6));">
        </div>
    </div>
    <div class="ml-auto mr-auto relative text-center max-w-4xl pt-0 pr-4 pb-0 pl-4 z-[10]">
        <h1
            class="font-bold text-center mb-[24px] text-light text-[48px] leading-[56px] lg:text-[72px] lg:leading-[72px]">
            <?php single_term_title(); ?>
        </h1>
        <div
            class="font-light text-center mb-[32px] text-light/90 text-[20px] leading-[28px] lg:text-[24px] lg:leading-[32px] max-w-2xl mx-auto">
            <?php echo term_description(); ?>
        </div>
    </div>
</section>

<!-- Main Content & Grid -->
<section class="bg-white pt-20 pr-0 pb-20 pl-0">
    <div class="container mx-auto px-4">

        <!-- Optional: Extra Description / Amenities from ACF on Term -->
        <?php if ($extra_desc = get_field('full_description', $term)): ?>
            <div class="max-w-3xl mx-auto text-center mb-16 text-lg text-gray">
                <?php echo wp_kses_post($extra_desc); ?>
            </div>
        <?php endif; ?>

        <?php if (have_posts()): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-8 max-w-5xl mx-auto">
                <?php while (have_posts()):
                    the_post(); ?>
                    <div class="h-full">
                        <?php get_template_part('template-parts/components/card-unit', null, array('post_id' => get_the_ID())); ?>
                    </div>
                <?php endwhile; ?>
            </div>

            <div class="mt-12">
                <?php the_posts_navigation(); ?>
            </div>

        <?php else: ?>
            <div class="text-center py-20">
                <h3 class="text-2xl font-bold text-dark">No accommodations found.</h3>
                <p class="text-gray mt-2">Check back later for updates.</p>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php
get_footer();
