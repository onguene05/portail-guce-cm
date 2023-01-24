<?php

/**
 * businoz customizer
 *
 * @package businoz
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Added Panels & Sections
 */
function businoz_customizer_panels_sections($wp_customize)
{

    //Add panel
    $wp_customize->add_panel('businoz_customizer', [
        'priority' => 10,
        'title'    => esc_html__('Businoz Customizer', 'businoz'),
    ]);

    /**
     * Customizer Section
     */
    $wp_customize->add_section('header_top_setting', [
        'title'       => esc_html__('Header Topbar Setting', 'businoz'),
        'description' => '',
        'priority'    => 10,
        'capability'  => 'edit_theme_options',
        'panel'       => 'businoz_customizer',
    ]);

    $wp_customize->add_section('header_social', [
        'title'       => esc_html__('Header Social', 'businoz'),
        'description' => '',
        'priority'    => 11,
        'capability'  => 'edit_theme_options',
        'panel'       => 'businoz_customizer',
    ]);

    $wp_customize->add_section('sidebar_social', [
        'title'       => esc_html__('Sidebar Social', 'businoz'),
        'description' => '',
        'priority'    => 11,
        'capability'  => 'edit_theme_options',
        'panel'       => 'businoz_customizer',
    ]);

    $wp_customize->add_section('footer_social', [
        'title'       => esc_html__('Footer Social', 'businoz'),
        'description' => '',
        'priority'    => 17,
        'capability'  => 'edit_theme_options',
        'panel'       => 'businoz_customizer',
    ]);

    $wp_customize->add_section('section_header_logo', [
        'title'       => esc_html__('Header Setting', 'businoz'),
        'description' => '',
        'priority'    => 12,
        'capability'  => 'edit_theme_options',
        'panel'       => 'businoz_customizer',
    ]);

    $wp_customize->add_section('blog_setting', [
        'title'       => esc_html__('Blog Setting', 'businoz'),
        'description' => '',
        'priority'    => 13,
        'capability'  => 'edit_theme_options',
        'panel'       => 'businoz_customizer',
    ]);

    $wp_customize->add_section('header_side_setting', [
        'title'       => esc_html__('Side Info', 'businoz'),
        'description' => '',
        'priority'    => 14,
        'capability'  => 'edit_theme_options',
        'panel'       => 'businoz_customizer',
    ]);

    $wp_customize->add_section('breadcrumb_setting', [
        'title'       => esc_html__('Breadcrumb Setting', 'businoz'),
        'description' => '',
        'priority'    => 15,
        'capability'  => 'edit_theme_options',
        'panel'       => 'businoz_customizer',
    ]);

    $wp_customize->add_section('blog_setting', [
        'title'       => esc_html__('Blog Setting', 'businoz'),
        'description' => '',
        'priority'    => 16,
        'capability'  => 'edit_theme_options',
        'panel'       => 'businoz_customizer',
    ]);

    $wp_customize->add_section('footer_setting', [
        'title'       => esc_html__('Footer Settings', 'businoz'),
        'description' => '',
        'priority'    => 16,
        'capability'  => 'edit_theme_options',
        'panel'       => 'businoz_customizer',
    ]);

    $wp_customize->add_section('color_setting', [
        'title'       => esc_html__('Color Setting', 'businoz'),
        'description' => '',
        'priority'    => 17,
        'capability'  => 'edit_theme_options',
        'panel'       => 'businoz_customizer',
    ]);

    $wp_customize->add_section('404_page', [
        'title'       => esc_html__('404 Page', 'businoz'),
        'description' => '',
        'priority'    => 18,
        'capability'  => 'edit_theme_options',
        'panel'       => 'businoz_customizer',
    ]);

    $wp_customize->add_section('typo_setting', [
        'title'       => esc_html__('Typography Setting', 'businoz'),
        'description' => '',
        'priority'    => 21,
        'capability'  => 'edit_theme_options',
        'panel'       => 'businoz_customizer',
    ]);

    $wp_customize->add_section('slug_setting', [
        'title'       => esc_html__('Slug Settings', 'businoz'),
        'description' => '',
        'priority'    => 22,
        'capability'  => 'edit_theme_options',
        'panel'       => 'businoz_customizer',
    ]);
}

add_action('customize_register', 'businoz_customizer_panels_sections');

