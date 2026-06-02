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
$layout_image = get_field('layout_image', $post_id);
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
    $fallback = get_the_post_thumbnail_url($post_id, 'full');
    if ($fallback) {
        $gallery_images = [['id' => 0, 'url' => $fallback, 'alt' => get_the_title()]];
    }
}

$total_images = count($gallery_images);
$carousel_id = 'property-hero-' . $post_id;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('bg-white'); ?>>
    <div class="container mx-auto px-4 pt-24 pb-8 md:pt-28 md:pb-12">
        <!-- Hero Gallery: Bento Grid (lg+) + Swiper (<lg) -->
        <?php if (!empty($gallery_images)): ?>
            <div class="gallery relative mb-6">
                <!-- Badges (shared across both layouts) -->
                <?php if (!empty($type_terms) || !empty($status_terms)): ?>
                    <div class="flex flex-wrap gap-2 absolute top-4 left-4 z-20">
                        <?php if (!empty($type_terms) && !is_wp_error($type_terms)):
                            foreach ($type_terms as $term): ?>
                                <a href="<?php echo esc_url(get_term_link($term)); ?>"
                                    class="bg-primary text-light px-3 py-1 rounded-full text-sm font-semibold no-underline hover:bg-primary/20 transition-colors">
                                    <?php echo esc_html($term->name); ?>
                                </a>
                        <?php endforeach;
                        endif; ?>
                        <?php if (!empty($status_terms) && !is_wp_error($status_terms)):
                            foreach ($status_terms as $term): ?>
                                <span class="bg-dark px-3 py-1 rounded-full text-sm font-semibold text-white">
                                    <?php echo esc_html($term->name); ?>
                                </span>
                        <?php endforeach;
                        endif; ?>
                    </div>
                <?php endif; ?>

                <!-- Mobile: Swiper Carousel -->
                <div class="lg:hidden relative w-full rounded-lg overflow-hidden">
                    <div id="<?php echo esc_attr($carousel_id); ?>" class="swiper js-property-swiper">
                        <div class="swiper-wrapper">
                            <?php foreach ($gallery_images as $image): ?>
                                <div class="swiper-slide">
                                    <div class="aspect-[3/2]">
                                        <img src="<?php echo esc_url($image['url']); ?>"
                                            alt="<?php echo esc_attr($image['alt']); ?>"
                                            class="w-full h-full object-cover">
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <?php if ($total_images > 1): ?>
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
                            <div
                                class="absolute bottom-4 left-4 z-10 bg-dark/60 text-white text-sm px-3 py-1 rounded-full backdrop-blur-sm">
                                <span class="js-slide-current">1</span> / <?php echo $total_images; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Desktop: Bento Grid -->
                <div class="hidden lg:block">
                    <?php if ($total_images === 1): ?>
                        <div class="rounded-lg overflow-hidden aspect-[9/4]">
                            <a href="<?php echo esc_url($gallery_images[0]['url']); ?>"
                                data-fancybox="property-gallery"
                                data-caption="<?php echo esc_attr($gallery_images[0]['alt'] ?: get_the_title()); ?>"
                                class="block w-full h-full group">
                                <img src="<?php echo esc_url($gallery_images[0]['url']); ?>"
                                    alt="<?php echo esc_attr($gallery_images[0]['alt']); ?>"
                                    class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
                            </a>
                        </div>

                    <?php elseif ($total_images === 2): ?>
                        <div class="grid grid-cols-12 gap-4 aspect-[9/4]">
                            <a href="<?php echo esc_url($gallery_images[0]['url']); ?>"
                                data-fancybox="property-gallery"
                                data-caption="<?php echo esc_attr($gallery_images[0]['alt'] ?: get_the_title()); ?>"
                                class="col-span-3 relative block overflow-hidden rounded-lg group">
                                <img src="<?php echo esc_url($gallery_images[0]['url']); ?>"
                                    alt="<?php echo esc_attr($gallery_images[0]['alt']); ?>"
                                    class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
                            </a>
                            <a href="<?php echo esc_url($gallery_images[1]['url']); ?>"
                                data-fancybox="property-gallery"
                                data-caption="<?php echo esc_attr($gallery_images[1]['alt'] ?: get_the_title()); ?>"
                                class="col-span-2 relative block overflow-hidden rounded-lg group">
                                <img src="<?php echo esc_url($gallery_images[1]['url']); ?>"
                                    alt="<?php echo esc_attr($gallery_images[1]['alt']); ?>"
                                    class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
                            </a>
                        </div>

                    <?php else: ?>
                        <div class="grid grid-cols-12 grid-rows-2 gap-5 aspect-[9/4]">
                            <!-- Main image (3/5 width, full height) -->
                            <a href="<?php echo esc_url($gallery_images[0]['url']); ?>"
                                data-fancybox="property-gallery"
                                data-caption="<?php echo esc_attr($gallery_images[0]['alt'] ?: get_the_title()); ?>"
                                class="col-span-8 row-span-2 relative block overflow-hidden rounded-lg group shadow">
                                <img src="<?php echo esc_url($gallery_images[0]['url']); ?>"
                                    alt="<?php echo esc_attr($gallery_images[0]['alt']); ?>"
                                    class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
                            </a>
                            <!-- Top-right image -->
                            <a href="<?php echo esc_url($gallery_images[1]['url']); ?>"
                                data-fancybox="property-gallery"
                                data-caption="<?php echo esc_attr($gallery_images[1]['alt'] ?: get_the_title()); ?>"
                                class="col-span-4 relative block overflow-hidden rounded-lg group shadow">
                                <img src="<?php echo esc_url($gallery_images[1]['url']); ?>"
                                    alt="<?php echo esc_attr($gallery_images[1]['alt']); ?>"
                                    class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
                            </a>
                            <!-- Bottom-right image -->
                            <a href="<?php echo esc_url($gallery_images[2]['url']); ?>"
                                data-fancybox="property-gallery"
                                data-caption="<?php echo esc_attr($gallery_images[2]['alt'] ?: get_the_title()); ?>"
                                class="col-span-4 relative block overflow-hidden rounded-lg group shadow">
                                <img src="<?php echo esc_url($gallery_images[2]['url']); ?>"
                                    alt="<?php echo esc_attr($gallery_images[2]['alt']); ?>"
                                    class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
                                <?php if ($total_images > 3): ?>
                                    <div class="absolute bottom-3 right-4 rounded-full bg-dark px-4 py-1 lh-1">
                                        <span class="text-white text-base font-medium">More +<?php echo $total_images - 3; ?></span>
                                    </div>
                                <?php endif; ?>
                            </a>
                        </div>
                        <?php if ($total_images > 3): ?>
                            <?php for ($i = 3; $i < $total_images; $i++): ?>
                                <a href="<?php echo esc_url($gallery_images[$i]['url']); ?>"
                                    data-fancybox="property-gallery"
                                    data-caption="<?php echo esc_attr($gallery_images[$i]['alt'] ?: get_the_title()); ?>"
                                    class="hidden"></a>
                            <?php endfor; ?>
                        <?php endif; ?>

                    <?php endif; ?>
                </div>

            </div>
        <?php endif; ?>
        <div class="grid lg:grid-cols-12 gap-4 lg:gap-5 mt-8">
            <!-- ══════════════════════════════════════
                 LEFT COLUMN : Header, Specs, Content, Map
                 ══════════════════════════════════════ -->
            <div class="lg:col-span-8 lg:me-10">
                <!-- Header: Badges, Title, Price, Location -->
                <div class="mb-6 md:mb-8">
                    <!-- Badges -->
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
                            <span class="text-2xl md:text-3xl font-bold text-dark whitespace-nowrap">
                                €<?php echo number_format((float) $price, 0, ',', '.'); ?>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Property Specs -->
                <?php
                $specs = [
                    [
                        'value' => $size,
                        'label' => '',
                        'suffix' => 'm²',
                        'icon' => '
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-scan-icon lucide-scan"><path d="M3 7V5a2 2 0 0 1 2-2h2"/><path d="M17 3h2a2 2 0 0 1 2 2v2"/><path d="M21 17v2a2 2 0 0 1-2 2h-2"/><path d="M7 21H5a2 2 0 0 1-2-2v-2"/></svg>'
                    ],
                    [
                        'value' => $bedrooms,
                        'label' => 'Bedrooms',
                        'icon' => '
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-bed-double-icon lucide-bed-double"><path d="M2 20v-8a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v8"/><path d="M4 10V6a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v4"/><path d="M12 4v6"/><path d="M2 18h20"/></svg>'
                    ],
                    [
                        'value' => $bathrooms,
                        'label' => 'Bathrooms',
                        'icon' => '
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-bath-icon lucide-bath"><path d="M10 4 8 6"/><path d="M17 19v2"/><path d="M2 12h20"/><path d="M7 19v2"/><path d="M9 5 7.621 3.621A2.121 2.121 0 0 0 4 5v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-5"/></svg>'
                    ]
                ];
                ?>

                <div class="flex flex-wrap gap-4 lg:gap-8 mb-8 md:mb-10">
                    <?php foreach ($specs as $spec): ?>
                        <?php if (!empty($spec['value'])): ?>
                            <div class="flex gap-2">
                                <div class="text-primary">
                                    <?php echo $spec['icon']; ?>
                                </div>
                                <div class="flex flex-wrap gap-1 items-center">
                                    <span class="">
                                        <?php echo esc_html($spec['value'] . ($spec['suffix'] ?? '')); ?>
                                    </span>
                                    <span class="">
                                        <?php echo esc_html($spec['label']); ?>
                                    </span>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>

                <!-- Description -->
                <div class="mb-8 md:mb-10">
                    <h2 class="text-xl md:text-2xl font-bold text-dark mb-4">About This Property</h2>
                    <div class="entry-content">
                        <?php the_content(); ?>
                    </div>
                </div>

                <!-- Layout Plan -->
                <?php if ($layout_image): ?>
                    <div class="mb-8 md:mb-10 max-w-xl">
                        <h2 class="text-xl md:text-2xl font-bold text-dark mb-4">Layout Plan</h2>
                        <a href="<?php echo esc_url($layout_image); ?>" data-fancybox="layout-plan"
                            data-caption="Layout Plan"
                            class="block rounded-lg border border-gray/10 overflow-hidden relative transition-shadow duration-300 hover:shadow-lg">
                            <img src="<?php echo esc_url($layout_image); ?>" alt="Layout Plan" class="w-full h-auto block">
                        </a>
                    </div>
                <?php endif; ?>

                <!-- Location Map -->
                <?php if ($latitude && $longitude): ?>
                    <?php
                    $map_lat = esc_js(str_replace(',', '.', $latitude));
                    $map_lng = esc_js(str_replace(',', '.', $longitude));
                    $map_title = esc_js(get_the_title());
                    ?>
                    <div class="mb-8 md:mb-10">
                        <h2 class="text-xl md:text-2xl font-bold text-dark mb-4">Points of Interest</h2>
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
                            class="w-full h-[350px] md:h-[400px] rounded-lg border border-gray/10 overflow-hidden z-0"
                            data-lat="<?php echo $map_lat; ?>"
                            data-lng="<?php echo $map_lng; ?>"
                            data-title="<?php echo $map_title; ?>">
                            <div class="flex items-center justify-center h-full bg-gray-50 text-gray-400 text-sm">
                                Loading map&hellip;
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

            </div>

            <!-- ══════════════════════════════════════
                 RIGHT COLUMN — Sticky Sidebar
                 ══════════════════════════════════════ -->
            <div class="lg:col-span-4">
                <div class="lg:sticky lg:top-24 space-y-6">

                    <!-- Contact Form Card -->
                    <div class="rounded-lg bg-primary/20 p-6" style="padding-bottom: 0;">
                        <h3 class="text-xl lg:text-[26px] font-semibold text-dark mb-1">Interested in this property?</h3>
                        <p class="text-dark text-sm mb-6">Fill out the form and we'll get back to you shortly.</p>

                        <?php echo do_shortcode('[contact-form-7 id="1072181" title="Single Property"]'); ?>
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
                                class="w-full inline-flex items-center justify-center font-medium text-center whitespace-nowrap h-10 border border-gray/100 bg-white text-sm gap-2 leading-5 px-4 py-2 rounded-md text-dark hover:bg-gray/5 transition-colors cursor-pointer no-underline">
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
                                        <span class="text-gray flex items-center gap-1.5">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M14.25 7.756a4.5 4.5 0 1 0 0 8.488M7.5 10.5h5.25m-5.25 3h5.25M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                            </svg>
                                            Price
                                        </span>
                                        <span
                                            class="font-semibold text-dark">€<?php echo number_format((float) $price, 0, ',', '.'); ?></span>
                                    </div>
                                <?php endif; ?>
                                <?php if ($size): ?>
                                    <div class="flex justify-between border-b border-gray/10 pb-2">
                                        <span class="text-gray flex items-center gap-1.5">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M3.75 3.75v4.5m0-4.5h4.5m-4.5 0L9 9M3.75 20.25v-4.5m0 4.5h4.5m-4.5 0L9 15M20.25 3.75h-4.5m4.5 0v4.5m0-4.5L15 9m5.25 11.25h-4.5m4.5 0v-4.5m0 4.5L15 15" />
                                            </svg>
                                            Size
                                        </span>
                                        <span class="font-semibold text-dark"><?php echo esc_html($size); ?> m²</span>
                                    </div>
                                <?php endif; ?>
                                <?php if ($bedrooms): ?>
                                    <div class="flex justify-between border-b border-gray/10 pb-2">
                                        <span class="text-gray flex items-center gap-1.5">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" fill="currentColor"
                                                class="w-4 h-4">
                                                <path
                                                    d="M64 96C81.7 96 96 110.3 96 128L96 352L320 352L320 224C320 206.3 334.3 192 352 192L512 192C565 192 608 235 608 288L608 512C608 529.7 593.7 544 576 544C558.3 544 544 529.7 544 512L544 448L96 448L96 512C96 529.7 81.7 544 64 544C46.3 544 32 529.7 32 512L32 128C32 110.3 46.3 96 64 96zM144 256C144 220.7 172.7 192 208 192C243.3 192 272 220.7 272 256C272 291.3 243.3 320 208 320C172.7 320 144 291.3 144 256z" />
                                            </svg>
                                            Bedrooms
                                        </span>
                                        <span class="font-semibold text-dark"><?php echo esc_html($bedrooms); ?></span>
                                    </div>
                                <?php endif; ?>
                                <?php if ($bathrooms): ?>
                                    <div class="flex justify-between border-b border-gray/10 pb-2">
                                        <span class="text-gray flex items-center gap-1.5">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" fill="currentColor"
                                                class="w-4 h-4">
                                                <path
                                                    d="M128 195.9C128 176.1 144.1 160 163.9 160C173.4 160 182.5 163.8 189.3 170.5L205.5 186.7C184.5 225.6 188.1 274.2 216.4 309.7L215 311C205.6 320.4 205.6 335.6 215 344.9C224.4 354.2 239.6 354.3 248.9 344.9L409 185C418.4 175.6 418.4 160.4 409 151.1C399.6 141.8 384.4 141.7 375.1 151.1L373.8 152.4C338.3 124.1 289.7 120.5 250.8 141.5L234.5 125.3C215.8 106.5 190.4 96 163.9 96C108.7 96 64 140.7 64 195.9L64 512C64 529.7 78.3 544 96 544C113.7 544 128 529.7 128 512L128 195.9zM320 416C337.7 416 352 401.7 352 384C352 366.3 337.7 352 320 352C302.3 352 288 366.3 288 384C288 401.7 302.3 416 320 416zM384 480C384 462.3 369.7 448 352 448C334.3 448 320 462.3 320 480C320 497.7 334.3 512 352 512C369.7 512 384 497.7 384 480zM384 352C401.7 352 416 337.7 416 320C416 302.3 401.7 288 384 288C366.3 288 352 302.3 352 320C352 337.7 366.3 352 384 352zM448 416C448 398.3 433.7 384 416 384C398.3 384 384 398.3 384 416C384 433.7 398.3 448 416 448C433.7 448 448 433.7 448 416zM448 288C465.7 288 480 273.7 480 256C480 238.3 465.7 224 448 224C430.3 224 416 238.3 416 256C416 273.7 430.3 288 448 288zM512 352C512 334.3 497.7 320 480 320C462.3 320 448 334.3 448 352C448 369.7 462.3 384 480 384C497.7 384 512 369.7 512 352zM544 320C561.7 320 576 305.7 576 288C576 270.3 561.7 256 544 256C526.3 256 512 270.3 512 288C512 305.7 526.3 320 544 320z" />
                                            </svg>
                                            Bathrooms
                                        </span>
                                        <span class="font-semibold text-dark"><?php echo esc_html($bathrooms); ?></span>
                                    </div>
                                <?php endif; ?>
                                <?php if ($location_string): ?>
                                    <div class="flex justify-between pb-2">
                                        <span class="text-gray flex items-center gap-1.5">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                            </svg>
                                            Location
                                        </span>
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
    <?php if ($latitude && $longitude): ?>
    /*
     * Google Maps callback — called by the Maps API script when loaded.
     * Must be defined at the top level (outside DOMContentLoaded) so the
     * async Maps script can find it when it finishes loading.
     */
    window.initPropertyMap = (function() {
        var initialized = false;
        return function() {
            if (initialized) return;
            initialized = true;

            var mapEl = document.getElementById('property-map');
            if (!mapEl) return;

            var mapLat = parseFloat(mapEl.getAttribute('data-lat'));
            var mapLng = parseFloat(mapEl.getAttribute('data-lng'));
            var mapTitle = mapEl.getAttribute('data-title') || '';

            if (isNaN(mapLat) || isNaN(mapLng)) return;

            // Clear the loading placeholder
            mapEl.innerHTML = '';

            // Create the map
            var map = new google.maps.Map(mapEl, {
                center: { lat: mapLat, lng: mapLng },
                zoom: 15,
                scrollwheel: false,
                mapTypeControl: false,
                streetViewControl: false,
                styles: [
                    {
                        featureType: 'poi',
                        elementType: 'labels',
                        stylers: [{ visibility: 'off' }]
                    }
                ]
            });

            // Property marker (red pin)
            var propertyMarker = new google.maps.Marker({
                position: { lat: mapLat, lng: mapLng },
                map: map,
                title: mapTitle,
                icon: {
                    path: 'M12 0C7.6 0 4 3.6 4 8c0 6 8 16 8 16s8-10 8-16c0-4.4-3.6-8-8-8zm0 11c-1.7 0-3-1.3-3-3s1.3-3 3-3 3 1.3 3 3-1.3 3-3 3z',
                    fillColor: '#ef4444',
                    fillOpacity: 1,
                    strokeColor: '#ffffff',
                    strokeWeight: 2,
                    scale: 1.5,
                    anchor: new google.maps.Point(12, 24),
                    labelOrigin: new google.maps.Point(12, 9)
                },
                label: {
                    text: ' ',
                    color: '#ffffff'
                }
            });

            // InfoWindow for property
            var propertyInfo = new google.maps.InfoWindow({
                content: '<div style="font-family:-apple-system,BlinkMacSystemFont,sans-serif;padding:4px 0;">' +
                    '<strong style="font-size:14px;color:#1a1a1a;">' + mapTitle + '</strong>' +
                    '<br><span style="font-size:12px;color:#888;">Your location</span></div>'
            });

            propertyMarker.addListener('click', function() {
                propertyInfo.open(map, propertyMarker);
            });

            // 500m walkable radius circle
            new google.maps.Circle({
                map: map,
                center: { lat: mapLat, lng: mapLng },
                radius: 500,
                strokeColor: '#ef4444',
                strokeOpacity: 0.8,
                strokeWeight: 2,
                fillColor: '#ef4444',
                fillOpacity: 0.05
            });

            // Fetch nearby places via PlacesService
            var service = new google.maps.places.PlacesService(map);
            var allPlaces = {};
            var pendingSearches = 0;

            // POI marker icon (blue pin)
            var poiIcon = {
                path: 'M10 0C5 0 1 4 1 9c0 7 9 19 9 19s9-12 9-19c0-5-4-9-9-9zm0 12.5c-1.9 0-3.5-1.6-3.5-3.5S8.1 5.5 10 5.5s3.5 1.6 3.5 3.5-1.6 3.5-3.5 3.5z',
                fillColor: '#3b82f6',
                fillOpacity: 1,
                strokeColor: '#ffffff',
                strokeWeight: 1.5,
                scale: 1.1,
                anchor: new google.maps.Point(10, 24),
                labelOrigin: new google.maps.Point(10, 9)
            };

            function searchByType(type, callback) {
                pendingSearches++;
                service.nearbySearch({
                    location: { lat: mapLat, lng: mapLng },
                    radius: 1000,
                    type: type
                }, function(results, status) {
                    pendingSearches--;
                    if (status === google.maps.places.PlacesServiceStatus.OK && results) {
                        results.forEach(function(place) {
                            if (!allPlaces[place.place_id]) {
                                allPlaces[place.place_id] = place;
                            }
                        });
                    }
                    if (pendingSearches <= 0 && callback) callback();
                });
            }

            var placeTypes = [
                'tourist_attraction', 'restaurant', 'cafe', 'bar',
                'park', 'shopping_mall', 'museum', 'art_gallery'
            ];

            placeTypes.forEach(function(type) {
                searchByType(type);
            });

            // When all searches complete, add markers
            var checkComplete = setInterval(function() {
                if (pendingSearches <= 0) {
                    clearInterval(checkComplete);
                    addPOIMarkers();
                }
            }, 200);

            function addPOIMarkers() {
                var placeIds = Object.keys(allPlaces);
                if (placeIds.length === 0) return;

                var infoWindow = new google.maps.InfoWindow();
                var bounds = new google.maps.LatLngBounds();
                bounds.extend({ lat: mapLat, lng: mapLng });

                placeIds.forEach(function(pid) {
                    var place = allPlaces[pid];
                    if (!place.geometry || !place.geometry.location) return;

                    var marker = new google.maps.Marker({
                        position: place.geometry.location,
                        map: map,
                        title: place.name,
                        icon: poiIcon
                    });

                    // Build InfoWindow content
                    var starsHtml = '';
                    if (place.rating) {
                        var fullStars = Math.round(place.rating);
                        for (var s = 0; s < 5; s++) {
                            starsHtml += s < fullStars ? '★' : '☆';
                        }
                    }

                    var content = '<div style="font-family:-apple-system,BlinkMacSystemFont,sans-serif;max-width:250px;padding:4px 0;">' +
                        '<strong style="font-size:14px;color:#1a1a1a;">' + (place.name || 'Place') + '</strong>' +
                        (place.vicinity ? '<div style="margin-top:2px;font-size:12px;color:#888;">' + place.vicinity + '</div>' : '') +
                        (place.rating ?
                            '<div style="margin-top:4px;font-size:13px;color:#f59e0b;">' + starsHtml +
                            ' <span style="color:#666;">' + place.rating.toFixed(1) +
                            (place.user_ratings_total ? ' (' + place.user_ratings_total + ')' : '') + '</span></div>'
                            : '') +
                        (place.types && place.types.length > 0 ?
                            '<div style="margin-top:2px;font-size:11px;color:#aaa;text-transform:capitalize;">' +
                            place.types[0].replace(/_/g, ' ') + '</div>'
                            : '') +
                        '<a href="https://www.google.com/maps/search/?api=1&query=' + encodeURIComponent(place.name) +
                        '&query_place_id=' + place.place_id +
                        '" target="_blank" rel="noopener noreferrer" ' +
                        'style="display:inline-block;margin-top:6px;font-size:12px;color:#2563eb;text-decoration:none;">Open in Google Maps ↗</a>' +
                        '</div>';

                    marker.addListener('click', (function(c, m) {
                        return function() {
                            infoWindow.setContent(c);
                            infoWindow.open(map, m);
                        };
                    })(content, marker));

                    bounds.extend(place.geometry.location);
                });

                // Fit bounds to show all markers
                if (placeIds.length > 1) {
                    map.fitBounds(bounds, { maxZoom: 15, padding: 50 });
                }
            }
        };
    })();
    <?php endif; ?>

    document.addEventListener('DOMContentLoaded', function() {

        var addressField = document.getElementById("property_address");
        if (addressField) {
            addressField.value = "<?php echo esc_js($address); ?>";
        }

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
            /*
             * [BACKUP] Leaflet Tourist Map — replaced by Google Maps Places API.
             * Kept as reference. To restore, also re-enable Leaflet enqueues in functions.php.
             *
            // Leaflet Tourist Map
            if (typeof L !== 'undefined') {
                var mapLat = parseFloat("<?php echo esc_js(str_replace(',', '.', $latitude)); ?>");
                var mapLng = parseFloat("<?php echo esc_js(str_replace(',', '.', $longitude)); ?>");

                var map = L.map('property-map', {
                    scrollWheelZoom: false
                }).setView([mapLat, mapLng], 15);

                // Using a slightly more stylistic map tile layer (CartoDB Positron) for a modern look
                L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
                    attribution: '&copy; OpenStreetMap contributors &copy; CARTO',
                    maxZoom: 19,
                }).addTo(map);

                // 1. The Main Property Marker (Red/Primary)
                var propertyIcon = L.divIcon({
                    className: 'custom-div-icon',
                    html: `<div style="background-color: #ef4444; width: 24px; height: 24px; border-radius: 50%; border: 3px solid white; box-shadow: 0 2px 5px rgba(0,0,0,0.3);"></div>`,
                    iconSize: [24, 24],
                    iconAnchor: [12, 12]
                });

                L.marker([mapLat, mapLng], {
                        icon: propertyIcon
                    })
                    .addTo(map)
                    .bindPopup('<strong><?php echo esc_js(get_the_title()); ?></strong><br>Your location');

                // 2. Tourist Points of Interest (POIs)
                // NOTE: Adjust the +/- math below to place these accurately around your actual coordinates!
                var touristSpots = [{
                        lat: mapLat + 0.003,
                        lng: mapLng + 0.004,
                        title: "Main Train Station",
                        icon: "🚂"
                    },
                    {
                        lat: mapLat - 0.002,
                        lng: mapLng + 0.005,
                        title: "City Center / Shopping",
                        icon: "🏛️"
                    },
                    {
                        lat: mapLat + 0.001,
                        lng: mapLng - 0.002,
                        title: "Free Ski Bus Stop",
                        icon: "🚌"
                    }
                ];

                touristSpots.forEach(function(spot) {
                    var poiIcon = L.divIcon({
                        className: 'poi-div-icon',
                        html: `<div style="background-color: white; padding: 4px; border-radius: 50%; box-shadow: 0 2px 4px rgba(0,0,0,0.2); font-size: 16px; text-align: center; line-height: 1;">${spot.icon}</div>`,
                        iconSize: [30, 30],
                        iconAnchor: [15, 15]
                    });

                    L.marker([spot.lat, spot.lng], {
                            icon: poiIcon
                        })
                        .addTo(map)
                        .bindPopup('<strong>' + spot.title + '</strong><br>Just a short walk away');
                });

                // Optional: Add a subtle radius circle to highlight the "Walkable Area"
                L.circle([mapLat, mapLng], {
                    color: '#ef4444',
                    fillColor: '#ef4444',
                    fillOpacity: 0.05,
                    radius: 500 // 500 meter walkable radius
                }).addTo(map);
            }
            */

        <?php endif; ?>

        // Fancybox init
        if (typeof Fancybox !== 'undefined') {
            var fancyboxOptions = {
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
            };

            Fancybox.bind('[data-fancybox="property-gallery"]', fancyboxOptions);
            Fancybox.bind('[data-fancybox="layout-plan"]', fancyboxOptions);
        }
    });
</script>