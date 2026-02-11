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

                array(
                    'key' => 'field_hero_video',
                    'label' => 'Hero Background Video',
                    'name' => 'hero_background_video',
                    'type' => 'file',
                    'return_format' => 'url',
                    'mime_types' => 'mp4,webm',
                    'instructions' => 'Upload an MP4 or WebM video for the hero background. Keep under 15MB for fast loading. The page Featured Image will be used as a fallback/poster.',
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

                // Properties Section
                array(
                    'key' => 'field_home_tab_accommodations',
                    'label' => 'Properties Section',
                    'type' => 'tab',
                ),
                array(
                    'key' => 'field_accommodations_title',
                    'label' => 'Properties Title',
                    'name' => 'accommodations_title',
                    'type' => 'text',
                    'default_value' => 'Our Properties',
                ),
                array(
                    'key' => 'field_accommodations_subtitle',
                    'label' => 'Properties Subtitle',
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

        // 2. Listing Landing Page Fields
        acf_add_local_field_group(array(
            'key' => 'group_listing_landing_page',
            'title' => 'Listing Landing Page Settings',
            'fields' => array(


                // Features Tab
                array(
                    'key' => 'field_landing_tab_features',
                    'label' => 'Features Section',
                    'type' => 'tab',
                ),
                array(
                    'key' => 'field_landing_features_content',
                    'label' => 'Features Content',
                    'name' => 'features_content',
                    'type' => 'wysiwyg',
                ),



                // Grid Tab
                array(
                    'key' => 'field_landing_tab_grid',
                    'label' => 'Units Grid',
                    'type' => 'tab',
                ),
                array(
                    'name' => 'property_type_filter',
                    'label' => 'Filter by Property Type',
                    'type' => 'taxonomy',
                    'taxonomy' => 'property_type',
                    'field_type' => 'select',
                    'return_format' => 'id',
                    'allow_null' => 1,
                    'multiple' => 0,
                    'instructions' => 'Select a Property Type to display only those properties. Leave empty to show all.',
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'page_template',
                        'operator' => '==',
                        'value' => 'page-templates/listing-landing.php',
                    ),
                ),
            ),
        ));

        // 3. Property Type Taxonomy Fields
        acf_add_local_field_group(array(
            'key' => 'group_property_type',
            'title' => 'Property Type Settings',
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
                        'value' => 'property_type',
                    ),
                ),
            ),
        ));

        // 3. Property Data Fields
        acf_add_local_field_group(array(
            'key' => 'group_accommodation_details',
            'title' => 'Property Details',
            'fields' => array(
                array(
                    'key' => 'field_featured_property',
                    'label' => 'Featured Property',
                    'name' => 'featured',
                    'type' => 'true_false',
                    'message' => 'Show this property in the featured section',
                    'ui' => 1,
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
