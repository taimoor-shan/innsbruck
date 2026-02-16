<?php
/**
 * Theme footer template.
 *
 * @package TailPress
 */
?>
</main>

<?php do_action('tailpress_content_end'); ?>
</div>

<?php do_action('tailpress_content_after'); ?>

<footer class="bg-[rgb(29,_32,_37)] text-neutral-50">
    <div class="ml-auto mr-auto w-full pt-12 pr-4 pb-12 pl-4 container">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-[32px]">
            <div>

             <?php

                    if (has_custom_logo()) {

                        the_custom_logo();
                    } else {
                        echo "<h3 class='font-bold mb-[16px] text-primary text-[20px] leading-[28px]'>" . get_bloginfo("name") . "</h3>";
                    }
                    ?>

                <p class="mb-[16px] text-[rgb(107,_114,_128)] text-[14px] leading-[20px] mt-8">We believe in providing
                    personalized service. By requesting information, we can ensure you get the perfect apartment for
                    your needs and answer any questions you may have.</p>
            </div>
            <div>
                <h4 class="font-semibold mb-[16px] text-[18px] leading-[28px]">Quick Links</h4>
                <?php
                wp_nav_menu([
                    'theme_location' => 'primary',
                    'menu_class' => '',
                    'container' => false,
                    'fallback_cb' => false,
                    'menu_type' => 'footer', // Custom arg for filter
                ]);
                ?>
            </div>
            <?php
            $contact_address = get_theme_mod('contact_address', 'Heiliggeiststrasse 2/2a/2b, 6020 Innsbruck, Austria');
            $contact_phone = get_theme_mod('contact_phone', '+43 660 478 47 12');
            $contact_whatsapp_label = get_theme_mod('contact_whatsapp_label', 'WhatsApp Preferred');
            $contact_email = get_theme_mod('contact_email', 'ibk.cityapartments@gmail.com');
            ?>
            <div>
                <h4 class="font-semibold mb-[16px] text-[18px] leading-[28px]">Contact Info</h4>
                <ul>
                    <li class="items-start flex text-left">
                        <div class="w-5 h-5 mt-[2px] text-primary shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                <circle cx="12" cy="10" r="3"></circle>
                            </svg>
                        </div>
                        <span
                            class="block text-left ml-[12px] text-[14px] leading-[20px]"><?php echo nl2br(esc_html($contact_address)); ?></span>
                    </li>
                    <li class="items-start flex text-left mt-[12px]">
                        <div class="w-5 h-5 mt-[2px] text-primary shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                            </svg>
                        </div>
                        <div class="text-left ml-[12px] text-[14px] leading-[20px]">
                            <?php if ($contact_whatsapp_label): ?>
                                <span
                                    class="block text-left text-primary text-[12px] leading-[16px]"><?php echo esc_html($contact_whatsapp_label); ?></span>
                            <?php endif; ?>
                            <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $contact_phone)); ?>" class="text-left text-inherit no-underline hover:text-primary transition-colors"><?php echo esc_html($contact_phone); ?></a>
                        </div>
                    </li>
                    <li class="items-start flex text-left mt-[12px]">
                        <div class="w-5 h-5 mt-[2px] text-primary shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                <polyline points="22,6 12,13 2,6"></polyline>
                            </svg>
                        </div>
                        <span
                            class="block text-left ml-[12px] text-[14px] leading-[20px]"><a href="mailto:<?php echo esc_attr($contact_email); ?>" class="text-inherit no-underline hover:text-primary transition-colors"><?php echo esc_html($contact_email); ?></a></span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="border-t text-center mt-[32px] border-[rgba(48,_171,_232,_0.2)]/20 pt-8 pr-0 pb-0 pl-0">
            <p class="text-center text-[rgb(107,_114,_128)] text-[14px] leading-[20px]">&copy; <?php echo date('Y'); ?>
                Delta Livings. All rights reserved.</p>
        </div>
    </div>
    </div>
</footer>
</div>

<?php wp_footer(); ?>
</body>

</html>