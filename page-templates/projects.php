<?php
/**
 * Template Name: Projects Page
 *
 * @package TailPress
 */

get_header();

// Hero Section
// Use the standard hero component logic. 
// Assuming the page user uses the standard Fields for Hero or we just pass the featured image.
// The user said: "Hero is already handled by hero.php via the_content() — do not add hero-related ACF fields."
// This likely means I should just run `the_content()` if it contains the hero block, OR assume standard hero rendering.
// Looking at content-home.php, it manually calls the hero component. 
// I will replicate the Hero setup from content-home.php but use this page's fields if they exist, or just fall back to standard.
// Actually, if "hero.php handles it via the_content()", that might mean there's a block or shortcode? 
// But `hero.php` usually implies a template part.
// I'll stick to the safe bet: Render the hero component using this page's Featured Image and Title.
// User also said: "Include hero.php at top (standard)"

$hero_title = get_the_title();
$hero_subtitle = has_excerpt() ? get_the_excerpt() : '';
$featured_image = get_the_post_thumbnail_url(get_the_ID(), 'full');

// We can check if there are specific hero fields typically used, but for now standardizing:
get_template_part('template-parts/components/hero', null, [
    'image' => $featured_image,
    'title' => $hero_title,
    'subtitle' => $hero_subtitle,
    'height' => 'h-[60vh]', // Slightly shorter than home
    'width' => 'max-w-5xl',
]);
?>


<section class="py-10 lg:py-20 bg-white">
    <div class="container mx-auto px-4 max-w-5xl text-center">
        <?php the_content(); ?>
    </div>
</section>


<?php
// 2. Past Projects Section
// Query 'project' CPT with 'project_stage' in 'completed', 'delivered'
$past_projects = new WP_Query([
    'post_type' => 'project',
    'posts_per_page' => -1,
    'tax_query' => [
        [
            'taxonomy' => 'project_stage',
            'field' => 'slug',
            'terms' => ['completed', 'sold'],
        ]
    ]
]);
?>
<?php if ($past_projects->have_posts()): ?>
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <!-- <div class="text-center mb-8 secTitle">
                <h2 class="mb-4">Past Projects</h2>
            </div> -->

            <div class="space-y-0">
                <?php
                $past_index = 0;
                while ($past_projects->have_posts()):
                    $past_projects->the_post();
                    $address = get_field('project_address');
                    $city_state = get_field('project_city_state');
                    $location = filter_var([$address, $city_state], FILTER_CALLBACK, ['options' => 'trim']);
                    $location_string = implode(', ', array_filter($location));
                    $year = get_field('project_year');
                    $scope = get_the_content();
                    $units = get_field('project_units');
                    $area = get_field('project_area');
                    $zigzag_class = ($past_index % 2 !== 0) ? 'md:flex-row-reverse' : 'md:flex-row';
                    ?>
                    <div
                        class="flex flex-col <?php echo $zigzag_class; ?> gap-8 items-center justify-center gap-0 border-b border-gray-200 last:border-b-0 pb-8 mb-8 last:pb-0 last:mb-0">
                        <!-- Featured Image (Left) -->
                        <?php if (has_post_thumbnail()): ?>
                            <div class="md:w-1/2 shrink-0 overflow-hidden rounded-lg self-start">
                                <?php the_post_thumbnail('large', ['class' => 'w-full object-cover aspect-[16/10]']); ?>
                            </div>
                        <?php endif; ?>

                        <!-- Details (Right) -->
                        <div class="flex-1 justify-start items-start flex flex-col justify-center">
                            <div class="mb-3">
                                <?php if ($year): ?>
                                    <span
                                        class="bg-accent text-dark text-xs font-semibold px-3 py-1 rounded shrink-0 border border-primary/20">Completed:
                                        <?php echo esc_html($year); ?></span>
                                <?php endif; ?>

                                <h3 class="mb-0 mt-4"><?php the_title(); ?></h3>

                            </div>

                            <?php if ($location_string): ?>
                                <p class=" flex items-start gap-1 mb-4">
                                    <svg class="w-4 h-4 shrink-0 mt-1" fill="none" stroke="var(--color-primary)"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                        </path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <?php echo esc_html($location_string); ?>
                                </p>
                            <?php endif; ?>

                            <?php if ($scope): ?>
                                <div class="text-gray">
                                    <?php echo $scope; ?>
                                </div>
                            <?php endif; ?>

                            <div class="flex flex-wrap gap-x-8 gap-y-2 mt-6">
                                <?php if ($units): ?>
                                    <div class="flex items-center gap-2">
                                        <span class="text-primary ">Units:</span>
                                        <span class="font-medium text-dark"><?php echo esc_html($units); ?></span>
                                    </div>
                                <?php endif; ?>
                                <?php if ($area): ?>
                                    <div class="flex items-center gap-2">
                                        <span class="text-primary ">Area:</span>
                                        <span class="font-medium text-dark"><?php echo esc_html($area); ?>m²</span>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <?php
                            $document_url = get_field('project_document');
                            if ($document_url):
                                ?>

                                <?php get_template_part('template-parts/components/button', null, [
                                    'attr' => 'x-data @click.prevent="$dispatch(\'open-download-modal\', \'' . esc_js($document_url) . '\')"',
                                    'text' => 'Investment Document',
                                    'style' => 'dark-solid',
                                    'class' => 'mt-6 text-sm',
                                    'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5" d="M8 10V7c0-2.21 1.79-4 4-4s4 1.79 4 4v3m-4 5a1 1 0 1 0 0-2a1 1 0 0 0 0 2m0 0v3m-5.4-8h10.8c.88 0 1.6.72 1.6 1.6v7c0 1.32-1.08 2.4-2.4 2.4H7.4C6.08 21 5 19.92 5 18.6v-7c0-.88.72-1.6 1.6-1.6"/></svg>',
                                    'icon_position' => 'left',
                                ]); ?>

                            <?php else: ?>
                                <?php get_template_part('template-parts/components/button', null, [
                                    'href' => home_url('/contact'), // Placeholder for the all-properties page we will build
                                    'text' => 'Inquire Now',
                                    'style' => 'dark-solid',
                                    'class' => 'mt-6 text-sm',
                                ]); ?>
                            <?php endif; ?>

                        </div>
                    </div>
                    <?php
                    $past_index++;
                endwhile;
                wp_reset_postdata(); ?>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php
