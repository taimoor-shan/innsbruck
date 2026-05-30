<?php

/**
 * Component: Hero
 *
 * @package TailPress
 * @param array $args Arguments for the hero section.
 *  - image: (string) URL for the background image (fallback/poster).
 *  - video: (string) Optional. URL for the background video (mp4/webm).
 *  - title: (string) Main title text.
 *  - subtitle: (string) Subtitle text.
 *  - height: (string) CSS class for height. Default 'h-[50vh]'.
 *  - content: (string) HTML content to display below subtitle (e.g. buttons).
 */

$image = $args['image'] ?? '';
$video = $args['video'] ?? '';
$content = $args['content'] ?? '';
$buttons = $args['buttons'] ?? '';
$height_class = $args['height'] ?? 'h-[50vh]';
$width_class = $args['width'] ?? 'max-w-[40rem]';
$title = $args['title'] ?? '';




// Determine video mime type from extension
$video_type = '';
if ($video) {
    $ext = strtolower(pathinfo(parse_url($video, PHP_URL_PATH), PATHINFO_EXTENSION));
    $video_type = ($ext === 'webm') ? 'video/webm' : 'video/mp4';
}
?>

<section class="items-center flex <?php echo esc_attr($height_class); ?> justify-start overflow-hidden relative mt-20">
    <!-- Background image (always present as fallback / visible while video loads) -->
    <div class="bg-center bg-cover absolute inset-0" style="background-image: url('<?php echo esc_url($image); ?>');">
    </div>

    <?php if ($video): ?>
        <!-- Background video -->
        <video class="absolute inset-0 w-full h-full object-cover" autoplay muted loop playsinline preload="auto"
            poster="<?php echo esc_url($image); ?>">
            <source src="<?php echo esc_url($video); ?>" type="<?php echo esc_attr($video_type); ?>">
        </video>
    <?php endif; ?>

    <!-- Gradient overlay -->
    <div class="absolute inset-y-0 left-0 w-[42rem]
    bg-gradient-to-r from-black/55 via-black/20 to-transparent md:hidden block">
</div>
    <div class="hero-content relative z-[10] text-light container mx-auto px-4">
        <div class="<?php echo esc_attr($width_class); ?>">

            <?php if ($content): ?>
                <?php echo $content; ?>
            <?php endif; ?>
            <?php if ($title): ?>
                <h1 class="text-primary">
                    <?php echo $title; ?> Units

                </h1>
            <?php endif; ?>

            <?php if ($buttons): ?>
                <div class="mt-6 flex flex-wrap gap-3 md:gap-4">
                    <?php echo wp_kses_post($buttons); ?>
                </div>
            <?php endif; ?>

        </div>

    </div>
</section>

<style>
    .hero-content h1 {
        font-size: min(max(34px, 10vw), 60px);
        line-height: 1;
    }

    @media (min-width: 1199px) {
        .hero-content p {
            font-size: 20px;
            line-height: 28px;
        }
    }
</style>