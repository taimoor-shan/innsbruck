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

?>

<section class="items-center flex h-screen justify-center overflow-hidden relative">
    <div class="bg-center bg-cover absolute left-0 top-0 right-0 bottom-0"
        style="background-image: url('<?php echo esc_url($hero_bg_url); ?>');">
        <div class="absolute left-0 top-0 right-0 bottom-0"
            style="background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.6));">
        </div>
    </div>
    <div class="ml-auto mr-auto relative text-center max-w-4xl pt-0 pr-4 pb-0 pl-4 z-[10]">
        <h1 class="font-bold text-center mb-[24px] text-neutral-50 text-[72px] leading-[72px]">
            <?php echo wp_kses_post($hero_title); ?>
        </h1>
        <p class="font-light text-center mb-[32px] text-neutral-50/90 text-[24px] leading-[32px] pt-0 pr-2 pb-0 pl-2">
            <?php echo esc_html($hero_subtitle); ?>
        </p>
        <div class="flex justify-center text-center gap-[16px] pt-0 pr-4 pb-0 pl-4">
            <a href="<?php echo home_url('/luxury'); ?>" class="block text-center">
                <button
                    class="items-center inline-flex font-medium justify-center text-center whitespace-nowrap h-10 bg-[rgb(48,_171,_232)] text-[18px] gap-[8px] leading-[28px] pt-2 pr-8 pb-2 pl-8 rounded-md appearance-none text-white">Explore
                    Luxury Units</button>
            </a>
            <a href="<?php echo home_url('/premium'); ?>" class="block text-center">
                <button
                    class="items-center inline-flex font-medium justify-center text-center whitespace-nowrap h-10 bg-white border-neutral-50 border-[2px] text-black text-[18px] gap-[8px] leading-[28px] pt-2 pr-8 pb-2 pl-8 rounded-md appearance-none">View
                    Premium Units</button>
            </a>
        </div>
    </div>
</section>

