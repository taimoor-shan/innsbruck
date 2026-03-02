<?php
/**
 * Single Property Content Template
 *
 * Renders full property detail with gallery in left column,
 * sidebar with form/document/specs in right column.
 *
 * @package TailPress
 */

$post_id = get_the_ID();

// ACF Fields
$price          = get_field('property_price', $post_id);
$address        = get_field('property_address', $post_id);
$city_state     = get_field('property_city_state', $post_id);
$size           = get_field('size', $post_id);
$bedrooms       = get_field('bedrooms', $post_id);
$bathrooms      = get_field('bathrooms', $post_id);
$document       = get_field('document', $post_id);
$latitude       = get_field('property_latitude', $post_id);
$longitude      = get_field('property_longitude', $post_id);

// Location string
$location_parts  = array_filter([$address, $city_state]);
$location_string = implode(', ', $location_parts);

// Taxonomy terms
$type_terms   = get_the_terms($post_id, 'property_type');
$status_terms = get_the_terms($post_id, 'property_status');

// Gallery images
$gallery_images = [];
if (function_exists('tailpress_get_gallery_images')) {
    $gallery_images = tailpress_get_gallery_images($post_id);
}
if (empty($gallery_images)) {
    $fallback = get_the_post_thumbnail_url($post_id, 'large');
    if ($fallback) {
        $gallery_images = [['id' => 0, 'url' => $fallback, 'alt' => get_the_title()]];
    }
}

