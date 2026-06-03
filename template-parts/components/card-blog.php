<?php
/**
 * Component: Blog Post Card
 *
 * Reusable card for displaying a blog post in archive grids.
 *
 * @package TailPress
 * @param array $args {
 *     Optional. Arguments for the card.
 *
 *     @type int  $post_id            Post ID. Defaults to current post in loop.
 *     @type bool $show_excerpt       Whether to show the excerpt. Default true.
 *     @type int  $excerpt_length     Excerpt word count. Default 20.
 *     @type bool $show_image         Whether to show featured image. Default true.
 *     @type bool $show_category      Whether to show category badge. Default true.
 *     @type bool $show_date          Whether to show publish date. Default true.
 *     @type bool $show_reading_time  Whether to show reading time. Default true.
 * }
 */

$post_id            = $args['post_id'] ?? get_the_ID();
$show_excerpt       = $args['show_excerpt'] ?? true;
$excerpt_length     = $args['excerpt_length'] ?? 20;
$show_image         = $args['show_image'] ?? true;
$show_category      = $args['show_category'] ?? true;
$show_date          = $args['show_date'] ?? true;
$show_reading_time  = $args['show_reading_time'] ?? true;

$post = get_post($post_id);
if (!$post) {
    return;
}

// Temporarily set up post data if we're using a specific post_id
$needs_setup = ($post_id !== get_the_ID());
if ($needs_setup) {
    setup_postdata($post);
}

$reading_time = tailpress_estimated_reading_time($post_id);
$categories = get_the_category($post_id);
$primary_category = !empty($categories) ? $categories[0] : null;
?>

<article id="post-<?php echo esc_attr($post_id); ?>"
         class="blog-card rounded-lg border border-gray/10 bg-white shadow-sm overflow-hidden hover:shadow-xl transition-all group h-full flex flex-col cursor-pointer"
         itemscope itemtype="https://schema.org/Article">

    <?php if ($show_image && has_post_thumbnail($post_id)): ?>
        <a href="<?php echo esc_url(get_permalink($post_id)); ?>"
           class="blog-card-image block overflow-hidden aspect-[16/9]"
           aria-hidden="true" tabindex="-1">
            <?php echo get_the_post_thumbnail($post_id, 'large', [
                'class' => 'w-full h-full object-cover',
                'itemprop' => 'image',
                'loading' => 'lazy',
            ]); ?>
        </a>
    <?php endif; ?>

    <div class="p-5 sm:p-6 flex flex-col flex-1">
        <?php if ($show_category && $primary_category): ?>
            <div class="mb-3">
                <a href="<?php echo esc_url(get_category_link($primary_category)); ?>"
                   class="category-badge"
                   itemprop="articleSection">
                    <?php echo esc_html($primary_category->name); ?>
                </a>
            </div>
        <?php endif; ?>

        <h3 class="text-lg sm:text-xl font-semibold mb-2 leading-snug" itemprop="headline">
            <a href="<?php echo esc_url(get_permalink($post_id)); ?>"
               class="text-dark hover:text-primary transition-colors no-underline">
                <?php echo esc_html(get_the_title($post_id)); ?>
            </a>
        </h3>

        <?php if ($show_excerpt): ?>
            <p class="text-gray text-sm leading-relaxed mb-4 flex-1" itemprop="description">
                <?php echo esc_html(wp_trim_words(
                    has_excerpt($post_id) ? get_the_excerpt($post_id) : get_the_content(null, false, $post_id),
                    $excerpt_length
                )); ?>
            </p>
        <?php endif; ?>

        <div class="flex items-center justify-between text-xs text-gray mt-auto border-t border-gray/10 pt-4">
            <?php if ($show_reading_time): ?>
                <span class="flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                         fill="none" stroke="currentColor" stroke-width="2"
                         stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polyline points="12 6 12 12 16 14"></polyline>
                    </svg>
                    <?php echo esc_html($reading_time); ?> <?php _e('min read', 'tailpress'); ?>
                </span>
            <?php endif; ?>

            <?php if ($show_date): ?>
                <time datetime="<?php echo esc_attr(get_the_date('c', $post_id)); ?>"
                      itemprop="datePublished">
                    <?php echo esc_html(get_the_date('', $post_id)); ?>
                </time>
            <?php endif; ?>
        </div>
    </div>
</article>

<?php
if ($needs_setup) {
    wp_reset_postdata();
}
