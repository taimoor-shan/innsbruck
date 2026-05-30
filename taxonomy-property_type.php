<?php
/**
 * Property Type Archive template.
 *
 * Displays properties filtered by property_type taxonomy term.
 * Layout matches all-properties.php for consistency.
 *
 * @package TailPress
 */

get_header();

$term = get_queried_object();
$hero_bg = get_field('hero_image', $term) ?: 'https://storage.googleapis.com/download/storage/v1/b/prd-shared-services.firebasestorage.app/o/h2m-assets%2Fb4cef5120d7ca8c5d3e060b4da4044d5a07da822.jpg?generation=1770502588636374&alt=media';
$current_slug = $term->slug;
$current_name = $term->name;
$extra_desc = get_field('full_description', $term);
$property_types = get_terms(['taxonomy' => 'property_type', 'hide_empty' => true]);
?>

<!-- Hero Section -->
<?php 
if(false):
get_template_part('template-parts/components/hero', null, [
    'image' => $hero_bg,
    'title' => single_term_title('', false),
    'subtitle' => term_description(),
    'height' => 'h-[50vh]'
]); 

endif;?>

<section class="bg-white py-10 md:pb-20 pt-10 mt-24">
    <div class="container mx-auto px-4">
<h1 class="text-2xl lg:text-4xl mb-8"><?php echo single_term_title('', false);?> Units</h1>
        <!-- Filter Bar -->
        <!-- <div class="mb-12 flex flex-wrap gap-6 justify-between">

           
            <?php //if (!empty($property_types) && !is_wp_error($property_types)): ?>
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="<?php //echo esc_url(home_url('/all-properties')); ?>"
                        class="inline-flex items-center justify-center font-medium no-underline transition-colors hover:shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none rounded-md appearance-none cursor-pointer h-9 px-3 text-[14px] leading-[20px] border border-gray/20 bg-white hover:bg-accent/90 hover:text-dark text-dark">
                        All Types
                    </a>
                    <?php //foreach ($property_types as $type_term): ?>
                        <a href="<?php //echo esc_url(get_term_link($type_term)); ?>"
                            class="inline-flex items-center justify-center font-medium no-underline transition-colors hover:shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none rounded-md appearance-none cursor-pointer h-9 px-3 text-[14px] leading-[20px] <?php echo $type_term->slug === $current_slug ? 'bg-primary text-white hover:bg-primary/90 hover:text-white' : 'border border-gray/20 bg-white hover:bg-accent/90 hover:text-dark text-dark'; ?>">
                            <?php //echo esc_html($type_term->name); ?>
                        </a>
                    <?php //endforeach; ?>
                </div>
            <?php //endif; ?>

        </div> -->

        <!-- Optional: Extended Description from ACF -->
        <?php if ($extra_desc): ?>
            <div class="max-w-3xl mx-auto text-center mb-12 text-lg text-gray">
                <?php echo wp_kses_post($extra_desc); ?>
            </div>
        <?php endif; ?>

        <!-- Properties Grid -->
        <div class="min-h-[400px]">
            <?php
            global $wp_query;
            get_template_part('template-parts/components/properties-loop', null, [
                'query' => $wp_query,
                'show_pagination' => true,
                'columns' => 3,
                'class' => 'grid gap-8 grid-cols-1 md:grid-cols-2 lg:grid-cols-3'
            ]);
            ?>
        </div>

    </div>
</section>

<?php
get_footer();
