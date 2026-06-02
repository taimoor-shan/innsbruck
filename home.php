<?php
/**
 * Blog index template.
 *
 * Used when a static front page is set and a "Posts page"
 * is selected in Settings > Reading.
 *
 * @package TailPress
 */

get_header();

$hero_data = tailpress_blog_hero_data();
$cta_data = tailpress_blog_cta_data();
$posts_page_id = get_option('page_for_posts');

// Featured article logic
$featured_post_id = null;
$show_featured = true;

if ($posts_page_id && function_exists('get_field')) {
    $show_featured = get_field('blog_show_featured', $posts_page_id);
    if ($show_featured === null) {
        $show_featured = true;
    }
    $featured_post_id = get_field('blog_featured_article', $posts_page_id);
}

// If no featured post selected, use the latest post from the main query
global $wp_query;
$exclude_ids = [];

if ($show_featured && !$featured_post_id && have_posts()) {
    $featured_post_id = $wp_query->posts[0]->ID;
    $exclude_ids[] = $featured_post_id;
} elseif ($show_featured && $featured_post_id) {
    $exclude_ids[] = $featured_post_id;
}
?>

<!-- Hero Section -->
<section class="bg-primary/20 text-dark py-12 md:py-20 mt-20">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold mb-2 md:mb-4">
            <?php echo esc_html($hero_data['title']); ?>
        </h1>
        <p class="text-base sm:text-lg md:text-xl text-dark/80 max-w-2xl mx-auto mb-0">
            <?php echo esc_html($hero_data['subtitle']); ?>
        </p>
    </div>
</section>

<?php
// Featured Article Section
if ($show_featured && $featured_post_id):
    $featured_post = get_post($featured_post_id);
    if ($featured_post):
        setup_postdata($featured_post);
        $featured_reading_time = tailpress_estimated_reading_time($featured_post_id);
        $featured_categories = get_the_category($featured_post_id);
        $featured_category = !empty($featured_categories) ? $featured_categories[0] : null;
?>
<section class="bg-accent py-12 md:py-20">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            <a href="<?php echo esc_url(get_permalink($featured_post)); ?>"
               class="block rounded-lg border border-gray/10 bg-white shadow-sm overflow-hidden hover:shadow-2xl transition-all featured-article group no-underline">
                <div class="grid grid-cols-1 md:grid-cols-2">
                    <?php if (has_post_thumbnail($featured_post)): ?>
                        <div class="featured-article-image h-40 sm:h-64 md:h-full min-h-[220px]">
                            <?php echo get_the_post_thumbnail($featured_post, 'large', [
                                'class' => 'w-full h-full object-cover',
                            ]); ?>
                        </div>
                    <?php endif; ?>
                    <div class="p-6 sm:p-8 lg:p-10 flex flex-col justify-center">
                        <?php if ($featured_category): ?>
                            <span class="category-badge self-start mb-3">
                                <?php echo esc_html($featured_category->name); ?>
                            </span>
                        <?php endif; ?>
                        <h2 class="text-xl sm:text-2xl md:text-3xl font-bold mt-2 mb-4 text-dark group-hover:text-primary transition-colors">
                            <?php echo esc_html(get_the_title($featured_post)); ?>
                        </h2>
                        <p class="text-gray text-base leading-relaxed mb-6">
                            <?php echo esc_html(wp_trim_words(
                                has_excerpt($featured_post) ? get_the_excerpt($featured_post) : get_the_content(null, false, $featured_post),
                                30
                            )); ?>
                        </p>
                        <div class="flex items-center gap-3 text-sm text-gray mt-auto">
                            <span class="flex items-center gap-1.5">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2"
                                     stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <polyline points="12 6 12 12 16 14"></polyline>
                                </svg>
                                <?php echo esc_html($featured_reading_time); ?> <?php _e('min read', 'tailpress'); ?>
                            </span>
                            <span class="meta-dot"></span>
                            <time datetime="<?php echo esc_attr(get_the_date('c', $featured_post)); ?>">
                                <?php echo esc_html(get_the_date('', $featured_post)); ?>
                            </time>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</section>
<?php
        wp_reset_postdata();
    endif;
endif;
?>

<!-- Latest Articles Grid -->
<section class="bg-accent/50 py-12 md:py-20">
    <div class="container mx-auto px-4">
        <?php
        // Category filter bar
        $categories = get_categories(['orderby' => 'name', 'order' => 'ASC']);
        if (!empty($categories)):
        ?>
        <div class="blog-filter-bar mb-8 justify-center md:justify-start">
            <a href="<?php echo esc_url(get_permalink($posts_page_id ?: home_url('/'))); ?>"
               class="filter-link active">
                <?php _e('All', 'tailpress'); ?>
            </a>
            <?php foreach ($categories as $cat): ?>
                <a href="<?php echo esc_url(get_category_link($cat)); ?>"
                   class="filter-link">
                    <?php echo esc_html($cat->name); ?>
                </a>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <h2 class="text-2xl md:text-3xl font-bold text-dark mb-8">
            <?php _e('Latest Articles', 'tailpress'); ?>
        </h2>

        <?php if (have_posts()): ?>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                <?php
                while (have_posts()):
                    the_post();
                    // Skip the featured post if in the main loop
                    if (in_array(get_the_ID(), $exclude_ids)) {
                        continue;
                    }
                ?>
                    <?php get_template_part('template-parts/components/card-blog'); ?>
                <?php endwhile; ?>
            </div>

            <?php
            // Reset excluded featured post count issue — show pagination
            // Re-setup to not confuse pagination
            ?>
            <?php TailPress\Pagination::render(); ?>

        <?php else: ?>
            <div class="text-center py-16">
                <p class="text-gray text-lg"><?php _e('No articles found. Check back soon!', 'tailpress'); ?></p>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- CTA Section -->
<div class="px-4">
 <div class="container max-w-4xl mx-auto px-4 text-center bg-primary/20  rounded-xl py-12 mb-12 border border-primary">
        <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold mb-4">
            <?php echo esc_html($cta_data['title']); ?>
        </h2>
        <p class="text-dark/80 text-base sm:text-lg max-w-2xl font-medium mx-auto mb-8">
            <?php echo esc_html($cta_data['subtitle']); ?>
        </p>
        <div class="flex flex-wrap justify-center gap-4">
            <?php
            get_template_part('template-parts/components/button', null, [
                'href' => esc_url($cta_data['button1_url']),
                'text' => $cta_data['button1_text'],
                'style' => 'primary',
                'class' => '',
            ]);
            get_template_part('template-parts/components/button', null, [
                'href' => esc_url($cta_data['button2_url']),
                'text' => $cta_data['button2_text'],
                'style' => 'dark-solid',
                'class' => '',
            ]);
            ?>
        </div>
    </div>
</div>
   


<?php
get_footer();