function _header_top_fields($fields)
{

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'businoz_topbar_switch',
        'label'    => esc_html__('Topbar Swicher', 'businoz'),
        'section'  => 'header_top_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__('Enable', 'businoz'),
            'off' => esc_html__('Disable', 'businoz'),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'businoz_header_lang',
        'label'    => esc_html__('Language Swicher', 'businoz'),
        'section'  => 'header_top_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__('Enable', 'businoz'),
            'off' => esc_html__('Disable', 'businoz'),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'businoz_preloader',
        'label'    => esc_html__('Preloader On/Off', 'businoz'),
        'section'  => 'header_top_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__('Enable', 'businoz'),
            'off' => esc_html__('Disable', 'businoz'),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'businoz_search',
        'label'    => esc_html__('Serach On/Off', 'businoz'),
        'section'  => 'header_top_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__('Enable', 'businoz'),
            'off' => esc_html__('Disable', 'businoz'),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'businoz_backtotop',
        'label'    => esc_html__('Back To Top On/Off', 'businoz'),
        'section'  => 'header_top_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__('Enable', 'businoz'),
            'off' => esc_html__('Disable', 'businoz'),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'businoz_header_right',
        'label'    => esc_html__('Header Right On/Off', 'businoz'),
        'section'  => 'header_top_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__('Enable', 'businoz'),
            'off' => esc_html__('Disable', 'businoz'),
        ],
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'businoz_email',
        'label'    => esc_html__('Email ID', 'businoz'),
        'section'  => 'header_top_setting',
        'default'  => esc_html__('info@webmail.com', 'businoz'),
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'businoz_topbar_switch',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'businoz_phone',
        'label'    => esc_html__('Phone Number', 'businoz'),
        'section'  => 'header_top_setting',
        'default'  => esc_html__('(098) 90 9090 00', 'businoz'),
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'businoz_topbar_switch',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'businoz_career_text',
        'label'    => esc_html__('Career Text', 'businoz'),
        'section'  => 'header_top_setting',
        'default'  => esc_html__('Careers: Junior UI & UX Designer, Consultant Sr.', 'businoz'),
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'businoz_topbar_switch',
                'operator' => '==',
                'value'    => true,
            ],
        ],
        'choices'  => [
            'language' => 'html',
        ],
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'businoz_address_01',
        'label'    => esc_html__('Office Address', 'businoz'),
        'section'  => 'header_top_setting',
        'default'  => esc_html__('22 Marion Street', 'businoz'),
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'businoz_topbar_switch',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'businoz_address_02',
        'label'    => esc_html__('Office Address 02', 'businoz'),
        'section'  => 'header_top_setting',
        'default'  => esc_html__(' Columbia, SC 29201', 'businoz'),
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'businoz_topbar_switch',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'businoz_open_hour',
        'label'    => esc_html__('Open Hour', 'businoz'),
        'section'  => 'header_top_setting',
        'default'  => esc_html__('Mon - Sat 8.00 - 18.00', 'businoz'),
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'businoz_topbar_switch',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'businoz_close_day',
        'label'    => esc_html__('Close Day', 'businoz'),
        'section'  => 'header_top_setting',
        'default'  => esc_html__('Sunday Closed', 'businoz'),
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'businoz_topbar_switch',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ];

    // button
    $fields[] = [
        'type'     => 'text',
        'settings' => 'businoz_button_text',
        'label'    => esc_html__('Button Text', 'businoz'),
        'section'  => 'header_top_setting',
        'default'  => esc_html__('Get Appointment', 'businoz'),
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'businoz_header_right',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ];

    $fields[] = [
        'type'     => 'link',
        'settings' => 'businoz_button_link',
        'label'    => esc_html__('Button URL', 'businoz'),
        'section'  => 'header_top_setting',
        'default'  => esc_html__('#', 'businoz'),
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'businoz_header_right',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ];


    return $fields;
}
add_filter('kirki/fields', '_header_top_fields');

/*
Header Social
 */
