<?php

namespace Bdevs\Elementor;

defined('ABSPATH') || die();


class Service extends \Generic\Elements\GenericWidget
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
        return 'cust-service';
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
        return __('Service', 'bdevs-element');
    }

    public function get_custom_help_url()
    {
        return 'http://elementor.bdevs.net//widgets/service/';
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
        return 'eicon-theme-builder';
    }

    public function get_keywords()
    {
        return ['service', 'list', 'icon'];
    }

    public function get_categories()
    {
        return ['bdevs-elementor'];
    }


    protected function register_content_controls()
    {

        $this->design_style();
        $this->info_icon();
        $this->images();
        $this->title_and_desc();
        $this->button();
        $this->features_list();
        $this->button_overlay();
        $this->icons_color_gradient();
        $this->icons_bg_gradient();
        $this->button_gradient();

        
        

    }

    public function design_style()
    {
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
                    'design_6' => __('Design 6', 'bdevs-elementor'),
                    'design_7' => __('Design 7', 'bdevs-elementor'),
                ],
                'default' => 'design_1',
                'frontend_available' => true,
                'style_transfer' => true,
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
                    'designs' => ['design_6'],
                ],
            ]
        );

        $this->end_controls_section();
    }

    public function info_icon()
    {

        $this->start_controls_section(
            '_section_media',
            [
                'label' => __('Icon / Image', 'bdevs-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'designs' => ['design_5', 'design_6','design_7'],
                ],
            ]
        );

        $this->add_control(
            'type',
            [
                'label' => __('Media Type', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'icon' => [
                        'title' => __('Icon', 'bdevs-elementor'),
                        'icon' => 'fa fa-smile-o',
                    ],
                    'image' => [
                        'title' => __('Image', 'bdevs-elementor'),
                        'icon' => 'fa fa-image',
                    ],
                ],
                'default' => 'icon',
                'toggle' => false,
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'image',
            [
                'label' => __('Image', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'type' => 'image'
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail2',
                'default' => 'medium_large',
                'separator' => 'none',
                'exclude' => [
                    'full',
                    'custom',
                    'large',
                    'shop_catalog',
                    'shop_single',
                    'shop_thumbnail'
                ],
                'condition' => [
                    'type' => 'image'
                ]
            ]
        );

        $this->add_control(
            'icon',
            [
                'label' => esc_html__('Icon', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'solid',
                ],
            ]
        );

        $this->end_controls_section();
    }


    public function images()
    {
        // img
        $this->start_controls_section(
            '_section_about_image',
            [
                'label' => __('Image', 'bdevs-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'designs' => ['design_1', 'design_2', 'design_3', 'design_4', 'design_5'],
                ],
            ]
        );

        $this->add_control(
            'image1',
            [
                'type' => \Elementor\Controls_Manager::MEDIA,
                'label' => __('Image', 'bdevs-elementor'),
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'designs' => ['design_1', 'design_2', 'design_4'],
                ],
            ]
        );


        $this->add_control(
            'image2',
            [
                'type' => \Elementor\Controls_Manager::MEDIA,
                'label' => __('Image 2nd', 'bdevs-elementor'),
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'designs' => ['design_1'],
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail22',
                'default' => 'large',
                'separator' => 'none',
            ]
        );

        $this->end_controls_section();
    }

    public function title_and_desc()
    {
        $this->start_controls_section(
            '_section_title',
            [
                'label' => __('Title & Description', 'bdevs-element'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'sub_title',
            [
                'label' => __('Sub Title', 'bdevs-element'),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Sub Title', 'bdevs-element'),
                'placeholder' => __('Sub Title', 'bdevs-element'),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'designs' => ['design_6'],
                ],
            ]
        );

        $this->add_control(
            'title_number',
            [
                'label' => __('Title Number', 'bdevs-element'),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('bdevs Info Box number', 'bdevs-element'),
                'placeholder' => __('Type Info Box number', 'bdevs-element'),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'designs' => ['design_1', 'design_2'],
                ],
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __('Title', 'bdevs-element'),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('bdevs Info Box Title', 'bdevs-element'),
                'placeholder' => __('Type Info Box Title', 'bdevs-element'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'title_link',
            [
                'label' => __('Title Link', 'bdevs-element'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('bdevs title url goes here', 'bdevs-element'),
                'placeholder' => __('Set Title URL', 'bdevs-element'),
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'designs' => ['design_1', 'design_2', 'design_5','design_7'],
                ],

            ]
        );

        $this->add_control(
            'back_title',
            [
                'label' => __('back Title', 'bdevs-element'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('01', 'bdevs-element'),
                'placeholder' => __('01', 'bdevs-element'),
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'designs' => ['design_5'],
                ],

            ]
        );

        $this->add_control(
            'description',
            [
                'label' => __('Description', 'bdevs-element'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __('bdevs info box description goes here', 'bdevs-element'),
                'placeholder' => __('Type info box description', 'bdevs-element'),
                'rows' => 5,
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'designs' => ['design_1', 'design_2', 'design_4', 'design_5','design_7'],
                ],
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label' => __('Title HTML Tag', 'bdevs-element'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'h1' => [
                        'title' => __('H1', 'bdevs-element'),
                        'icon' => 'eicon-editor-h1'
                    ],
                    'h2' => [
                        'title' => __('H2', 'bdevs-element'),
                        'icon' => 'eicon-editor-h2'
                    ],
                    'h3' => [
                        'title' => __('H3', 'bdevs-element'),
                        'icon' => 'eicon-editor-h3'
                    ],
                    'h4' => [
                        'title' => __('H4', 'bdevs-element'),
                        'icon' => 'eicon-editor-h4'
                    ],
                    'h5' => [
                        'title' => __('H5', 'bdevs-element'),
                        'icon' => 'eicon-editor-h5'
                    ],
                    'h6' => [
                        'title' => __('H6', 'bdevs-element'),
                        'icon' => 'eicon-editor-h6'
                    ]
                ],
                'default' => 'h4',
                'toggle' => false,
            ]
        );

        $this->add_responsive_control(
            'align',
            [
                'label' => __('Alignment', 'bdevs-element'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'bdevs-element'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'bdevs-element'),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'bdevs-element'),
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

    public function button()
    {

        // Button 01
        $this->start_controls_section(
            '_section_button',
            [
                'label' => __('Button', 'bdevs-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'designs' => ['design_1', 'design_2', 'design_5','design_7'],
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


    public function features_list()
    {
        $this->start_controls_section(
            '_section_icon',
            [
                'label' => __('Services List', 'bdevs-element'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'designs' => ['design_3', 'design_6'],
                ],
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'field_condition',
            [
                'label' => __('Field condition', 'bdevs-element'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'style_1' => __('Style 1', 'bdevs-element'),
                    'style_2' => __('Style 2', 'bdevs-element'),
                    'style_3' => __('Style 3', 'bdevs-element'),
                    'style_4' => __('Style 4', 'bdevs-element'),
                    'style_5' => __('Style 5', 'bdevs-element'),
                    'style_6' => __('Style 6', 'bdevs-element'),
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );


        $repeater->add_control(
            'ser_number',
            [
                'label' => __('Number', 'bdevs-element'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'default' => __('01', 'bdevs-element'),
                'placeholder' => __('Type Number Here', 'bdevs-element'),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'field_condition' => ['style_6'],
                ],
            ]
        );

        $repeater->add_control(
            'title',
            [
                'label' => __('Title', 'bdevs-element'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'default' => __('Title', 'bdevs-element'),
                'placeholder' => __('Title', 'bdevs-element'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'title_url',
            [
                'label' => __('Title url', 'bdevs-element'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'default' => __('Title url', 'bdevs-element'),
                'placeholder' => __('Title url', 'bdevs-element'),
                'condition' => [
                    'field_condition' => ['style_1'],
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'serv_description',
            [
                'label' => __('Description', 'bdevs-element'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'default' => __('Description', 'bdevs-element'),
                'placeholder' => __('Type Description Here', 'bdevs-element'),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'field_condition' => ['style_6'],
                ],
            ]
        );

        $repeater->add_control(
            'button_text',
            [
                'label' => __('Text', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Button Text',
                'placeholder' => __('Type button text here', 'bdevs-elementor'),
                'label_block' => true,
                'condition' => [
                    'field_condition' => ['style_6'],
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'button_link',
            [
                'label' => __('Link', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => 'http://elementor.bdevs.net/',
                'condition' => [
                    'field_condition' => ['style_6'],
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'slides',
            [
                'show_label' => false,
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '<# print(title || "Carousel Item"); #>',
                'default' => [
                    [
                        'image' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'image' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
                    ]
                ]
            ]
        );

        $this->end_controls_section();
    }



 // Button overlay

    public function button_overlay(){

        // Background Overlay
        $this->start_controls_section(
            '_section_text_overlay2',
            [
                'label' => __( 'Button Overlay', 'bdevs-elementor' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'designs' => ['design_2'],
                ],
                 
            ]
        );
        
        $this->start_controls_tabs( 'tabs_background_overlay2' );

         $this->start_controls_tab(
            'tab_background_button_overlay_normal',
            [
                'label' => __( 'Normal', 'bdevs-elementor' ),
                'condition' => [
                    'designs' => ['design_2'],
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background2',
                'label' => esc_html__( 'Background', 'bdevs-elementor' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .bd-service__link-2 a',
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
                    '{{WRAPPER}}  .elementor-background-overlay .bd-service__link-2 a' => 'opacity: {{SIZE}};',
                ],
                // 'condition' => [
                //     'background_overlay_background' => [ 'classic', 'gradient' ],
                // ],
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
                'selector' => '{{WRAPPER}} .bd-service__wrapper:hover .bd-service__link-2 a',
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
                    '{{WRAPPER}} .bd-service__wrapper:hover .bd-service__link-2 a .elementor-background-overlay' => 'opacity: {{SIZE}};',
                ],
                // 'condition' => [
                //     'background_overlay_background' => [ 'classic', 'gradient' ],
                // ],
            ]
        );


        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

      }



 // Icons color Gradient

    public function icons_color_gradient(){

        // Background Overlay
        $this->start_controls_section(
            '_section_icons_color_gradient',
            [
                'label' => __( 'Icon Color', 'bdevs-elementor' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'designs' => ['design_5'],
                ],
                 
            ]
        );
        
        $this->start_controls_tabs( 'tabs_icons_color_gradient' );

         $this->start_controls_tab(
            'tab_background_icons_color_gradient_normal',
            [
                'label' => __( 'Normal', 'bdevs-elementor' ),
                'condition' => [
                    'designs' => ['design_5'],
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background9',
                'label' => esc_html__( 'Background', 'bdevs-elementor' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .bd-service-icon-2 i',
            ]
        );

        $this->add_control(
            'background_icons_color_gradient_opacity',
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
                    '{{WRAPPER}}  .elementor-background-overlay .bd-service-icon-2 i' => 'opacity: {{SIZE}};',
                ],
                // 'condition' => [
                //     'background_overlay_background' => [ 'classic', 'gradient' ],
                // ],
            ]
        );

        $this->end_controls_tab();


        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

      }



 // Icons Gradient

    public function icons_bg_gradient(){

        // Background Overlay
        $this->start_controls_section(
            '_section_icons_gradient',
            [
                'label' => __( 'Icons Background Color', 'bdevs-elementor' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'designs' => ['design_5'],
                ],
                 
            ]
        );
        
        $this->start_controls_tabs( 'tabs_icons_gradient' );

         $this->start_controls_tab(
            'tab_background_icons_gradient_normal',
            [
                'label' => __( 'Normal', 'bdevs-elementor' ),
                'condition' => [
                    'designs' => ['design_5'],
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background3',
                'label' => esc_html__( 'Background', 'bdevs-elementor' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .bd-service-icon-2 .bd-service__item-3.style-2 .bd-service-icon-2::before',
            ]
        );

        $this->add_control(
            'background_icons_gradient_opacity',
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
                    '{{WRAPPER}}  .elementor-background-overlay .bd-service-icon-2 .bd-service__item-3.style-2 .bd-service-icon-2::before' => 'opacity: {{SIZE}};',
                ],
                // 'condition' => [
                //     'background_overlay_background' => [ 'classic', 'gradient' ],
                // ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_background_icons_gradient_hover',
            [
                'label' => __( 'Hover', 'elementor' ),
            ]
        );

         $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'icons-hover-gradient-color2',
                'label' => esc_html__( 'Background', 'bdevs-elementor' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .bd-service__item-3.style-2:hover .bd-service-icon-2::before',
            ]
        );


        $this->add_control(
            'background_icons_gradient_overlay_opacity',
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
                    '{{WRAPPER}} .bd-service__item-3.style-2:hover .bd-service-icon-2::before .elementor-background-overlay' => 'opacity: {{SIZE}};',
                ],
                // 'condition' => [
                //     'background_overlay_background' => [ 'classic', 'gradient' ],
                // ],
            ]
        );


        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

      }

 // Button Gradient

    public function button_gradient(){

        // Background Overlay
        $this->start_controls_section(
            '_section_text_overlay3',
            [
                'label' => __( 'Button Gradient', 'bdevs-elementor' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'designs' => ['design_5'],
                ],
                 
            ]
        );
        
        $this->start_controls_tabs( 'tabs_background_overlay3' );

         $this->start_controls_tab(
            'tab_button_overlay_normal',
            [
                'label' => __( 'Normal', 'bdevs-elementor' ),
                'condition' => [
                    'designs' => ['design_5'],
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background4',
                'label' => esc_html__( 'Background', 'bdevs-elementor' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .bd-service-btn-2::before',
            ]
        );

        $this->add_control(
            'background_button_overlay_opacity3',
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
                    '{{WRAPPER}}  .elementor-background-overlay .bd-service-btn-2::before' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_background_button_overlay_hover3',
            [
                'label' => __( 'Hover', 'elementor' ),
            ]
        );

         $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'btn-hover-bg-color3',
                'label' => esc_html__( 'Background', 'bdevs-elementor' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}}  .bd-service-btn-2:hover::before',
            ]
        );


        $this->add_control(
            'background_button_hover_overlay_opacity3',
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
                    '{{WRAPPER}}  .bd-service-btn-2:hover::before .elementor-background-overlay' => 'opacity: {{SIZE}};',
                ],
            ]
        );


        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

      }


    /**
     * Register styles related controls
     */
    protected function register_style_controls()
    {

        $this->title_style_controls();
        $this->description_style_controls();
        $this->box_section_style_content();
        $this->button_style();
    }





    protected function title_style_controls()
    {
        $this->start_controls_section(
            '_section_style_content',
            [
                'label' => __('Title / Content', 'bdevs-elementor'),
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
                    '{{WRAPPER}} .bdevs-el-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'content_background',
                'selector' => '{{WRAPPER}} .bdevs-el-content',
                'exclude' => [
                    'image'
                ]
            ]
        );

        // Title
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

        // Subtitle
        $this->add_control(
            '_heading_subtitle',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => __('Subtitle', 'bdevs-elementor'),
                'separator' => 'before',
                'condition' => [
                    'designs' => ['design_6'],
                ],
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
                'condition' => [
                    'designs' => ['design_6'],
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
                'condition' => [
                    'designs' => ['design_6'],
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'subtitle',
                'selector' => '{{WRAPPER}} .bdevs-el-subtitle',
                'condition' => [
                    'designs' => ['design_6'],
            ],
            ],
        );
    }

    protected function description_style_controls()
    {


        // description
        $this->add_control(
            '_content_description',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => __('Description', 'bdevs-elementor'),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'description_spacing',
            [
                'label' => __('Bottom Spacing', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-content p' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => __('Text Color', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-content p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'description',
                'selector' => '{{WRAPPER}} .bdevs-el-content p',
            ]
        );


        $this->end_controls_section();
    }


    protected function box_section_style_content()
    {

        // services item
        $this->start_controls_section(
            '_box_section_style_content',
            [
                'label' => __('Box Title / Content', 'bdevs-element'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'designs' => ['design_6'],
                ],
            ]
        );

        $this->add_responsive_control(
            '_box_content_padding',
            [
                'label' => __('Content Padding', 'bdevs-element'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-box-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'box_content_background',
                'selector' => '{{WRAPPER}} .bdevs-box-content',
                'exclude' => [
                    'image'
                ]
            ]
        );

        // Box Title
        $this->add_control(
            '_box_heading_title',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => __('Title', 'bdevs-element'),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            '_box_title_spacing',
            [
                'label' => __('Bottom Spacing', 'bdevs-element'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-box-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            '_box_title_color',
            [
                'label' => __('Text Color', 'bdevs-element'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-box-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'boxtitle',
                'selector' => '{{WRAPPER}} .bdevs-box-title',
            ]
        );

        // description
        $this->add_control(
            '_box_content_description',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => __('Description', 'bdevs-element'),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            '_box_description_spacing',
            [
                'label' => __('Bottom Spacing', 'bdevs-element'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-box-content p' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            '_box_description_color',
            [
                'label' => __('Text Color', 'bdevs-element'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-box-content p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'boxdescription',
                'selector' => '{{WRAPPER}} .bdevs-box-content p',
            ]
        );


        $this->end_controls_section();
    }

    protected function button_style()
    {


        // Button 1 style
        $this->start_controls_section(
            '_section_style_button',
            [
                'label' => __('Button', 'bdevs-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'designs' => ['design_7'],
                ],
            ]
        );

        $this->add_responsive_control(
            'button_padding',
            [
                'label' => __('Padding', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'selector' => '{{WRAPPER}} .bdevs-el-btn',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'button_border',
                'selector' => '{{WRAPPER}} .bdevs-el-btn',
            ]
        );

        $this->add_control(
            'button_border_radius',
            [
                'label' => __('Border Radius', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_box_shadow',
                'selector' => '{{WRAPPER}} .bdevs-el-btn',
            ]
        );

        $this->add_control(
            'hr',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
                'style' => 'thick',
            ]
        );

        $this->start_controls_tabs('_tabs_button');

        $this->start_controls_tab(
            '_tab_button_normal',
            [
                'label' => __('Normal', 'bdevs-elementor'),
            ]
        );

        $this->add_control(
            'button_color',
            [
                'label' => __('Text Color', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-btn' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_bg_color',
            [
                'label' => __('Background Color', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-btn' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            '_tab_button_hover',
            [
                'label' => __('Hover', 'bdevs-elementor'),
            ]
        );

        $this->add_control(
            'button_hover_color',
            [
                'label' => __('Text Color', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-btn:hover, {{WRAPPER}} .bdevs-el-btn:focus' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_bg_color',
            [
                'label' => __('Background Color', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-btn:hover, {{WRAPPER}} .bdevs-el-btn:focus' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_border_color',
            [
                'label' => __('Border Color', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'button_border_border!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-btn:hover, {{WRAPPER}} .bdevs-el-btn:focus' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();

    }


    /**
     * Render widget output on the frontend.
     *
     * Used to generate the final HTML displayed on the frontend.
     *
     * Note that if skin is selected, it will be rendered by the skin itself,
     * not the widget.
     *
     * @since 1.0.0
     * @access public
     */
    protected function render()
    {
        $settings = $this->get_settings_for_display();

        $this->add_inline_editing_attributes('description', 'none');
        $this->add_render_attribute('description', 'class', '');
        $this->add_render_attribute('title', 'class', 'wow fadeInUp2 bdevs-el-title');
        $this->add_render_attribute('title', 'data-wow-delay', '.4s');

        $this->add_inline_editing_attributes('button_text', 'none');
        $this->add_render_attribute('button_text', 'class', '');
        $this->add_render_attribute('button', 'class', 'z-btn');


?>

    <?php if ($settings['designs'] === 'design_7') :

       if (!empty($settings['button_link'])) {
                $this->add_render_attribute('button', 'class', 'bd-service__btn bdevs-el-btn');
                $this->add_link_attributes('button', $settings['button_link']);
            }

    ?>

    <section class="bd-service__area wow fadeInUp" data-wow-duration="1.5s"
         data-wow-delay=".3s">
          <div class="bd-service__wrapper text-center mb-30">
             <div class="bd-singel__item">
                <div class="bd-service__title bdevs-el-content">
                    <?php if ($settings['title']) : ?>
                   <h3 class="bdevs-el-title"><a href="<?php echo esc_url($settings['title_link']); ?>"><?php echo wp_kses_post($settings['title']); ?></a></h3>
                   <?php endif; ?>

                    <?php if ($settings['description']) : ?>
                      <p><?php echo wp_kses_post($settings['description']); ?></p>
                    <?php endif; ?>
                </div>
                <div class="bd-service-image">
                     <?php if ($settings['type'] === 'image' && ($settings['image']['url'] || $settings['image']['id'])) :
                        $this->get_render_attribute_string('image');
                        $settings['hover_animation'] = 'disable-animation'; // hack to prevent image hover animation
                    ?>
                        <figure>
                            <?php echo \Elementor\Group_Control_Image_Size::get_attachment_image_html($settings, 'thumbnail', 'image'); ?>
                        </figure>
                    <?php elseif (!empty($settings['icon']) || !empty($settings['selected_icon']['value'])) : ?>
                        <figure>
                            <?php \Elementor\Icons_Manager::render_icon($settings['icon'], ['aria-hidden' => 'true']); ?>
                        </figure>
                    <?php endif; ?>
                </div>
             </div>
             <div class="service-button">
               

               <?php if ($settings['button_text'] && ((empty($settings['button_selected_icon']) || empty($settings['button_selected_icon']['value'])) && empty($settings['button_icon']))) :
                    printf(
                        '<a %1$s>%2$s</a>',
                        $this->get_render_attribute_string('button'),
                        esc_html($settings['button_text'])
                    );
                elseif (empty($settings['button_text']) && ((!empty($settings['button_selected_icon']) || empty($settings['button_selected_icon']['value'])) || !empty($settings['button_icon']))) : ?>
                    <a <?php $this->print_render_attribute_string('button'); ?>><?php bdevs_elementor_render_icon($settings, 'button_icon', 'button_selected_icon'); ?></a>
                    <?php elseif ($settings['button_text'] && ((!empty($settings['button_selected_icon']) || empty($settings['button_selected_icon']['value'])) || !empty($settings['button_icon']))) :
                    if ($settings['button_icon_position'] === 'before') : ?>
                        <a <?php $this->print_render_attribute_string('button'); ?>><?php bdevs_elementor_render_icon($settings, 'button_icon', 'button_selected_icon', ['class' => 'bdevs-btn-icon']); ?>
                            <span><?php echo esc_html($settings['button_text']); ?></span></a>
                    <?php
                    else : ?>
                        <a <?php $this->print_render_attribute_string('button'); ?>>
                            <span><?php echo esc_html($settings['button_text']); ?></span>

                            <?php bdevs_elementor_render_icon($settings, 'button_icon', 'button_selected_icon', ['class' => 'bdevs-btn-icon']); ?>
                        </a>
                    <?php
                     endif;
                endif; ?>   
             </div>
          </div>
    </section>

    <?php elseif ($settings['designs'] === 'design_6') :

            $this->add_inline_editing_attributes('title', 'basic');
            $this->add_render_attribute('title', 'class', 'bd-big__title-3 medium bdevs-el-title');


            if (!empty($settings['button_link'])) {
                $this->add_link_attributes('button', $settings['button_link']);
            }

        ?>
            <section class="bd-service__area fix p-relative z-index-11 wow fadeInUp" data-wow-duration="1.5s" data-wow-delay=".3s">
                <?php if (!empty($settings['shape_switch'])) : ?>
                    <div class="bd-service__shape-wrapper p-relative">
                        <img class="bd-service__shape-1" src="<?php echo get_template_directory_uri(); ?>/assets/img/service/service-shape-1.png" alt="service-shape">
                        <img class="bd-service__shape-2" src="<?php echo get_template_directory_uri(); ?>/assets/img/service/service-shape-1.png" alt="service-shape">
                    </div>
                <?php endif; ?>

                <div class="container">
                    <div class="row justify-content-center text-center">
                        <div class="bd-section__title-3 mb-15">
                            <?php if ($settings['sub_title']) : ?>
                                <h6 class="bd-small__title-3"><?php echo wp_kses_post($settings['sub_title']); ?></h6>
                            <?php endif; ?>

                            <?php if ($settings['title']) :
                                printf(
                                    '<%1$s %2$s>%3$s</%1$s>',
                                    tag_escape($settings['title_tag']),
                                    $this->get_render_attribute_string('title'),
                                    wp_kses_post($settings['title'])
                                );
                            endif; ?>
                        </div>
                        <div class="row g-0 bd-service__bordered">


                            <?php
                            foreach ($settings['slides'] as $key => $slide) :
                            ?>
                                <div class="col-xl-3 col-lg-6 col-md-6">
                                    <div class="bd-service__wrapper p-relative mb-30">
                                        <div class="bd-service__item-3 text-center p-relative">
                                            <div class="bd-service-icon">
                                                <?php if ($settings['type'] === 'image' && ($settings['image']['url'] || $settings['image']['id'])) :
                                                    $this->get_render_attribute_string('image');
                                                    $settings['hover_animation'] = 'disable-animation'; // hack to prevent image hover animation
                                                ?>
                                                    <figure>
                                                        <?php echo \Elementor\Group_Control_Image_Size::get_attachment_image_html($settings, 'thumbnail', 'image'); ?>
                                                    </figure>
                                                <?php elseif (!empty($settings['icon']) || !empty($settings['selected_icon']['value'])) : ?>
                                                    <figure>
                                                        <?php \Elementor\Icons_Manager::render_icon($settings['icon'], ['aria-hidden' => 'true']); ?>
                                                    </figure>
                                                <?php endif; ?>
                                            </div>
                                            <div class="bd-service__content-3 ">

                                                <h4><a href="<?php echo esc_url($slide['title_url']); ?>"><?php echo wp_kses_post($slide['title']); ?></a></h4>

                                                <?php if (!empty($slide['ser_number'])) : ?>
                                                    <span class="bd-service_big_text"><?php echo wp_kses_post($slide['ser_number']); ?></span>
                                                <?php endif; ?>

                                                <?php if (!empty($slide['serv_description'])) : ?>
                                                    <p><?php echo wp_kses_post($slide['serv_description']); ?></p>
                                                <?php endif; ?>
                                            </div>

                                            <?php if (!empty($slide['button_text'])) : ?>
                                                <div class="service-button">
                                                    <a class="bd-service-btn" href="<?php echo esc_url($slide['button_link']['url']); ?>"><?php echo esc_html($slide['button_text']); ?><i class="fa-regular fa-arrow-right-long"></i></a>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                    </div>
                </div>
            </section>




        <?php elseif ($settings['designs'] === 'design_5') :

            if (!empty($settings['button_link'])) {
                $this->add_link_attributes('button', $settings['button_link']);
            }

        ?>

            <section class="bd-service__deatils-area wow fadeInUp" data-wow-duration="1.5s" data-wow-delay=".3s">
                <div class="bd-service__wrapper style-2 p-relative mb-30">
                    <div class="bd-service__item-3 style-2 text-center p-relative">
                        <div class="bd-service-icon-2">
                            <?php if ($settings['type'] === 'image' && ($settings['image']['url'] || $settings['image']['id'])) :
                                $this->get_render_attribute_string('image');
                                $settings['hover_animation'] = 'disable-animation'; // hack to prevent image hover animation
                            ?>
                                <figure>
                                    <?php echo \Elementor\Group_Control_Image_Size::get_attachment_image_html($settings, 'thumbnail', 'image'); ?>
                                </figure>
                            <?php elseif (!empty($settings['icon']) || !empty($settings['selected_icon']['value'])) : ?>
                                <figure>
                                    <?php \Elementor\Icons_Manager::render_icon($settings['icon'], ['aria-hidden' => 'true']); ?>
                                </figure>
                            <?php endif; ?>
                        </div>
                        <div class="bd-service__content-3 bdevs-el-content">

                            <?php if ($settings['title']) : ?>
                                <h4 class="bdevs-el-title"><a href="<?php echo esc_url($settings['title_link']); ?>"><?php echo wp_kses_post($settings['title']); ?></a></h4>
                            <?php endif; ?>
                            <?php if ($settings['back_title']) : ?>
                                <span class="bd-service_big_text"><?php echo wp_kses_post($settings['back_title']); ?></span>
                            <?php endif; ?>
                            <?php if ($settings['description']) : ?>
                                <p><?php echo wp_kses_post($settings['description']); ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="bd-service-btn-2">

                            <?php if ($settings['button_text'] && ((empty($settings['button_selected_icon']) || empty($settings['button_selected_icon']['value'])) && empty($settings['button_icon']))) :
                                printf(
                                    '<a %1$s>%2$s</a>',
                                    $this->get_render_attribute_string('button'),
                                    esc_html($settings['button_text'])
                                );
                            elseif (empty($settings['button_text']) && ((!empty($settings['button_selected_icon']) || empty($settings['button_selected_icon']['value'])) || !empty($settings['button_icon']))) : ?>
                                <a <?php $this->print_render_attribute_string('button'); ?>><?php bdevs_elementor_render_icon($settings, 'button_icon', 'button_selected_icon'); ?></a>
                                <?php elseif ($settings['button_text'] && ((!empty($settings['button_selected_icon']) || empty($settings['button_selected_icon']['value'])) || !empty($settings['button_icon']))) :
                                if ($settings['button_icon_position'] === 'before') : ?>
                                    <a <?php $this->print_render_attribute_string('button'); ?>><?php bdevs_elementor_render_icon($settings, 'button_icon', 'button_selected_icon', ['class' => 'bdevs-btn-icon']); ?>
                                        <span><?php echo esc_html($settings['button_text']); ?></span></a>
                                <?php
                                else : ?>
                                    <a <?php $this->print_render_attribute_string('button'); ?>>
                                        <span><?php echo esc_html($settings['button_text']); ?></span>

                                        <?php bdevs_elementor_render_icon($settings, 'button_icon', 'button_selected_icon', ['class' => 'bdevs-btn-icon']); ?>
                                    </a>
                            <?php
                                endif;
                            endif; ?>
                        </div>
                    </div>
                </div>
            </section>

        <?php elseif ($settings['designs'] === 'design_4') :

            if (!empty($settings['image1']['id'])) {
                $image1 = wp_get_attachment_image_url($settings['image1']['id'], 'url');
            }

        ?>

            <div class="bd-case__features-item mb-30">
                <div class="bd-case__features-icon">
                    <img src="<?php echo esc_url($image1); ?>" alt="case-icon">
                </div>
                <div class="bd-case__features-content bdevs-el-content">
                    <?php if ($settings['title']) : ?>
                        <h4 class="bdevs-el-title"><?php echo wp_kses_post($settings['title']); ?></h4>
                    <?php endif; ?>
                    <?php if ($settings['description']) : ?>
                        <p><?php echo wp_kses_post($settings['description']); ?></p>
                    <?php endif; ?>
                </div>
            </div>

        <?php elseif ($settings['designs'] === 'design_3') : ?>

            <div class="bd-service__details-features mb-60">
                <?php if ($settings['title']) : ?>
                    <h3 class="bd-service__details-title mb-20 bdevs-el-title"><?php echo wp_kses_post($settings['title']); ?></h3>
                <?php endif; ?>
                <div class="bd-service__features-list">
                    <?php
                    foreach ($settings['slides'] as $key => $slide) :
                    ?>
                        <a href="<?php echo esc_url($slide['title_url']); ?>"><?php echo wp_kses_post($slide['title']); ?></a>
                    <?php endforeach; ?>
                </div>
            </div>

        <?php elseif ($settings['designs'] === 'design_2') :

            if (!empty($settings['image1']['id'])) {
                $image1 = wp_get_attachment_image_url($settings['image1']['id'], 'full');
            }

            if (!empty($settings['button_link'])) {
                $this->add_render_attribute('button', 'class', 'bd-theme-4-btn bdevs-el-btn');
                $this->add_link_attributes('button', $settings['button_link']);
            }

        ?>

            <section class="bd-service__area section__shape-2 wow fadeInUp" data-wow-duration="1.5s" data-wow-delay=".3s">
                <div class="bd-service__wrapper mb-30">
                    <div class="bd-service__item-2 text-center p-relative">
                        <div class="bd-service__content-2 bdevs-el-content">
                            <?php if ($settings['title_number']) : ?>
                                <span><?php echo wp_kses_post($settings['title_number']); ?></span>
                            <?php endif; ?>
                            <?php if ($settings['title']) : ?>
                                <h3 class="bdevs-el-title"><a href="<?php echo esc_url($settings['title_link']); ?>"><?php echo wp_kses_post($settings['title']); ?></a></h3>
                            <?php endif; ?>

                            <?php if ($settings['description']) : ?>
                                <p><?php echo wp_kses_post($settings['description']); ?></p>
                            <?php endif; ?>
                        </div>
                        <?php if (!empty($image1)) : ?>
                            <div class="bd-service__icon-2">
                                <img src="<?php echo esc_url($image1); ?>" alt="service-icon-2.png">
                            </div>
                        <?php endif; ?>

                    </div>
                    <div class="bd-service__link-2 text-center">
                        <?php if ($settings['button_text'] && ((empty($settings['button_selected_icon']) || empty($settings['button_selected_icon']['value'])) && empty($settings['button_icon']))) :
                            printf(
                                '<a %1$s>%2$s</a>',
                                $this->get_render_attribute_string('button'),
                                esc_html($settings['button_text'])
                            );
                        elseif (empty($settings['button_text']) && ((!empty($settings['button_selected_icon']) || empty($settings['button_selected_icon']['value'])) || !empty($settings['button_icon']))) : ?>
                            <a <?php $this->print_render_attribute_string('button'); ?>><?php bdevs_elementor_render_icon($settings, 'button_icon', 'button_selected_icon'); ?></a>
                            <?php elseif ($settings['button_text'] && ((!empty($settings['button_selected_icon']) || empty($settings['button_selected_icon']['value'])) || !empty($settings['button_icon']))) :
                            if ($settings['button_icon_position'] === 'before') : ?>
                                <a <?php $this->print_render_attribute_string('button'); ?>><?php bdevs_elementor_render_icon($settings, 'button_icon', 'button_selected_icon', ['class' => 'bdevs-btn-icon']); ?>
                                    <span><?php echo esc_html($settings['button_text']); ?></span></a <?php
                                                                                                    else : ?> <a <?php $this->print_render_attribute_string('button'); ?>>
                                <span><?php echo esc_html($settings['button_text']); ?></span>

                                <?php bdevs_elementor_render_icon($settings, 'button_icon', 'button_selected_icon', ['class' => 'bdevs-btn-icon']); ?>
                                </a>
                        <?php
                                                                                                    endif;
                                                                                                endif; ?>
                    </div>
                </div>
            </section>

        <?php else :

            if (!empty($settings['image1']['id'])) {
                $image1 = wp_get_attachment_image_url($settings['image1']['id'], 'full');
            }

            if (!empty($settings['image2']['id'])) {
                $image2 = wp_get_attachment_image_url($settings['image2']['id'], 'full');
            }


        ?>

            <div class="bd-service__item p-relative mb-30">
                <div class="bd-service__thumb w-img">
                    <img src="<?php echo esc_url($image1); ?>" alt="service-1">
                </div>

                <?php if ($settings['title']) : ?>
                    <div class="bd-service__content">
                        <h3 class="bdevs-el-title"><?php echo wp_kses_post($settings['title']); ?></h3>
                    </div>
                <?php endif; ?>

                <div class="bd-service__ovrelay">
                    <div class="bd-service__inner">
                        <i class="fa-regular fa-arrow-up-long"></i>
                        <?php if (!empty($image2)) : ?>
                            <img src="<?php echo esc_url($image2); ?>" alt="service-icon-1">
                        <?php endif; ?>

                        <?php if ($settings['title']) : ?>
                            <h3 class="bdevs-el-title"><a href="<?php echo esc_url($settings['title_link']); ?>">
                                    <?php echo wp_kses_post($settings['title']); ?>
                                </a>
                            </h3>
                        <?php endif; ?>

                        <?php if ($settings['description']) : ?>
                            <p><?php echo wp_kses_post($settings['description']); ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="bd-service__link">
                        <a href="<?php echo esc_url($settings['title_link']); ?>"><i class="far fa-long-arrow-right"></i></a>
                    </div>
                </div>
            </div>

        <?php endif; ?>

<?php
    }
}
