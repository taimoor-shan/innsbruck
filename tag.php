<?php
/**
 * Tag archive template.
 *
 * @package TailPress
 */

get_header();
?>

<!-- Tag Hero -->
<section class="bg-primary text-white py-12 md:py-20 mt-16">
    <div class="container mx-auto px-4 text-center">
        <span class="text-white/60 text-sm uppercase tracking-wider font-medium">
            <?php _e('Tag', 'tailpress'); ?>
        </span>
        <h1 class="text-3xl md:text-5xl lg:text-6xl font-bold mt-2">
            <?php single_tag_title(); ?>
        </h1>
        <?php if ($desc = tag_description()): ?>
            <p class="text-white/80 text-base sm:text-lg max-w-2xl mx-auto mt-4">
                <?php echo wp_kses_post($desc); ?>
            </p>
        <?php endif; ?>
    </div>
</section>

<!-- Tag Posts Grid -->
<section class="bg-accent/50 py-12 md:py-20">
    <div class="container mx-auto px-4">
        <?php
        $posts_page_id = get_option('page_for_posts');
        if (have_posts()):
        ?>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                <?php while (have_posts()): the_post(); ?>
                    <?php get_template_part('template-parts/components/card-blog'); ?>
                <?php endwhile; ?>
            </div>
            <?php TailPress\Pagination::render(); ?>
        <?php else: ?>
            <div class="text-center py-16">
                <p class="text-gray text-lg"><?php _e('No posts found with this tag.', 'tailpress'); ?></p>
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
