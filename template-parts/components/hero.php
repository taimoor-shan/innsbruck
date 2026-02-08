<?php
/**
 * Component: Hero
 *
 * @package TailPress
 * @param array $args Arguments for the hero section.
 *  - image: (string) URL for the background image.
 *  - title: (string) Main title text.
 *  - subtitle: (string) Subtitle text.
 *  - height: (string) CSS class for height. Default 'h-[50vh]'.
 *  - content: (string) HTML content to display below subtitle (e.g. buttons).
 */

$image = $args['image'] ?? '';
$title = $args['title'] ?? '';
$subtitle = $args['subtitle'] ?? '';
$height_class = $args['height'] ?? 'h-[50vh]';
$content = $args['content'] ?? '';
?>

<section class="items-center flex <?php echo esc_attr($height_class); ?> justify-center overflow-hidden relative">
    <div class="bg-center bg-cover absolute left-0 top-0 right-0 bottom-0"
        style="background-image: url('<?php echo esc_url($image); ?>');">
        <div class="absolute left-0 top-0 right-0 bottom-0"
            style="background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.6));">
        </div>
    </div>
    <div class=" mt-20 ml-auto mr-auto relative text-center max-w-4xl pt-0 pr-4 pb-0 pl-4 z-[10]">
        <h1 class="text-center mb-[24px] text-light text-[48px] leading-[56px] lg:text-[72px] lg:leading-[72px]">
            <?php echo wp_kses_post($title); ?>
        </h1>
        <?php if ($subtitle): ?>
            <div
                class="font-light text-center mb-[32px] text-light/90 text-[20px] leading-[28px] lg:text-[24px] lg:leading-[32px] max-w-2xl mx-auto">
                <?php echo wp_kses_post($subtitle); ?>
            </div>
        <?php endif; ?>

        <?php if ($content): ?>
            <div class="flex flex-col sm:flex-row gap-3 md:gap-4 justify-center px-4">
                <?php echo $content; ?>
            </div>
        <?php endif; ?>
    </div>
</section>