function _header_social_fields($fields)
{
    // header section social
    $fields[] = [
        'type'     => 'text',
        'settings' => 'businoz_topbar_fb_url',
        'label'    => esc_html__('Facebook Url', 'businoz'),
        'section'  => 'header_social',
        'default'  => esc_html__('#', 'businoz'),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'businoz_topbar_twitter_url',
        'label'    => esc_html__('Twitter Url', 'businoz'),
        'section'  => 'header_social',
        'default'  => esc_html__('#', 'businoz'),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'businoz_topbar_linkedin_url',
        'label'    => esc_html__('Linkedin Url', 'businoz'),
        'section'  => 'header_social',
        'default'  => esc_html__('#', 'businoz'),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'businoz_topbar_instagram_url',
        'label'    => esc_html__('Instagram Url', 'businoz'),
        'section'  => 'header_social',
        'default'  => esc_html__('#', 'businoz'),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'businoz_topbar_vimeo_url',
        'label'    => esc_html__('Vimeo Url', 'businoz'),
        'section'  => 'header_social',
        'default'  => esc_html__('#', 'businoz'),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'businoz_topbar_youtube_url',
        'label'    => esc_html__('Youtube Url', 'businoz'),
        'section'  => 'header_social',
        'default'  => esc_html__('#', 'businoz'),
        'priority' => 10,
    ];


    return $fields;
}
add_filter('kirki/fields', '_header_social_fields');



/*
Sidebar Social
 */
function _sidebar_social_fields($fields)
{
    // Sidebar section social
    $fields[] = [
        'type'     => 'text',
        'settings' => 'businoz_sidebar_fb_url',
        'label'    => esc_html__('Facebook Url', 'businoz'),
        'section'  => 'sidebar_social',
        'default'  => esc_html__('#', 'businoz'),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'businoz_sidebar_twitter_url',
        'label'    => esc_html__('Twitter Url', 'businoz'),
        'section'  => 'sidebar_social',
        'default'  => esc_html__('#', 'businoz'),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'businoz_sidebar_linkedin_url',
        'label'    => esc_html__('Linkedin Url', 'businoz'),
        'section'  => 'sidebar_social',
        'default'  => esc_html__('#', 'businoz'),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'businoz_sidebar_instagram_url',
        'label'    => esc_html__('Instagram Url', 'businoz'),
        'section'  => 'sidebar_social',
        'default'  => esc_html__('#', 'businoz'),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'businoz_sidebar_vimeo_url',
        'label'    => esc_html__('Vimeo Url', 'businoz'),
        'section'  => 'sidebar_social',
        'default'  => esc_html__('#', 'businoz'),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'businoz_sidebar_youtube_url',
        'label'    => esc_html__('Youtube Url', 'businoz'),
        'section'  => 'sidebar_social',
        'default'  => esc_html__('#', 'businoz'),
        'priority' => 10,
    ];

    return $fields;
}
add_filter('kirki/fields', '_sidebar_social_fields');



/*
Footer Social
 */
function _footer_social_fields($fields)
{
    // header section social
    $fields[] = [
        'type'     => 'text',
        'settings' => 'businoz_footer_fb_url',
        'label'    => esc_html__('Facebook Url', 'businoz'),
        'section'  => 'footer_social',
        'default'  => esc_html__('#', 'businoz'),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'businoz_footer_twitter_url',
        'label'    => esc_html__('Twitter Url', 'businoz'),
        'section'  => 'footer_social',
        'default'  => esc_html__('#', 'businoz'),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'businoz_footer_instagram_url',
        'label'    => esc_html__('Instagram Url', 'businoz'),
        'section'  => 'footer_social',
        'default'  => esc_html__('#', 'businoz'),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'businoz_footer_linkedin_url',
        'label'    => esc_html__('Linkedin Url', 'businoz'),
        'section'  => 'footer_social',
        'default'  => esc_html__('#', 'businoz'),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'businoz_footer_youtube_url',
        'label'    => esc_html__('Youtube Url', 'businoz'),
        'section'  => 'footer_social',
        'default'  => esc_html__('#', 'businoz'),
        'priority' => 10,
    ];


    return $fields;
}
add_filter('kirki/fields', '_footer_social_fields');


/*
Header Settings
 */
