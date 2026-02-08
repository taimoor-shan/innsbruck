<?php
/**
 * Component: Benefit Card
 *
 * @package TailPress
 * @param array $args Arguments for the card (icon, title, description).
 */

$icon = $args['icon'] ?? '';
$title = $args['title'] ?? '';
$description = $args['description'] ?? '';
?>
<div class="border bg-white border-primary/20 shadow-sm rounded-lg h-full">
    <div class="text-center p-6">
        <?php if ($icon): ?>
            <div class="fill-none mx-auto overflow-hidden w-12 h-12 mb-4 text-primary">
                <img src="<?php echo esc_url($icon); ?>" class="block w-full h-full object-contain"
                    alt="<?php echo esc_attr($title); ?>" />
            </div>
        <?php endif; ?>

        <?php if ($title): ?>
            <h3 class="font-semibold text-center mb-2 text-xl leading-7 text-dark">
                <?php echo esc_html($title); ?>
            </h3>
        <?php endif; ?>

        <?php if ($description): ?>
            <p class="text-center text-gray text-sm leading-5">
                <?php echo esc_html($description); ?>
            </p>
        <?php endif; ?>
    </div>
</div>