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
    <div class="ml-auto mr-auto w-full pt-12 pr-4 pb-12 pl-4">
        <div class="grid gap-[32px]" style="grid-template-columns: repeat(3, minmax(0px, 1fr));">
            <div>
                <h3 class="font-bold mb-[16px] text-[rgb(48,_171,_232)] text-[20px] leading-[28px]">Innsbruck City
                    Apartments</h3>
                <p class="mb-[16px] text-[rgb(107,_114,_128)] text-[14px] leading-[20px]">We believe in providing
                    personalized service. By requesting information, we can ensure you get the perfect apartment for
                    your needs and answer any questions you may have.</p>
            </div>
            <div>
                <h4 class="font-semibold mb-[16px] text-[18px] leading-[28px]">Quick Links</h4>
                <ul>
                    <li class="list-none text-left">
                        <a href="<?php echo home_url('/luxury'); ?>" class="text-left text-[14px] leading-[20px]">Luxury
                            Units</a>
                    </li>
                    <li class="list-none text-left mt-[8px]">
                        <a href="<?php echo home_url('/premium'); ?>"
                            class="text-left text-[14px] leading-[20px]">Premium Units</a>
                    </li>
                    <li class="list-none text-left mt-[8px]">
                        <a href="<?php echo home_url('/blog'); ?>" class="text-left text-[14px] leading-[20px]">Tirol
                            Region</a>
                    </li>
                    <li class="list-none text-left mt-[8px]">
                        <a href="<?php echo home_url('/contact'); ?>"
                            class="text-left text-[14px] leading-[20px]">Contact Us</a>
                    </li>
                </ul>
            </div>
            <div>
                <h4 class="font-semibold mb-[16px] text-[18px] leading-[28px]">Contact Info</h4>
                <ul>
                    <li class="items-start flex text-left">
                        <div
                            class="fill-none overflow-hidden text-left align-middle w-5 h-5 mt-[2px] text-[rgb(48,_171,_232)] shrink-[0]">
                            <!-- Note: Using external URL for fidelity since local asset is missing. -->
                            <img src="https://storage.googleapis.com/download/storage/v1/b/prd-shared-services.firebasestorage.app/o/h2m-assets%2Fb9f65246b7034767fc11ea611be60edcbab724d3.svg?generation=1770502588613710&amp;alt=media"
                                class="block size-full" />
                        </div>
                        <span class="block text-left ml-[12px] text-[14px] leading-[20px]">Heiliggeiststrasse 2/2a/2b,
                            6020 Innsbruck, Austria</span>
                    </li>
                    <li class="items-start flex text-left mt-[12px]">
                        <div
                            class="fill-none overflow-hidden text-left align-middle w-5 h-5 mt-[2px] text-[rgb(48,_171,_232)] shrink-[0]">
                            <img src="https://storage.googleapis.com/download/storage/v1/b/prd-shared-services.firebasestorage.app/o/h2m-assets%2Fb0caa86e1509e75195dbf4f52e6266e757f7654d.svg?generation=1770502588646930&amp;alt=media"
                                class="block size-full" />
                        </div>
                        <div class="text-left ml-[12px] text-[14px] leading-[20px]">
                            <span class="block text-left text-[rgb(48,_171,_232)] text-[12px] leading-[16px]">WhatsApp
                                Preferred</span>
                            <span class="text-left">+43 660 478 47 12</span>
                        </div>
                    </li>
                    <li class="items-start flex text-left mt-[12px]">
                        <div
                            class="fill-none overflow-hidden text-left align-middle w-5 h-5 mt-[2px] text-[rgb(48,_171,_232)] shrink-[0]">
                            <img src="https://storage.googleapis.com/download/storage/v1/b/prd-shared-services.firebasestorage.app/o/h2m-assets%2Fb9ef28536579510dac0407f4da4001e46535cfe7.svg?generation=1770502588640506&amp;alt=media"
                                class="block size-full" />
                        </div>
                        <span
                            class="block text-left ml-[12px] text-[14px] leading-[20px]">ibk.cityapartments@gmail.com</span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="border-t text-center mt-[32px] border-[rgba(48,_171,_232,_0.2)]/20 pt-8 pr-0 pb-0 pl-0">
            <p class="text-center text-[rgb(107,_114,_128)] text-[14px] leading-[20px]">&copy; <?php echo date('Y'); ?>
                Innsbruck City Apartments. All rights reserved.</p>
        </div>
    </div>
</footer>
</div>

<?php wp_footer(); ?>
</body>

</html>