<?php
/**
 * Component: Property Type Card
 *
 * Displays a property type term as a card with image, description, and CTA.
 *
 * @package TailPress
 * @param array $args
 *  - term: (WP_Term) Required. The property_type term object.
 */

$term = $args['term'] ?? null;
if (!$term || is_wp_error($term)) {
    return;
}

$card_image = get_field('card_image', $term) ?: get_field('hero_image', $term);
$description = get_field('full_description', $term);
$term_link = get_term_link($term);
$term_name = $term->name;
?>

<div class="relative border bg-white shadow-sm rounded-lg overflow-hidden h-full transition-all hover:shadow-md flex flex-col">
    <?php if ($card_image): ?>
        <div class="aspect-[16/10] overflow-hidden">
            <img src="<?php echo esc_url($card_image); ?>"
                 alt="<?php echo esc_attr($term_name); ?>"
                 class="w-full h-full object-cover transition-transform duration-300 hover:scale-105"
                 loading="lazy">
        </div>
    <?php endif; ?>

    <div class="p-6 flex flex-col flex-1 absolute bottom-2 left-2">
        <h3 class="font-semibold text-xl leading-7 text-dark mb-3">
            <?php echo esc_html($term_name); ?>
        </h3>

        <?php if ($description): ?>
            <div class="text-gray text-sm leading-6 mb-6 flex-1">
                <?php echo wp_trim_words(wp_strip_all_tags($description), 25, '...'); ?>
            </div>
        <?php endif; ?>

        <div class="mt-auto">
            <?php get_template_part('template-parts/components/button', null, [
                'href' => $term_link,
                'text' => 'View ' . $term_name . ' Apartments',
                'style' => 'primary',
                'class' => 'w-full text-center justify-center',
            ]); ?>
        </div>
    </div>
</div>
