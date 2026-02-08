<?php

/**
 * TailPress Customizer settings.
 *
 * @package TailPress
 */

function tailpress_customize_register($wp_customize)
{
    // Contact Information Section
    $wp_customize->add_section('tailpress_contact_section', array(
        'title' => __('Contact Information', 'tailpress'),
        'priority' => 120,
    ));

    // Address
    $wp_customize->add_setting('contact_address', array(
        'default' => 'Heiliggeiststrasse 2/2a/2b, 6020 Innsbruck, Austria',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport' => 'refresh',
    ));

    $wp_customize->add_control('contact_address', array(
        'label' => __('Address', 'tailpress'),
        'description' => __('Enter the full address.', 'tailpress'),
        'section' => 'tailpress_contact_section',
        'type' => 'textarea',
    ));

    // Phone
    $wp_customize->add_setting('contact_phone', array(
        'default' => '+43 660 478 47 12',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh',
    ));

    $wp_customize->add_control('contact_phone', array(
        'label' => __('Phone Number', 'tailpress'),
        'section' => 'tailpress_contact_section',
        'type' => 'text',
    ));

    // WhatsApp Label
    $wp_customize->add_setting('contact_whatsapp_label', array(
        'default' => 'WhatsApp Preferred',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh',
    ));

    $wp_customize->add_control('contact_whatsapp_label', array(
        'label' => __('WhatsApp Label', 'tailpress'),
        'description' => __('Label shown above phone number (e.g. WhatsApp Preferred)', 'tailpress'),
        'section' => 'tailpress_contact_section',
        'type' => 'text',
    ));

    // Email
    $wp_customize->add_setting('contact_email', array(
        'default' => 'ibk.cityapartments@gmail.com',
        'sanitize_callback' => 'sanitize_email',
        'transport' => 'refresh',
    ));

    $wp_customize->add_control('contact_email', array(
        'label' => __('Email Address', 'tailpress'),
        'section' => 'tailpress_contact_section',
        'type' => 'email',
    ));
}
add_action('customize_register', 'tailpress_customize_register');
