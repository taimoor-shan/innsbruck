<?php
/**
 * Template part for displaying home page content.
 *
 * @package TailPress
 */

// Hero Section Fields
$hero_title = get_field('hero_title') ?: 'Innsbruck City Apartments'; // Fallback for dev
$hero_subtitle = get_field('hero_subtitle') ?: 'In the heart of the mountains and the center of Innsbruck';
$hero_video = get_field('hero_background_video') ?: '';
$featured_image = get_the_post_thumbnail_url(get_the_ID(), 'full') ?: 'https://storage.googleapis.com/download/storage/v1/b/prd-shared-services.firebasestorage.app/o/h2m-assets%2Fb4cef5120d7ca8c5d3e060b4da4044d5a07da822.jpg?generation=1770502588636374&alt=media';
?>

<?php
// Capture buttons for Hero component
ob_start();
?>
<?php get_template_part('template-parts/components/button', null, [
    'href' => home_url('/all-properties'),
    'text' => 'View Properties',
    'style' => 'primary'
]); ?>
<?php get_template_part('template-parts/components/button', null, [
    'href' => home_url('/projects'),
    'text' => 'Upcoming Projects',
    'style' => 'white-solid',
    'class' => 'border-light font-medium' // Extra styling to match previous look
]); ?>
<?php
$hero_buttons = ob_get_clean();

// Render Hero Component
get_template_part('template-parts/components/hero', null, [
    'image' => $featured_image,
    'video' => $hero_video,
    'title' => $hero_title,
    'subtitle' => $hero_subtitle,
    'height' => 'h-[80vh]',
    'content' => $hero_buttons
]);
?>

<!-- <section class="bg-white pt-20 pr-0 pb-20 pl-0">
    <div class="ml-auto mr-auto w-full pt-0 pr-4 pb-0 pl-4 container">
        <div class="text-center mb-[64px] secTitle">
            <h2 class="text-center mb-[16px] text-[36px] leading-[40px]">
                <?php echo get_field('benefits_title') ?: 'Benefits of Innsbruck City Apartments'; ?>
            </h2>
            <p class="ml-auto mr-auto text-center text-gray text-[18px] leading-[28px] max-w-2xl">
                <?php echo get_field('benefits_subtitle') ?: 'Discover our Luxury and Premium apartments'; ?>
            </p>
        </div>

        <div class="grid gap-[32px] grid-cols-1 md:grid-cols-2 lg:grid-cols-4">
            <?php
            if (have_rows('benefits_list')):
                while (have_rows('benefits_list')):
                    the_row();
                    $args = array(
                        'icon' => get_sub_field('icon'),
                        'title' => get_sub_field('title'),
                        'description' => get_sub_field('description'),
                    );
                    get_template_part('template-parts/components/card-benefit', null, $args);
                endwhile;
            else:
                // Fallback for Demo if no rows exist yet
                $demo_benefits = [
                    ['title' => 'Prime Location', 'desc' => 'Located in the city center of Innsbruck', 'icon' => 'https://storage.googleapis.com/download/storage/v1/b/prd-shared-services.firebasestorage.app/o/h2m-assets%2Ff579f8082ff20add84f3d7bf7489a737e77b858d.svg?generation=1770502588640546&alt=media'],
                    ['title' => 'Luxury Amenities', 'desc' => 'Premium furnishings and modern facilities', 'icon' => 'https://storage.googleapis.com/download/storage/v1/b/prd-shared-services.firebasestorage.app/o/h2m-assets%2F89efef4fe1312d57ce4896232a6aa8c6e827b587.svg?generation=1770502588604791&alt=media'],
                    ['title' => 'City Center', 'desc' => 'World-class skiing, dining, and attractions', 'icon' => 'https://storage.googleapis.com/download/storage/v1/b/prd-shared-services.firebasestorage.app/o/h2m-assets%2F964336d17be7fa52b0e996550bb4cdc92db132a5.svg?generation=1770502588601630&alt=media'],
                    ['title' => 'Business Travel', 'desc' => 'Perfect environment for business trips', 'icon' => 'https://storage.googleapis.com/download/storage/v1/b/prd-shared-services.firebasestorage.app/o/h2m-assets%2F3851596ebcb7a7232c991ed3bdbaee6b11f9b67f.svg?generation=1770502588650601&alt=media'],
                ];
                foreach ($demo_benefits as $benefit) {
                    get_template_part('template-parts/components/card-benefit', null, array(
                        'icon' => $benefit['icon'],
                        'title' => $benefit['title'],
                        'description' => $benefit['desc']
                    ));
                }
            endif;
            ?>
        </div>
    </div>
</section> -->

