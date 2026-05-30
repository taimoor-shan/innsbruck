<?php

/**
 * Component: Universal Unit Card
 *
 * @package TailPress
 * @param array $args Arguments for the card (id, title, gallery, size, bedrooms, etc.).
 */

$post_id = $args['post_id'] ?? get_the_ID();
$title = get_the_title($post_id);
$price = get_field('property_price', $post_id);
$size = get_field('size', $post_id);
$bedrooms = get_field('bedrooms', $post_id);
$livingroom = get_field('livingroom', $post_id);
$bathrooms = get_field('bathrooms', $post_id);
$balcony = get_field('balcony', $post_id);
$jacuzzi = get_field('jacuzzi', $post_id);
$floor_plan = get_field('floor_plan', $post_id);

// Get Terms for Badge
$type = get_the_terms($post_id, 'property_type');
$badge_label = !empty($type) ? $type[0]->name : '';
$badge_slug  = !empty($type) ? $type[0]->slug : '';
// Get Terms for Badge
$status = get_the_terms($post_id, 'property_status');
$status_label = !empty($status) ? $status[0]->name : '';
$is_sold = !empty($status) && $status[0]->slug === 'sold';

$gallery_images = [];
if (function_exists('tailpress_get_gallery_images')) {
    $gallery_images = tailpress_get_gallery_images($post_id);
}

// Convert to array of URLs for Swiper loop
$gallery = array_map(function ($img) {
    return $img['url'];
}, $gallery_images);

// Fallback Gallery if empty (for dev/demo or if no gallery selected)
if (empty($gallery)) {
    // Try ACF gallery if old field still there, or just featured image
    $fallback_img = get_the_post_thumbnail_url($post_id, 'large') ?: 'https://storage.googleapis.com/download/storage/v1/b/prd-shared-services.firebasestorage.app/o/h2m-assets%2F9ed7d824b867c563836fa0e11722551307a341e2.jpg?generation=1770502588609302&amp;alt=media';
    $gallery = [$fallback_img];
}
$carousel_id = 'carousel-' . $post_id;
?>

<div class="rounded-lg border bg-white text-dark shadow-sm overflow-hidden transition-all h-full flex flex-col">

    <!-- Carousel Section -->
    <div class="relative w-full group">
        <?php if ($badge_label): ?>
            <div class="absolute top-2 left-2 md:top-4 md:left-4 z-10">
                <span
                    class="<?php echo $badge_slug === 'luxury' ? 'bg-primary' : 'bg-dark'; ?> text-white px-2 py-1 md:px-4 md:py-2 rounded-full text-xs  font-semibold shadow-sm backdrop-blur-sm">
                    <?php echo esc_html($badge_label); ?>
                </span>
            </div>
        <?php endif; ?>
        <?php if (false): ?>
            <?php if ($status_label): ?>
                <div class="absolute top-2 left-2 md:top-4 md:left-4 z-10">
                    <span
                        class="bg-green-700 <?php echo $is_sold ? 'bg-primary' : ''; ?> text-white px-2 py-1 md:px-4 md:py-2 rounded-full text-xs  font-semibold shadow-sm backdrop-blur-sm">
                        <?php echo esc_html($status_label); ?>
                    </span>
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <?php if (!empty($gallery)): ?>
            <div id="<?php echo esc_attr($carousel_id); ?>"
                class="swiper card-swiper js-card-swiper rounded-t-lg overflow-hidden">
                <div class="swiper-wrapper">
                    <?php foreach ($gallery as $image_url): ?>
                        <div class="swiper-slide">
                            <div class="oi-aspect sixteen-nine">
                                <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($title); ?>"
                                    class="oi-aspect-img<?php echo $is_sold ? ' grayscale' : ''; ?>">
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <!-- Navigation Buttons -->
                <div class="flex items-center gap-2 absolute bottom-4 right-4 z-10">
                    <div
                        class="card-prev w-8 h-8 bg-white/80 text-dark rounded-full flex items-center justify-center hover:bg-white transition-colors cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                        </svg>
                    </div>
                    <div
                        class="card-next w-8 h-8 bg-white/80 text-dark rounded-full flex items-center justify-center hover:bg-white transition-colors cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="oi-aspect sixteen-nine">
                <img src="<?php echo esc_url($gallery[0] ?? ''); ?>" alt="<?php echo esc_attr($title); ?>"
                    class="oi-aspect-img<?php echo $is_sold ? ' grayscale' : ''; ?>">
            </div>
        <?php endif; ?>
    </div>

    <!-- Details Section -->
    <div class="p-4 md:p-6 flex flex-col grow">
        <div class="mb-2 flex flex-wrap gap-1 justify-between items-start mb-4">
            <h3 class="text-lg md:text-xl lg:text-2xl font-bold mb-0">
                <?php echo esc_html($title); ?>
            </h3>
            <span class="text-primary text-lg md:text-xl font-bold">
                <?php if ($is_sold): ?>
                    <span class="text-sm md:text-base font-medium">Sold</span>
                <?php elseif ($price): ?>
                    €<?php echo number_format((float) $price, 0, ',', '.'); ?>
               
                <?php endif; ?>
            </span>
        </div>



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
                'class' => 'flex-1 text-xs md:text-sm',
                'style' => 'dark-solid'
            ]); ?>

            <?php if (!$is_sold): ?>
                <?php get_template_part('template-parts/components/button', null, [
                    'href' => get_permalink($post_id),
                    'text' => 'View Details',
                    'style' => 'outline',
                    'class' => 'flex-1 text-xs md:text-sm',
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

<?php if (count($gallery) > 1): ?>
    <script>
        (function() {
            var carouselId = '<?php echo esc_js($carousel_id); ?>';

            function initSwiper() {
                if (typeof Swiper === 'undefined') {
                    setTimeout(initSwiper, 100);
                    return;
                }
                var el = document.getElementById(carouselId);
                if (el && !el.classList.contains('swiper-initialized')) {
                    new Swiper('#' + carouselId, {
                        loop: true,
                        navigation: {
                            nextEl: '#' + carouselId + ' .card-next',
                            prevEl: '#' + carouselId + ' .card-prev',
                        },
                    });
                }
            }
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', initSwiper);
            } else {
                initSwiper();
            }
        })();
    </script>
<?php endif; ?>