function _header_header_fields($fields)
{


    $fields[] = [
        'type'        => 'radio-image',
        'settings'    => 'choose_default_header',
        'label'       => esc_html__('Select Header Style', 'businoz'),
        'section'     => 'section_header_logo',
        'placeholder' => esc_html__('Select an option...', 'businoz'),
        'priority'    => 10,
        'multiple'    => 1,
        'choices'     => [
            'header-style-1'  => get_template_directory_uri() . '/inc/img/header/header-1.png',
            'header-style-2'  => get_template_directory_uri() . '/inc/img/header/header-2.png',
            'header-style-3'  => get_template_directory_uri() . '/inc/img/header/header-3.png',
            'header-style-4'  => get_template_directory_uri() . '/inc/img/header/header-4.png',
            'header-style-5'  => get_template_directory_uri() . '/inc/img/header/header-5.png',
            'header-style-6'  => get_template_directory_uri() . '/inc/img/header/header-1.png',
        ],
        'default'     => 'header-style-1',
    ];

    $fields[] = [
        'type'        => 'image',
        'settings'    => 'logo',
        'label'       => esc_html__('Header Logo', 'businoz'),
        'description' => esc_html__('Upload Your Logo.', 'businoz'),
        'section'     => 'section_header_logo',
        'default'     => get_template_directory_uri() . '/assets/img/logo/logo.png',
    ];

    $fields[] = [
        'type'        => 'image',
        'settings'    => 'seconday_logo',
        'label'       => esc_html__('Header Secondary Logo', 'businoz'),
        'description' => esc_html__('Header Logo white', 'businoz'),
        'section'     => 'section_header_logo',
        'default'     => get_template_directory_uri() . '/assets/img/logo/logo-3.png',
    ];

    $fields[] = [
        'type'        => 'slider',
        'settings'    => 'businoz_logo_size',
        'label'       => esc_html__('Header Logo Size', 'businoz'),
        'description' => esc_html__('Header Logo Size', 'businoz'),
        'section'     => 'section_header_logo',
        'default' => '153px',
        'choices'     => [
            'min'  => 100,
            'max'  => 400,
            'step' => 4,
        ],
    ];

    return $fields;
}
add_filter('kirki/fields', '_header_header_fields');

/*
Header Side Info
 */
function _header_side_fields($fields)
{
    // side info settings
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'businoz_side_logo_hide',
        'label'    => esc_html__('Side logo On/Off', 'businoz'),
        'section'  => 'header_side_setting',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__('Enable', 'businoz'),
            'off' => esc_html__('Disable', 'businoz'),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'businoz_side_search',
        'label'    => esc_html__('Side Serach On/Off', 'businoz'),
        'section'  => 'header_side_setting',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__('Enable', 'businoz'),
            'off' => esc_html__('Disable', 'businoz'),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'businoz_side_dec_hide',
        'label'    => esc_html__('Side Desc On/Off', 'businoz'),
        'section'  => 'header_side_setting',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__('Enable', 'businoz'),
            'off' => esc_html__('Disable', 'businoz'),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'businoz_side_map_hide',
        'label'    => esc_html__('Side Map On/Off', 'businoz'),
        'section'  => 'header_side_setting',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__('Enable', 'businoz'),
            'off' => esc_html__('Disable', 'businoz'),
        ],
    ];


    $fields[] = [
        'type'     => 'switch',
        'settings' => 'businoz_contact_info_hide',
        'label'    => esc_html__('Side Contact Info On/Off', 'businoz'),
        'section'  => 'header_side_setting',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__('Enable', 'businoz'),
            'off' => esc_html__('Disable', 'businoz'),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'businoz_side_social_hide',
        'label'    => esc_html__('Side Social On/Off', 'businoz'),
        'section'  => 'header_side_setting',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__('Enable', 'businoz'),
            'off' => esc_html__('Disable', 'businoz'),
        ],
    ];

    $fields[] = [
        'type'        => 'image',
        'settings'    => 'side_logo',
        'label'       => esc_html__('Sidebar Logo', 'businoz'),
        'description' => esc_html__('Upload Side Logo.', 'businoz'),
        'section'     => 'header_side_setting',
        'default'     => get_template_directory_uri() . '/assets/img/logo/logo-3.png',
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'businoz_side_dec',
        'label'    => esc_html__('Side Description', 'businoz'),
        'section'  => 'header_side_setting',
        'default'  => esc_html__('We are a creative film and photo production company hungry for quality.', 'businoz'),
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'businoz_side_dec_hide',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ];

    $fields[] = [
        'type'     => 'link',
        'settings' => 'businoz_side_map_url',
        'label'    => esc_html__('Map URL', 'businoz'),
        'section'  => 'header_side_setting',
        'default'  => esc_html__('https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d29176.030811137334!2d90.3883827!3d23.924917699999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sbd!4v1605272373598!5m2!1sen!2sbd', 'businoz'),
        'priority' => 10,
    ];

    // contact
    $fields[] = [
        'type'     => 'text',
        'settings' => 'businoz_contact_title',
        'label'    => esc_html__('Contact Title', 'businoz'),
        'section'  => 'header_side_setting',
        'default'  => esc_html__('Contact Title', 'businoz'),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'businoz_extra_address',
        'label'    => esc_html__('Office Address', 'businoz'),
        'section'  => 'header_side_setting',
        'default'  => esc_html__('28/4 Palmal, London', 'businoz'),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'businoz_extra_phone',
        'label'    => esc_html__('Phone Number', 'businoz'),
        'section'  => 'header_side_setting',
        'default'  => esc_html__('333 888 200 - 55', 'businoz'),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'businoz_extra_email',
        'label'    => esc_html__('Email ID', 'businoz'),
        'section'  => 'header_side_setting',
        'default'  => esc_html__('info@businoz.com', 'businoz'),
        'priority' => 10,
    ];

    return $fields;
}
add_filter('kirki/fields', '_header_side_fields');