<!-- Old Benifits -->
<?php
// 4. Investor Trust Section
$trust_title = get_field('projects_trust_title');
$trust_subtitle = get_field('projects_trust_subtitle');
$trust_title_highlighted = get_field('projects_trust_title_highlighted');
$trust_image = get_field('projects_trust_image');
?>
<?php if (have_rows('projects_trust_points')): ?>
    <section class="py-20 border-t border-b">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-20 items-start">
                <!-- Left Column: Subtitle + Image -->
                <div class="lg:col-span-1  secTitle left">
                    <?php if ($trust_title || $trust_subtitle): ?>
                        <h2 class="font-semibold leading-tight mb-12">
                            <?php if ($trust_title): ?>
                                <h2><?php echo esc_html($trust_title); ?></h2>

                            <?php endif; ?>
                            <?php if ($trust_subtitle): ?>
                                <p class="">
                                    <?php echo esc_html($trust_subtitle); ?>
                                </p>
                            <?php endif; ?>
                        </h2>
                    <?php endif; ?>

                    <?php if ($trust_image): ?>
                        <div class="mt-10 hidden md:block">
                            <img src="<?php echo esc_url($trust_image); ?>" alt="<?php echo esc_attr($trust_title); ?>"
                                class="w-full max-w-md rounded-lg object-cover aspect-video">
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Right Column: Heading + Numbered Points -->
                <div class="lg:col-span-1  left">

                    <div class="space-y-0" x-data="{ active: 1 }">
                        <?php
                        $index = 1;
                        while (have_rows('projects_trust_points')):
                            the_row(); ?>
                            <div class="border-t border-gray-200 py-6">
                                <div class="flex justify-between items-start cursor-pointer group"
                                    @click="active = (active === <?php echo $index; ?> ? null : <?php echo $index; ?>)">
                                    <div class="flex gap-3">
                                        <span
                                            class="text-gray-400 font-semibold leading-snug group-hover:text-primary transition-colors"
                                            :class="{ '!text-primary': active === <?php echo $index; ?> }">
                                            <?php echo str_pad($index, 2, '0', STR_PAD_LEFT); ?>
                                        </span>
                                        <div class="flex flex-col gap-3">
                                            <h3 class="text-lg font-semibold leading-snug mb-0 transition-colors">
                                                <?php echo esc_html(get_sub_field('point_title')); ?>
                                            </h3>
                                            <p class="text text-gray leading-relaxed mb-0"
                                                x-show="active === <?php echo $index; ?>" x-collapse>
                                                <?php echo esc_html(get_sub_field('point_description')); ?>
                                            </p>
                                        </div>

                                    </div>
                                    <span class="text-gray-400 transform transition-transform duration-200"
                                        :class="{ 'rotate-180': active === <?php echo $index; ?> }">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                        </svg>
                                    </span>
                                </div>

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


<!-- Featured Properties -->
<section class="pt-20 pr-0 pb-20 pl-0 bg-gray-50">
    <div class="ml-auto mr-auto w-full pt-0 pr-4 pb-0 pl-4 container">
        <div class="flex flex-wrap justify-between  gap-10 mb-10">
            <div class="secTitle left">
                <h2 class=" mb-[16px] text-[36px] leading-[40px]">
                    <?php echo get_field('accommodations_title') ?: 'Our Properties'; ?>
                </h2>
                <!-- <p class="text-gray/90 text-[18px] leading-[28px]">
                    <?php echo get_field('accommodations_subtitle') ?: 'Choose from our Premium and Luxury apartments'; ?>
                </p> -->
            </div>
            <div class="">
                <?php get_template_part('template-parts/components/button', null, [
                    'href' => home_url('/all-properties'), // Placeholder for the all-properties page we will build
                    'text' => 'All Properties',
                    'style' => 'dark-solid',
                ]); ?>
            </div>
        </div>
        <?php
        get_template_part('template-parts/components/properties-loop', null, array(
            'featured' => true,
            'posts_per_page' => 3, // Show top 3 featured
            'columns' => 3,
            'class' => 'grid gap-8 grid-cols-1 md:grid-cols-2 lg:grid-cols-3'
        ));
        ?>


    </div>
</section>

<section class="overflow-hidden relative text-dark pt-20 pr-0 pb-20 pl-0 border-b">
    <!-- <div class="absolute left-0 top-0 right-0 bottom-0 container"
        style="background-image: linear-gradient(rgba(29, 32, 37, 0.4), rgba(29, 32, 37, 0.8), rgb(29, 32, 37));"></div> -->
    <div class="ml-auto mr-auto relative text-center w-full pt-0 pr-4 pb-0 pl-4 z-[10] max-w-3xl">
        <h2 class=" text-center pt-0 pr-2 pb-0 pl-2">
            <?php echo get_field('cta_title') ?: 'Request your luxury or premium apartment in the center of Innsbruck'; ?>
        </h2>
        <p class="ml-auto mr-auto text-center mb-[32px] text-gray text-lg max-w-2xl">
            <?php echo get_field('cta_subtitle') ?: 'Contact us today to request information about availability'; ?>
        </p>
        <div class="text-center">
            <?php get_template_part('template-parts/components/button', null, [
                'href' => home_url('/contact'),
                'text' => 'Request Booking',
                'class' => 'px-12 py-2 text-[18px]',
                'style' => 'dark-solid'
            ]); ?>
        </div>
    </div>
</section>