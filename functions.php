<?php

if (is_file(__DIR__ . '/vendor/autoload_packages.php')) {
    require_once __DIR__ . '/vendor/autoload_packages.php';
}

function tailpress(): TailPress\Framework\Theme
{
    return TailPress\Framework\Theme::instance()
        ->assets(
            fn($manager) => $manager
                ->withCompiler(
                    new TailPress\Framework\Assets\ViteCompiler,
                    fn($compiler) => $compiler
                        ->registerAsset('resources/css/app.css')
                        ->registerAsset('resources/js/app.js')
                        ->editorStyleFile('resources/css/editor-style.css')
                )
                ->enqueueAssets()
        )
        ->features(fn($manager) => $manager->add(TailPress\Framework\Features\MenuOptions::class))
        ->menus(fn($manager) => $manager->add('primary', __('Primary Menu', 'tailpress')))
        ->themeSupport(fn($manager) => $manager->add([
            'title-tag',
            'custom-logo',
            'post-thumbnails',
            'align-wide',
            'wp-block-styles',
            'responsive-embeds',
            'html5' => [
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
            ]
        ]));
}

// Load ACF Fields
require_once get_template_directory() . '/inc/class-tailpress-acf.php';

// Load Customizer Settings
require_once get_template_directory() . '/inc/customizer.php';

tailpress();

/**
 * Register Property Custom Post Type.
 */
