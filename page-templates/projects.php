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
            'terms' => ['completed', 'sold'],
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
                                    <span class="bg-accent text-dark text-xs font-semibold px-3 py-1 rounded shrink-0">Completed:
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
                            <?php
                            $document_url = get_field('project_document');
                            if ($document_url):
                                ?>

                                <?php get_template_part('template-parts/components/button', null, [
                                    'href' => $document_url,
                                    'text' => 'Investment Document',
                                    'style' => 'dark-solid',
                                    'class' => 'mt-6 text-sm',
                                    'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7.792 21.25h8.416a3.5 3.5 0 0 0 3.5-3.5v-5.53a3.5 3.5 0 0 0-1.024-2.475l-5.969-5.97A3.5 3.5 0 0 0 10.24 2.75H7.792a3.5 3.5 0 0 0-3.5 3.5v11.5a3.5 3.5 0 0 0 3.5 3.5"/><path fill="currentColor" fill-rule="evenodd" d="M10.437 7.141c-.239.078-.392.236-.436.411c-.09.352 0 .73.253 1.203c.126.234.28.471.45.725l.092.137l.145.215l.019-.068l.086-.306q.148-.503.23-1.02c.089-.642-.011-1.018-.309-1.26c-.08-.065-.278-.119-.53-.037m.055 4.152l-.27-.362l-.032-.048c-.115-.19-.243-.38-.382-.585l-.1-.149a10 10 0 0 1-.512-.828c-.31-.578-.558-1.286-.358-2.067c.17-.664.698-1.081 1.227-1.254c.517-.168 1.174-.147 1.66.247c.792.644.848 1.573.739 2.357a9 9 0 0 1-.261 1.174l-.096.34q-.112.382-.208.769l-.067.194l1.392 1.864c.65-.078 1.364-.125 2.03-.077c.769.054 1.595.242 2.158.776a1.56 1.56 0 0 1 .395 1.441c-.117.48-.454.88-.919 1.123c-.985.515-1.902.105-2.583-.416c-.533-.407-1.045-.975-1.476-1.453l-.104-.114c-.37.057-.72.121-1.004.175c-.305.057-.684.128-1.096.22l-.151.443q-.125.288-.238.58l-.122.303a8 8 0 0 1-.427.91c-.33.578-.857 1.192-1.741 1.241c-1.184.066-1.986-.985-1.756-2.108l.006-.027c.2-.791.894-1.31 1.565-1.653c.597-.306 1.294-.532 1.941-.701zm.87 1.165l-.287.843l.421-.08l.004-.001l.38-.07zm2.84 1.604c.274.29.547.56.831.777c.55.42.94.493 1.299.305c.2-.105.284-.241.309-.342a.35.35 0 0 0-.08-.309c-.257-.228-.722-.38-1.392-.428a8 8 0 0 0-.967-.003m-5.005.947c-.318.109-.62.23-.89.368c-.587.3-.87.604-.944.867c-.078.415.192.673.516.655c.27-.015.506-.184.766-.639q.204-.372.358-.767l.107-.266z" clip-rule="evenodd"/></g></svg>',
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
                                        class="bg-accent text-dark text-xs font-semibold px-2 py-1 rounded shrink-0"><?php echo esc_html($stage_name); ?></span>
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
                                    'href' => $document_url,
                                    'text' => 'Investment Document',
                                    'style' => 'dark-solid',
                                    'class' => 'mt-6 text-sm',
                                    'icon' => '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>',
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

<?php
get_footer();