/*
_header_page_title_fields
 */
function _header_page_title_fields($fields)
{
    // Breadcrumb Setting
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'businoz_breadcrumb_shape_switch',
        'label'    => esc_html__('Shape Show/Hide', 'businoz'),
        'section'  => 'breadcrumb_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__('Enable', 'businoz'),
            'off' => esc_html__('Disable', 'businoz'),
        ],
    ];

    $fields[] = [
        'type'        => 'image',
        'settings'    => 'breadcrumb_bg_img',
        'label'       => esc_html__('Breadcrumb Background Image', 'businoz'),
        'description' => esc_html__('Breadcrumb Background Image', 'businoz'),
        'section'     => 'breadcrumb_setting',
        'default'     => get_template_directory_uri() . '/assets/img/breadcrumb/breadcrumb-1.jpg',
    ];

    $fields[] = [
        'type'        => 'image',
        'settings'    => 'breadcrumb_img',
        'label'       => esc_html__('Breadcrumb Image', 'businoz'),
        'description' => esc_html__('Breadcrumb Image', 'businoz'),
        'section'     => 'breadcrumb_setting',
        'default'     => get_template_directory_uri() . '/assets/img/hero/breadcrumb.png',
    ];

    $fields[] = [
        'type'        => 'color',
        'settings'    => 'businoz_breadcrumb_bg_color',
        'label'       => __('Breadcrumb BG Color', 'businoz'),
        'description' => esc_html__('This is a Breadcrumb bg color control.', 'businoz'),
        'section'     => 'breadcrumb_setting',
        'default'     => '#f4f9fc',
        'priority'    => 10,
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'breadcrumb_info_switch',
        'label'    => esc_html__('Breadcrumb Info switch', 'businoz'),
        'section'  => 'breadcrumb_setting',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__('Enable', 'businoz'),
            'off' => esc_html__('Disable', 'businoz'),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'breadcrumb_subtitle_switch',
        'label'    => esc_html__('Breadcrumb SubTitle switch', 'businoz'),
        'section'  => 'breadcrumb_setting',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__('Enable', 'businoz'),
            'off' => esc_html__('Disable', 'businoz'),
        ],
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'businoz_breadcrumb_subtitle',
        'label'    => esc_html__('Breadcrumb SubTitle', 'businoz'),
        'section'  => 'breadcrumb_setting',
        'default'  => esc_html__('Welcome To Our Agency', 'businoz'),
        'priority' => 10,
    ];

    return $fields;
}
add_filter('kirki/fields', '_header_page_title_fields');

/*
Header Social
 */
