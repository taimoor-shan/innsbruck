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
 *  - icon: (string) SVG or HTML string for the icon. Raw markup, not escaped.
 *  - icon_position: (string) 'left' or 'right'. Default 'left'.
 *  - icon_class: (string) Additional classes for the icon wrapper span.
 */

$href = $args['href'] ?? '';
$text = $args['text'] ?? '';
$style = $args['style'] ?? 'primary';
$class = $args['class'] ?? '';
$type = $args['type'] ?? 'button';
$attr = $args['attr'] ?? '';
$icon = $args['icon'] ?? '';
$icon_position = $args['icon_position'] ?? 'left';
$icon_class = $args['icon_class'] ?? '';

// Base Classes
$base_classes = 'inline-flex items-center justify-center gap-2 font-semibold no-underline transition-colors hover:shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none rounded-md appearance-none cursor-pointer';

// Size Classes (default is 'h-10 px-8 py-2')
$size_classes = 'py-1 px-6 py-3 text-[16px] leading-[18px]';

// Variant Styles
$styles = [
    'primary' => 'bg-primary text-white hover:bg-primary/90 hover:text-white', // Added hover:text-white to ensure transparency
    'outline' => 'bg-transparent border-1 border-primary text-primary hover:bg-primary hover:text-white',
    'white-outline' => 'bg-transparent border-1 border-white text-dark hover:bg-white/10 hover:text-dark',
    'white-solid' => 'bg-white text-dark border-1 border-white hover:bg-primary/90 hover:text-white hover:border-primary',
    'dark-outline' => 'bg-transparent border-1 border-dark text-dark hover:bg-primary hover:text-white',
    'dark-solid' => 'bg-dark text-white border-1 border-dark hover:bg-primary hover:text-white hover:border-primary',
    'ghost' => 'bg-transparent hover:bg-gray/10 text-dark',
    'outline-card' => 'border border-gray/20 bg-white hover:bg-primary/90 hover:text-dark text-dark',
];

// Specific overrides for small buttons (like in cards)
if (strpos($class, 'text-xs') !== false || strpos($class, 'text-sm') !== false) {
    $size_classes = 'h-9 px-3 text-[14px] leading-[20px]';
}

$classes = $base_classes . ' ' . $size_classes . ' ' . ($styles[$style] ?? $styles['primary']) . ' ' . $class;

// Build icon HTML
$icon_html = '';
if ($icon) {
    $icon_wrapper_class = 'inline-flex items-center shrink-0' . ($icon_class ? ' ' . $icon_class : '');
    $icon_html = '<span class="' . esc_attr($icon_wrapper_class) . '">' . $icon . '</span>';
}

// Build inner content (icon + text)
$content = '';
if ($icon && $icon_position === 'left') {
    $content = $icon_html . esc_html($text);
} elseif ($icon && $icon_position === 'right') {
    $content = esc_html($text) . $icon_html;
} else {
    $content = esc_html($text);
}

if ($href) {
    echo '<a href="' . esc_url($href) . '" class="' . esc_attr($classes) . '" ' . $attr . '>' . $content . '</a>';
} else {
    echo '<button type="' . esc_attr($type) . '" class="' . esc_attr($classes) . '" ' . $attr . '>' . $content . '</button>';
}