$carousel_id = 'property-hero-' . $post_id;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('bg-white'); ?>>
    <div class="container mx-auto px-4 pt-24 pb-8 md:pt-28 md:pb-12">
        <div class="flex flex-col lg:flex-row gap-8 lg:gap-12">

            <!-- ══════════════════════════════════════
                 LEFT COLUMN — Gallery, Header, Specs, Content, Map
                 ══════════════════════════════════════ -->
            <div class="lg:w-2/3">

                <!-- Hero Gallery (Swiper + Fancybox) -->
                <?php if (!empty($gallery_images)): ?>
                    <div class="relative w-full rounded-lg overflow-hidden mb-6">
                        <div id="<?php echo esc_attr($carousel_id); ?>" class="swiper js-property-swiper">
                            <div class="swiper-wrapper">
                                <?php foreach ($gallery_images as $image): ?>
                                    <div class="swiper-slide">
                                        <a href="<?php echo esc_url($image['url']); ?>"
                                           data-fancybox="property-gallery"
                                           data-caption="<?php echo esc_attr($image['alt'] ?: get_the_title()); ?>"
                                           class="block">
                                            <div class="aspect-video">
                                                <img src="<?php echo esc_url($image['url']); ?>"
                                                     alt="<?php echo esc_attr($image['alt']); ?>"
                                                     class="w-full h-full object-cover">
                                            </div>
                                        </a>
                                    </div>
                                <?php endforeach; ?>
                            </div>

                            <!-- Navigation -->
                            <?php if (count($gallery_images) > 1): ?>
                                <div class="absolute bottom-4 right-4 z-10 flex items-center gap-2">
                                    <div class="property-prev w-9 h-9 bg-white/80 text-dark rounded-full flex items-center justify-center hover:bg-white transition-colors cursor-pointer shadow-md backdrop-blur-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                                        </svg>
                                    </div>
                                    <div class="property-next w-9 h-9 bg-white/80 text-dark rounded-full flex items-center justify-center hover:bg-white transition-colors cursor-pointer shadow-md backdrop-blur-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                        </svg>
                                    </div>
                                </div>

                                <!-- Image counter -->
                                <div class="absolute bottom-4 left-4 z-10 bg-dark/60 text-white text-sm px-3 py-1 rounded-full backdrop-blur-sm">
                                    <span class="js-slide-current">1</span> / <?php echo count($gallery_images); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Header: Badges, Title, Price, Location -->
                <div class="mb-6 md:mb-8">
                    <!-- Badges -->
                    <?php if (!empty($type_terms) || !empty($status_terms)): ?>
                        <div class="flex flex-wrap gap-2 mb-3">
                            <?php if (!empty($type_terms) && !is_wp_error($type_terms)):
                                foreach ($type_terms as $term): ?>
                                    <a href="<?php echo esc_url(get_term_link($term)); ?>"
                                       class="bg-primary/10 text-primary px-3 py-1 rounded-full text-xs font-semibold no-underline hover:bg-primary/20 transition-colors">
                                        <?php echo esc_html($term->name); ?>
                                    </a>
                                <?php endforeach;
                            endif; ?>
                            <?php if (!empty($status_terms) && !is_wp_error($status_terms)):
                                foreach ($status_terms as $term): ?>
                                    <span class="bg-dark/5 text-dark px-3 py-1 rounded-full text-xs font-semibold">
                                        <?php echo esc_html($term->name); ?>
                                    </span>
                                <?php endforeach;
                            endif; ?>
                        </div>
                    <?php endif; ?>

                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
                        <div>
                            <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold text-dark mb-1">
                                <?php the_title(); ?>
                            </h1>
                            <?php if ($location_string): ?>
                                <p class="text-gray flex items-center gap-1.5 mb-0 text-sm md:text-base">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-primary shrink-0">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                    </svg>
                                    <?php echo esc_html($location_string); ?>
                                </p>
                            <?php endif; ?>
                        </div>
                        <?php if ($price): ?>
                            <span class="text-2xl md:text-3xl font-bold text-primary whitespace-nowrap">
                                €<?php echo number_format((float)$price, 0, ',', '.'); ?>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Property Specs -->
                <div class="grid grid-cols-3 gap-4 md:gap-6 mb-8 md:mb-10">
                    <?php if ($size): ?>
                        <div class="text-center p-4 md:p-5 rounded-lg bg-gray/5 border border-gray/10">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mx-auto text-primary mb-2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3.75v4.5m0-4.5h4.5m-4.5 0L9 9M3.75 20.25v-4.5m0 4.5h4.5m-4.5 0L9 15M20.25 3.75h-4.5m4.5 0v4.5m0-4.5L15 9m5.25 11.25h-4.5m4.5 0v-4.5m0 4.5L15 15" />
                            </svg>
                            <span class="block text-lg md:text-xl font-bold text-dark"><?php echo esc_html($size); ?> m²</span>
                            <span class="text-gray text-xs md:text-sm">Size</span>
                        </div>
                    <?php endif; ?>
                    <?php if ($bedrooms): ?>
                        <div class="text-center p-4 md:p-5 rounded-lg bg-gray/5 border border-gray/10">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mx-auto text-primary mb-2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                            </svg>
                            <span class="block text-lg md:text-xl font-bold text-dark"><?php echo esc_html($bedrooms); ?></span>
                            <span class="text-gray text-xs md:text-sm">Bedrooms</span>
                        </div>
                    <?php endif; ?>
                    <?php if ($bathrooms): ?>
                        <div class="text-center p-4 md:p-5 rounded-lg bg-gray/5 border border-gray/10">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mx-auto text-primary mb-2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            <span class="block text-lg md:text-xl font-bold text-dark"><?php echo esc_html($bathrooms); ?></span>
                            <span class="text-gray text-xs md:text-sm">Bathrooms</span>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Description -->
                <div class="mb-8 md:mb-10">
                    <h2 class="text-xl md:text-2xl font-bold text-dark mb-4">About This Property</h2>
                    <div class="entry-content">
                        <?php the_content(); ?>
                    </div>
                </div>

                <!-- Location Map -->
                <?php if ($latitude && $longitude): ?>
                    <div class="mb-8 md:mb-10">
                        <h2 class="text-xl md:text-2xl font-bold text-dark mb-4">Location</h2>
                        <?php if ($location_string): ?>
                            <p class="text-gray mb-4 flex items-center gap-1.5">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-primary shrink-0">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                </svg>
                                <?php echo esc_html($location_string); ?>
                            </p>
                        <?php endif; ?>
                        <div id="property-map" class="w-full h-[350px] md:h-[400px] rounded-lg border border-gray/10 overflow-hidden z-0"></div>
                    </div>
                <?php endif; ?>

            </div>

            <!-- ══════════════════════════════════════
                 RIGHT COLUMN — Sticky Sidebar
                 ══════════════════════════════════════ -->
            <div class="lg:w-1/3">
                <div class="lg:sticky lg:top-24 space-y-6">

                    <!-- Contact Form Card -->
                    <div class="rounded-lg border border-gray/10 bg-white shadow-sm p-6">
                        <h3 class="text-lg font-bold text-dark mb-1">Interested in this property?</h3>
                        <p class="text-gray text-sm mb-4">Fill out the form and we'll get back to you shortly.</p>

                        <form action="<?php echo esc_url(home_url('/contact')); ?>" method="GET" class="space-y-3">
                            <input type="hidden" name="property" value="<?php echo esc_attr(get_the_title()); ?>">
                            <div>
                                <input type="text" name="name" placeholder="Your Name"
                                       class="w-full px-3 py-2.5 text-sm border border-gray/20 rounded-md focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-colors bg-white text-dark">
                            </div>
                            <div>
                                <input type="email" name="email" placeholder="Email Address"
                                       class="w-full px-3 py-2.5 text-sm border border-gray/20 rounded-md focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-colors bg-white text-dark">
                            </div>
                            <div>
                                <input type="tel" name="phone" placeholder="Phone Number"
                                       class="w-full px-3 py-2.5 text-sm border border-gray/20 rounded-md focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-colors bg-white text-dark">
                            </div>
                            <div>
                                <textarea name="message" rows="3" placeholder="Message (optional)"
                                          class="w-full px-3 py-2.5 text-sm border border-gray/20 rounded-md focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-colors resize-none bg-white text-dark"></textarea>
                            </div>
                            <button type="submit"
                                    class="w-full inline-flex items-center justify-center font-medium text-center whitespace-nowrap h-10 bg-primary text-sm gap-2 leading-5 px-4 py-2 rounded-md text-white hover:bg-primary/90 transition-colors cursor-pointer no-underline">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                                </svg>
                                Request Info
                            </button>
                        </form>
                    </div>

                    <!-- Document Download -->
                    <?php if ($document): ?>
                        <div class="rounded-lg border border-gray/10 bg-white shadow-sm p-6">
                            <h3 class="text-lg font-bold text-dark mb-2">Property Document</h3>
                            <p class="text-gray text-sm mb-4">Download the detailed property brochure or floor plan.</p>
                            <a href="<?php echo esc_url($document); ?>" target="_blank" rel="noopener noreferrer"
                               class="w-full inline-flex items-center justify-center font-medium text-center whitespace-nowrap h-10 border border-gray/20 bg-white text-sm gap-2 leading-5 px-4 py-2 rounded-md text-dark hover:bg-gray/5 transition-colors cursor-pointer no-underline">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                </svg>
                                Download Document
                            </a>
                        </div>
                    <?php endif; ?>
