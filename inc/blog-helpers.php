<?php

/**
 * Blog helper functions.
 *
 * @package TailPress
 */

/**
 * Estimate reading time for a post.
 *
 * @param int|null $post_id Post ID. Defaults to current post.
 * @return int Estimated reading time in minutes (minimum 1).
 */
function tailpress_estimated_reading_time($post_id = null)
{
    if (!$post_id) {
        $post_id = get_the_ID();
    }

    $content = get_post_field('post_content', $post_id);
    $word_count = str_word_count(wp_strip_all_tags($content));
    $reading_time = ceil($word_count / 200);

    return max(1, $reading_time);
}

/**
 * Get related posts based on shared categories.
 *
 * @param int|null $post_id Post ID. Defaults to current post.
 * @param int $count Number of related posts to return.
 * @return WP_Query
 */
function tailpress_get_related_posts($post_id = null, $count = 3)
{
    if (!$post_id) {
        $post_id = get_the_ID();
    }

    $categories = get_the_category($post_id);

    if (empty($categories)) {
        // Fallback: recent posts excluding current
        return new WP_Query([
            'post_type' => 'post',
            'posts_per_page' => $count,
            'post__not_in' => [$post_id],
            'orderby' => 'date',
            'order' => 'DESC',
            'ignore_sticky_posts' => 1,
        ]);
    }

    $category_ids = wp_list_pluck($categories, 'term_id');

    return new WP_Query([
        'post_type' => 'post',
        'posts_per_page' => $count,
        'post__not_in' => [$post_id],
        'category__in' => $category_ids,
        'orderby' => 'date',
        'order' => 'DESC',
        'ignore_sticky_posts' => 1,
    ]);
}

/**
 * Get blog hero data from Customizer, with hardcoded fallbacks.
 *
 * @return array{title: string, subtitle: string}
 */
function tailpress_blog_hero_data()
{
    $posts_page_id = get_option('page_for_posts');

    // ACF override (per-page)
    $title = '';
    $subtitle = '';

    if ($posts_page_id && function_exists('get_field')) {
        $acf_title = get_field('blog_page_title', $posts_page_id);
        $acf_subtitle = get_field('blog_page_subtitle', $posts_page_id);

        if ($acf_title) {
            $title = $acf_title;
        }
        if ($acf_subtitle) {
            $subtitle = $acf_subtitle;
        }
    }

    // Customizer fallback
    if (!$title) {
        $title = get_theme_mod('blog_hero_title', 'Explore the Tirol Region');
    }
    if (!$subtitle) {
        $subtitle = get_theme_mod('blog_hero_subtitle', 'Discover the best of Alpine living, from world-class skiing to cultural treasures in the heart of the Austrian Alps.');
    }

    return [
        'title' => $title,
        'subtitle' => $subtitle,
    ];
}

/**
 * Get blog CTA data from Customizer, with hardcoded fallbacks.
 *
 * @return array{title: string, subtitle: string, button1_text: string, button1_url: string, button2_text: string, button2_url: string}
 */
function tailpress_blog_cta_data()
{
    return [
        'title' => get_theme_mod('blog_cta_title', 'Ready to Experience the Tirol Mountains?'),
        'subtitle' => get_theme_mod('blog_cta_subtitle', 'Book your luxury or premium apartment in Innsbruck and wake up to breathtaking Alpine views every morning.'),
        'button1_text' => get_theme_mod('blog_cta_button1_text', 'View Luxury Units'),
        'button1_url' => get_theme_mod('blog_cta_button1_url', home_url('/property_type/luxury/')),
        'button2_text' => get_theme_mod('blog_cta_button2_text', 'View Premium Units'),
        'button2_url' => get_theme_mod('blog_cta_button2_url', home_url('/property_type/premium/')),
    ];
}
