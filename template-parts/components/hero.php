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
$title = $args['title'] ?? '';
// $subtitle = $args['subtitle'] ?? '';
$height_class = $args['height'] ?? 'h-[50vh]';
$width_class = $args['width'] ?? 'max-w-5xl';

// Determine video mime type from extension
$video_type = '';
if ($video) {
    $ext = strtolower(pathinfo(parse_url($video, PHP_URL_PATH), PATHINFO_EXTENSION));
    $video_type = ($ext === 'webm') ? 'video/webm' : 'video/mp4';
}
?>

<section class="items-center flex <?php echo esc_attr($height_class); ?> justify-center overflow-hidden relative">
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
    <div class="absolute inset-0"
        style="background-image: linear-gradient(to bottom, rgba(0, 0, 0, 0.8) 0%, rgba(0, 0, 0, 0.3) 50%, rgba(0, 0, 0, 0.7) 100%);">
    </div>
    <div class="hero-content mt-20 ml-auto mr-auto relative text-center pt-0 pr-4 pb-0 pl-4 z-[10] text-light">
        <h1 class="text-center <?php echo esc_attr($width_class); ?>">
            <?php echo esc_html($title); ?>
        </h1>
    </div>
</section>

<style>
    .hero-content h1 {
        font-size: min(max(34px, 10vw), 60px);
        line-height: 1.1;
    }

    @media (min-width: 1199px) {
        .hero-content p {
            font-size: 20px;
            line-height: 28px;
        }
    }
</style>