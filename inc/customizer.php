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

    // Blog Settings Section
    $wp_customize->add_section('tailpress_blog_section', array(
        'title' => __('Blog Settings', 'tailpress'),
        'priority' => 130,
    ));

    // Blog Hero Title
    $wp_customize->add_setting('blog_hero_title', array(
        'default' => 'Explore the Tirol Region',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh',
    ));

    $wp_customize->add_control('blog_hero_title', array(
        'label' => __('Blog Hero Title', 'tailpress'),
        'section' => 'tailpress_blog_section',
        'type' => 'text',
    ));

    // Blog Hero Subtitle
    $wp_customize->add_setting('blog_hero_subtitle', array(
        'default' => 'Discover the best of Alpine living, from world-class skiing to cultural treasures in the heart of the Austrian Alps.',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport' => 'refresh',
    ));

    $wp_customize->add_control('blog_hero_subtitle', array(
        'label' => __('Blog Hero Subtitle', 'tailpress'),
        'section' => 'tailpress_blog_section',
        'type' => 'textarea',
    ));

    // Blog CTA Title
    $wp_customize->add_setting('blog_cta_title', array(
        'default' => 'Ready to Experience the Tirol Mountains?',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh',
    ));

    $wp_customize->add_control('blog_cta_title', array(
        'label' => __('CTA Title', 'tailpress'),
        'section' => 'tailpress_blog_section',
        'type' => 'text',
    ));

    // Blog CTA Subtitle
    $wp_customize->add_setting('blog_cta_subtitle', array(
        'default' => 'Book your luxury or premium apartment in Innsbruck and wake up to breathtaking Alpine views every morning.',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport' => 'refresh',
    ));

    $wp_customize->add_control('blog_cta_subtitle', array(
        'label' => __('CTA Subtitle', 'tailpress'),
        'section' => 'tailpress_blog_section',
        'type' => 'textarea',
    ));

    // CTA Button 1 Text
    $wp_customize->add_setting('blog_cta_button1_text', array(
        'default' => 'View Luxury Units',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh',
    ));

    $wp_customize->add_control('blog_cta_button1_text', array(
        'label' => __('CTA Button 1 Text', 'tailpress'),
        'section' => 'tailpress_blog_section',
        'type' => 'text',
    ));

    // CTA Button 1 URL
    $wp_customize->add_setting('blog_cta_button1_url', array(
        'default' => '/property_type/luxury/',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh',
    ));

    $wp_customize->add_control('blog_cta_button1_url', array(
        'label' => __('CTA Button 1 URL', 'tailpress'),
        'section' => 'tailpress_blog_section',
        'type' => 'text',
    ));

    // CTA Button 2 Text
    $wp_customize->add_setting('blog_cta_button2_text', array(
        'default' => 'View Premium Units',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh',
    ));

    $wp_customize->add_control('blog_cta_button2_text', array(
        'label' => __('CTA Button 2 Text', 'tailpress'),
        'section' => 'tailpress_blog_section',
        'type' => 'text',
    ));

    // CTA Button 2 URL
    $wp_customize->add_setting('blog_cta_button2_url', array(
        'default' => '/property_type/premium/',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh',
    ));

    $wp_customize->add_control('blog_cta_button2_url', array(
        'label' => __('CTA Button 2 URL', 'tailpress'),
        'section' => 'tailpress_blog_section',
        'type' => 'text',
    ));
}
add_action('customize_register', 'tailpress_customize_register');