function _header_blog_fields($fields)
{
    // Blog Setting
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'businoz_blog_btn_switch',
        'label'    => esc_html__('Blog BTN On/Off', 'businoz'),
        'section'  => 'blog_setting',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__('Enable', 'businoz'),
            'off' => esc_html__('Disable', 'businoz'),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'businoz_blog_cat',
        'label'    => esc_html__('Blog Category Meta On/Off', 'businoz'),
        'section'  => 'blog_setting',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__('Enable', 'businoz'),
            'off' => esc_html__('Disable', 'businoz'),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'businoz_blog_author',
        'label'    => esc_html__('Blog Author Meta On/Off', 'businoz'),
        'section'  => 'blog_setting',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__('Enable', 'businoz'),
            'off' => esc_html__('Disable', 'businoz'),
        ],
    ];
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'businoz_blog_date',
        'label'    => esc_html__('Blog Date Meta On/Off', 'businoz'),
        'section'  => 'blog_setting',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__('Enable', 'businoz'),
            'off' => esc_html__('Disable', 'businoz'),
        ],
    ];
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'businoz_blog_comments',
        'label'    => esc_html__('Blog Comments Meta On/Off', 'businoz'),
        'section'  => 'blog_setting',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__('Enable', 'businoz'),
            'off' => esc_html__('Disable', 'businoz'),
        ],
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'businoz_blog_btn',
        'label'    => esc_html__('Blog Button text', 'businoz'),
        'section'  => 'blog_setting',
        'default'  => esc_html__('Read More', 'businoz'),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'breadcrumb_blog_title',
        'label'    => esc_html__('Blog Title', 'businoz'),
        'section'  => 'blog_setting',
        'default'  => esc_html__('Blog', 'businoz'),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'breadcrumb_blog_title_details',
        'label'    => esc_html__('Blog Details Title', 'businoz'),
        'section'  => 'blog_setting',
        'default'  => esc_html__('Blog Details', 'businoz'),
        'priority' => 10,
    ];
    return $fields;
}
add_filter('kirki/fields', '_header_blog_fields');

/*
Footer
 */
function _header_footer_fields($fields)
{
    // Footer Setting
    $fields[] = [
        'type'        => 'radio-image',
        'settings'    => 'choose_default_footer',
        'label'       => esc_html__('Choose Footer Style', 'businoz'),
        'section'     => 'footer_setting',
        'default'     => '5',
        'placeholder' => esc_html__('Select an option...', 'businoz'),
        'priority'    => 10,
        'multiple'    => 1,
        'choices'     => [
            'footer-style-1' => get_template_directory_uri() . '/inc/img/footer/footer-1.png',
            'footer-style-2' => get_template_directory_uri() . '/inc/img/footer/footer-2.png',
            'footer-style-3' => get_template_directory_uri() . '/inc/img/footer/footer-3.png',
            'footer-style-4' => get_template_directory_uri() . '/inc/img/footer/footer-4.png',
            'footer-style-5' => get_template_directory_uri() . '/inc/img/footer/footer-5.png',
        ],
        'default'     => 'footer-style-1',
    ];


    $fields[] = [
        'type'        => 'select',
        'settings'    => 'footer_widget_number',
        'label'       => esc_html__('Widget Number', 'businoz'),
        'section'     => 'footer_setting',
        'default'     => '4',
        'placeholder' => esc_html__('Select an option...', 'businoz'),
        'priority'    => 10,
        'multiple'    => 1,
        'choices'     => [
            '4' => esc_html__('Widget Number 4', 'businoz'),
            '3' => esc_html__('Widget Number 3', 'businoz'),
            '2' => esc_html__('Widget Number 2', 'businoz'),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'businoz_footer_shape_switch',
        'label'    => esc_html__('Footer Shape On/Off', 'businoz'),
        'section'  => 'footer_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__('Enable', 'businoz'),
            'off' => esc_html__('Disable', 'businoz'),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'businoz_footer_logo_switch',
        'label'    => esc_html__('Footer Logo On/Off', 'businoz'),
        'section'  => 'footer_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__('Enable', 'businoz'),
            'off' => esc_html__('Disable', 'businoz'),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'businoz_footer_menu_switch',
        'label'    => esc_html__('Footer Menu On/Off', 'businoz'),
        'section'  => 'footer_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__('Enable', 'businoz'),
            'off' => esc_html__('Disable', 'businoz'),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'businoz_social_switch',
        'label'    => esc_html__('Footer Social On/Off', 'businoz'),
        'section'  => 'footer_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__('Enable', 'businoz'),
            'off' => esc_html__('Disable', 'businoz'),
        ],
    ];

    $fields[] = [
        'type'        => 'image',
        'settings'    => 'businoz_footer_bg',
        'label'       => esc_html__('Footer Background Image.', 'businoz'),
        'description' => esc_html__('Footer Background Image.', 'businoz'),
        'section'     => 'footer_setting',
        'default'     => get_template_directory_uri() . '/assets/img/footer/footer-bg.jpg',
    ];

    $fields[] = [
        'type'        => 'image',
        'settings'    => 'businoz_footer_logo',
        'label'       => esc_html__('Footer Logo', 'businoz'),
        'description' => esc_html__('Upload Your Logo.', 'businoz'),
        'section'     => 'footer_setting',
        'default'     => get_template_directory_uri() . '/assets/img/logo/logo-10.png',
    ];

    $fields[] = [
        'type'        => 'color',
        'settings'    => 'businoz_footer_bg_color',
        'label'       => __('Footer BG Color', 'businoz'),
        'description' => esc_html__('This is a Footer bg color control.', 'businoz'),
        'section'     => 'footer_setting',
        'default'     => '#f4f9fc',
        'priority'    => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'businoz_footer_phone',
        'label'    => esc_html__('Footer Phone', 'businoz'),
        'section'  => 'footer_setting',
        'default'  => esc_html__('(+88) 258 - 241 - 302', 'businoz'),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'businoz_footer_email',
        'label'    => esc_html__('Footer Email', 'businoz'),
        'section'  => 'footer_setting',
        'default'  => esc_html__('info@example.com', 'businoz'),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'link',
        'settings' => 'footer_menu_link1',
        'label'    => esc_html__('Footer URL 01', 'businoz'),
        'section'  => 'footer_setting',
        'default'  => esc_html__('#', 'businoz'),
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'businoz_footer_menu_switch',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ];

    $fields[] = [
        'type'     => 'link',
        'settings' => 'footer_menu_link2',
        'label'    => esc_html__('Footer URL 02', 'businoz'),
        'section'  => 'footer_setting',
        'default'  => esc_html__('#', 'businoz'),
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'businoz_footer_menu_switch',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ];

    $fields[] = [
        'type'     => 'link',
        'settings' => 'footer_menu_link3',
        'label'    => esc_html__('Footer URL 03', 'businoz'),
        'section'  => 'footer_setting',
        'default'  => esc_html__('#', 'businoz'),
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'businoz_footer_menu_switch',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'businoz_copyright',
        'label'    => esc_html__('Copy Right', 'businoz'),
        'section'  => 'footer_setting',
        'default'  => esc_html__('© 2022 All rights reserved | Design & Develop by BDevs', 'businoz'),
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'footer_copyright_switch',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ];
    return $fields;
}
add_filter('kirki/fields', '_header_footer_fields');