// 3. Upcoming / Planned Projects
// Query 'project' CPT with 'project_stage' in 'feasibility', 'design', 'permits'
$future_projects = new WP_Query([
    'post_type' => 'project',
    'posts_per_page' => -1,
    'tax_query' => [
        [
            'taxonomy' => 'project_stage',
            'field' => 'slug',
            'terms' => ['coming-soon'],
        ]
    ]
]);
?>
<?php if ($future_projects->have_posts()): ?>
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <!-- <div class="text-center mb-8 secTitle">
                <h2 class="mb-4">Upcoming Projects</h2>
                <p class="text-gray">Sneak peek into our future developments</p>
            </div> -->

            <div class="space-y-0">
                <?php
                $future_index = 0;
                while ($future_projects->have_posts()):
                    $future_projects->the_post();
                    $area = get_field('project_area');
                    $units = get_field('project_units');
                    $type = get_field('project_type');
                    $timeline = get_field('project_timeline');
                    $scope = get_the_content();
                    $cta_link = get_field('project_cta_link');

                    // Get terms for 'project_stage' to show as label
                    $terms = get_the_terms(get_the_ID(), 'project_stage');
                    $stage_name = !empty($terms) ? $terms[0]->name : '';

                    $address = get_field('project_address');
                    $city_state = get_field('project_city_state');
                    $location = filter_var([$address, $city_state], FILTER_CALLBACK, ['options' => 'trim']);
                    $location_string = implode(', ', array_filter($location));
                    $zigzag_class = ($future_index % 2 !== 0) ? 'md:flex-row-reverse' : 'md:flex-row';
                    ?>
                    <div
                        class="flex flex-col <?php echo $zigzag_class; ?> items-center gap-8 border-b border-gray-200 last:border-b-0 pb-8 mb-8 lg:pb-16 lg:mb-16 last:pb-0 last:mb-0">
                        <!-- Featured Image (Left) -->
                        <?php if (has_post_thumbnail()): ?>
                            <div class="md:w-1/2 shrink-0 overflow-hidden rounded-lg self-start">
                                <?php the_post_thumbnail('large', ['class' => 'w-full object-cover aspect-[16/9]']); ?>
                            </div>
                        <?php endif; ?>

                        <!-- Details (Right) -->
                        <div class="flex-1 flex flex-col justify-center items-start">
                            <div class="mb-3">
                                <?php if ($stage_name): ?>
                                    <span
                                        class="bg-green-100 text-dark text-xs font-semibold px-2 py-1 rounded shrink-0 border border-green-200"><?php echo esc_html($stage_name); ?></span>
                                <?php endif; ?>
                                <h3 class="mb-0 mt-4"><?php the_title(); ?></h3>

                            </div>

                            <?php if ($location_string): ?>
                                <p class="flex gap-1 mb-4">
                                    <svg class="w-4 h-4 shrink-0 mt-1" fill="none" stroke="var(--color-primary)"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                        </path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <?php echo esc_html($location_string); ?>
                                </p>
                            <?php endif; ?>

                            <?php if ($scope): ?>
                                <div class="text-gray">
                                    <?php echo $scope; ?>
                                </div>
                            <?php endif; ?>

                            <div class="flex flex-wrap gap-x-8 gap-y-2 mt-6">
                                <?php if ($units): ?>
                                    <div class="flex items-center gap-2">
                                        <span class="text-primary">Units:</span>
                                        <span class="font-medium text-dark"><?php echo esc_html($units); ?></span>
                                    </div>
                                <?php endif; ?>
                                <?php if ($area): ?>
                                    <div class="flex items-center gap-2">
                                        <span class="text-primary">Area:</span>
                                        <span class="font-medium text-dark"><?php echo esc_html($area); ?>m²</span>
                                    </div>
                                <?php endif; ?>
                                <?php if ($type): ?>
                                    <div class="flex items-center gap-2">
                                        <span class="text-primary">Type:</span>
                                        <span class="font-medium text-dark"><?php echo esc_html($type); ?></span>
                                    </div>
                                <?php endif; ?>
                                <?php if ($timeline): ?>
                                    <div class="flex items-center gap-2">
                                        <span class="text-primary">Timeline:</span>
                                        <span class="font-medium text-dark"><?php echo esc_html($timeline); ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <?php
                            $document_url = get_field('project_document');
                            if ($document_url):
                                ?>
                                <?php get_template_part('template-parts/components/button', null, [
                                    'attr' => 'x-data @click.prevent="$dispatch(\'open-download-modal\', \'' . esc_js($document_url) . '\')"',
                                    'text' => 'Investment Document',
                                    'style' => 'dark-solid',
                                    'class' => 'mt-6 text-sm',
                                    'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5" d="M8 10V7c0-2.21 1.79-4 4-4s4 1.79 4 4v3m-4 5a1 1 0 1 0 0-2a1 1 0 0 0 0 2m0 0v3m-5.4-8h10.8c.88 0 1.6.72 1.6 1.6v7c0 1.32-1.08 2.4-2.4 2.4H7.4C6.08 21 5 19.92 5 18.6v-7c0-.88.72-1.6 1.6-1.6"/></svg>',
                                    'icon_position' => 'left',
                                ]); ?>
                            <?php else: ?>
                                <?php get_template_part('template-parts/components/button', null, [
                                    'href' => home_url('/contact'), // Placeholder for the all-properties page we will build
                                    'text' => 'Inquire Now',
                                    'style' => 'dark-solid',
                                    'class' => 'mt-6 text-sm',
                                ]); ?>
                            <?php endif; ?>

                        </div>
                    </div>
                    <?php
                    $future_index++;
                endwhile;
                wp_reset_postdata(); ?>
            </div>
        </div>
    </section>
