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
$price = get_field('property_price', $post_id);
$address = get_field('property_address', $post_id);
$city_state = get_field('property_city_state', $post_id);
$size = get_field('size', $post_id);
$bedrooms = get_field('bedrooms', $post_id);
$bathrooms = get_field('bathrooms', $post_id);
$document = get_field('document', $post_id);
$latitude = get_field('property_latitude', $post_id);
$longitude = get_field('property_longitude', $post_id);

// Location string
$location_parts = array_filter([$address, $city_state]);
$location_string = implode(', ', $location_parts);

// Taxonomy terms
$type_terms = get_the_terms($post_id, 'property_type');
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
                                        <a href="<?php echo esc_url($image['url']); ?>" data-fancybox="property-gallery"
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
                                    <div
                                        class="property-prev w-9 h-9 bg-white/80 text-dark rounded-full flex items-center justify-center hover:bg-white transition-colors cursor-pointer shadow-md backdrop-blur-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                            stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15.75 19.5L8.25 12l7.5-7.5" />
                                        </svg>
                                    </div>
                                    <div
                                        class="property-next w-9 h-9 bg-white/80 text-dark rounded-full flex items-center justify-center hover:bg-white transition-colors cursor-pointer shadow-md backdrop-blur-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                            stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                        </svg>
                                    </div>
                                </div>

                                <!-- Image counter -->
                                <div
                                    class="absolute bottom-4 left-4 z-10 bg-dark/60 text-white text-sm px-3 py-1 rounded-full backdrop-blur-sm">
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
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-primary shrink-0">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                    </svg>
                                    <?php echo esc_html($location_string); ?>
                                </p>
                            <?php endif; ?>
                        </div>
                        <?php if ($price): ?>
                            <span class="text-2xl md:text-3xl font-bold text-primary whitespace-nowrap">
                                €<?php echo number_format((float) $price, 0, ',', '.'); ?>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Property Specs -->
                <div class="grid grid-cols-2 md:grid-cols-3 gap-3 md:gap-4 mb-8 md:mb-10">
                    <?php if ($size): ?>
                        <div
                            class="p-3 md:p-4 rounded-lg bg-gray/5 border border-gray/10 flex gap-2 items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6 shrink-0 text-primary">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.75 3.75v4.5m0-4.5h4.5m-4.5 0L9 9M3.75 20.25v-4.5m0 4.5h4.5m-4.5 0L9 15M20.25 3.75h-4.5m4.5 0v4.5m0-4.5L15 9m5.25 11.25h-4.5m4.5 0v-4.5m0 4.5L15 15" />
                            </svg>
                            <div class="grp flex gap-2 items-center">
                                <span class="block text-base md:text-lg font-bold text-dark"><?php echo esc_html($size); ?>
                                    m²</span>
                                <span class="text-gray text-xs md:text-sm">Size</span>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if ($bedrooms): ?>
                        <div
                            class="p-3 md:p-4 rounded-lg bg-gray/5 border border-gray/10 flex gap-2 items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"
                                class="w-6 h-6 shrink-0 text-primary"><!--!Font Awesome Free v7.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.-->
                                <path fill="currentColor"
                                    d="M64 96C81.7 96 96 110.3 96 128L96 352L320 352L320 224C320 206.3 334.3 192 352 192L512 192C565 192 608 235 608 288L608 512C608 529.7 593.7 544 576 544C558.3 544 544 529.7 544 512L544 448L96 448L96 512C96 529.7 81.7 544 64 544C46.3 544 32 529.7 32 512L32 128C32 110.3 46.3 96 64 96zM144 256C144 220.7 172.7 192 208 192C243.3 192 272 220.7 272 256C272 291.3 243.3 320 208 320C172.7 320 144 291.3 144 256z" />
                            </svg>
                            <div class="grp flex gap-2 items-center">
                                <span
                                    class="block text-base md:text-lg font-bold text-dark"><?php echo esc_html($bedrooms); ?></span>
                                <span class="text-gray text-xs md:text-sm">Bedrooms</span>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if ($bathrooms): ?>
                        <div
                            class="p-3 md:p-4 rounded-lg bg-gray/5 border border-gray/10 flex gap-2 items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"
                                class="w-6 h-6 shrink-0 text-primary"><!--!Font Awesome Free v7.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.-->
                                <path fill="currentColor"
                                    d="M128 195.9C128 176.1 144.1 160 163.9 160C173.4 160 182.5 163.8 189.3 170.5L205.5 186.7C184.5 225.6 188.1 274.2 216.4 309.7L215 311C205.6 320.4 205.6 335.6 215 344.9C224.4 354.2 239.6 354.3 248.9 344.9L409 185C418.4 175.6 418.4 160.4 409 151.1C399.6 141.8 384.4 141.7 375.1 151.1L373.8 152.4C338.3 124.1 289.7 120.5 250.8 141.5L234.5 125.3C215.8 106.5 190.4 96 163.9 96C108.7 96 64 140.7 64 195.9L64 512C64 529.7 78.3 544 96 544C113.7 544 128 529.7 128 512L128 195.9zM320 416C337.7 416 352 401.7 352 384C352 366.3 337.7 352 320 352C302.3 352 288 366.3 288 384C288 401.7 302.3 416 320 416zM384 480C384 462.3 369.7 448 352 448C334.3 448 320 462.3 320 480C320 497.7 334.3 512 352 512C369.7 512 384 497.7 384 480zM384 352C401.7 352 416 337.7 416 320C416 302.3 401.7 288 384 288C366.3 288 352 302.3 352 320C352 337.7 366.3 352 384 352zM448 416C448 398.3 433.7 384 416 384C398.3 384 384 398.3 384 416C384 433.7 398.3 448 416 448C433.7 448 448 433.7 448 416zM448 288C465.7 288 480 273.7 480 256C480 238.3 465.7 224 448 224C430.3 224 416 238.3 416 256C416 273.7 430.3 288 448 288zM512 352C512 334.3 497.7 320 480 320C462.3 320 448 334.3 448 352C448 369.7 462.3 384 480 384C497.7 384 512 369.7 512 352zM544 320C561.7 320 576 305.7 576 288C576 270.3 561.7 256 544 256C526.3 256 512 270.3 512 288C512 305.7 526.3 320 544 320z" />
                            </svg>
                            <div class="grp flex gap-2 items-center">
                                <span
                                    class="block text-base md:text-lg font-bold text-dark"><?php echo esc_html($bathrooms); ?></span>
                                <span class="text-gray text-xs md:text-sm">Bathrooms</span>
                            </div>
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
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="w-4 h-4 text-primary shrink-0">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                </svg>
                                <?php echo esc_html($location_string); ?>
                            </p>
                        <?php endif; ?>
                        <div id="property-map"
                            class="w-full h-[350px] md:h-[400px] rounded-lg border border-gray/10 overflow-hidden z-0">
                        </div>
                    </div>
                <?php endif; ?>

            </div>

            <!-- ══════════════════════════════════════
                 RIGHT COLUMN — Sticky Sidebar
                 ══════════════════════════════════════ -->
            <div class="lg:w-1/3">
                <div class="lg:sticky lg:top-24 space-y-6">

                    <!-- Contact Form Card -->
                    <div class="rounded-lg border border-gray/10 bg-white shadow-sm p-6" style="padding-bottom: 0;">
                        <h3 class="text-2xl font-semibold text-dark mb-1">Interested in this property?</h3>
                        <p class="text-gray text-sm mb-4">Fill out the form and we'll get back to you shortly.</p>

                        <?php echo do_shortcode('[contact-form-7 id="f3d669a" title="Property Form"]'); ?>
                        <!-- 
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
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                                </svg>
                                Request Info
                            </button>
                        </form> -->
                    </div>

                    <!-- Document Download -->
                    <?php if ($document): ?>
                        <div class="rounded-lg border border-gray/10 bg-white shadow-sm p-6">
                            <h3 class="text-lg font-bold text-dark mb-2">Property Document</h3>
                            <p class="text-gray text-sm mb-4">Download the detailed property brochure or floor plan.</p>
                            <a href="<?php echo esc_url($document); ?>" target="_blank" rel="noopener noreferrer"
                                class="w-full inline-flex items-center justify-center font-medium text-center whitespace-nowrap h-10 border border-gray/20 bg-white text-sm gap-2 leading-5 px-4 py-2 rounded-md text-dark hover:bg-gray/5 transition-colors cursor-pointer no-underline">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                </svg>
                                Investment Brochure
                            </a>
                        </div>
                    <?php endif; ?>
                    <?php if (false): ?>
                        <!-- Quick Specs Card -->
                        <div class="rounded-lg border border-gray/10 bg-white shadow-sm p-6">
                            <h3 class="text-lg font-bold text-dark mb-3">Property Details</h3>
                            <div class="space-y-2 text-sm">
                                <?php if ($price): ?>
                                    <div class="flex justify-between border-b border-gray/10 pb-2">
                                        <span class="text-gray">Price</span>
                                        <span
                                            class="font-semibold text-dark">€<?php echo number_format((float) $price, 0, ',', '.'); ?></span>
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
                                        <span
                                            class="font-semibold text-dark text-right max-w-[60%]"><?php echo esc_html($location_string); ?></span>
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
    document.addEventListener('DOMContentLoaded', function () {

        document.getElementById("property_address").value = "<?php echo $address; ?>";

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
                    slideChange: function () {
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