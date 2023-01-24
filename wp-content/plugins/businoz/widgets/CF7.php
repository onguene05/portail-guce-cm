<?php

namespace Bdevs\Elementor;

defined('ABSPATH') || die();

class CF7 extends \Generic\Elements\GenericWidget
{

    /**
     * Get widget name.
     *
     * Retrieve Bdevs Element widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name()
    {
        return 'cust-contact-form';
    }

    /**
     * Get widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */

    public function get_title()
    {
        return __('Contact Form', 'bdevs-elementor');
    }

    public function get_custom_help_url()
    {
        return 'http://elementor.bdevs.net/bdevselementor/contact-form/';
    }

     public function get_script_depends()
    {
        return ['bootstrap', 'genwow', 'swiper', 'bdevs-elementor-js'];
    }
     public function get_style_depends()
    {
        return ['bootstrap', 'fontawesome', 'swiper', 'bdevs-elementor-flaticon', 'bdevs-elementor-css'];
    }

    /**
     * Get widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */

    public function get_icon()
    {
        return 'eicon-save-o gen-icon';
    }

    public function get_keywords()
    {
        return ['skill', 'blurb', 'infobox', 'contact form', 'block', 'box'];
    }

    public function get_categories()
    {
        return ['bdevs-elementor'];
    }


    protected static function get_profile_names()
    {
        return [
            'fal fa-comments' => __('Comments', 'bdevs-elementor'),
            'apple' => __('Apple', 'bdevs-elementor'),
            'behance' => __('Behance', 'bdevs-elementor'),
            'bitbucket' => __('BitBucket', 'bdevs-elementor'),
            'codepen' => __('CodePen', 'bdevs-elementor'),
            'delicious' => __('Delicious', 'bdevs-elementor'),
            'deviantart' => __('DeviantArt', 'bdevs-elementor'),
            'digg' => __('Digg', 'bdevs-elementor'),
            'dribbble' => __('Dribbble', 'bdevs-elementor'),
            'email' => __('Email', 'bdevs-elementor'),
            'facebook' => __('Facebook', 'bdevs-elementor'),
            'flickr' => __('Flicker', 'bdevs-elementor'),
            'foursquare' => __('FourSquare', 'bdevs-elementor'),
            'github' => __('Github', 'bdevs-elementor'),
            'houzz' => __('Houzz', 'bdevs-elementor'),
            'instagram' => __('Instagram', 'bdevs-elementor'),
            'jsfiddle' => __('JS Fiddle', 'bdevs-elementor'),
            'linkedin' => __('LinkedIn', 'bdevs-elementor'),
            'medium' => __('Medium', 'bdevs-elementor'),
            'pinterest' => __('Pinterest', 'bdevs-elementor'),
            'product-hunt' => __('Product Hunt', 'bdevs-elementor'),
            'reddit' => __('Reddit', 'bdevs-elementor'),
            'slideshare' => __('Slide Share', 'bdevs-elementor'),
            'snapchat' => __('Snapchat', 'bdevs-elementor'),
            'soundcloud' => __('SoundCloud', 'bdevs-elementor'),
            'spotify' => __('Spotify', 'bdevs-elementor'),
            'stack-overflow' => __('StackOverflow', 'bdevs-elementor'),
            'tripadvisor' => __('TripAdvisor', 'bdevs-elementor'),
            'tumblr' => __('Tumblr', 'bdevs-elementor'),
            'twitch' => __('Twitch', 'bdevs-elementor'),
            'twitter' => __('Twitter', 'bdevs-elementor'),
            'vimeo' => __('Vimeo', 'bdevs-elementor'),
            'vk' => __('VK', 'bdevs-elementor'),
            'website' => __('Website', 'bdevs-elementor'),
            'whatsapp' => __('WhatsApp', 'bdevs-elementor'),
            'wordpress' => __('WordPress', 'bdevs-elementor'),
            'xing' => __('Xing', 'bdevs-elementor'),
            'yelp' => __('Yelp', 'bdevs-elementor'),
            'youtube' => __('YouTube', 'bdevs-elementor'),
        ];
    }

