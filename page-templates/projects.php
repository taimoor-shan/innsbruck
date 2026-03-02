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
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
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
            'terms' => ['completed', 'delivered'],
        ]
    ]
]);
?>
<?php if ($past_projects->have_posts()): ?>
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="mb-4">Past Projects</h2>
            </div>

            <div class="space-y-0">
                <?php while ($past_projects->have_posts()):
                    $past_projects->the_post();
                    $address = get_field('project_address');
                    $city_state = get_field('project_city_state');
                    $location = filter_var([$address, $city_state], FILTER_CALLBACK, ['options' => 'trim']);
                    $location_string = implode(', ', array_filter($location));
                    $year = get_field('project_year');
                    $scope = get_the_content();
                    $units = get_field('project_units');
                    $area = get_field('project_area');
                    ?>
                    <div class="flex flex-col md:flex-row gap-0 border-b border-gray-200 last:border-b-0 pb-8 mb-8 last:pb-0 last:mb-0">
                        <!-- Featured Image (Left) -->
                        <?php if (has_post_thumbnail()): ?>
                            <div class="md:w-1/2 shrink-0 overflow-hidden rounded-lg">
                                <?php the_post_thumbnail('large', ['class' => 'w-full h-full object-cover aspect-[16/9]']); ?>
                            </div>
                        <?php endif; ?>

                        <!-- Details (Right) -->
                        <div class="flex-1 p-6 md:p-8 flex flex-col justify-center">
                            <div class="mb-3">
                                <?php if ($year): ?>
                                    <span class="bg-primary/5 text-primary text-xs font-semibold px-3 py-1 rounded shrink-0">Completed: <?php echo esc_html($year); ?></span>
                                <?php endif; ?>
                                <h3 class="text-3xl mb-0 mt-4"><?php the_title(); ?></h3>
                            </div>

                            <?php if ($location_string): ?>
                                <p class=" flex items-center gap-1 mb-4">
                                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="var(--color-primary)" viewBox="0 0 24 24">
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
                                    <span class="text-gray block mb-2">The Scope:</span>
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
                <?php endwhile;
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
    <section class="py-20 bg-dark text-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-semibold mb-4 text-white">Upcoming Projects</h2>
                <p class="text-gray-400">Sneak peek into our future developments</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php while ($future_projects->have_posts()):
                    $future_projects->the_post();
                    $area = get_field('project_area');
                    $type = get_field('project_type');
                    $timeline = get_field('project_timeline');
                    $cta_link = get_field('project_cta_link');

                    // Get terms for 'project_stage' to show as label
                    $terms = get_the_terms(get_the_ID(), 'project_stage');
                    $stage_name = !empty($terms) ? $terms[0]->name : '';
                    ?>
                    <div class="bg-white/5 border border-white/10 rounded-lg hover:bg-white/10 transition-colors overflow-hidden">
                        <?php if (has_post_thumbnail()): ?>
                            <div class="h-48 overflow-hidden">
                                <?php the_post_thumbnail('medium_large', ['class' => 'w-full h-full object-cover']); ?>
                            </div>
                        <?php endif; ?>
                        <div class="p-6">
                        <div class="flex justify-between items-start mb-4">
                            <h3 class="font-semibold text-xl text-white"><?php the_title(); ?></h3>
                            <?php if ($stage_name): ?>
                                <span
                                    class="bg-primary text-white text-xs font-semibold px-2 py-1 rounded"><?php echo esc_html($stage_name); ?></span>
                            <?php endif; ?>
                        </div>

                        <div class="space-y-2">
                            <?php if ($type): ?>
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-400">Type</span>
                                    <span class="font-medium text-white"><?php echo esc_html($type); ?></span>
                                </div>
                            <?php endif; ?>

                            <?php if ($area): ?>
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-400">Area</span>
                                    <span class="font-medium text-white"><?php echo esc_html($area); ?></span>
                                </div>
                            <?php endif; ?>
                            <?php if ($units): ?>
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-400">Units</span>
                                    <span class="font-medium text-white"><?php echo esc_html($units); ?></span>
                                </div>
                            <?php endif; ?>

                            <?php if ($timeline): ?>
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-400">Timeline</span>
                                    <span class="font-medium text-white"><?php echo esc_html($timeline); ?></span>
                                </div>
                            <?php endif; ?>
                        </div>

                        <?php if ($cta_link): ?>
                            <a href="<?php echo esc_url($cta_link); ?>"
                                class="block w-full py-2 text-center border border-white/20 rounded hover:bg-white hover:text-dark transition-colors text-sm font-medium mt-6">
                                Learn More
                            </a>
                        <?php endif; ?>
                        </div>
                    </div>
                <?php endwhile;
                wp_reset_postdata(); ?>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php
// 4. Investor Trust Section
$trust_title = get_field('projects_trust_title');
?>
<?php if (have_rows('projects_trust_points')): ?>
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <?php if ($trust_title): ?>
                <div class="text-center mb-16">
                    <h2 class="text-3xl font-semibold"><?php echo esc_html($trust_title); ?></h2>
                </div>
            <?php endif; ?>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-y-12 gap-x-8">
                <?php while (have_rows('projects_trust_points')):
                    the_row(); ?>
                    <div class="text-center">
                        <div class="w-12 h-1 bg-primary mx-auto mb-6"></div>
                        <h3 class="text-xl font-semibold mb-3"><?php echo esc_html(get_sub_field('point_title')); ?></h3>
                        <p class="text-gray leading-relaxed max-w-sm mx-auto">
                            <?php echo esc_html(get_sub_field('point_description')); ?>
                        </p>
                    </div>
                <?php endwhile; ?>
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
            <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-lg overflow-hidden flex flex-col md:flex-row">
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
                <div class="p-8 md:p-12 md:w-1/2">
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
