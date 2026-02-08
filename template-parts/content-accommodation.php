<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="mx-auto flex max-w-5xl flex-col text-center">
        <h1 class="mt-6 text-5xl font-medium tracking-tight [text-wrap:balance] text-zinc-950 sm:text-6xl">
            <?php the_title(); ?>
        </h1>
    </header>

    <?php if (has_post_thumbnail()): ?>
        <div class="mt-10 sm:mt-20 mx-auto max-w-4xl rounded-4xl bg-light overflow-hidden">
            <?php the_post_thumbnail('large', ['class' => 'aspect-16/10 w-full object-cover']); ?>
        </div>
    <?php endif; ?>

    <div class="entry-content mx-auto max-w-3xl mt-10 sm:mt-20">
        <?php the_content(); ?>
    </div>

    <?php
    if (function_exists('tailpress_get_gallery_images')) {
        $gallery_images = tailpress_get_gallery_images();
        if (!empty($gallery_images)): ?>
            <div class="mx-auto max-w-5xl mt-12">
                <h2 class="text-3xl font-bold text-center mb-8">Gallery</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                    <?php foreach ($gallery_images as $image): ?>
                        <div class="aspect-square overflow-hidden rounded-lg">
                            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>"
                                class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif;
    }
    ?>
</article>