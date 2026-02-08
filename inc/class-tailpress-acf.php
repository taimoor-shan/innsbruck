<?php

class TailPress_ACF
{

    public function __construct()
    {
        add_action('acf/init', array($this, 'register_fields'));
    }

    public function register_fields()
    {
        if (!function_exists('acf_add_local_field_group')) {
            return;
        }

        // 1. Homepage Fields
        acf_add_local_field_group(array(
            'key' => 'group_homepage',
            'title' => 'Homepage Settings',
            'fields' => array(
                // Hero Section
                array(
                    'key' => 'field_home_tab_hero',
                    'label' => 'Hero Section',
                    'type' => 'tab',
                ),
                array(
                    'key' => 'field_hero_title',
                    'label' => 'Hero Title',
                    'name' => 'hero_title',
                    'type' => 'text',
                    'default_value' => 'Innsbruck City Apartments',
                ),
                array(
                    'key' => 'field_hero_subtitle',
                    'label' => 'Hero Subtitle',
                    'name' => 'hero_subtitle',
                    'type' => 'textarea',
                    'default_value' => 'In the heart of the mountains and the center of Innsbruck',
                    'rows' => 2,
                ),
                array(
                    'key' => 'field_hero_bg',
                    'label' => 'Hero Background Image',
                    'name' => 'hero_background_image',
                    'type' => 'image',
                    'return_format' => 'url',
                    'preview_size' => 'medium',
                ),

                // Benefits Section
                array(
                    'key' => 'field_home_tab_benefits',
                    'label' => 'Benefits Section',
                    'type' => 'tab',
                ),
                array(
                    'key' => 'field_benefits_title',
                    'label' => 'Benefits Title',
                    'name' => 'benefits_title',
                    'type' => 'text',
                    'default_value' => 'Benefits of Innsbruck City Apartments',
                ),
                array(
                    'key' => 'field_benefits_subtitle',
                    'label' => 'Benefits Subtitle',
                    'name' => 'benefits_subtitle',
                    'type' => 'textarea',
                    'default_value' => 'Discover our Luxury and Premium apartments',
                    'rows' => 2,
                ),
                array(
                    'key' => 'field_benefits_list',
                    'label' => 'Benefits List',
                    'name' => 'benefits_list',
                    'type' => 'repeater',
                    'layout' => 'block',
                    'button_label' => 'Add Benefit',
                    'sub_fields' => array(
                        array(
                            'key' => 'field_benefit_icon',
                            'label' => 'Icon',
                            'name' => 'icon',
                            'type' => 'image',
                            'return_format' => 'url',
                        ),
                        array(
                            'key' => 'field_benefit_title',
                            'label' => 'Title',
                            'name' => 'title',
                            'type' => 'text',
                        ),
                        array(
                            'key' => 'field_benefit_description',
                            'label' => 'Description',
                            'name' => 'description',
                            'type' => 'textarea',
                            'rows' => 2,
                        ),
                    ),
                ),

                // Accommodations Section
                array(
                    'key' => 'field_home_tab_accommodations',
                    'label' => 'Accommodations Section',
                    'type' => 'tab',
                ),
                array(
                    'key' => 'field_accommodations_title',
                    'label' => 'Accommodations Title',
                    'name' => 'accommodations_title',
                    'type' => 'text',
                    'default_value' => 'Our Accommodations',
                ),
                array(
                    'key' => 'field_accommodations_subtitle',
                    'label' => 'Accommodations Subtitle',
                    'name' => 'accommodations_subtitle',
                    'type' => 'textarea',
                    'default_value' => 'Choose from our Premium and Luxury apartments',
                    'rows' => 2,
                ),

                // CTA Section
                array(
                    'key' => 'field_home_tab_cta',
                    'label' => 'CTA Section',
                    'type' => 'tab',
                ),
                array(
                    'key' => 'field_cta_title',
                    'label' => 'CTA Title',
                    'name' => 'cta_title',
                    'type' => 'text',
                    'default_value' => 'Request your luxury or premium apartment in the center of Innsbruck',
                ),
                array(
                    'key' => 'field_cta_subtitle',
                    'label' => 'CTA Subtitle',
                    'name' => 'cta_subtitle',
                    'type' => 'textarea',
                    'default_value' => 'Contact us today to request information about availability',
                    'rows' => 2,
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'page_template',
                        'operator' => '==',
                        'value' => 'front-page.php',
                    ),
                ),
            ),
        ));

        // 2. Unit Type Taxonomy Fields
        acf_add_local_field_group(array(
            'key' => 'group_unit_type',
            'title' => 'Unit Type Settings',
            'fields' => array(
                array(
                    'key' => 'field_term_hero_image',
                    'label' => 'Hero Image',
                    'name' => 'hero_image',
                    'type' => 'image',
                    'instructions' => 'Top banner image for the archive page',
                    'return_format' => 'url',
                ),
                array(
                    'key' => 'field_term_card_image',
                    'label' => 'Card Image',
                    'name' => 'card_image',
                    'type' => 'image',
                    'instructions' => 'Image shown on the homepage card',
                    'return_format' => 'url',
                ),
                array(
                    'key' => 'field_term_full_desc',
                    'label' => 'Full Description',
                    'name' => 'full_description',
                    'type' => 'wysiwyg',
                    'instructions' => 'Extended description shown above the grid',
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'taxonomy',
                        'operator' => '==',
                        'value' => 'unit_type',
                    ),
                ),
            ),
        ));

        // 3. Accommodation Data Fields
        acf_add_local_field_group(array(
            'key' => 'group_accommodation_details',
            'title' => 'Accommodation Details',
            'fields' => array(
                array(
                    'key' => 'field_gallery',
                    'label' => 'Photo Gallery',
                    'name' => 'gallery',
                    'type' => 'gallery',
                    'return_format' => 'url',
                ),
                array(
                    'key' => 'field_size',
                    'label' => 'Size (m²)',
                    'name' => 'size',
                    'type' => 'number',
                    'append' => 'm²',
                ),
                array(
                    'key' => 'field_bedrooms',
                    'label' => 'Bedrooms',
                    'name' => 'bedrooms',
                    'type' => 'text',
                    'default_value' => '1 Bedroom',
                ),
                array(
                    'key' => 'field_livingroom',
                    'label' => 'Livingroom',
                    'name' => 'livingroom',
                    'type' => 'text',
                    'default_value' => '1 Livingroom (incl. pull out Bed 160cm)',
                ),
                array(
                    'key' => 'field_bathrooms',
                    'label' => 'Bathrooms',
                    'name' => 'bathrooms',
                    'type' => 'number',
                    'default_value' => 1,
                ),
                array(
                    'key' => 'field_balcony',
                    'label' => 'Has Balcony?',
                    'name' => 'balcony',
                    'type' => 'true_false',
                    'ui' => true,
                ),
                array(
                    'key' => 'field_jacuzzi',
                    'label' => 'Has Jacuzzi?',
                    'name' => 'jacuzzi',
                    'type' => 'true_false',
                    'ui' => true,
                ),
                array(
                    'key' => 'field_floor_plan',
                    'label' => 'Floor Plan Image',
                    'name' => 'floor_plan',
                    'type' => 'image',
                    'return_format' => 'url',
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'accommodation',
                    ),
                ),
            ),
        ));
    }
}

new TailPress_ACF();