<?php if(false): ?>
                    <!-- Quick Specs Card -->
                    <div class="rounded-lg border border-gray/10 bg-white shadow-sm p-6">
                        <h3 class="text-lg font-bold text-dark mb-3">Property Details</h3>
                        <div class="space-y-2 text-sm">
                            <?php if ($price): ?>
                                <div class="flex justify-between border-b border-gray/10 pb-2">
                                    <span class="text-gray">Price</span>
                                    <span class="font-semibold text-dark">€<?php echo number_format((float)$price, 0, ',', '.'); ?></span>
                                </div>
                            <?php endif; ?>
                            <?php if ($size): ?>
                                <div class="flex justify-between border-b border-gray/10 pb-2">
                                    <span class="text-gray">Size</span>
                                    <span class="font-semibold text-dark"><?php echo esc_html($size); ?> m²</span>
                                </div>
                            <?php endif; ?>
                            <?php if ($bedrooms): ?>
                                <div class="flex justify-between border-b border-gray/10 pb-2">
                                    <span class="text-gray">Bedrooms</span>
                                    <span class="font-semibold text-dark"><?php echo esc_html($bedrooms); ?></span>
                                </div>
                            <?php endif; ?>
                            <?php if ($bathrooms): ?>
                                <div class="flex justify-between border-b border-gray/10 pb-2">
                                    <span class="text-gray">Bathrooms</span>
                                    <span class="font-semibold text-dark"><?php echo esc_html($bathrooms); ?></span>
                                </div>
                            <?php endif; ?>
                            <?php if ($location_string): ?>
                                <div class="flex justify-between pb-2">
                                    <span class="text-gray">Location</span>
                                    <span class="font-semibold text-dark text-right max-w-[60%]"><?php echo esc_html($location_string); ?></span>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
<?php endif; ?>
                </div>
            </div>

        </div>
    </div>
</article>

<!-- Scripts: Swiper + Map + Fancybox -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Hero Swiper
    var heroEl = document.getElementById('<?php echo esc_js($carousel_id); ?>');
    if (heroEl && typeof Swiper !== 'undefined') {
        var heroSwiper = new Swiper('#<?php echo esc_js($carousel_id); ?>', {
            loop: true,
            navigation: {
                nextEl: '#<?php echo esc_js($carousel_id); ?> .property-next',
                prevEl: '#<?php echo esc_js($carousel_id); ?> .property-prev',
            },
            on: {
                slideChange: function() {
                    var counter = heroEl.querySelector('.js-slide-current');
                    if (counter) {
                        counter.textContent = this.realIndex + 1;
                    }
                }
            }
        });
    }

    <?php if ($latitude && $longitude): ?>
    // Leaflet Map
    if (typeof L !== 'undefined') {
        var map = L.map('property-map', {
            scrollWheelZoom: false
        }).setView([<?php echo esc_js($latitude); ?>, <?php echo esc_js($longitude); ?>], 15);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
            maxZoom: 19,
        }).addTo(map);

        L.marker([<?php echo esc_js($latitude); ?>, <?php echo esc_js($longitude); ?>])
            .addTo(map)
            .bindPopup('<strong><?php echo esc_js(get_the_title()); ?></strong><?php echo $location_string ? '<br>' . esc_js($location_string) : ''; ?>');
    }
    <?php endif; ?>

    // Fancybox init
    if (typeof Fancybox !== 'undefined') {
        Fancybox.bind('[data-fancybox="property-gallery"]', {
            animated: true,
            showClass: 'fancybox-fadeIn',
            hideClass: 'fancybox-fadeOut',
            Toolbar: {
                display: {
                    left: [],
                    middle: ['prev', 'infobar', 'next'],
                    right: ['close'],
                }
            }
        });
    }
});
</script>