<?php
/**
 * Theme header template.
 *
 * @package TailPress
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <?php wp_head(); ?>
</head>

<body <?php body_class('bg-white text-zinc-900 antialiased'); ?>>
    <?php do_action('tailpress_site_before'); ?>

    <div id="page" class="min-h-screen flex flex-col">
        <?php do_action('tailpress_header'); ?>

        <nav class=" fixed left-0 top-0 right-0 bg-[rgb(29,_32,_37)] z-[50]">
            <div class="ml-auto mr-auto w-full p-4 container">
                <div x-data="{ open: false }" class="items-center flex justify-between w-full">
                    <!-- <a href="<?php echo home_url('/'); ?>" class="flex flex-col">
                        <span
                            class="block font-bold text-primary text-[24px] leading-[30px]">Innsbruck</span>
                        <span class="block font-light text-neutral-50 text-[14px] leading-[20px]">City Apartments</span>
                    </a> -->
                    <?php

                    if (has_custom_logo()) {

                        the_custom_logo();
                    } else {
                        echo "<h3>" . get_bloginfo("name") . "</h3>";
                    }
                    ?>

                    <!-- Mobile Menu Button -->
                    <button @click="open = ! open" class="md:hidden text-white p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                    </button>

                    <!-- Desktop Menu -->
                    <div class="hidden md:flex items-center">
                        <?php
                        wp_nav_menu([
                            'theme_location' => 'primary',
                            'menu_class' => 'items-center flex',
                            'container' => false,
                            'fallback_cb' => false,
                            'menu_type' => 'header', // Custom arg for filter
                        ]);
                        ?>
                        <?php get_template_part('template-parts/components/button', null, [
                            'href' => home_url('/contact'), // Placeholder for the all-properties page we will build
                            'text' => 'Request Info',
                            'style' => 'white-solid',
                            'class' => 'ml-[32px] text-sm border-primary text-primary',
                        ]); ?>
                    </div>

                    <!-- Mobile Menu Dropdown -->
                    <div x-show="open" x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 -translate-y-2"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 -translate-y-2" @click.away="open = false"
                        class="absolute top-full left-0 w-full bg-[#1d2025] border-t border-[rgba(48,171,232,0.2)] p-4 shadow-lg md:hidden flex flex-col gap-4">
                        <?php
                        wp_nav_menu([
                            'theme_location' => 'primary',
                            'menu_class' => 'flex flex-col gap-4',
                            'container' => false,
                            'fallback_cb' => false,
                            'menu_type' => 'mobile', // Use specific mobile type
                        ]);
                        ?>
                        <?php get_template_part('template-parts/components/button', null, [
                            'href' => home_url('/contact'), // Placeholder for the all-properties page we will build
                            'text' => 'Request Info',
                            'style' => 'white-solid',
                            'class' => 'w-full d-block',
                        ]); ?>
                    </div>
                </div>
            </div>
        </nav>

        <?php do_action('tailpress_content_start'); ?>
        <main>