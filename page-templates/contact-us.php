<?php
/**
 * Template Name: Contact Us
 *
 * @package TailPress
 */

get_header();

// 1. Hero Data
$hero_title = get_the_title();
$hero_subtitle = get_the_excerpt();
$hero_image = get_the_post_thumbnail_url(get_the_ID(), 'full');

// Render Hero
get_template_part('template-parts/components/hero', null, [
    'image' => $hero_image,
    'title' => $hero_title,
    'subtitle' => $hero_subtitle,
    'height' => 'h-[60vh]'
]);

// 2. Contact Info Data
$contact_address = get_theme_mod('contact_address', 'Heiliggeiststrasse 2/2a/2b, 6020 Innsbruck, Austria');
$contact_phone = get_theme_mod('contact_phone', '+43 660 478 47 12');
$contact_whatsapp_label = get_theme_mod('contact_whatsapp_label', 'WhatsApp Preferred');
$contact_email = get_theme_mod('contact_email', 'ibk.cityapartments@gmail.com');

?>

<section class="py-12 md:py-20 bg-background">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 md:gap-8 max-w-6xl mx-auto">
            <div class="lg:col-span-2">
                <div class="rounded-lg border bg-card text-card-foreground shadow-sm">
                    <div class="p-4 md:p-6 lg:p-8">
                        <h2 class="text-xl md:text-2xl lg:text-3xl font-bold mb-4 md:mb-6">Request Information</h2>
                        <form class="space-y-4 md:space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3 md:gap-4">
                                <div><label
                                        class="font-medium peer-disabled:cursor-not-allowed peer-disabled:opacity-70 text-sm md:text-base"
                                        for="name">Full Name *</label><input
                                        class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 text-sm md:text-base"
                                        id="name" required="" placeholder="John Doe" value=""></div>
                                <div><label
                                        class="font-medium peer-disabled:cursor-not-allowed peer-disabled:opacity-70 text-sm md:text-base"
                                        for="email">Email Address *</label><input type="email"
                                        class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 text-sm md:text-base"
                                        id="email" required="" placeholder="john@example.com" value=""></div>
                            </div>
                            <div><label
                                    class="font-medium peer-disabled:cursor-not-allowed peer-disabled:opacity-70 text-sm md:text-base"
                                    for="phone">Phone Number</label><input type="tel"
                                    class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 text-sm md:text-base"
                                    id="phone" placeholder="+43 660 478 47 12" value=""></div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3 md:gap-4">
                                <div><label
                                        class="font-medium peer-disabled:cursor-not-allowed peer-disabled:opacity-70 text-sm md:text-base"
                                        for="apartmentType">Apartment Type</label>
                                    <div class="relative">
                                        <select id="apartmentType"
                                            class="flex h-10 w-full items-center justify-between rounded-md border border-input bg-background px-3 py-2 ring-offset-background placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 text-sm md:text-base appearance-none">
                                            <option value="" disabled selected>Select type</option>
                                            <option value="Luxury">Luxury Units</option>
                                            <option value="Premium">Premium Units</option>
                                            <option value="Not Sure">Not Sure Yet</option>
                                        </select>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-chevron-down h-4 w-4 opacity-50 absolute right-3 top-3 pointer-events-none"
                                            aria-hidden="true">
                                            <path d="m6 9 6 6 6-6"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div><label
                                        class="font-medium peer-disabled:cursor-not-allowed peer-disabled:opacity-70 text-sm md:text-base"
                                        for="guests">Number of Guests</label><input type="number"
                                        class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 text-sm md:text-base"
                                        id="guests" min="1" placeholder="2" value=""></div>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3 md:gap-4">
                                <div><label
                                        class="font-medium peer-disabled:cursor-not-allowed peer-disabled:opacity-70 text-sm md:text-base"
                                        for="checkIn">Preferred Check-in</label><input type="date"
                                        class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 text-sm md:text-base"
                                        id="checkIn" value=""></div>
                                <div><label
                                        class="font-medium peer-disabled:cursor-not-allowed peer-disabled:opacity-70 text-sm md:text-base"
                                        for="checkOut">Preferred Check-out</label><input type="date"
                                        class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 text-sm md:text-base"
                                        id="checkOut" value=""></div>
                            </div>
                            <div><label
                                    class="font-medium peer-disabled:cursor-not-allowed peer-disabled:opacity-70 text-sm md:text-base"
                                    for="message">Message *</label><textarea
                                    class="flex min-h-[80px] w-full rounded-md border border-input bg-background px-3 py-2 ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 text-sm md:text-base"
                                    id="message" required=""
                                    placeholder="Tell us about your requirements and any questions you may have..."
                                    rows="4"></textarea></div><button
                                class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 h-10 px-4 py-2 w-full bg-primary text-primary-foreground hover:bg-primary/90 text-sm md:text-base"
                                type="submit">Send Request</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="space-y-4 md:space-y-6">
                <div class="rounded-lg border bg-card text-card-foreground shadow-sm">
                    <div class="p-4 md:p-6">
                        <h3 class="text-lg md:text-xl font-bold mb-3 md:mb-4">Contact Information</h3>
                        <div class="space-y-3 md:space-y-4">
                            <div class="flex items-start space-x-2 md:space-x-3"><svg xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-map-pin w-4 h-4 md:w-5 md:h-5 text-primary flex-shrink-0 mt-1">
                                    <path
                                        d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0">
                                    </path>
                                    <circle cx="12" cy="10" r="3"></circle>
                                </svg>
                                <div>
                                    <p class="font-semibold text-sm md:text-base">Address</p>
                                    <p class="text-xs md:text-sm text-muted-foreground">
                                        <?php echo nl2br(esc_html($contact_address)); ?>
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-2 md:space-x-3"><svg xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-phone w-4 h-4 md:w-5 md:h-5 text-primary flex-shrink-0 mt-1">
                                    <path
                                        d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z">
                                    </path>
                                </svg>
                                <div>
                                    <p class="font-semibold text-sm md:text-base">Phone</p>
                                    <?php if ($contact_whatsapp_label): ?>
                                        <p class="text-xs text-primary">
                                            <?php echo esc_html($contact_whatsapp_label); ?>
                                        </p>
                                    <?php endif; ?>
                                    <p class="text-xs md:text-sm text-muted-foreground">
                                        <?php echo esc_html($contact_phone); ?>
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-2 md:space-x-3"><svg xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-mail w-4 h-4 md:w-5 md:h-5 text-primary flex-shrink-0 mt-1">
                                    <rect width="20" height="16" x="2" y="4" rx="2"></rect>
                                    <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
                                </svg>
                                <div>
                                    <p class="font-semibold text-sm md:text-base">Email</p>
                                    <p class="text-xs md:text-sm text-muted-foreground break-all">
                                        <?php echo esc_html($contact_email); ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="rounded-lg border shadow-sm bg-primary text-primary-foreground">
                    <div class="p-4 md:p-6">
                        <h3 class="text-lg md:text-xl font-bold mb-2 md:mb-3">Why Request?</h3>
                        <p class="text-xs md:text-sm">We believe in providing personalized service. By requesting
                            information instead of booking online, we can ensure you get the perfect apartment for your
                            needs and answer any questions you may have.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
get_footer();