    public function get_tp_contact_form(){
        if ( ! class_exists( 'WPCF7' ) ) {
            return;
        }
        $tp_cfa         = array();
        $tp_cf_args     = array( 'posts_per_page' => -1, 'post_type'=> 'wpcf7_contact_form' );
        $tp_forms       = get_posts( $tp_cf_args );
        $tp_cfa         = ['0' => esc_html__( 'Select Form', 'tpcore' ) ];
        if( $tp_forms ){
            foreach ( $tp_forms as $tp_form ){
                $tp_cfa[$tp_form->ID] = $tp_form->post_title;
            }
        }else{
            $tp_cfa[ esc_html__( 'No contact form found', 'bdevs-elementor' ) ] = 0;
        }
        return $tp_cfa;
    }


    protected function register_content_controls() {
        $this->design_style();
        $this->title_and_desc();
        $this->contact_form07();
        $this->images();
        $this->button();
        $this->social_profile();
        $this->button_gradient();

    } 

    public function design_style() { 
        $this->start_controls_section(
            '_section_design_title',
            [
                'label' => __('Presets', 'bdevs-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'designs',
            [
                'label' => __('Designs', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'design_1' => __('Design 1', 'bdevs-elementor'),
                    'design_2' => __('Design 2', 'bdevs-elementor'),
                    'design_3' => __('Design 3', 'bdevs-elementor'),
                    'design_4' => __('Design 4', 'bdevs-elementor'),
                    'design_5' => __('Design 5', 'bdevs-elementor'),
                ],
                'default' => 'design_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $this->end_controls_section();
    }


    public function title_and_desc() { 
        $this->start_controls_section(
            '_section_title',
            [
                'label' => __('Title & Description', 'bdevs-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'shape_switch',
            [
                'label' => __('Shape SWITCHER', 'bdevselement'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'bdevselement'),
                'label_off' => __('Hide', 'bdevselement'),
                'return_value' => 'yes',
                'default' => 'yes',
                'style_transfer' => true,
                'condition' => [
                    'designs' => ['design_5'],
                ],
            ]
        );  

        $this->add_control(
            'sub_title',
            [
                'label' => __('Sub Title', 'bdevs-elementor'),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('bdevs Info Box Sub Title', 'bdevs-elementor'),
                'placeholder' => __('Type Info Box Sub Title', 'bdevs-elementor'),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'designs' => ['design_1', 'design_3', 'design_4', 'design_5'],
                ],
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __('Title', 'bdevs-elementor'),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __('bdevs Info Box Title', 'bdevs-elementor'),
                'placeholder' => __('Type Info Box Title', 'bdevs-elementor'),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'designs' => ['design_1', 'design_3', 'design_4', 'design_5'],
                ],
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => __('Description', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __('bdevs info box description goes here', 'bdevs-elementor'),
                'placeholder' => __('Type info box description', 'bdevs-elementor'),
                'rows' => 5,
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'designs' => ['design_3', 'design_4', 'design_5'],
                ],
            ]
        );

        $this->add_control(
            'email',
            [
                'label' => __('Email', 'bdevs-elementor'),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('info@webmail.com', 'bdevs-elementor'),
                'placeholder' => __('Type Info Box email', 'bdevs-elementor'),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'designs' => ['design_3', 'design_4', 'design_5'],
                ],
            ]
        );

        $this->add_control(
            'phone_number',
            [
                'label' => __('Phone Number', 'bdevs-elementor'),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('785 680 659 00', 'bdevs-elementor'),
                'placeholder' => __('Type Info Box phone Number', 'bdevs-elementor'),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'designs' => ['design_3', 'design_4', 'design_5'],
                ],
            ]
        );

        $this->add_control(
            'address',
            [
                'label' => __('Address', 'bdevs-elementor'),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('12/A, New York, US', 'bdevs-elementor'),
                'placeholder' => __('Type Info Box Address', 'bdevs-elementor'),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'designs' => ['design_4'],
                ],
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label' => __('Title HTML Tag', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'h1' => [
                        'title' => __('H1', 'bdevs-elementor'),
                        'icon' => 'eicon-editor-h1'
                    ],
                    'h2' => [
                        'title' => __('H2', 'bdevs-elementor'),
                        'icon' => 'eicon-editor-h2'
                    ],
                    'h3' => [
                        'title' => __('H3', 'bdevs-elementor'),
                        'icon' => 'eicon-editor-h3'
                    ],
                    'h4' => [
                        'title' => __('H4', 'bdevs-elementor'),
                        'icon' => 'eicon-editor-h4'
                    ],
                    'h5' => [
                        'title' => __('H5', 'bdevs-elementor'),
                        'icon' => 'eicon-editor-h5'
                    ],
                    'h6' => [
                        'title' => __('H6', 'bdevs-elementor'),
                        'icon' => 'eicon-editor-h6'
                    ]
                ],
                'default' => 'h2',
                'toggle' => false,
            ]
        );

