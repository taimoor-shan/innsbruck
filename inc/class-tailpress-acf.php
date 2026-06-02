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
                // array(
                //     'key' => 'field_home_tab_benefits',
                //     'label' => 'Benefits Section',
                //     'type' => 'tab',
                // ),
                // array(
                //     'key' => 'field_benefits_title',
                //     'label' => 'Benefits Title',
                //     'name' => 'benefits_title',
                //     'type' => 'text',
                //     'default_value' => 'Benefits of Innsbruck City Apartments',
                // ),
                // array(
                //     'key' => 'field_benefits_subtitle',
                //     'label' => 'Benefits Subtitle',
                //     'name' => 'benefits_subtitle',
                //     'type' => 'textarea',
                //     'default_value' => 'Discover our Luxury and Premium apartments',
                //     'rows' => 2,
                // ),
                // array(
                //     'key' => 'field_benefits_list',
                //     'label' => 'Benefits List',
                //     'name' => 'benefits_list',
                //     'type' => 'repeater',
                //     'layout' => 'block',
                //     'button_label' => 'Add Benefit',
                //     'sub_fields' => array(
                //         array(
                //             'key' => 'field_benefit_icon',
                //             'label' => 'Icon',
                //             'name' => 'icon',
                //             'type' => 'image',
                //             'return_format' => 'url',
                //         ),
                //         array(
                //             'key' => 'field_benefit_title',
                //             'label' => 'Title',
                //             'name' => 'title',
                //             'type' => 'text',
                //         ),
                //         array(
                //             'key' => 'field_benefit_description',
                //             'label' => 'Description',
                //             'name' => 'description',
                //             'type' => 'textarea',
                //             'rows' => 2,
                //         ),
                //     ),
                // ),

                // Tab: Property Types
                array(
                    'key' => 'field_tab_property_types',
                    'label' => 'Property Types Section',
                    'type' => 'tab',
                ),
                array(
                    'key' => 'field_property_types_title',
                    'label' => 'Section Title',
                    'name' => 'property_types_title',
                    'type' => 'text',
                    'default_value' => 'Our Property Types',
                ),
                array(
                    'key' => 'field_property_types_subtitle',
                    'label' => 'Section Subtitle',
                    'name' => 'property_types_subtitle',
                    'type' => 'textarea',
                    'default_value' => 'Choose from our selection of premium accommodations',
                    'rows' => 2,
                ),

                // Tab: Trust
                array(
                    'key' => 'field_tab_trust',
                    'label' => 'Trust Section',
                    'type' => 'tab',
                ),

                array(
                    'key' => 'field_projects_trust_title',
                    'label' => 'Section Title',
                    'name' => 'projects_trust_title',
                    'type' => 'text',
                    'default_value' => 'Why Invest With Us',
                ),
                array(
                    'key' => 'field_projects_trust_subtitle',
                    'label' => 'Section Subtitle',
                    'name' => 'projects_trust_subtitle',
                    'type' => 'textarea',
                    'rows' => 4,
                    'default_value' => 'Discover our Luxury and Premium apartments',
                ),

                array(
                    'key' => 'field_projects_trust_image',
                    'label' => 'Section Image',
                    'name' => 'projects_trust_image',
                    'type' => 'image',
                    'return_format' => 'url',
                    'instructions' => 'Image displayed on the left side of the section.',
                ),
                array(
                    'key' => 'field_projects_trust_points',
                    'label' => 'Trust Points',
                    'name' => 'projects_trust_points',
                    'type' => 'repeater',
                    'layout' => 'block',
                    'button_label' => 'Add Point',
                    'sub_fields' => array(
                        array(
                            'key' => 'field_trust_point_title',
                            'label' => 'Title',
                            'name' => 'point_title',
                            'type' => 'text',
                        ),
                        array(
                            'key' => 'field_trust_point_description',
                            'label' => 'Description',
                            'name' => 'point_description',
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
                    'wrapper' => array(
                        'width' => '50',
                    ),
                ),
                array(
                    'key' => 'field_property_price',
                    'label' => 'Price',
                    'name' => 'property_price',
                    'type' => 'number',
                    'wrapper' => array(
                        'width' => '50',
                    ),
                ),
                // array(
                //     'key' => 'field_property_address',
                //     'label' => 'Street Address',
                //     'name' => 'property_address',
                //     'type' => 'text',
                //     'wrapper' => array(
                //         'width' => '50',
                //     ),
                // ),
                // array(
                //     'key' => 'field_property_city_state',
                //     'label' => 'City, State',
                //     'name' => 'property_city_state',
                //     'type' => 'text',
                //     'wrapper' => array(
                //         'width' => '50',
                //     ),
                // ),
                array(
                    'key' => 'field_size',
                    'label' => 'Size (m²)',
                    'name' => 'size',
                    'type' => 'number',
                    'append' => 'm²',
                    'wrapper' => array(
                        'width' => '50',
                    ),
                ),
                array(
                    'key' => 'field_bedrooms',
                    'label' => 'Bedrooms',
                    'name' => 'bedrooms',
                    'type' => 'number',
                    'default_value' => 1,
                    'wrapper' => array(
                        'width' => '50',
                    ),
                ),
                array(
                    'key' => 'field_living-area',
                    'label' => 'Livingroom',
                    'name' => 'livingroom',
                    'type' => 'text',
                    'default_value' => 1,
                    'wrapper' => array(
                        'width' => '50',
                    ),
                ),
                array(
                    'key' => 'field_bathrooms',
                    'label' => 'Bathrooms',
                    'name' => 'bathrooms',
                    'type' => 'text',
                    'default_value' => 1,
                    'wrapper' => array(
                        'width' => '50',
                    ),
                ),
                array(
                    'key' => 'field_document',
                    'label' => 'Document',
                    'name' => 'document',
                    'type' => 'file',
                    'return_format' => 'url',
                    'wrapper' => array(
                        'width' => '50',
                    ),
                ),
                array(
                    'key' => 'field_layout_image',
                    'label' => 'Layout Image',
                    'name' => 'layout_image',
                    'type' => 'image',
                    'return_format' => 'url',
                    'preview_size' => 'medium',
                    'instructions' => 'Upload a floor plan or layout image for this property.',
                    'mime_types' => 'jpg,jpeg,png,webp',
                    'wrapper' => array(
                        'width' => '50',
                    ),
                ),
                array(
                    'key' => 'field_balcony',
                    'label' => 'Balcony',
                    'name' => 'balcony',
                    'type' => 'true_false',
                    'ui' => 1,
                    'wrapper' => array(
                        'width' => '50',
                    ),
                ),
                array(
                    'key' => 'field_jacuzzi',
                    'label' => 'Jacuzzi',
                    'name' => 'jacuzzi',
                    'type' => 'true_false',
                    'ui' => 1,
                    'wrapper' => array(
                        'width' => '50',
                    ),
                ),
                array(
                    'key' => 'field_property_latitude',
                    'label' => 'Latitude',
                    'name' => 'property_latitude',
                    'type' => 'number',
                    'instructions' => 'e.g. 47.2692',
                    'step' => 'any',
                    'wrapper' => array(
                        'width' => '50',
                    ),
                ),
                array(
                    'key' => 'field_property_longitude',
                    'label' => 'Longitude',
                    'name' => 'property_longitude',
                    'type' => 'number',
                    'instructions' => 'e.g. 11.4041',
                    'step' => 'any',
                    'wrapper' => array(
                        'width' => '50',
                    ),
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

        // 4. Projects Page Fields
        acf_add_local_field_group(array(
            'key' => 'group_projects_page',
            'title' => 'Projects Page Configuration',
            'fields' => array(
                // Tab: Philosophy
                array(
                    'key' => 'field_tab_philosophy',
                    'label' => 'Philosophy',
                    'type' => 'tab',
                ),
                array(
                    'key' => 'field_projects_philosophy_title',
                    'label' => 'Section Title',
                    'name' => 'projects_philosophy_title',
                    'type' => 'text',
                    'default_value' => 'Our Philosophy',
                ),
                array(
                    'key' => 'field_projects_philosophy_intro',
                    'label' => 'Intro Text',
                    'name' => 'projects_philosophy_intro',
                    'type' => 'textarea',
                    'rows' => 3,
                ),
                array(
                    'key' => 'field_projects_principles',
                    'label' => 'Principles',
                    'name' => 'projects_principles',
                    'type' => 'wysiwyg',
                ),

                array(
                    'key' => 'field_projects_philosophy_image',
                    'label' => 'Section Image',
                    'name' => 'projects_philosophy_image',
                    'type' => 'image',
                    'return_format' => 'url',
                ),



                // Tab: Lead
                array(
                    'key' => 'field_tab_lead',
                    'label' => 'Lead Section',
                    'type' => 'tab',
                ),
                array(
                    'key' => 'field_projects_lead_title',
                    'label' => 'Section Title',
                    'name' => 'projects_lead_title',
                    'type' => 'text',
                    'default_value' => 'Interested in Investing?',
                ),
                array(
                    'key' => 'field_projects_lead_text',
                    'label' => 'Section Text',
                    'name' => 'projects_lead_text',
                    'type' => 'textarea',
                    'rows' => 3,
                ),
                array(
                    'key' => 'field_projects_lead_form',
                    'label' => 'Form Shortcode',
                    'name' => 'projects_lead_form',
                    'type' => 'text',
                    'instructions' => 'Enter the Gravity Forms or CF7 shortcode here.',
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'page_template',
                        'operator' => '==',
                        'value' => 'page-templates/projects.php',
                    ),
                ),
            ),
        ));

        // 5. Blog Page Settings
        acf_add_local_field_group(array(
            'key' => 'group_blog_page',
            'title' => 'Blog Page Settings',
            'fields' => array(
                array(
                    'key' => 'field_blog_featured_article',
                    'label' => 'Featured Article',
                    'name' => 'blog_featured_article',
                    'type' => 'post_object',
                    'post_type' => array('post'),
                    'allow_null' => 1,
                    'return_format' => 'id',
                    'instructions' => 'Select a post to feature in the hero slot. Leave empty to auto-select the most recent post.',
                ),
                array(
                    'key' => 'field_blog_show_featured',
                    'label' => 'Show Featured Section',
                    'name' => 'blog_show_featured',
                    'type' => 'true_false',
                    'ui' => 1,
                    'default_value' => 1,
                    'instructions' => 'Toggle the featured article section on/off.',
                ),
                array(
                    'key' => 'field_blog_page_title',
                    'label' => 'Page Title Override',
                    'name' => 'blog_page_title',
                    'type' => 'text',
                    'default_value' => '',
                    'instructions' => 'Overrides the Customizer hero title for this page only.',
                ),
                array(
                    'key' => 'field_blog_page_subtitle',
                    'label' => 'Page Subtitle Override',
                    'name' => 'blog_page_subtitle',
                    'type' => 'textarea',
                    'default_value' => '',
                    'instructions' => 'Overrides the Customizer hero subtitle for this page only.',
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'page_type',
                        'operator' => '==',
                        'value' => 'posts_page',
                    ),
                ),
            ),
        ));

        // 6. Project Post Fields
        acf_add_local_field_group(array(
            'key' => 'group_project_details',
            'title' => 'Project Details',
            'fields' => array(
                array(
                    'key' => 'field_project_address',
                    'label' => 'Street Address',
                    'name' => 'project_address',
                    'type' => 'text',
                    'wrapper' => array(
                        'width' => '50',
                    ),
                ),
                array(
                    'key' => 'field_project_city_state',
                    'label' => 'City, State',
                    'name' => 'project_city_state',
                    'type' => 'text',
                    'wrapper' => array(
                        'width' => '50',
                    ),
                ),
                array(
                    'key' => 'field_project_year',
                    'label' => 'Year',
                    'name' => 'project_year',
                    'type' => 'text',
                    'wrapper' => array(
                        'width' => '50',
                    ),
                ),
                array(
                    'key' => 'field_project_area',
                    'label' => 'Area / Size',
                    'name' => 'project_area',
                    'type' => 'text',
                    'wrapper' => array(
                        'width' => '50',
                    ),
                ),
                array(
                    'key' => 'field_project_units',
                    'label' => 'Units',
                    'name' => 'project_units',
                    'type' => 'number',
                    'wrapper' => array(
                        'width' => '50',
                    ),
                ),
                array(
                    'key' => 'field_project_type',
                    'label' => 'Type',
                    'name' => 'project_type',
                    'type' => 'text',
                    'instructions' => 'e.g. Residential, Commercial',
                    'wrapper' => array(
                        'width' => '50',
                    ),
                ),
                array(
                    'key' => 'field_project_timeline',
                    'label' => 'Expected Timeline',
                    'name' => 'project_timeline',
                    'type' => 'text',
                    'instructions' => 'For future projects only',
                    'wrapper' => array(
                        'width' => '50',
                    ),
                ),
                array(
                    'key' => 'field_project_document',
                    'label' => 'Investment Document',
                    'name' => 'project_document',
                    'type' => 'file',
                    'return_format' => 'url',
                    'instructions' => 'Upload the investment document (PDF).',
                    'wrapper' => array(
                        'width' => '50',
                    ),
                ),
                array(
                    'key' => 'field_project_cta_link',
                    'label' => 'CTA Link',
                    'name' => 'project_cta_link',
                    'type' => 'url',
                    'instructions' => 'Link for future projects (e.g. to a landing page)',
                    'wrapper' => array(
                        'width' => '50',
                    ),
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'project',
                    ),
                ),
            ),
        ));
    }
}

new TailPress_ACF();
