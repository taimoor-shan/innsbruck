<?php

if (is_file(__DIR__.'/vendor/autoload_packages.php')) {
    require_once __DIR__.'/vendor/autoload_packages.php';
}

function tailpress(): TailPress\Framework\Theme
{
    return TailPress\Framework\Theme::instance()
        ->assets(fn($manager) => $manager
            ->withCompiler(new TailPress\Framework\Assets\ViteCompiler, fn($compiler) => $compiler
                ->registerAsset('resources/css/app.css')
                ->registerAsset('resources/js/app.js')
                ->editorStyleFile('resources/css/editor-style.css')
            )
            ->enqueueAssets()
        )
        ->features(fn($manager) => $manager->add(TailPress\Framework\Features\MenuOptions::class))
        ->menus(fn($manager) => $manager->add('primary', __( 'Primary Menu', 'tailpress')))
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

tailpress();

/**
 * Register Accommodation Custom Post Type.
 */
function register_accommodation_cpt() {
    $labels = array(
        'name'                  => _x( 'Accommodations', 'Post Type General Name', 'tailpress' ),
        'singular_name'         => _x( 'Accommodation', 'Post Type Singular Name', 'tailpress' ),
        'menu_name'             => __( 'Accommodations', 'tailpress' ),
        'name_admin_bar'        => __( 'Accommodation', 'tailpress' ),
        'archives'              => __( 'Accommodation Archives', 'tailpress' ),
        'attributes'            => __( 'Accommodation Attributes', 'tailpress' ),
        'parent_item_colon'     => __( 'Parent Accommodation:', 'tailpress' ),
        'all_items'             => __( 'All Accommodations', 'tailpress' ),
        'add_new_item'          => __( 'Add New Accommodation', 'tailpress' ),
        'add_new'               => __( 'Add New', 'tailpress' ),
        'new_item'              => __( 'New Accommodation', 'tailpress' ),
        'edit_item'             => __( 'Edit Accommodation', 'tailpress' ),
        'update_item'           => __( 'Update Accommodation', 'tailpress' ),
        'view_item'             => __( 'View Accommodation', 'tailpress' ),
        'view_items'            => __( 'View Accommodations', 'tailpress' ),
        'search_items'          => __( 'Search Accommodation', 'tailpress' ),
        'not_found'             => __( 'Not found', 'tailpress' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'tailpress' ),
        'featured_image'        => __( 'Featured Image', 'tailpress' ),
        'set_featured_image'    => __( 'Set featured image', 'tailpress' ),
        'remove_featured_image' => __( 'Remove featured image', 'tailpress' ),
        'use_featured_image'    => __( 'Use as featured image', 'tailpress' ),
        'insert_into_item'      => __( 'Insert into accommodation', 'tailpress' ),
        'uploaded_to_this_item' => __( 'Uploaded to this accommodation', 'tailpress' ),
        'items_list'            => __( 'Accommodations list', 'tailpress' ),
        'items_list_navigation' => __( 'Accommodations list navigation', 'tailpress' ),
        'filter_items_list'     => __( 'Filter accommodations list', 'tailpress' ),
    );
    $args = array(
        'label'                 => __( 'Accommodation', 'tailpress' ),
        'description'           => __( 'Accommodation details', 'tailpress' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
        'taxonomies'            => array( 'category', 'post_tag' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-building',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'show_in_rest'          => true,
    );
    register_post_type( 'accommodation', $args );
}
add_action( 'init', 'register_accommodation_cpt', 0 );