function register_accommodation_cpt()
{
    $labels = array(
        'name' => _x('Properties', 'Post Type General Name', 'tailpress'),
        'singular_name' => _x('Property', 'Post Type Singular Name', 'tailpress'),
        'menu_name' => __('Properties', 'tailpress'),
        'name_admin_bar' => __('Property', 'tailpress'),
        'archives' => __('Property Archives', 'tailpress'),
        'attributes' => __('Property Attributes', 'tailpress'),
        'parent_item_colon' => __('Parent Property:', 'tailpress'),
        'all_items' => __('All Properties', 'tailpress'),
        'add_new_item' => __('Add New Property', 'tailpress'),
        'add_new' => __('Add New', 'tailpress'),
        'new_item' => __('New Property', 'tailpress'),
        'edit_item' => __('Edit Property', 'tailpress'),
        'update_item' => __('Update Property', 'tailpress'),
        'view_item' => __('View Property', 'tailpress'),
        'view_items' => __('View Properties', 'tailpress'),
        'search_items' => __('Search Property', 'tailpress'),
        'not_found' => __('Not found', 'tailpress'),
        'not_found_in_trash' => __('Not found in Trash', 'tailpress'),
        'featured_image' => __('Featured Image', 'tailpress'),
        'set_featured_image' => __('Set featured image', 'tailpress'),
        'remove_featured_image' => __('Remove featured image', 'tailpress'),
        'use_featured_image' => __('Use as featured image', 'tailpress'),
        'insert_into_item' => __('Insert into property', 'tailpress'),
        'uploaded_to_this_item' => __('Uploaded to this property', 'tailpress'),
        'items_list' => __('Properties list', 'tailpress'),
        'items_list_navigation' => __('Properties list navigation', 'tailpress'),
        'filter_items_list' => __('Filter properties list', 'tailpress'),
    );
    $args = array(
        'label' => __('Property', 'tailpress'),
        'description' => __('Property details', 'tailpress'),
        'labels' => $labels,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        // 'taxonomies' => array('category', 'post_tag'),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-building',
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'post',
        'show_in_rest' => true,
    );
    register_post_type('accommodation', $args);

    // Register Property Type Taxonomy
    $type_labels = array(
        'name' => _x('Property Types', 'Taxonomy General Name', 'tailpress'),
        'singular_name' => _x('Property Type', 'Taxonomy Singular Name', 'tailpress'),
        'menu_name' => __('Property Type', 'tailpress'),
        'all_items' => __('All Property Types', 'tailpress'),
        'parent_item' => __('Parent Property Type', 'tailpress'),
        'parent_item_colon' => __('Parent Property Type:', 'tailpress'),
        'new_item_name' => __('New Property Type Name', 'tailpress'),
        'add_new_item' => __('Add New Property Type', 'tailpress'),
        'edit_item' => __('Edit Property Type', 'tailpress'),
        'update_item' => __('Update Property Type', 'tailpress'),
        'view_item' => __('View Property Type', 'tailpress'),
        'separate_items_with_commas' => __('Separate property types with commas', 'tailpress'),
        'add_or_remove_items' => __('Add or remove property types', 'tailpress'),
        'choose_from_most_used' => __('Choose from the most used', 'tailpress'),
        'popular_items' => __('Popular Property Types', 'tailpress'),
        'search_items' => __('Search Property Types', 'tailpress'),
        'not_found' => __('Not Found', 'tailpress'),
        'no_terms' => __('No property types', 'tailpress'),
        'items_list' => __('Property types list', 'tailpress'),
        'items_list_navigation' => __('Property types list navigation', 'tailpress'),
    );
    $type_args = array(
        'labels' => $type_labels,
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => true,
        'show_in_rest' => true,
    );
    register_taxonomy('property_type', array('accommodation'), $type_args);

    // Register Property Status Taxonomy
    $status_labels = array(
        'name' => _x('Property Statuses', 'Taxonomy General Name', 'tailpress'),
        'singular_name' => _x('Property Status', 'Taxonomy Singular Name', 'tailpress'),
        'menu_name' => __('Property Status', 'tailpress'),
        'all_items' => __('All Property Statuses', 'tailpress'),
        'parent_item' => __('Parent Property Status', 'tailpress'),
        'parent_item_colon' => __('Parent Property Status:', 'tailpress'),
        'new_item_name' => __('New Property Status Name', 'tailpress'),
        'add_new_item' => __('Add New Property Status', 'tailpress'),
        'edit_item' => __('Edit Property Status', 'tailpress'),
        'update_item' => __('Update Property Status', 'tailpress'),
        'view_item' => __('View Property Status', 'tailpress'),
        'separate_items_with_commas' => __('Separate property statuses with commas', 'tailpress'),
        'add_or_remove_items' => __('Add or remove property statuses', 'tailpress'),
        'choose_from_most_used' => __('Choose from the most used', 'tailpress'),
        'popular_items' => __('Popular Property Statuses', 'tailpress'),
        'search_items' => __('Search Property Statuses', 'tailpress'),
        'not_found' => __('Not Found', 'tailpress'),
        'no_terms' => __('No property statuses', 'tailpress'),
        'items_list' => __('Property statuses list', 'tailpress'),
        'items_list_navigation' => __('Property statuses list navigation', 'tailpress'),
    );
    $status_args = array(
        'labels' => $status_labels,
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => true,
        'show_in_rest' => true,
    );
    register_taxonomy('property_status', array('accommodation'), $status_args);
}
add_action('init', 'register_accommodation_cpt', 0);

/**
 * Register Project Custom Post Type.
 */
