<?php

/**
 * Single post template — luxury hospitality layout.
 *
 * @package TailPress
 */

get_header();

$posts_page_id = get_option('page_for_posts');
$cta_data = tailpress_blog_cta_data();
?>

<div class="mt-20">
    <?php if (have_posts()): ?>
        <?php while (have_posts()): the_post(); ?>
            <?php
            $reading_time = tailpress_estimated_reading_time();
            $categories = get_the_category();
            $primary_category = !empty($categories) ? $categories[0] : null;
            ?>



            <!-- Post Hero with Featured Image -->
            <div class="relative h-[30vh] sm:h-[50vh] min-h-[300px] max-h-[600px] overflow-hidden mt-4"
                itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
                <?php if (has_post_thumbnail()): ?>
                    <?php the_post_thumbnail('full', [
                        'class' => 'w-full h-full object-cover',
                        'itemprop' => 'url',
                    ]); ?>
                <?php else: ?>
                    <div class="w-full h-full bg-dark"></div>
                <?php endif; ?>
                <!-- <div class="post-hero-gradient absolute inset-0"></div> -->
                <!-- Breadcrumbs -->


            </div>
            <div class="container max-w-4xl">
                <nav class="breadcrumb-nav mt-8 mb-4 text-sm !text-primary"
                    typeof="BreadcrumbList" vocab="https://schema.org/" aria-label="<?php _e('Breadcrumb', 'tailpress'); ?>">
                    <span property="itemListElement" typeof="ListItem">
                        <a property="item" typeof="WebPage"
                            href="<?php echo esc_url(home_url('/')); ?>">
                            <span property="name"><?php _e('Home', 'tailpress'); ?></span>
                        </a>
                        <meta property="position" content="1">
                    </span>
                    <span class="mx-2">/</span>
                    <?php if ($posts_page_id): ?>
                        <span property="itemListElement" typeof="ListItem">
                            <a property="item" typeof="WebPage"
                                href="<?php echo esc_url(get_permalink($posts_page_id)); ?>">
                                <span property="name"><?php _e('Blog', 'tailpress'); ?></span>
                            </a>
                            <meta property="position" content="2">
                        </span>
                        <span class="mx-2">/</span>
                    <?php endif; ?>
                    <?php if ($primary_category): ?>
                        <span property="itemListElement" typeof="ListItem">
                            <a property="item" typeof="WebPage"
                                href="<?php echo esc_url(get_category_link($primary_category)); ?>">
                                <span property="name"><?php echo esc_html($primary_category->name); ?></span>
                            </a>
                            <meta property="position" content="<?php echo $posts_page_id ? '3' : '2'; ?>">
                        </span>
                        <!-- <span class="mx-2">/</span> -->
                    <?php endif; ?>
                    <!-- <span property="itemListElement" typeof="ListItem">
                        <span property="name" class="text-dark"><?php the_title(); ?></span>
                        <meta property="position" content="<?php echo $primary_category ? ($posts_page_id ? '4' : '3') : ($posts_page_id ? '3' : '2'); ?>">
                    </span> -->
                </nav>
                <?php if (($primary_category) && (false)): ?>
                    <a href="<?php echo esc_url(get_category_link($primary_category)); ?>"
                        class="category-badge-dark mb-3">
                        <?php echo esc_html($primary_category->name); ?>
                    </a>
                <?php endif; ?>
                <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold  mt-3 leading-tight" itemprop="headline">
                    <?php the_title(); ?>
                </h1>
                <div class="flex flex-wrap items-center gap-2 sm:gap-3 mt-4 text-sm text-dark/88">
                    <time datetime="<?php echo esc_attr(get_the_date('c')); ?>"
                        itemprop="datePublished">
                        <?php echo esc_html(get_the_date()); ?>
                    </time>
                    <span class="meta-dot bg-white/40"></span>
                    <span class="flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 16 14"></polyline>
                        </svg>
                        <?php echo esc_html($reading_time); ?> <?php _e('min read', 'tailpress'); ?>
                    </span>
                    <span class="meta-dot bg-white/40"></span>
                    <span itemprop="author" itemscope itemtype="https://schema.org/Person">
                        <?php printf(__('by %s', 'tailpress'), '<span itemprop="name">' . esc_html(get_the_author()) . '</span>'); ?>
                    </span>
                </div>
                <!-- Post Content -->
                <?php get_template_part('template-parts/content-single-luxury'); ?>

                <!-- related Posts -->
                <?php
                $related = tailpress_get_related_posts(null, 3);
                if ($related->have_posts()):
                ?>
                    <section class="bg-accent/50 py-12 md:py-20 mt-12">
                        <div class="container mx-auto px-4">
                            <h2 class="text-2xl md:text-3xl font-bold text-dark mb-8 text-center">
                                <?php _e('Related Articles', 'tailpress'); ?>
                            </h2>
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                                <?php while ($related->have_posts()): $related->the_post(); ?>
                                    <?php get_template_part('template-parts/components/card-blog'); ?>
                                <?php endwhile; ?>
                                <?php wp_reset_postdata(); ?>
                            </div>
                        </div>
                    </section>
                <?php endif; ?>
            </div>
       <?php endwhile; ?>
    <?php endif; ?>
</div>

<!-- Booking CTA -->
<div class="px-4">

    <div class="container max-w-4xl mx-auto px-4 text-center bg-primary/20  rounded-xl py-12 mb-12 border border-primary">
        <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold mb-4">
            <?php _e('Ready to Visit Innsbruck?', 'tailpress'); ?>
        </h2>
        <p class="text-dark/70 max-w-xl mx-auto mb-8 text-base sm:text-lg font-medium">
            <?php _e('Book your stay at Innsbruck City Apartments and experience Alpine luxury firsthand.', 'tailpress'); ?>
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


<!-- Comments -->
 <?php if(false): ?>

<div class="container mx-auto px-4">
    <?php if (have_posts()): rewind_posts();
        while (have_posts()): the_post(); ?>
            <?php if (comments_open() || get_comments_number()): ?>
                <div class="max-w-3xl mx-auto py-12">
                    <?php comments_template(); ?>
                </div>
            <?php endif; ?>
    <?php endwhile;
    endif; ?>
</div>
 <?php endif; ?>
<?php
get_footer();