// color
function businoz_color_fields($fields)
{
    // Color Settings
    $fields[] = [
        'type'        => 'color',
        'settings'    => 'businoz_color_option',
        'label'       => __('Theme Color', 'businoz'),
        'description' => esc_html__('This is a Theme color control.', 'businoz'),
        'section'     => 'color_setting',
        'default'     => '#0e51ac',
        'priority'    => 10,
    ];
    $fields[] = [
        'type'        => 'color',
        'settings'    => 'businoz_secondary_color',
        'label'       => __('Secondary Color', 'businoz'),
        'description' => esc_html__('This is a Secondary color control.', 'businoz'),
        'section'     => 'color_setting',
        'default'     => '#0e51ac',
        'priority'    => 10,
    ];


    return $fields;
}
add_filter('kirki/fields', 'businoz_color_fields');

// 404
function businoz_404_fields($fields)
{
    // 404 settings
    $fields[] = [
        'type'        => 'image',
        'settings'    => 'businoz_404_bg',
        'label'       => esc_html__('404 Image.', 'businoz'),
        'description' => esc_html__('404 Image.', 'businoz'),
        'section'     => '404_page',
    ];
    $fields[] = [
        'type'     => 'text',
        'settings' => 'businoz_error_title',
        'label'    => esc_html__('Not Found Title', 'businoz'),
        'section'  => '404_page',
        'default'  => esc_html__('Page not found', 'businoz'),
        'priority' => 10,
    ];
    $fields[] = [
        'type'     => 'textarea',
        'settings' => 'businoz_error_desc',
        'label'    => esc_html__('404 Description Text', 'businoz'),
        'section'  => '404_page',
        'default'  => esc_html__('Oops! The page you are looking for does not exist. It might have been moved or deleted', 'businoz'),
        'priority' => 10,
    ];
    $fields[] = [
        'type'     => 'text',
        'settings' => 'businoz_error_link_text',
        'label'    => esc_html__('404 Link Text', 'businoz'),
        'section'  => '404_page',
        'default'  => esc_html__('Back To Home', 'businoz'),
        'priority' => 10,
    ];
    return $fields;
}
add_filter('kirki/fields', 'businoz_404_fields');



/**
 * Added Fields
 */
