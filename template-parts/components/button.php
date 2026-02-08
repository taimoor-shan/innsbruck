<?php
/**
 * Component: Button
 *
 * @package TailPress
 * @param array $args Arguments for the button.
 *  - href: (string) URL for the link. If provided, renders an <a> tag. If not, renders a <button> tag.
 *  - text: (string) Button text.
 *  - style: (string) 'primary', 'outline', 'white-outline', 'ghost'. Default 'primary'.
 *  - class: (string) Additional classes.
 *  - type: (string) Button type attribute (e.g. 'submit', 'button'). Default 'button'.
 *  - attr: (string) Additional attributes (e.g. 'onclick="..."').
 */

$href = $args['href'] ?? '';
$text = $args['text'] ?? '';
$style = $args['style'] ?? 'primary';
$class = $args['class'] ?? '';
$type = $args['type'] ?? 'button';
$attr = $args['attr'] ?? '';

// Base Classes
$base_classes = 'inline-flex items-center justify-center font-medium no-underline transition-colors hover:shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none rounded-md appearance-none cursor-pointer';

// Size Classes (default is 'h-10 px-8 py-2')
$size_classes = 'h-10 px-8 py-3 text-[18px] leading-[28px]';

// Variant Styles
$styles = [
    'primary' => 'bg-primary text-white hover:bg-primary/90 hover:text-white', // Added hover:text-white to ensure transparency
    'outline' => 'bg-transparent border-2 border-primary text-primary hover:bg-primary hover:text-white',
    'white-outline' => 'bg-transparent border-2 border-white text-dark hover:bg-white/10 hover:text-dark',
    'white-solid' => 'bg-white text-dark border-2 border-white hover:bg-white/90',
    'ghost' => 'bg-transparent hover:bg-gray/10 text-dark',
    'outline-card' => 'border border-gray/20 bg-white hover:bg-accent/90 hover:text-dark text-dark', // Matches "border border-input bg-background hover:bg-accent" mapping
];

// Specific overrides for small buttons (like in cards)
if (strpos($class, 'text-xs') !== false || strpos($class, 'text-sm') !== false) {
    $size_classes = 'h-9 px-3 text-[14px] leading-[20px]';
}

$classes = $base_classes . ' ' . $size_classes . ' ' . ($styles[$style] ?? $styles['primary']) . ' ' . $class;

if ($href) {
    echo '<a href="' . esc_url($href) . '" class="' . esc_attr($classes) . '" ' . $attr . '>' . esc_html($text) . '</a>';
} else {
    echo '<button type="' . esc_attr($type) . '" class="' . esc_attr($classes) . '" ' . $attr . '>' . esc_html($text) . '</button>';
}
