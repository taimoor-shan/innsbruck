<?php
/**
 * Search results template.
 *
 * @package TailPress
 */

get_header();
?>

<!-- Search Hero -->
<section class="bg-primary text-white py-12 md:py-20 mt-16">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-3xl md:text-5xl lg:text-6xl font-bold">
            <?php printf(__('Search results for: %s', 'tailpress'), '<span class="text-accent">' . esc_html(get_search_query()) . '</span>'); ?>
        </h1>
        <?php get_template_part('searchform'); ?>
    </div>
</section>

<!-- Results Grid -->
<section class="bg-accent/50 py-12 md:py-20">
    <div class="container mx-auto px-4">
        <?php
        $posts_page_id = get_option('page_for_posts');
        if (have_posts()):
        ?>
            <p class="text-gray mb-8 text-center md:text-left">
                <?php
                global $wp_query;
                printf(
                    _n('%s result found', '%s results found', $wp_query->found_posts, 'tailpress'),
                    number_format_i18n($wp_query->found_posts)
                );
                ?>
            </p>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                <?php while (have_posts()): the_post(); ?>
                    <?php get_template_part('template-parts/components/card-blog'); ?>
                <?php endwhile; ?>
            </div>
            <?php TailPress\Pagination::render(); ?>
        <?php else: ?>
            <div class="text-center py-16">
                <h2 class="text-xl font-semibold text-dark mb-4">
                    <?php _e('No results found.', 'tailpress'); ?>
                </h2>
                <p class="text-gray mb-6">
                    <?php _e('Try searching with different keywords or browse our latest articles.', 'tailpress'); ?>
                </p>
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
                'class' => 'text-sm sm:text-base',
            ]);
            get_template_part('template-parts/components/button', null, [
                'href' => esc_url($cta_data['button2_url']),
                'text' => $cta_data['button2_text'],
                'style' => 'white-outline',
                'class' => 'text-sm sm:text-base',
            ]);
            ?>
        </div>
    </div>
</section>

<?php
get_footer();