function businoz_typo_fields($fields)
{
    // typography settings
    $fields[] = [
        'type'        => 'typography',
        'settings'    => 'typography_body_setting',
        'label'       => esc_html__('Body Font', 'businoz'),
        'section'     => 'typo_setting',
        'default'     => [
            'font-family'    => '',
            'variant'        => '',
            'font-size'      => '',
            'line-height'    => '',
            'letter-spacing' => '0',
            'color'          => '',
        ],
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => 'body',
            ],
        ],
    ];

    $fields[] = [
        'type'        => 'typography',
        'settings'    => 'typography_h_setting',
        'label'       => esc_html__('Heading h1 Fonts', 'businoz'),
        'section'     => 'typo_setting',
        'default'     => [
            'font-family'    => '',
            'variant'        => '',
            'font-size'      => '',
            'line-height'    => '',
            'letter-spacing' => '0',
            'color'          => '',
        ],
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => 'h1',
            ],
        ],
    ];

    $fields[] = [
        'type'        => 'typography',
        'settings'    => 'typography_h2_setting',
        'label'       => esc_html__('Heading h2 Fonts', 'businoz'),
        'section'     => 'typo_setting',
        'default'     => [
            'font-family'    => '',
            'variant'        => '',
            'font-size'      => '',
            'line-height'    => '',
            'letter-spacing' => '0',
            'color'          => '',
        ],
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => 'h2',
            ],
        ],
    ];

    $fields[] = [
        'type'        => 'typography',
        'settings'    => 'typography_h3_setting',
        'label'       => esc_html__('Heading h3 Fonts', 'businoz'),
        'section'     => 'typo_setting',
        'default'     => [
            'font-family'    => '',
            'variant'        => '',
            'font-size'      => '',
            'line-height'    => '',
            'letter-spacing' => '0',
            'color'          => '',
        ],
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => 'h3',
            ],
        ],
    ];

    $fields[] = [
        'type'        => 'typography',
        'settings'    => 'typography_h4_setting',
        'label'       => esc_html__('Heading h4 Fonts', 'businoz'),
        'section'     => 'typo_setting',
        'default'     => [
            'font-family'    => '',
            'variant'        => '',
            'font-size'      => '',
            'line-height'    => '',
            'letter-spacing' => '0',
            'color'          => '',
        ],
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => 'h4',
            ],
        ],
    ];

    $fields[] = [
        'type'        => 'typography',
        'settings'    => 'typography_h5_setting',
        'label'       => esc_html__('Heading h5 Fonts', 'businoz'),
        'section'     => 'typo_setting',
        'default'     => [
            'font-family'    => '',
            'variant'        => '',
            'font-size'      => '',
            'line-height'    => '',
            'letter-spacing' => '0',
            'color'          => '',
        ],
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => 'h5',
            ],
        ],
    ];

    $fields[] = [
        'type'        => 'typography',
        'settings'    => 'typography_h6_setting',
        'label'       => esc_html__('Heading h6 Fonts', 'businoz'),
        'section'     => 'typo_setting',
        'default'     => [
            'font-family'    => '',
            'variant'        => '',
            'font-size'      => '',
            'line-height'    => '',
            'letter-spacing' => '0',
            'color'          => '',
        ],
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => 'h6',
            ],
        ],
    ];
    return $fields;
}

add_filter('kirki/fields', 'businoz_typo_fields');




/**
 * Added Fields
 */
function businoz_slug_setting($fields)
{
    // slug settings
    $fields[] = [
        'type'     => 'text',
        'settings' => 'businoz_ev_slug',
        'label'    => esc_html__('Event Slug', 'businoz'),
        'section'  => 'slug_setting',
        'default'  => esc_html__('ourevent', 'businoz'),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'businoz_port_slug',
        'label'    => esc_html__('Portfolio Slug', 'businoz'),
        'section'  => 'slug_setting',
        'default'  => esc_html__('ourportfolio', 'businoz'),
        'priority' => 10,
    ];

    return $fields;
}

add_filter('kirki/fields', 'businoz_slug_setting');


/**
 * This is a short hand function for getting setting value from customizer
 *
 * @param string $name
 *
 * @return bool|string
 */
function BUSINOZ_THEME_option($name)
{
    $value = '';
    if (class_exists('businoz')) {
        $value = Kirki::get_option(businoz_get_theme(), $name);
    }

    return apply_filters('BUSINOZ_THEME_option', $value, $name);
}

/**
 * Get config ID
 *
 * @return string
 */
function businoz_get_theme()
{
    return 'businoz';
}