<?php endif; ?>



<?php
// 5. Investor Lead Section
$lead_title = get_field('projects_lead_title');
$lead_text = get_field('projects_lead_text');
$lead_form = get_field('projects_lead_form');
?>
<?php if ($lead_title || $lead_form): ?>
    <section class="py-20 bg-primary/5">
        <div class="container mx-auto px-4">
            <div class=" mx-auto bg-white rounded-xl shadow-lg overflow-hidden flex flex-col md:flex-row">
                <div class="p-8 md:p-12 md:w-1/2 bg-dark text-white flex flex-col justify-center">
                    <?php if ($lead_title): ?>
                        <h2 class="text-3xl font-semibold mb-4"><?php echo esc_html($lead_title); ?></h2>
                    <?php endif; ?>
                    <?php if ($lead_text): ?>
                        <p class="text-gray-300 leading-relaxed">
                            <?php echo wp_kses_post($lead_text); ?>
                        </p>
                    <?php endif; ?>
                </div>
                <div class="p-8 md:p-12 md:w-1/2" style="padding-bottom: 16px;">
                    <?php if ($lead_form): ?>
                        <div class="lead-form-wrapper">
                            <?php echo do_shortcode($lead_form); ?>
                        </div>
                    <?php else: ?>
                        <p class="text-gray text-center italic">Contact form will appear here.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<!-- Document Download Modal (Alpine.js) -->
<div x-data="{ 
        showModal: false, 
        documentUrl: '',
        init() {
            // Listen for Contact Form 7 successful submission
            document.addEventListener('wpcf7mailsent', (event) => {
                // Check if the form is inside this modal
                if (this.$el.contains(event.target) && this.documentUrl) {
                    // Open document in new tab
                    window.open(this.documentUrl, '_blank');
                    
                    // Wait a bit then close modal and reset
                    setTimeout(() => {
                        this.showModal = false;
                        this.documentUrl = '';
                    }, 1000);
                }
            });
        }
    }" @open-download-modal.window="showModal = true; documentUrl = $event.detail" x-show="showModal"
    class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6" style="display: none;" x-cloak>

    <!-- Backdrop -->
    <div x-show="showModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-black/60 backdrop-blur-sm transition-opacity"></div>

    <!-- Modal Box -->
    <div class="relative w-full max-w-2xl transform rounded-xl bg-white p-6 sm:p-10 shadow-2xl transition-all"
        @click.outside="showModal = false" x-show="showModal" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">

        <!-- Close Button -->
        <button @click="showModal = false" type="button"
            class="absolute right-4 top-4 rounded-md text-gray-400 hover:text-gray-600 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 transition-colors">
            <span class="sr-only">Close modal</span>
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <div class="mb-6 border-b border-gray-100 pb-4">
            <h3 class="text-2xl font-bold text-dark mb-2">Download Document</h3>
            <p class="text-gray-600 text-sm">Please provide your details below to access the investment document.</p>
        </div>

        <!-- Form Placeholder -->
        <div class="lead-form-wrapper mt-4">
            <!-- IMPORTANT: Replace the ID with your actual Contact Form 7 ID -->
            <?php echo do_shortcode('[contact-form-7 id="a218341" title="Investor Form"]'); ?>
        </div>
    </div>
</div>

<?php
get_footer();