function register_project_cpt()
{
    // Project CPT
    $labels = array(
        'name' => _x('Projects', 'Post Type General Name', 'tailpress'),
        'singular_name' => _x('Project', 'Post Type Singular Name', 'tailpress'),
        'menu_name' => __('Projects', 'tailpress'),
        'all_items' => __('All Projects', 'tailpress'),
        'add_new_item' => __('Add New Project', 'tailpress'),
        'edit_item' => __('Edit Project', 'tailpress'),
        'update_item' => __('Update Project', 'tailpress'),
        'view_item' => __('View Project', 'tailpress'),
        'view_items' => __('View Projects', 'tailpress'),
        'search_items' => __('Search Projects', 'tailpress'),
    );
    $args = array(
        'label' => __('Project', 'tailpress'),
        'labels' => $labels,
        'supports' => array('title', 'thumbnail', 'editor'),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 6,
        'menu_icon' => 'dashicons-portfolio',
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'can_export' => true,
        'has_archive' => false,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'post',
        'show_in_rest' => true,
    );
    register_post_type('project', $args);

    // Project Stage Taxonomy
    $stage_labels = array(
        'name' => _x('Project Stages', 'Taxonomy General Name', 'tailpress'),
        'singular_name' => _x('Project Stage', 'Taxonomy Singular Name', 'tailpress'),
        'menu_name' => __('Project Stage', 'tailpress'),
        'all_items' => __('All Project Stages', 'tailpress'),
        'edit_item' => __('Edit Project Stage', 'tailpress'),
        'update_item' => __('Update Project Stage', 'tailpress'),
        'add_new_item' => __('Add New Project Stage', 'tailpress'),
        'new_item_name' => __('New Project Stage Name', 'tailpress'),
    );
    $stage_args = array(
        'labels' => $stage_labels,
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_in_rest' => true,
        'capabilities' => array(
            'manage_terms' => 'manage_options', // Only admins can enter the taxonomy management page
            'edit_terms' => 'do_not_allow',     // Disable creating/editing terms for ALL users (hides "Add New")
            'delete_terms' => 'do_not_allow',   // Disable deleting terms for ALL users
            'assign_terms' => 'edit_posts',     // Users can still assign existing terms
        ),
    );
    register_taxonomy('project_stage', array('project'), $stage_args);
}
add_action('init', 'register_project_cpt', 0);


