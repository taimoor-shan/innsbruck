<?php
/**
 * Template part for displaying home page content.
 *
 * @package TailPress
 */

// Hero Section Fields
$hero_title = get_field('hero_title') ?: 'Innsbruck City Apartments'; // Fallback for dev
$hero_subtitle = get_field('hero_subtitle') ?: 'In the heart of the mountains and the center of Innsbruck';
$hero_bg_url = get_field('hero_background_image') ?: 'https://storage.googleapis.com/download/storage/v1/b/prd-shared-services.firebasestorage.app/o/h2m-assets%2Fb4cef5120d7ca8c5d3e060b4da4044d5a07da822.jpg?generation=1770502588636374&alt=media';
$featured_image = get_the_post_thumbnail_url(get_the_ID(), 'full') ?: $hero_bg_url;
?>

<section class="items-center flex h-screen justify-center overflow-hidden relative">
    <div class="bg-center bg-cover absolute left-0 top-0 right-0 bottom-0"
        style="background-image: url('<?php echo esc_url($featured_image); ?>');">
        <div class="absolute left-0 top-0 right-0 bottom-0"
            style="background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.6));">
        </div>
    </div>
    <div class="ml-auto mr-auto relative text-center max-w-4xl pt-0 pr-4 pb-0 pl-4 z-[10]">
        <h1 class="font-bold text-center mb-[24px] text-light text-[72px] leading-[72px]">
            <?php echo wp_kses_post($hero_title); ?>
        </h1>
        <p class="font-light text-center mb-[32px] text-light/90 text-[24px] leading-[32px] pt-0 pr-2 pb-0 pl-2">
            <?php echo esc_html($hero_subtitle); ?>
        </p>
        <div class="flex justify-center text-center gap-[16px] pt-0 pr-4 pb-0 pl-4">
            <?php get_template_part('template-parts/components/button', null, [
                'href' => home_url('/luxury'),
                'text' => 'Explore Luxury Units',
                'style' => 'primary'
            ]); ?>
            <?php get_template_part('template-parts/components/button', null, [
                'href' => home_url('/premium'),
                'text' => 'View Premium Units',
                'style' => 'white-solid',
                'class' => 'border-light font-medium' // Extra styling to match previous look
            ]); ?>
        </div>
    </div>
</section>

<section class="bg-white pt-20 pr-0 pb-20 pl-0">
    <div class="ml-auto mr-auto w-full pt-0 pr-4 pb-0 pl-4 container">
        <div class="text-center mb-[64px]">
            <h2 class="font-bold text-center mb-[16px] text-[36px] leading-[40px]">
                <?php echo get_field('benefits_title') ?: 'Benefits of Innsbruck City Apartments'; ?></h2>
            <p class="ml-auto mr-auto text-center text-gray text-[18px] leading-[28px] max-w-2xl">
                <?php echo get_field('benefits_subtitle') ?: 'Discover our Luxury and Premium apartments'; ?></p>
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
</section>

<section class="bg-white pt-20 pr-0 pb-20 pl-0">
    <div class="ml-auto mr-auto w-full pt-0 pr-4 pb-0 pl-4 container">
        <div class="text-center mb-[64px]">
            <h2 class="font-bold text-center mb-[16px] text-[36px] leading-[40px]">
                <?php echo get_field('accommodations_title') ?: 'Our Accommodations'; ?></h2>
            <p class="text-center text-gray text-[18px] leading-[28px]">
                <?php echo get_field('accommodations_subtitle') ?: 'Choose from our Premium and Luxury apartments'; ?>
            </p>
        </div>
        <div class="grid gap-[32px] grid-cols-1 md:grid-cols-2">
            <?php
            $terms = get_terms(array(
                'taxonomy' => 'unit_type',
                'hide_empty' => false,
            ));

            if (!empty($terms) && !is_wp_error($terms)):
                foreach ($terms as $term):
                    $image = get_field('card_image', $term);
                    $bg_image = $image ? $image : 'https://storage.googleapis.com/download/storage/v1/b/prd-shared-services.firebasestorage.app/o/h2m-assets%2F9ed7d824b867c563836fa0e11722551307a341e2.jpg?generation=1770502588609302&amp;alt=media';
                    $term_link = get_term_link($term);
                    ?>
                    <div
                        class="border overflow-hidden bg-white border-primary/20 shadow-sm rounded-lg group hover:shadow-lg transition-shadow duration-300">
                        <div class="overflow-hidden relative h-80">
                            <img alt="<?php echo esc_attr($term->name); ?>" src="<?php echo esc_url($bg_image); ?>"
                                class="block size-full max-w-full object-cover overflow-clip align-middle transition-transform duration-500 group-hover:scale-105" />
                            <div class="absolute left-0 top-0 right-0 bottom-0"
                                style="background-image: linear-gradient(to top, rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0));"></div>
                            <div class="absolute left-0 right-0 bottom-0 text-light p-6">
                                <h3 class="font-bold mb-[8px] text-[30px] leading-[36px]"><?php echo esc_html($term->name); ?>
                                </h3>
                                <p class="mb-[16px] text-light/90"><?php echo esc_html($term->description); ?></p>
                                <?php get_template_part('template-parts/components/button', null, [
                                    'href' => esc_url($term_link),
                                    'text' => 'View Units',
                                    'style' => 'primary',
                                    'class' => 'text-dark text-[14px] h-9 px-3 py-0'
                                ]); ?>
                            </div>
                        </div>
                    </div>
                    <?php
                endforeach;
            else:
                ?>
                <div class="col-span-2 text-center text-gray">
                    <p>No unit types found. Please add "Luxury" and "Premium" in Accommodations > Unit Types.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<section class="overflow-hidden relative bg-dark text-light pt-20 pr-0 pb-20 pl-0">
    <div class="absolute left-0 top-0 right-0 bottom-0 container"
        style="background-image: linear-gradient(rgba(29, 32, 37, 0.4), rgba(29, 32, 37, 0.8), rgb(29, 32, 37));"></div>
    <div class="ml-auto mr-auto relative text-center w-full pt-0 pr-4 pb-0 pl-4 z-[10]">
        <h2 class="font-bold text-center mb-[24px] text-[36px] leading-[40px] pt-0 pr-2 pb-0 pl-2">
            <?php echo get_field('cta_title') ?: 'Request your luxury or premium apartment in the center of Innsbruck'; ?>
        </h2>
        <p class="ml-auto mr-auto text-center mb-[32px] text-light/90 text-[20px] leading-[28px] max-w-2xl">
            <?php echo get_field('cta_subtitle') ?: 'Contact us today to request information about availability'; ?>
        </p>
        <div class="text-center">
            <?php get_template_part('template-parts/components/button', null, [
                'href' => home_url('/contact'),
                'text' => 'Request Booking',
                'class' => 'px-12 py-2 text-[18px]',
                'style' => 'primary'
            ]); ?>
        </div>
    </div>
</section>