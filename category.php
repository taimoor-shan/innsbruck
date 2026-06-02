<?php

/**
 * Category archive template.
 *
 * @package TailPress
 */

get_header();
?>

<!-- Category Hero -->
<section
    class="relative bg-dark text-white py-28 md:py-36 mt-20 bg-cover bg-center bg-no-repeat"
    style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/img/innsbruck-005.jpeg');">

    <div class="absolute bg-dark opacity-[.7] w-full h-full inset-0 z-10"></div>

    <div class="relative z-20 container mx-auto px-4 text-center">
        <span class="text-white/60 text-sm uppercase tracking-wider font-medium">
            <?php _e('Category', 'tailpress'); ?>
        </span>

        <h1 class="text-3xl md:text-5xl lg:text-6xl font-bold mt-2">
            <?php single_cat_title(); ?>
        </h1>

        <?php if ($desc = category_description()): ?>
            <p class="text-white/80 text-base sm:text-lg max-w-2xl mx-auto mt-4">
                <?php echo wp_kses_post($desc); ?>
            </p>
        <?php endif; ?>
    </div>
</section>

<!-- Category Posts Grid -->
<section class="bg-accent/50 py-12 md:py-20">
    <div class="container mx-auto px-4">
        <?php
        // Category filter bar — show all categories + active state
        $categories = get_categories(['orderby' => 'name', 'order' => 'ASC']);
        $current_cat_id = get_queried_object_id();
        $posts_page_id = get_option('page_for_posts');
        if (!empty($categories)):
        ?>
            <div class="blog-filter-bar mb-8 justify-center md:justify-start">
                <a href="<?php echo esc_url(get_permalink($posts_page_id ?: home_url('/'))); ?>"
                    class="filter-link">
                    <?php _e('All', 'tailpress'); ?>
                </a>
                <?php foreach ($categories as $cat): ?>
                    <a href="<?php echo esc_url(get_category_link($cat)); ?>"
                        class="filter-link <?php echo ($cat->term_id === $current_cat_id) ? 'active' : ''; ?>">
                        <?php echo esc_html($cat->name); ?>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if (have_posts()): ?>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                <?php while (have_posts()): the_post(); ?>
                    <?php get_template_part('template-parts/components/card-blog'); ?>
                <?php endwhile; ?>
            </div>
            <?php TailPress\Pagination::render(); ?>
        <?php else: ?>
            <div class="text-center py-16">
                <p class="text-gray text-lg"><?php _e('No posts found in this category.', 'tailpress'); ?></p>
                <a href="<?php echo esc_url(get_permalink($posts_page_id ?: home_url('/'))); ?>"
                    class="inline-block mt-4 text-primary hover:underline font-medium">
                    <?php _e('View all articles', 'tailpress'); ?>
                </a>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- CTA Section -->
<?php $cta_data = tailpress_blog_cta_data(); ?>
<section class="bg-primary text-white py-12 md:py-20">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold mb-4">
            <?php echo esc_html($cta_data['title']); ?>
        </h2>
        <p class="text-white/80 text-base sm:text-lg max-w-2xl mx-auto mb-8">
            <?php echo esc_html($cta_data['subtitle']); ?>
        </p>
        <div class="flex flex-wrap justify-center gap-4">
            <?php
            get_template_part('template-parts/components/button', null, [
                'href' => esc_url($cta_data['button1_url']),
                'text' => $cta_data['button1_text'],
                'style' => 'dark-solid',
                'class' => '',
            ]);
            get_template_part('template-parts/components/button', null, [
                'href' => esc_url($cta_data['button2_url']),
                'text' => $cta_data['button2_text'],
                'style' => 'white-outline',
                'class' => '',
            ]);
            ?>
        </div>
    </div>
</section>

<?php
get_footer();
