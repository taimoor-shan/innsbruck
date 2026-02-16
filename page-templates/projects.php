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
]);
?>

<?php
// 1. Philosophy Section
$philosophy_title = get_field('projects_philosophy_title');
$philosophy_intro = get_field('projects_philosophy_intro');
$philosophy_principles = get_field('projects_principles');
$philosophy_image = get_field('projects_philosophy_image');
?>
<?php if ($philosophy_title || $philosophy_intro || $philosophy_principles || $philosophy_image): ?>
    <section class="py-10 lg:py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center secTitle left">
                <div>
                    <?php if ($philosophy_title): ?>
                        <h2 class="mb-4"><?php echo esc_html($philosophy_title); ?></h2>
                    <?php endif; ?>

                    <?php if ($philosophy_intro): ?>
                        <div class="prose max-w-none text-dark font-medium mb-6">
                            <?php echo wp_kses_post($philosophy_intro); ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($philosophy_principles): ?>
                        <div class="secTitle">
                            <?php echo wp_kses_post($philosophy_principles); ?>
                        </div>
                    <?php endif; ?>
                </div>

                <?php if ($philosophy_image): ?>
                    <div class="relative h-full">
                        <img src="<?php echo esc_url($philosophy_image); ?>" alt="<?php echo esc_attr($philosophy_title); ?>"
                            class="">
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php endif; ?>

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
            'terms' => ['completed', 'delivered', 'sold'],
        ]
    ]
]);
?>
<?php if ($past_projects->have_posts()): ?>
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-8 secTitle">
                <h2 class="mb-4">Past Projects</h2>
            </div>

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
                    <div class="flex flex-col <?php echo $zigzag_class; ?> items-center gap-0 border-b border-gray-200 last:border-b-0 pb-8 mb-8 last:pb-0 last:mb-0">
                        <!-- Featured Image (Left) -->
                        <?php if (has_post_thumbnail()): ?>
                            <div class="md:w-1/2 shrink-0 overflow-hidden rounded-lg self-start">
                                <?php the_post_thumbnail('large', ['class' => 'w-full object-cover aspect-[16/10]']); ?>
                            </div>
                        <?php endif; ?>

                        <!-- Details (Right) -->
                        <div class="flex-1 p-6 md:p-8 flex flex-col justify-center">
                            <div class="mb-3">
                                <?php if ($year): ?>
                                    <span class="bg-primary/5 text-primary text-xs font-semibold px-3 py-1 rounded shrink-0">Completed: <?php echo esc_html($year); ?></span>
                                <?php endif; ?>
                                <h3 class="mb-0 mt-4"><?php the_title(); ?></h3>
                            </div>

                            <?php if ($location_string): ?>
                                <p class=" flex items-start gap-1 mb-4">
                                    <svg class="w-4 h-4 shrink-0 mt-1" fill="none" stroke="var(--color-primary)" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <?php echo esc_html($location_string); ?>
                                </p>
                            <?php endif; ?>

                            <?php if ($scope): ?>
                                <div class="">
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
            'terms' => ['feasibility', 'design', 'permits'],
        ]
    ]
]);
?>
<?php if ($future_projects->have_posts()): ?>
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-8 secTitle">
                <h2 class="mb-4">Upcoming Projects</h2>
                <p class="text-gray">Sneak peek into our future developments</p>
            </div>

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
                    <div class="flex flex-col <?php echo $zigzag_class; ?> items-center gap-8 border-b border-gray-200 last:border-b-0 pb-8 mb-8 lg:pb-16 lg:mb-16 last:pb-0 last:mb-0">
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
                                    <span class="bg-primary/5 text-primary text-xs font-semibold px-3 py-1 rounded shrink-0"><?php echo esc_html($stage_name); ?></span>
                                <?php endif; ?>
                                <h3 class="mb-0 mt-4"><?php the_title(); ?></h3>
                            </div>

                            <?php if ($location_string): ?>
                                <p class="flex gap-1 mb-4">
                                    <svg class="w-4 h-4 shrink-0 mt-1" fill="none" stroke="var(--color-primary)" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
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

                            <a href="<?php echo get_bloginfo('url') . '/contact'; ?>"
                                class="inline-block mt-6 px-6 py-2 border border-primary text-primary rounded hover:bg-primary hover:text-white transition-colors text-sm font-medium">
                                Inquire Now
                            </a>

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
// 4. Investor Trust Section
$trust_title = get_field('projects_trust_title');
$trust_subtitle = get_field('projects_trust_subtitle');
$trust_title_highlighted = get_field('projects_trust_title_highlighted');
$trust_image = get_field('projects_trust_image');
?>
<?php if (have_rows('projects_trust_points')): ?>
    <section class="py-20 bg-gray-50 border-t border-b">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-16 items-start">
                <!-- Left Column: Subtitle + Image -->
                <div class="lg:col-span-1 hidden md:block">
                   

                    <?php if ($trust_image): ?>
                        <div class="mt-8">
                            <img src="<?php echo esc_url($trust_image); ?>" alt="<?php echo esc_attr($trust_title); ?>"
                                class="w-full max-w-md rounded-lg object-cover aspect-[3/4]">
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Right Column: Heading + Numbered Points -->
                <div class="lg:col-span-3 secTitle left">
                    <?php if ($trust_title || $trust_title_highlighted): ?>
                        <h2 class="font-semibold leading-tight mb-12">
                            <?php if ($trust_title): ?>
                                <?php echo esc_html($trust_title); ?><?php if ($trust_title_highlighted): ?>,<?php endif; ?>
                            <?php endif; ?>
                            <?php if ($trust_title_highlighted): ?>
                                <span class="text-gray-400"><?php echo esc_html($trust_title_highlighted); ?></span>
                            <?php endif; ?>
                        </h2>
                    <?php endif; ?>

                    <div class="space-y-0">
                        <?php
                        $index = 1;
                        while (have_rows('projects_trust_points')):
                            the_row(); ?>
                            <div class="grid lg:grid-cols-3 gap-x-6 items-start border-t border-gray-200 py-6">
                                <div class="col-span-2 lg:col-span-1 flex items-start gap-6 mb-6 mb-lg-4">
                                    <span class="text-gray-400 leading-snug"><?php echo str_pad($index, 2, '0', STR_PAD_LEFT); ?></span>
                                    <h3 class="text-lg font-semibold leading-snug mb-0"><?php echo esc_html(get_sub_field('point_title')); ?></h3>
                                </div>
                                <p class="text text-gray leading-relaxed col-span-2 mb-0">
                                    <?php echo esc_html(get_sub_field('point_description')); ?>
                                </p>
                            </div>
                        <?php
                            $index++;
                        endwhile; ?>
                    </div>
                </div>
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

<?php
get_footer();