        $this->add_responsive_control(
            'align',
            [
                'label' => __('Alignment', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'bdevs-elementor'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'bdevs-elementor'),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'bdevs-elementor'),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}}' => 'text-align: {{VALUE}};'
                ]
            ]
        );

        $this->end_controls_section();
    }

    public function contact_form07() {
        $this->start_controls_section(
            'tpcore_contact',
            [
                'label' => esc_html__('Contact Form', 'tpcore'),
            ]
        );

        $this->add_control(
            'tpcore_select_contact_form',
            [
                'label'   => esc_html__( 'Select Form', 'tpcore' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'default' => '0',
                'options' => $this->get_tp_contact_form(),
            ]
        );

        $this->end_controls_section();
    }

    public function images() {
        $this->start_controls_section(
            '_section_about_image',
            [
                'label' => __('Image', 'bdevs-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'designs' => ['design_10'],
                ],
            ]
        );

        $this->add_control(
            'bg_image',
            [
                'type' => \Elementor\Controls_Manager::MEDIA,
                'label' => __('Bg Image', 'bdevs-elementor'),
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'large',
                'separator' => 'none',
            ]
        );

        $this->end_controls_section();
    }

    public function button(){
        // Button 01
        $this->start_controls_section(
            '_section_button',
            [
                'label' => __('Button', 'bdevs-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'designs' => ['design_10'],
                ],     
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => __('Text', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Button Text', 'bdevs-elementor'),
                'placeholder' => __('Type button text here', 'bdevs-elementor'),
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'button_link',
            [
                'label' => __('Link', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => __('http://elementor.bdevs.net/', 'bdevs-elementor'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'button_icon',
            [
                'label' => __('Icon', 'bdevs-elementor'),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::ICON,
                'default' => 'fa fa-angle-right',
            ]
        );

        $this->add_control(
            'button_selected_icon',
            [
                'type' => \Elementor\Controls_Manager::ICONS,
                'fa4compatibility' => 'button_icon',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'button_icon_position',
            [
                'label' => __('Icon Position', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'before' => [
                        'title' => __('Before', 'bdevs-elementor'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'after' => [
                        'title' => __('After', 'bdevs-elementor'),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'default' => 'after',
                'toggle' => false,
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'button_icon_spacing',
            [
                'label' => __('Icon Spacing', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'default' => [
                    'size' => 10
                ],
                'selectors' => [
                    '{{WRAPPER}} .btn--icon-before .btn-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .btn--icon-after .btn-icon' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    public function social_profile() {
        $this->start_controls_section(
            '_section_social',
            [
                'label' => __('Social Profiles', 'bdevs-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'designs' => ['design_4'],
                ],
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'name',
            [
                'label' => __('Profile Name', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'select2options' => [
                    'allowClear' => false,
                ],
                'options' => self::get_profile_names()
            ]
        );

        $repeater->add_control(
            'link', [
                'label' => __('Profile Link', 'bdevs-elementor'),
                'placeholder' => __('Add your profile link', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::URL,
                'label_block' => true,
                'autocomplete' => false,
                'show_external' => false,
                'condition' => [
                    'name!' => 'email'
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'email', [
                'label' => __('Email Address', 'bdevs-elementor'),
                'placeholder' => __('Add your email address', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => false,
                'input_type' => 'email',
                'condition' => [
                    'name' => 'email'
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'customize',
            [
                'label' => __('Want To Customize?', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'bdevs-elementor'),
                'label_off' => __('No', 'bdevs-elementor'),
                'return_value' => 'yes',
                'style_transfer' => true,
            ]
        );

        $repeater->start_controls_tabs(
            '_tab_icon_colors',
            [
                'condition' => ['customize' => 'yes']
            ]
        );

        $repeater->start_controls_tab(
            '_tab_icon_normal',
            [
                'label' => __('Normal', 'bdevs-elementor'),
            ]
        );

        $repeater->add_control(
            'color',
            [
                'label' => __('Text Color', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-member-links > {{CURRENT_ITEM}}' => 'color: {{VALUE}}',
                ],
                'condition' => ['customize' => 'yes'],
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'bg_color',
            [
                'label' => __('Background Color', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-member-links > {{CURRENT_ITEM}}' => 'background-color: {{VALUE}}',
                ],
                'condition' => ['customize' => 'yes'],
                'style_transfer' => true,
            ]
        );

        $repeater->end_controls_tab();
        $repeater->start_controls_tab(
            '_tab_icon_hover',
            [
                'label' => __('Hover', 'bdevs-elementor'),
            ]
        );

        $repeater->add_control(
            'hover_color',
            [
                'label' => __('Text Color', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-member-links > {{CURRENT_ITEM}}:hover, {{WRAPPER}} .bdevs-member-links > {{CURRENT_ITEM}}:focus' => 'color: {{VALUE}}',
                ],
                'condition' => ['customize' => 'yes'],
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'hover_bg_color',
            [
                'label' => __('Background Color', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-member-links > {{CURRENT_ITEM}}:hover, {{WRAPPER}} .bdevs-member-links > {{CURRENT_ITEM}}:focus' => 'background-color: {{VALUE}}',
                ],
                'condition' => ['customize' => 'yes'],
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'hover_border_color',
            [
                'label' => __('Border Color', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-member-links > {{CURRENT_ITEM}}:hover, {{WRAPPER}} .bdevs-member-links > {{CURRENT_ITEM}}:focus' => 'border-color: {{VALUE}}',
                ],
                'condition' => ['customize' => 'yes'],
                'style_transfer' => true,
            ]
        );

        $repeater->end_controls_tab();
        $repeater->end_controls_tabs();

        $this->add_control(
            'profiles',
            [
                'show_label' => false,
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '<# print(name.slice(0,1).toUpperCase() + name.slice(1)) #>',
                'default' => [
                    [
                        'link' => ['url' => 'https://facebook.com/'],
                        'name' => 'facebook'
                    ],
                    [
                        'link' => ['url' => 'https://twitter.com/'],
                        'name' => 'twitter'
                    ],
                    [
                        'link' => ['url' => 'https://linkedin.com/'],
                        'name' => 'linkedin'
                    ]
                ],
            ]
        );

        $this->add_control(
            'show_profiles',
            [
                'label' => __('Show Profiles', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'bdevs-elementor'),
                'label_off' => __('Hide', 'bdevs-elementor'),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
                'style_transfer' => true,
            ]
        );

        $this->end_controls_section();
    }

     // Button overlay

    public function button_gradient(){

        // Background Overlay
        $this->start_controls_section(
            '_section_text_overlay2',
            [
                'label' => __( 'Button Gradient', 'bdevs-elementor' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'designs' => ['design_2','design_3', 'design_4'],
                ],
                 
            ]
        );
        
        $this->start_controls_tabs( 'tabs_background_overlay2' );

         $this->start_controls_tab(
            'tab_background_button_overlay_normal',
            [
                'label' => __( 'Normal', 'bdevs-elementor' ),
                'condition' => [
                    'designs' => ['design_2','design_3','design_4'],
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background2',
                'label' => esc_html__( 'Background', 'bdevs-elementor' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .bd-gadient__btn, .bd-contact__btn-3',
            ]
        );

        $this->add_control(
            'background_button_overlay_opacity',
            [
                'label' => __( 'Opacity', 'bdevs-elementor' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'default' => [
                    'size' => .5,
                ],
                'range' => [
                    'px' => [
                        'max' => 1,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}  .elementor-background-overlay .bd-gadient__btn, .bd-contact__btn-3' => 'opacity: {{SIZE}};',
                ],
               
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_background_button_overlay_hover',
            [
                'label' => __( 'Hover', 'elementor' ),
            ]
        );

         $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'btn-hover-bg-color2',
                'label' => esc_html__( 'Background', 'bdevs-elementor' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .bd-gadient__btn:hover, .bd-contact__btn-3:hover::before',
            ]
        );


        $this->add_control(
            'background_button_hover_overlay_opacity',
            [
                'label' => __( 'Opacity', 'bdevs-elementor' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'default' => [
                    'size' => .5,
                ],
                'range' => [
                    'px' => [
                        'max' => 1,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .bd-gadient__btn:hover .elementor-background-overlay, .bd-contact__btn-3:hover::before' => 'opacity: {{SIZE}};',
                ],
            ]
        );


        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

      }


    protected function register_style_controls() {

       $this->title_description_style_controls();

    }


    protected function title_description_style_controls() {

        $this->start_controls_section(
            '_section_style_content',
            [
                'label' => __('Title & Description', 'bdevs-elementor'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'content_padding',
            [
                'label' => __('Content Padding', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'content_background',
                'selector' => '{{WRAPPER}} .bdevs-el-title',
                'exclude' => [
                    'image'
                ]
            ]
        );

        $this->add_control(
            '_heading_title',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => __('Title', 'bdevs-elementor'),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'title_spacing',
            [
                'label' => __('Bottom Spacing', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __('Text Color', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title',
                'selector' => '{{WRAPPER}} .bdevs-el-title',
            ]
        );

        $this->add_control(
            '_heading_subtitle',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => __('Subtitle', 'bdevs-elementor'),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'subtitle_spacing',
            [
                'label' => __('Bottom Spacing', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-subtitle' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'subtitle_color',
            [
                'label' => __('Text Color', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-subtitle' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'subtitle',
                'selector' => '{{WRAPPER}} .bdevs-el-subtitle',
            ]
        );

        $this->end_controls_section();

        
        
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

    ?>

    <?php if ($settings['designs'] === 'design_2'):  ?> 

        <div class="bd-contact__wrapper-2 contact-style-2 mb-30">
            <div class="contact__form">
                <!-- Start Contact Form -->
                <?php if( !empty($settings['tpcore_select_contact_form']) ) : ?> 
                <div class="form-wrapper"> 
                    <?php echo do_shortcode( '[contact-form-7  id="'.$settings['tpcore_select_contact_form'].'"]' ); ?> 
                </div> 
                <?php else : ?>
                    <?php echo '<div class="alert alert-info"><p class="m-0">' . __('Please Select contact form.', 'tpcore' ). '</p></div>'; ?>
                <?php endif; ?>
            </div>
        </div>

    <?php elseif ($settings['designs'] === 'design_3'):  ?>


        <!-- Cta-are-start -->
        <section class="bd-cta__area p-relative z-index-11 pt-120 wow fadeInUp" data-wow-duration="1.5s"
         data-wow-delay=".3s">
            <div class="container-fluid">
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-lg-6">
                        <div class="bd-user__wrapper">
                            <div class="bd-section__title-two common mb-30">
                                <?php if ($settings['sub_title']): ?>
                                <h6 class="bdevs-el-subtitle"><?php echo wp_kses_post($settings['sub_title']); ?></h6>
                                <?php endif; ?>

                                <?php if ($settings['title']): ?>
                                <h2 class="bdevs-el-title"><?php echo wp_kses_post($settings['title']); ?></h2>
                                <?php endif; ?>

                                <?php if ($settings['description']): ?>
                                <p><?php echo wp_kses_post($settings['description']); ?></p>
                                <?php endif; ?>
                            </div>
                            <div class="bd-cta__item-wrapper mb-30">
                                <?php if ($settings['email']): ?>
                                <div class="bd-cta__item">
                                    <div class="bd-cta__item-icon">
                                      <i class="fal fa-envelope"></i>
                                    </div>
                                    <div class="bd-cta__item-title">
                                      <span><?php print esc_html__( 'Email address', 'businoz' );?></span>
                                      <h3><a href="mailto:<?php echo esc_url($settings['email']); ?>"><?php echo wp_kses_post($settings['email']); ?></a></h3>
                                    </div>
                                </div>
                                <?php endif; ?>

                                <?php if ($settings['phone_number']): ?>
                                <div class="bd-cta__item">
                                   <div class="bd-cta__item-icon">
                                      <i class="fal fa-phone"></i>
                                   </div>
                                   <div class="bd-cta__item-title">
                                      <span><?php print esc_html__( 'Phone number', 'businoz' );?></span>
                                      <h3><a href="tel:<?php echo esc_url($settings['phone_number']); ?>"><?php echo wp_kses_post($settings['phone_number']); ?></a></h3>
                                   </div>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6">
                        <div class="bd-contact__wrapper">
                            <!-- Start Contact Form -->
                            <?php if( !empty($settings['tpcore_select_contact_form']) ) : ?> 
                            <div class="form-wrapper"> 
                                <?php echo do_shortcode( '[contact-form-7  id="'.$settings['tpcore_select_contact_form'].'"]' ); ?> 
                            </div> 
                            <?php else : ?>
                                <?php echo '<div class="alert alert-info"><p class="m-0">' . __('Please Select contact form.', 'tpcore' ). '</p></div>'; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Cta-are-end -->


    <?php elseif ($settings['designs'] === 'design_4'): ?>

        <!-- Cta-are-start -->
        <section class="bd-cta__area p-relative z-index-11 wow fadeInUp" data-wow-duration="1.5s"
             data-wow-delay=".3s">
            <div class="container-fluid">
            </div>
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-6 col-lg-6">
                        <div class="bd-section__title-two common mb-50">
                            <?php if ($settings['sub_title']): ?>
                            <h6 class="bdevs-el-subtitle"><?php echo wp_kses_post($settings['sub_title']); ?></h6>
                            <?php endif; ?>

                            <?php if ($settings['title']): ?>
                            <h2 class="bdevs-el-title"><?php echo wp_kses_post($settings['title']); ?></h2>
                            <?php endif; ?>

                            <?php if ($settings['description']): ?>
                            <p><?php echo wp_kses_post($settings['description']); ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="bd-cta__item-container mb-60">
                            <div class="bd-cta__item-wrapper">
                                <?php if ($settings['email']): ?>
                                <div class="bd-cta__item">
                                   <div class="bd-cta__item-icon">
                                      <i class="fal fa-envelope"></i>
                                   </div>
                                   <div class="bd-cta__item-title">
                                      <span><?php print esc_html__( 'Email address', 'businoz' );?></span>
                                      <h3><a href="mailto:<?php echo esc_url($settings['email']); ?>"><?php echo wp_kses_post($settings['email']); ?></a></h3>
                                   </div>
                                </div>
                                <?php endif; ?>

                                <?php if ($settings['phone_number']): ?>
                                <div class="bd-cta__item">
                                   <div class="bd-cta__item-icon">
                                      <i class="fal fa-phone"></i>
                                   </div>
                                   <div class="bd-cta__item-title">
                                      <span><?php print esc_html__( 'Phone number', 'businoz' );?></span>
                                      <h3><a href="tel:<?php echo esc_url($settings['phone_number']); ?>"><?php echo wp_kses_post($settings['phone_number']); ?></a></h3>
                                   </div>
                                </div>
                                <?php endif; ?>
                            </div>
                            <div class="bd-cta__item-wrapper">
                                <?php if ($settings['address']): ?>
                                <div class="bd-cta__item">
                                    <div class="bd-cta__item-icon">
                                      <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                    <div class="bd-cta__item-title">
                                      <span><?php print esc_html__( 'Office Address', 'businoz' );?></span>
                                      <h4><?php echo wp_kses_post($settings['address']); ?></h4>
                                    </div>
                                </div>
                                <?php endif; ?>
                            </div>
                            <?php if ($settings['show_profiles'] && is_array($settings['profiles'])) : ?>
                            <div class="bd-cta__item">
                                <div class="bd-cta__item-icon">
                                   <i class="fal fa-share"></i>
                                </div>
                                <div class="bd-cta__item-title">
                                    <span><?php print esc_html__( 'Social Option', 'businoz' );?></span>
                                    <div class="bd-contact__social">
                                        <?php
                                        foreach ($settings['profiles'] as $profile) :
                                            $icon = !empty($profile['name']) ? $profile['name'] : '';
                                            $url = !empty($profile['link']['url']) ? $profile['link']['url'] : '';

                                            if ($profile['name'] === 'website') {
                                                $icon = 'globe';
                                            } elseif ($profile['name'] === 'email') {
                                                $icon = 'envelope';
                                                $url = 'mailto:' . antispambot($profile['email']);
                                            }

                                            printf('<a target="_blank" rel="noopener" data-tooltip="hello" href="%s" class="elementor-repeater-item-%s comments-btn"><i class="fab fa-%s" aria-hidden="true"></i></a>',
                                                $url,
                                                esc_attr($profile['_id']),
                                                esc_attr($icon),
                                                esc_attr($icon)
                                            );
                                        endforeach; ?>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6">
                        <div class="bd-contact__wrapper mb-60">
                            <!-- Start Contact Form -->
                            <?php if( !empty($settings['tpcore_select_contact_form']) ) : ?> 
                            <div class="form-wrapper"> 
                                <?php echo do_shortcode( '[contact-form-7  id="'.$settings['tpcore_select_contact_form'].'"]' ); ?> 
                            </div> 
                            <?php else : ?>
                                <?php echo '<div class="alert alert-info"><p class="m-0">' . __('Please Select contact form.', 'tpcore' ). '</p></div>'; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Cta-are-end -->

    <?php elseif ($settings['designs'] === 'design_5'): ?>

       <!-- Cta-araea-start -->
       <section class="bd-cta__area section-bg-3 p-relative z-index-1 fix pt-120 pb-90 wow fadeInUp">
            <?php if (!empty($settings['shape_switch'])) : ?>
            <div class="bd-cta__wrapper">
                <img class="bd-cta__patten-1" src="<?php echo get_template_directory_uri(); ?>/assets/img/bg/pattren-3.png" alt="pattren-3.png">
                <img class="bd-cta__patten-2" src="<?php echo get_template_directory_uri(); ?>/assets/img/bg/pattren-4.png" alt="pattren-3.png">
            </div>
            <?php endif; ?>
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-6 col-lg-6">
                        <div class="bd-cat__box mb-30">
                            <div class="bd-section__title-5 mb-40">
                                <?php if ($settings['sub_title']): ?>
                                <h5 class="bd-smaill__title-5 bdevs-el-subtitle">
                                    <?php echo wp_kses_post($settings['sub_title']); ?>
                                </h5>
                                <?php endif; ?>

                                <?php if ($settings['title']): ?>
                                <h2 class="bd-big__title-5 bdevs-el-title mb-20">
                                    <?php echo wp_kses_post($settings['title']); ?>
                                </h2>
                                <?php endif; ?>

                                <?php if ($settings['description']): ?>
                                <p class="paragraph"><?php echo wp_kses_post($settings['description']); ?></p>
                                <?php endif; ?>
                            </div>
                            <div class="bd-cta__item-wrapper style-2 mb-30">
                                <?php if ($settings['email']): ?>
                                <div class="bd-cta__item">
                                   <div class="bd-cta__item-icon">
                                      <i class="fal fa-envelope"></i>
                                   </div>
                                   <div class="bd-cta__item-title">
                                      <span><?php print esc_html__( 'Email address', 'businoz' );?></span>
                                      <h3><a href="mailto:<?php echo esc_url($settings['email']); ?>"><?php echo wp_kses_post($settings['email']); ?></a></h3>
                                   </div>
                                </div>
                                <?php endif; ?>

                                <?php if ($settings['phone_number']): ?>
                                <div class="bd-cta__item">
                                   <div class="bd-cta__item-icon">
                                      <i class="fal fa-phone"></i>
                                   </div>
                                   <div class="bd-cta__item-title">
                                      <span><?php print esc_html__( 'Phone number', 'businoz' );?></span>
                                      <h3><a href="tel:<?php echo esc_url($settings['phone_number']); ?>"><?php echo wp_kses_post($settings['phone_number']); ?></a></h3>
                                   </div>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6">
                        <div class="bd-contact__wrapper style-2 mb-30">
                            <?php if( !empty($settings['tpcore_select_contact_form']) ) : ?> 
                            <div class="form-wrapper"> 
                                <?php echo do_shortcode( '[contact-form-7  id="'.$settings['tpcore_select_contact_form'].'"]' ); ?> 
                            </div> 
                            <?php else : ?>
                                <?php echo '<div class="alert alert-info"><p class="m-0">' . __('Please Select contact form.', 'tpcore' ). '</p></div>'; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Cta-araea-end -->



    <?php else: ?>

    <!-- Newslatter-aera-start -->
    <section class="bd-newaletter__area black-bg-2 pt-65 pb-65 wow fadeInUp" data-wow-duration="1.5s"
     data-wow-delay=".3s">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-6 col-lg-6">
                    <div class="bd-newslettter__content">
                        <?php if ($settings['sub_title']): ?>
                        <span class="bdevs-el-subtitle"><?php echo wp_kses_post($settings['sub_title']); ?></span>
                        <?php endif; ?>

                        <?php if ($settings['title']): ?>
                        <h2><?php echo wp_kses_post($settings['title']); ?></h2>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6">
                    <div class="bd-newsletter__subcribe p-relative text-end">
                        <!-- Start Contact Form -->
                        <?php if( !empty($settings['tpcore_select_contact_form']) ) : ?> 
                        <div class="form-wrapper"> 
                            <?php echo do_shortcode( '[contact-form-7  id="'.$settings['tpcore_select_contact_form'].'"]' ); ?> 
                        </div> 
                        <?php else : ?>
                            <?php echo '<div class="alert alert-info"><p class="m-0">' . __('Please Select contact form.', 'tpcore' ). '</p></div>'; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Newslatter-aera-end -->

    <?php endif; ?>
        <?php
    }
}