// Allow SVG upload
function allow_svg_uploads($mimes)
{
    $mimes['svg'] = 'image/svg+xml';
    $mimes['svgz'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'allow_svg_uploads');

// Fix SVG display in Media Library
function fix_svg_display()
{
    echo '<style>
        .attachment-266x266, .thumbnail img {
            width: 100% !important;
            height: auto !important;
        }
    </style>';
}
add_action('admin_head', 'fix_svg_display');


/**
 * Add Tailwind classes to menu items
 */
function tailpress_nav_menu_add_li_class($classes, $item, $args, $depth)
{
    if (isset($args->theme_location) && 'primary' === $args->theme_location) {
        if (isset($args->menu_type) && 'footer' === $args->menu_type) {
            $classes[] = 'list-none text-left mt-[8px] first:mt-0';
        } elseif (isset($args->menu_type) && 'mobile' === $args->menu_type) {
            $classes[] = 'list-none w-full';
        } else {
            // Default to header styles
            $classes[] = 'ml-[32px] first:ml-0';
        }
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'tailpress_nav_menu_add_li_class', 10, 4);

/**
 * Add Tailwind classes to menu links
 */
function tailpress_nav_menu_add_link_class($atts, $item, $args, $depth)
{
    if (isset($args->theme_location) && 'primary' === $args->theme_location) {
        if (isset($args->menu_type) && 'footer' === $args->menu_type) {
            $atts['class'] = 'text-left text-[14px] leading-[20px]';
        } elseif (isset($args->menu_type) && 'mobile' === $args->menu_type) {
            $atts['class'] = 'block w-full text-left text-neutral-50 font-medium text-[16px] py-2';
        } else {
            // Default to header styles
            // Check if current item is active
            $is_active = in_array('current-menu-item', $item->classes) || in_array('current-menu-ancestor', $item->classes);
            $text_color = $is_active ? 'text-primary' : 'text-neutral-50';

            $atts['class'] = "block font-medium {$text_color} text-[14px] leading-[20px]";
        }
    }
    return $atts;
}
add_filter('nav_menu_link_attributes', 'tailpress_nav_menu_add_link_class', 10, 4);

/**
 * Add type="module" and defer to the app script
 */
function tailpress_add_module_type_to_script($tag, $handle, $src)
{
    // Check if it's the main app script.
    // Matches:
    // 1. Handle 'tailpress-app' or 'app'
    // 2. Src contains 'app' and '.js' and is within a theme's assets folder (flexible check)
    // 3. Src matches Vite build pattern '/assets/app-'
    if ('tailpress-app' === $handle || 'app' === $handle || (strpos($src, 'app') !== false && strpos($src, '.js') !== false && (strpos($src, '/themes/') !== false || strpos($src, '/assets/') !== false))) {
        $tag = '<script type="module" src="' . esc_url($src) . '" defer id="' . esc_attr($handle) . '-js"></script>';
    }
    return $tag;
}
add_filter('script_loader_tag', 'tailpress_add_module_type_to_script', 10, 3);

/**
 * AJAX Property Filter Handler
 */
function tailpress_ajax_filter_properties()
{
    // Verify Nonce (optional but recommended, can skip for public read-only if desired but good practice)
    // check_ajax_referer('tailpress_nonce', 'nonce');

    $type = isset($_POST['property_type']) ? sanitize_text_field($_POST['property_type']) : '';
    $status = isset($_POST['property_status']) ? sanitize_text_field($_POST['property_status']) : '';
    $paged = isset($_POST['paged']) ? intval($_POST['paged']) : 1;

    // Args for properties-loop
    $args = [
        'property_type' => $type,
        'property_status' => $status,
        'paged' => $paged,
        'posts_per_page' => 12,
        'show_pagination' => true, // Loop handles pagination HTML, or we can handle it separately
    ];

    // If implementing infinite scroll or load more, we might want just the items.
    // For now, let's return the whole loop output including pagination.

    // We need to pass the query args so properties-loop builds the query
    // properties-loop expects 'query' OR args to build it.
    // We will let properties-loop build it by passing the filter args.

    ob_start();
    get_template_part('template-parts/components/properties-loop', null, $args);
    $html = ob_get_clean();

    // Calculate max pages for JS logic if needed
    // We'd need to rebuild the query to get max_num_pages if we want to send it separately,
    // but properties-loop already runs the query. 
    // Optimization: properties-loop could expose the query object if we needed it, but HTML is enough for now.

    wp_send_json_success([
        'html' => $html
    ]);
}
add_action('wp_ajax_filter_properties', 'tailpress_ajax_filter_properties');
add_action('wp_ajax_nopriv_filter_properties', 'tailpress_ajax_filter_properties');

// Add excerpt support to pages
add_post_type_support('page', 'excerpt');

/**
 * Enqueue Leaflet.js + Fancybox on single property pages.
 */
function tailpress_enqueue_single_property_assets()
{
    if (!is_singular('accommodation')) {
        return;
    }

    // Leaflet CSS + JS
    wp_enqueue_style(
        'leaflet',
        'https://unpkg.com/leaflet@1.9.4/dist/leaflet.css',
        [],
        '1.9.4'
    );
    wp_enqueue_script(
        'leaflet',
        'https://unpkg.com/leaflet@1.9.4/dist/leaflet.js',
        [],
        '1.9.4',
        true
    );

    // Fancybox CSS + JS
    wp_enqueue_style(
        'fancybox',
        'https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css',
        [],
        '5.0'
    );
    wp_enqueue_script(
        'fancybox',
        'https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js',
        [],
        '5.0',
        true
    );
}
add_action('wp_enqueue_scripts', 'tailpress_enqueue_single_property_assets');

// Remove autop from contact form 7
add_filter('wpcf7_autop_or_not', '__return_false');

/**
 * Custom order to show 'sold' properties last.
 * Triggered by 'sort_sold_last' query var.
 */
add_filter('posts_orderby', function ($orderby, $query) {
    if ($query->get('sort_sold_last')) {
        global $wpdb;
        // Subquery counts if the post has the 'sold' term in 'property_status' taxonomy.
        // If count > 0, it evaluates to 1, pushing it to the end of the ASC sort.
        $sold_subquery = "(
            SELECT COUNT(1)
            FROM {$wpdb->term_relationships} tr
            INNER JOIN {$wpdb->term_taxonomy} tt ON tr.term_taxonomy_id = tt.term_taxonomy_id
            INNER JOIN {$wpdb->terms} t ON tt.term_id = t.term_id
            WHERE tr.object_id = {$wpdb->posts}.ID
              AND tt.taxonomy = 'property_status'
              AND t.slug = 'sold'
        ) ASC";

        if ($orderby) {
            $orderby = $sold_subquery . ", " . $orderby;
        } else {
            $orderby = $sold_subquery;
        }
    }
    return $orderby;
}, 10, 2);
