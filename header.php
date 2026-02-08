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

        <?php do_action('tailpress_header'); ?>

        <nav
            class="border-b fixed left-0 top-0 right-0 backdrop-blur-xs bg-[rgba(29,_32,_37,_0.95)]/95 border-[rgba(48,_171,_232,_0.2)]/20 z-[50]">
            <div class="ml-auto mr-auto w-full p-4 container">
                <div class="items-center flex justify-between">
                    <a href="<?php echo home_url('/'); ?>" class="flex flex-col">
                        <span
                            class="block font-bold text-[rgb(48,_171,_232)] text-[24px] leading-[30px]">Innsbruck</span>
                        <span class="block font-light text-neutral-50 text-[14px] leading-[20px]">City Apartments</span>
                    </a>
                    <div class="items-center flex">
                        <a href="<?php echo home_url('/'); ?>"
                            class="block font-medium text-[rgb(48,_171,_232)] text-[14px] leading-[20px]">Home</a>
                        <a href="<?php echo home_url('/luxury'); ?>"
                            class="block font-medium ml-[32px] text-neutral-50 text-[14px] leading-[20px]">Luxury
                            Units</a>
                        <a href="<?php echo home_url('/premium'); ?>"
                            class="block font-medium ml-[32px] text-neutral-50 text-[14px] leading-[20px]">Premium
                            Units</a>
                        <a href="<?php echo home_url('/blog'); ?>"
                            class="block font-medium ml-[32px] text-neutral-50 text-[14px] leading-[20px]">Tirol
                            Region</a>
                        <a href="<?php echo home_url('/contact'); ?>"
                            class="block font-medium ml-[32px] text-neutral-50 text-[14px] leading-[20px]">Contact</a>
                        <a href="<?php echo home_url('/contact'); ?>" class="block ml-[32px]">
                            <button
                                class="items-center inline-flex font-medium justify-center text-center whitespace-nowrap h-10 bg-[rgb(48,_171,_232)] text-[14px] gap-[8px] leading-[20px] pt-2 pr-4 pb-2 pl-4 rounded-md appearance-none">Request
                                Info</button>
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        <?php do_action('tailpress_content_start'); ?>
        <main>