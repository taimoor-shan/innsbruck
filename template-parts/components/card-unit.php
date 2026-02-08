<?php
/**
 * Component: Universal Unit Card
 *
 * @package TailPress
 * @param array $args Arguments for the card (id, title, gallery, size, bedrooms, etc.).
 */

$post_id = $args['post_id'] ?? get_the_ID();
$title = get_the_title($post_id);
$gallery = get_field('gallery', $post_id);
$size = get_field('size', $post_id);
$bedrooms = get_field('bedrooms', $post_id);
$livingroom = get_field('livingroom', $post_id);
$bathrooms = get_field('bathrooms', $post_id);
$balcony = get_field('balcony', $post_id);
$jacuzzi = get_field('jacuzzi', $post_id);
$floor_plan = get_field('floor_plan', $post_id);

// Get Terms for Badge
$terms = get_the_terms($post_id, 'unit_type');
$badge_label = !empty($terms) ? $terms[0]->name : '';

// Fallback Gallery if empty (for dev/demo)
if (!$gallery) {
    $gallery = [
        get_the_post_thumbnail_url($post_id, 'full') ?: 'https://storage.googleapis.com/download/storage/v1/b/prd-shared-services.firebasestorage.app/o/h2m-assets%2F9ed7d824b867c563836fa0e11722551307a341e2.jpg?generation=1770502588609302&amp;alt=media'
    ];
}
$carousel_id = 'carousel-' . $post_id;
?>

<div class="rounded-lg border bg-white text-dark shadow-sm overflow-hidden transition-all h-full flex flex-col">

    <!-- Carousel Section -->
    <div class="relative w-full group" id="<?php echo esc_attr($carousel_id); ?>" data-carousel>
        <div class="overflow-hidden">
            <div class="flex transition-transform duration-300 ease-in-out" data-carousel-track>
                <?php foreach ($gallery as $image_url): ?>
                    <div class="min-w-full shrink-0 grow-0 basis-full">
                        <div class="relative h-64 md:h-60">
                            <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($title); ?>"
                                class="w-full h-full object-cover">
                            <?php if ($badge_label): ?>
                                <div class="absolute top-2 right-2 md:top-4 md:right-4">
                                    <span
                                        class="bg-white/90 text-dark px-2 py-1 md:px-4 md:py-2 rounded-full text-xs md:text-sm font-semibold shadow-sm backdrop-blur-sm">
                                        <?php echo esc_html($badge_label); ?>
                                    </span>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Navigation Buttons -->
        <?php if (count($gallery) > 1): ?>
            <button
                class="absolute top-1/2 left-2 md:left-4 -translate-y-1/2 w-8 h-8 rounded-full bg-white/80 hover:bg-white text-dark shadow-sm flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity focus:outline-none"
                data-carousel-prev>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4">
                    <path d="m12 19-7-7 7-7" />
                    <path d="M19 12H5" />
                </svg>
            </button>
            <button
                class="absolute top-1/2 right-2 md:right-4 -translate-y-1/2 w-8 h-8 rounded-full bg-white/80 hover:bg-white text-dark shadow-sm flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity focus:outline-none"
                data-carousel-next>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4">
                    <path d="M5 12h14" />
                    <path d="m12 5 7 7-7 7" />
                </svg>
            </button>
        <?php endif; ?>
    </div>

    <!-- Details Section -->
    <div class="p-4 md:p-6 flex flex-col grow">
        <h3 class="text-lg md:text-xl lg:text-2xl font-bold mb-3 md:mb-4">
            <?php echo esc_html($title); ?>
        </h3>

        <div class="space-y-1.5 md:space-y-2 mb-4 md:mb-6 text-sm md:text-base grow">
            <?php if ($size): ?>
                <div class="flex justify-between border-b border-gray/10 pb-1">
                    <span class="text-gray">Size:</span>
                    <span class="font-semibold">
                        <?php echo esc_html($size); ?> m²
                    </span>
                </div>
            <?php endif; ?>

            <?php if ($bedrooms): ?>
                <div class="flex justify-between border-b border-gray/10 pb-1">
                    <span class="text-gray">Bedrooms:</span>
                    <span class="font-semibold">
                        <?php echo esc_html($bedrooms); ?>
                    </span>
                </div>
            <?php endif; ?>

            <?php if ($livingroom): ?>
                <div class="flex justify-between border-b border-gray/10 pb-1">
                    <span class="text-gray">Livingroom:</span>
                    <span class="font-semibold text-right text-xs md:text-sm max-w-[60%]">
                        <?php echo esc_html($livingroom); ?>
                    </span>
                </div>
            <?php endif; ?>

            <?php if ($bathrooms): ?>
                <div class="flex justify-between border-b border-gray/10 pb-1">
                    <span class="text-gray">Bathrooms:</span>
                    <span class="font-semibold">
                        <?php echo esc_html($bathrooms); ?>
                    </span>
                </div>
            <?php endif; ?>

            <?php if ($balcony): ?>
                <div class="flex justify-between border-b border-gray/10 pb-1">
                    <span class="text-gray">Balcony:</span>
                    <span class="font-semibold">✓</span>
                </div>
            <?php endif; ?>

            <?php if ($jacuzzi): ?>
                <div class="flex justify-between border-b border-gray/10 pb-1">
                    <span class="text-gray">Jacuzzi:</span>
                    <span class="font-semibold">✓</span>
                </div>
            <?php endif; ?>
        </div>

        <!-- Buttons -->
        <div class="flex gap-2 md:gap-3 mt-auto">
            <?php get_template_part('template-parts/components/button', null, [
                'href' => home_url('/contact'),
                'text' => 'Request Info',
                'class' => 'w-full text-xs md:text-sm',
                'style' => 'primary'
            ]); ?>
            <?php if ($floor_plan): ?>
                <?php get_template_part('template-parts/components/button', null, [
                    'text' => 'View Layout',
                    'style' => 'outline-card',
                    'class' => 'flex-1 text-xs md:text-sm',
                    'attr' => 'onclick="window.openModal(\'modal-' . $post_id . '\')"'
                ]); ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Layout Modal -->
<?php if ($floor_plan): ?>
    <div id="modal-<?php echo $post_id; ?>" class="fixed inset-0 z-[200] hidden" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-dark/80 backdrop-blur-sm transition-opacity"
            onclick="window.closeModal('modal-<?php echo $post_id; ?>')"></div>
        <div class="fixed left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 z-[210] w-full max-w-3xl p-4">
            <div class="bg-white rounded-lg shadow-lg overflow-hidden relative">
                <button class="absolute top-4 right-4 p-2 rounded-full bg-gray/10 hover:bg-gray/20 transition-colors"
                    onclick="window.closeModal('modal-<?php echo $post_id; ?>')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="w-5 h-5">
                        <path d="M18 6 6 18" />
                        <path d="m6 6 12 12" />
                    </svg>
                </button>
                <div class="p-6">
                    <h3 class="text-xl font-bold mb-4">
                        <?php echo esc_html($title); ?> - Layout
                    </h3>
                    <img src="<?php echo esc_url($floor_plan); ?>" alt="Floor Plan"
                        class="w-full h-auto rounded-md border border-gray/20">
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>