<section class="bg-white pt-20 pr-0 pb-20 pl-0">
    <div class="ml-auto mr-auto w-full pt-0 pr-4 pb-0 pl-4">
        <div class="text-center mb-[64px]">
            <h2 class="font-bold text-center mb-[16px] text-[36px] leading-[40px]">
                <?php echo get_field('benefits_title') ?: 'Benefits of Innsbruck City Apartments'; ?>
            </h2>
            <p class="ml-auto mr-auto text-center text-[rgb(107,_114,_128)] text-[18px] leading-[28px] max-w-2xl">
                <?php echo get_field('benefits_subtitle') ?: 'Discover our Luxury and Premium apartments'; ?>
            </p>
        </div>
        <div class="grid gap-[32px]" style="grid-template-columns: repeat(4, minmax(0px, 1fr));">
            <!-- Benefit 1 -->
            <div
                class="border bg-white border-[rgba(48,_171,_232,_0.2)]/20 shadow-[rgba(0,0,0,0)_0px_0px_0px_0px,_rgba(0,0,0,0)_0px_0px_0px_0px,_rgba(0,0,0,0.05)_0px_1px_2px_0px] rounded-lg">
                <div class="text-center p-6">
                    <div
                        class="fill-none ml-auto mr-auto overflow-hidden text-center align-middle w-12 h-12 mb-[16px] text-[rgb(48,_171,_232)]">
                        <img src="https://storage.googleapis.com/download/storage/v1/b/prd-shared-services.firebasestorage.app/o/h2m-assets%2Ff579f8082ff20add84f3d7bf7489a737e77b858d.svg?generation=1770502588640546&amp;alt=media"
                            class="block size-full" />
                    </div>
                    <h3 class="font-semibold text-center mb-[8px] text-[20px] leading-[28px]">Prime Location</h3>
                    <p class="text-center text-[rgb(107,_114,_128)] text-[14px] leading-[20px]">Located in the city
                        center of Innsbruck, walking distance from all attractions</p>
                </div>
            </div>
            <!-- Benefit 2 -->
            <div
                class="border bg-white border-[rgba(48,_171,_232,_0.2)]/20 shadow-[rgba(0,0,0,0)_0px_0px_0px_0px,_rgba(0,0,0,0)_0px_0px_0px_0px,_rgba(0,0,0,0.05)_0px_1px_2px_0px] rounded-lg">
                <div class="text-center p-6">
                    <div
                        class="fill-none ml-auto mr-auto overflow-hidden text-center align-middle w-12 h-12 mb-[16px] text-[rgb(48,_171,_232)]">
                        <img src="https://storage.googleapis.com/download/storage/v1/b/prd-shared-services.firebasestorage.app/o/h2m-assets%2F89efef4fe1312d57ce4896232a6aa8c6e827b587.svg?generation=1770502588604791&amp;alt=media"
                            class="block size-full" />
                    </div>
                    <h3 class="font-semibold text-center mb-[8px] text-[20px] leading-[28px]">Luxury Amenities</h3>
                    <p class="text-center text-[rgb(107,_114,_128)] text-[14px] leading-[20px]">Premium furnishings and
                        modern facilities designed for ultimate comfort</p>
                </div>
            </div>
            <!-- Benefit 3 -->
            <div
                class="border bg-white border-[rgba(48,_171,_232,_0.2)]/20 shadow-[rgba(0,0,0,0)_0px_0px_0px_0px,_rgba(0,0,0,0)_0px_0px_0px_0px,_rgba(0,0,0,0.05)_0px_1px_2px_0px] rounded-lg">
                <div class="text-center p-6">
                    <div
                        class="fill-none ml-auto mr-auto overflow-hidden text-center align-middle w-12 h-12 mb-[16px] text-[rgb(48,_171,_232)]">
                        <img src="https://storage.googleapis.com/download/storage/v1/b/prd-shared-services.firebasestorage.app/o/h2m-assets%2F964336d17be7fa52b0e996550bb4cdc92db132a5.svg?generation=1770502588601630&amp;alt=media"
                            class="block size-full" />
                    </div>
                    <h3 class="font-semibold text-center mb-[8px] text-[20px] leading-[28px]">City Center</h3>
                    <p class="text-center text-[rgb(107,_114,_128)] text-[14px] leading-[20px]">World-class skiing,
                        dining, and cultural attractions</p>
                </div>
            </div>
            <!-- Benefit 4 -->
            <div
                class="border bg-white border-[rgba(48,_171,_232,_0.2)]/20 shadow-[rgba(0,0,0,0)_0px_0px_0px_0px,_rgba(0,0,0,0)_0px_0px_0px_0px,_rgba(0,0,0,0.05)_0px_1px_2px_0px] rounded-lg">
                <div class="text-center p-6">
                    <div
                        class="fill-none ml-auto mr-auto overflow-hidden text-center align-middle w-12 h-12 mb-[16px] text-[rgb(48,_171,_232)]">
                        <img src="https://storage.googleapis.com/download/storage/v1/b/prd-shared-services.firebasestorage.app/o/h2m-assets%2F3851596ebcb7a7232c991ed3bdbaee6b11f9b67f.svg?generation=1770502588650601&amp;alt=media"
                            class="block size-full" />
                    </div>
                    <h3 class="font-semibold text-center mb-[8px] text-[20px] leading-[28px]">Business Travel</h3>
                    <p class="text-center text-[rgb(107,_114,_128)] text-[14px] leading-[20px]">Perfect environment for
                        business trips with high- speed internet and dedicated workspace</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="bg-white pt-20 pr-0 pb-20 pl-0">
    <div class="ml-auto mr-auto w-full pt-0 pr-4 pb-0 pl-4">
        <div class="text-center mb-[64px]">
            <h2 class="font-bold text-center mb-[16px] text-[36px] leading-[40px]">
                <?php echo get_field('accommodations_title') ?: 'Our Accommodations'; ?>
            </h2>
            <p class="text-center text-[rgb(107,_114,_128)] text-[18px] leading-[28px]">
                <?php echo get_field('accommodations_subtitle') ?: 'Choose from our Premium and Luxury apartments'; ?>
            </p>
        </div>
        <div class="grid gap-[32px]" style="grid-template-columns: repeat(2, minmax(0px, 1fr));">
            <?php
            $args = array(
                'post_type' => 'accommodation',
                'posts_per_page' => 4,
            );
            $query = new WP_Query($args);

            if ($query->have_posts()):
                while ($query->have_posts()):
                    $query->the_post();
                    $bg_image = get_the_post_thumbnail_url() ?: 'https://storage.googleapis.com/download/storage/v1/b/prd-shared-services.firebasestorage.app/o/h2m-assets%2F9ed7d824b867c563836fa0e11722551307a341e2.jpg?generation=1770502588609302&amp;alt=media'; // Fallback
                    ?>
                    <div
                        class="border overflow-hidden bg-white border-gray-200 shadow-[rgba(0,0,0,0)_0px_0px_0px_0px,_rgba(0,0,0,0)_0px_0px_0px_0px,_rgba(0,0,0,0.05)_0px_1px_2px_0px] rounded-lg">
                        <div class="overflow-hidden relative h-80">
                            <img alt="<?php the_title_attribute(); ?>" src="<?php echo esc_url($bg_image); ?>"
                                class="block size-full max-w-full object-cover overflow-clip align-middle" />
                            <div class="absolute left-0 top-0 right-0 bottom-0"
                                style="background-image: linear-gradient(to top, rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0));"></div>
                            <div class="absolute left-0 right-0 bottom-0 text-neutral-50 p-6">
                                <h3 class="font-bold mb-[8px] text-[30px] leading-[36px]">
                                    <?php the_title(); ?>
                                </h3>
                                <p class="mb-[16px] text-neutral-50/90">
                                    <?php echo get_the_excerpt(); ?>
                                </p>
                                <a href="<?php the_permalink(); ?>">
                                    <button
                                        class="items-center inline-flex font-medium justify-center text-center whitespace-nowrap h-9 bg-[rgb(48,_171,_232)] text-[rgb(29,_32,_37)] text-[14px] gap-[8px] leading-[20px] pt-0 pr-3 pb-0 pl-3 rounded-md appearance-none">View
                                        Details</button>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php
                endwhile;
                wp_reset_postdata();
            else:
                ?>
                <!-- Fallback content if no accommodations found (preserving React look for demo) -->
                <div class="col-span-2 text-center text-gray-500">
                    <p>No accommodations found. Please add accommodations in the dashboard.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<section class="overflow-hidden relative bg-[rgb(29,_32,_37)] text-neutral-50 pt-20 pr-0 pb-20 pl-0">
    <div class="absolute left-0 top-0 right-0 bottom-0"
        style="background-image: linear-gradient(rgba(29, 32, 37, 0.4), rgba(29, 32, 37, 0.8), rgb(29, 32, 37));"></div>
    <div class="ml-auto mr-auto relative text-center w-full pt-0 pr-4 pb-0 pl-4 z-[10]">
        <h2 class="font-bold text-center mb-[24px] text-[36px] leading-[40px] pt-0 pr-2 pb-0 pl-2">
            <?php echo get_field('cta_title') ?: 'Request your luxury or premium apartment in the center of Innsbruck'; ?>
        </h2>
        <p class="ml-auto mr-auto text-center mb-[32px] text-neutral-50/90 text-[20px] leading-[28px] max-w-2xl">
            <?php echo get_field('cta_subtitle') ?: 'Contact us today to request information about availability'; ?>
        </p>
        <div class="text-center">
            <a href="<?php echo home_url('/contact'); ?>" class="text-center">
                <button
                    class="items-center inline-flex font-medium justify-center text-center whitespace-nowrap h-10 bg-[rgb(48,_171,_232)] text-[rgb(29,_32,_37)] text-[18px] gap-[8px] leading-[28px] pt-2 pr-12 pb-2 pl-12 rounded-md appearance-none">Request
                    Booking</button>
            </a>
        </div>
    </div>
</section>