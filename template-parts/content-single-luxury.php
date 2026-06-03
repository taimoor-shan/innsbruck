<?php
/**
 * Single post content — luxury layout.
 *
 * Renders post content with tags, author bio, and post navigation.
 *
 * @package TailPress
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>
         itemscope itemtype="https://schema.org/Article">

    <div class="entry-content mx-auto mt-10">
        <?php the_content(); ?>
    </div>

    <?php if (has_tag()): ?>
        <div class="mx-auto px-4 mt-8">
            <div class="flex flex-wrap gap-2">
                <?php the_tags('', '', ''); ?>
            </div>
        </div>
    <?php endif; ?>

    <!-- Author Bio -->
    <!-- <div class="author-bio mx-auto px-4 flex flex-col sm:flex-row gap-4 py-6 my-8">
        <div class="flex-none">
            <?php echo get_avatar(get_the_author_meta('ID'), 64, '', esc_attr(sprintf(__('Avatar for %s', 'tailpress'), get_the_author())), [
                'class' => 'w-16 h-16 rounded-full object-cover',
            ]); ?>
        </div>
        <div>
            <span class="font-semibold text-dark block mb-1">
                <?php printf(__('Written by %s', 'tailpress'), get_the_author()); ?>
            </span>
            <?php if ($bio = get_the_author_meta('description')): ?>
                <p class="text-sm text-gray leading-relaxed"><?php echo esc_html($bio); ?></p>
            <?php endif; ?>
        </div>
    </div> -->

    <!-- Post Navigation -->
    <div class="mx-auto px-4 flex flex-col sm:flex-row justify-between gap-4 mt-4 mb-12 pt-8 border-t border-gray/10">
        <div class="text-sm">
            <?php
            $prev_post = get_previous_post();
            if ($prev_post):
            ?>
                <span class="text-gray block mb-1"><?php _e('Previous Article', 'tailpress'); ?></span>
                <?php previous_post_link('%link', '<span class="text-primary hover:underline transition-colors font-medium">%title</span>'); ?>
            <?php endif; ?>
        </div>
        <div class="text-sm text-right">
            <?php
            $next_post = get_next_post();
            if ($next_post):
            ?>
                <span class="text-gray block mb-1"><?php _e('Next Article', 'tailpress'); ?></span>
                <?php next_post_link('%link', '<span class="text-primary hover:underline transition-colors font-medium">%title</span>'); ?>
            <?php endif; ?>
        </div>
    </div>

</article>
