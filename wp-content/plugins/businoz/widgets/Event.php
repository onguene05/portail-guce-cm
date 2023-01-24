<?php

namespace Bdevs\Elementor;

defined('ABSPATH') || die();

class Event extends \Generic\Elements\GenericWidget {

    /**
     * Get widget name.
     *
     * Retrieve Bdevs Element widget name.
     *
     * @return string Widget name.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_name()
    {
        return 'cust-event';
    }

    /**
     * Get widget title.
     *
     * @return string Widget title.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_title()
    {
        return __('Event', 'bdevs-elementor');
    }
    public function get_custom_help_url() {
        return 'http://elementor.bdevs.net//widgets/about/';
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
     * @return string Widget icon.
     * @since 1.0.0
     * @access public
     *
     */

    public function get_icon()
    {
        return 'eicon-single-post';
    }

    public function get_keywords()
    {
        return ['info', 'blurb', 'box', 'about', 'testimonial', 'content'];
    }

    public function get_categories()
    {
        return ['bdevs-elementor'];
    }

    /**
     * Register content related controls
     */
    protected function register_content_controls() {

        $this->design_style();
        $this->title_and_desc();
        $this->event_box();
        $this->event_box2();
        $this->images();
        $this->button();
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
            'sub_title',
            [
                'label' => __('Sub Title', 'bdevs-elementor'),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('bdevs Info Box Sub Title', 'bdevs-elementor'),
                'placeholder' => __('Type Info Box Sub Title', 'bdevs-elementor'),
                'dynamic' => [
                    'active' => true,
                ]
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
                ]
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
                    'designs' => ['design_10'],
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
                'default' => 'h3',
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

    public function event_box(){

        $this->start_controls_section(
            '_event-box1',
            [
                'label' => __( 'Event Box', 'bdevs-elementor' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'designs' => ['design_1']
                ]
            ]
        );

        $this->add_control(
            'event-title1',
            [
                'label'       => __( 'Event Title 01', 'bdevs-elementor' ),
                'label_block' => true,
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => 'Wedding Anniversary',
                'placeholder' => __( 'Event Title 01', 'bdevs-elementor' ),
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'event-month1',
            [
                'label'       => __( 'Event Month 01', 'bdevs-elementor' ),
                'label_block' => true,
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => 'Feb',
                'placeholder' => __( 'Event Month 01', 'bdevs-elementor' ),
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'event-day1',
            [
                'label'       => __( 'Event Day 01', 'bdevs-elementor' ),
                'label_block' => true,
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => 'Monday',
                'placeholder' => __( 'Event Day 01', 'bdevs-elementor' ),
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'event-date1',
            [
                'label'       => __( 'Event Date 01', 'bdevs-elementor' ),
                'label_block' => true,
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => '14',
                'placeholder' => __( 'Event Date 01', 'bdevs-elementor' ),
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'event-time1',
            [
                'label'       => __( 'Event Time 01', 'bdevs-elementor' ),
                'label_block' => true,
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => '04:30 PM',
                'placeholder' => __( 'Event Time 01', 'bdevs-elementor' ),
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'event-year1',
            [
                'label'       => __( 'Event Year 01', 'bdevs-elementor' ),
                'label_block' => true,
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => '2022',
                'placeholder' => __( 'Event Year 01', 'bdevs-elementor' ),
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        );  

        $this->add_control(
            'event-address1',
            [
                'label'       => __( 'Event Address 01', 'bdevs-elementor' ),
                'label_block' => true,
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'default'     => 'St. Joseph Church, London, U.K.',
                'placeholder' => __( 'Event Address 01', 'bdevs-elementor' ),
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        );  

        $this->add_control(
            'event-phone1',
            [
                'label'       => __( 'Event Phone 01', 'bdevs-elementor' ),
                'label_block' => true,
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => '+1 682-853-2470',
                'placeholder' => __( 'Event Phone 01', 'bdevs-elementor' ),
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        ); 

        $this->add_control(
            'event-button-text1',
            [
                'label'       => __( 'Event BTN Text 01', 'bdevs-elementor' ),
                'label_block' => true,
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => 'View Map',
                'placeholder' => __( 'Event BTN Text 01', 'bdevs-elementor' ),
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        ); 

        $this->add_control(
            'event_url1',
            [
                'label' => __( 'Event URL 01', 'bdevs-elementor' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'event url goes here', 'bdevs-elementor' ),
                'placeholder' => __( 'Set Event URL', 'bdevs-elementor' ),
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'title_tag2',
            [
                'label'   => __( 'Title HTML Tag', 'bdevs-elementor' ),
                'type'    => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'h1' => [
                        'title' => __( 'H1', 'bdevs-elementor' ),
                        'icon'  => 'eicon-editor-h1',
                    ],
                    'h2' => [
                        'title' => __( 'H2', 'bdevs-elementor' ),
                        'icon'  => 'eicon-editor-h2',
                    ],
                    'h3' => [
                        'title' => __( 'H3', 'bdevs-elementor' ),
                        'icon'  => 'eicon-editor-h3',
                    ],
                    'h4' => [
                        'title' => __( 'H4', 'bdevs-elementor' ),
                        'icon'  => 'eicon-editor-h4',
                    ],
                    'h5' => [
                        'title' => __( 'H5', 'bdevs-elementor' ),
                        'icon'  => 'eicon-editor-h5',
                    ],
                    'h6' => [
                        'title' => __( 'H6', 'bdevs-elementor' ),
                        'icon'  => 'eicon-editor-h6',
                    ],
                ],
                'default' => 'h4',
                'toggle'  => false,
            ]
        );

        $this->add_responsive_control(
            'align2',
            [
                'label'     => __( 'Alignment', 'bdevs-elementor' ),
                'type'      => \Elementor\Controls_Manager::CHOOSE,
                'options'   => [
                    'left'   => [
                        'title' => __( 'Left', 'bdevs-elementor' ),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'bdevs-elementor' ),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'right'  => [
                        'title' => __( 'Right', 'bdevs-elementor' ),
                        'icon'  => 'fa fa-align-right',
                    ],
                ],
                'toggle'    => true,
                'selectors' => [
                    '{{WRAPPER}} .section__title-wrapper' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

    }

    public function images(){
        $this->start_controls_section(
            '_section_about_image',
            [
                'label' => __('Image', 'bdevs-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'bg_image',
            [
                'type' => \Elementor\Controls_Manager::MEDIA,
                'label' => __('BG Image', 'bdevs-elementor'),
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'image',
            [
                'type' => \Elementor\Controls_Manager::MEDIA,
                'label' => __('Image', 'bdevs-elementor'),
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'image2',
            [
                'type' => \Elementor\Controls_Manager::MEDIA,
                'label' => __('Image 02', 'bdevs-elementor'),
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

    public function event_box2(){
        $this->start_controls_section(
            '_event-box2',
            [
                'label' => __( 'Event Box 02', 'bdevs-elementor' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'designs' => ['design_1']
                ]
            ]
        );

        $this->add_control(
            'event-title2',
            [
                'label'       => __( 'Event Title 02', 'bdevs-elementor' ),
                'label_block' => true,
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => 'Wedding Anniversary',
                'placeholder' => __( 'Event Title 02', 'bdevs-elementor' ),
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'event-month2',
            [
                'label'       => __( 'Event Month 02', 'bdevs-elementor' ),
                'label_block' => true,
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => 'Feb',
                'placeholder' => __( 'Event Month 02', 'bdevs-elementor' ),
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'event-day2',
            [
                'label'       => __( 'Event Day 02', 'bdevs-elementor' ),
                'label_block' => true,
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => 'Monday',
                'placeholder' => __( 'Event Day 02', 'bdevs-elementor' ),
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'event-date2',
            [
                'label'       => __( 'Event Date 02', 'bdevs-elementor' ),
                'label_block' => true,
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => '14',
                'placeholder' => __( 'Event Date 01', 'bdevs-elementor' ),
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'event-time2',
            [
                'label'       => __( 'Event Time 02', 'bdevs-elementor' ),
                'label_block' => true,
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => '04:30 PM',
                'placeholder' => __( 'Event Time 01', 'bdevs-elementor' ),
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'event-year2',
            [
                'label'       => __( 'Event Year 02', 'bdevs-elementor' ),
                'label_block' => true,
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => '2022',
                'placeholder' => __( 'Event Year 02', 'bdevs-elementor' ),
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        );  

        $this->add_control(
            'event-address2',
            [
                'label'       => __( 'Event Address 02', 'bdevs-elementor' ),
                'label_block' => true,
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'default'     => 'St. Joseph Church, London, U.K.',
                'placeholder' => __( 'Event Address 02', 'bdevs-elementor' ),
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        );  

        $this->add_control(
            'event-phone2',
            [
                'label'       => __( 'Event Phone 02', 'bdevs-elementor' ),
                'label_block' => true,
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => '+1 682-853-2470',
                'placeholder' => __( 'Event Phone 02', 'bdevs-elementor' ),
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        ); 

        $this->add_control(
            'event-button-text2',
            [
                'label'       => __( 'Event BTN Text 02', 'bdevs-elementor' ),
                'label_block' => true,
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => 'View Map',
                'placeholder' => __( 'Event BTN Text 02', 'bdevs-elementor' ),
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        ); 

        $this->add_control(
            'event_url2',
            [
                'label' => __( 'Event URL 02', 'bdevs-elementor' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'event url goes here', 'bdevs-elementor' ),
                'placeholder' => __( 'Set Event URL', 'bdevs-elementor' ),
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'title_tag3',
            [
                'label'   => __( 'Title HTML Tag', 'bdevs-elementor' ),
                'type'    => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'h1' => [
                        'title' => __( 'H1', 'bdevs-elementor' ),
                        'icon'  => 'eicon-editor-h1',
                    ],
                    'h2' => [
                        'title' => __( 'H2', 'bdevs-elementor' ),
                        'icon'  => 'eicon-editor-h2',
                    ],
                    'h3' => [
                        'title' => __( 'H3', 'bdevs-elementor' ),
                        'icon'  => 'eicon-editor-h3',
                    ],
                    'h4' => [
                        'title' => __( 'H4', 'bdevs-elementor' ),
                        'icon'  => 'eicon-editor-h4',
                    ],
                    'h5' => [
                        'title' => __( 'H5', 'bdevs-elementor' ),
                        'icon'  => 'eicon-editor-h5',
                    ],
                    'h6' => [
                        'title' => __( 'H6', 'bdevs-elementor' ),
                        'icon'  => 'eicon-editor-h6',
                    ],
                ],
                'default' => 'h4',
                'toggle'  => false,
            ]
        );

        $this->add_responsive_control(
            'align3',
            [
                'label'     => __( 'Alignment', 'bdevs-elementor' ),
                'type'      => \Elementor\Controls_Manager::CHOOSE,
                'options'   => [
                    'left'   => [
                        'title' => __( 'Left', 'bdevs-elementor' ),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'bdevs-elementor' ),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'right'  => [
                        'title' => __( 'Right', 'bdevs-elementor' ),
                        'icon'  => 'fa fa-align-right',
                    ],
                ],
                'toggle'    => true,
                'selectors' => [
                    '{{WRAPPER}} .section__title-wrapper' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    public function button(){

        // Button 
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

    /**
     * Register styles related controls
     */
    protected function register_style_controls() {

       $this->title_style_controls();
       $this->description_style_controls();
       $this->button_style_controls();

    }

    protected function title_style_controls() {
        $this->start_controls_section(
            '_section_style_content',
            [
                'label' => __( 'Title / Content', 'bdevs-elementor' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'content_padding',
            [
                'label' => __( 'Content Padding', 'bdevs-elementor' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
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
                'label' => __( 'Title', 'bdevs-elementor' ),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'title_spacing',
            [
                'label' => __( 'Bottom Spacing', 'bdevs-elementor' ),
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
                'label' => __( 'Text Color', 'bdevs-elementor' ),
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
                'condition' => [
                    'designs' => ['design_6'],
                ],
            ]
        );

        // Subtitle    
        $this->add_control(
            '_heading_subtitle',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => __( 'Subtitle', 'bdevs-elementor' ),
                'separator' => 'before',
                 'condition' => [
                    'designs' => ['design_6'],
                ],
            ]
        );

        $this->add_responsive_control(
            'subtitle_spacing',
            [
                'label' => __( 'Bottom Spacing', 'bdevs-elementor' ),
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
                'label' => __( 'Text Color', 'bdevs-elementor' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-subtitle' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'designs' => ['design_6'],
                ],
            ]
        );

      }

      protected function description_style_controls() {

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'subtitle',
                'selector' => '{{WRAPPER}} .bdevs-el-subtitle',
            ]
        );

        // description
        $this->add_control(
            '_content_description',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => __( 'Description', 'bdevs-elementor' ),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'description_spacing',
            [
                'label' => __( 'Bottom Spacing', 'bdevs-elementor' ),
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
                'label' => __( 'Text Color', 'bdevs-elementor' ),
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

      protected function button_style_controls() {

        
        // Button 1 style
        $this->start_controls_section(
            '_section_style_button',
            [
                'label' => __( 'Button', 'bdevs-elementor' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'designs' => ['design_2','design_3','design_4','design_5'],
                ],
            ]
        );

        $this->add_responsive_control(
            'button_padding',
            [
                'label' => __( 'Padding', 'bdevs-elementor' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
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
                'label' => __( 'Border Radius', 'bdevs-elementor' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
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

        $this->start_controls_tabs( '_tabs_button' );

        $this->start_controls_tab(
            '_tab_button_normal',
            [
                'label' => __( 'Normal', 'bdevs-elementor' ),
            ]
        );

        $this->add_control(
            'button_color',
            [
                'label' => __( 'Text Color', 'bdevs-elementor' ),
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
                'label' => __( 'Background Color', 'bdevs-elementor' ),
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
                'label' => __( 'Hover', 'bdevs-elementor' ),
            ]
        );

        $this->add_control(
            'button_hover_color',
            [
                'label' => __( 'Text Color', 'bdevs-elementor' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-btn:hover, {{WRAPPER}} .bdevs-el-btn:focus' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_bg_color',
            [
                'label' => __( 'Background Color', 'bdevs-elementor' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-btn:hover, {{WRAPPER}} .bdevs-el-btn:focus' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_border_color',
            [
                'label' => __( 'Border Color', 'bdevs-elementor' ),
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

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        
        ?>

        <?php if ($settings['designs'] === 'design_7'):

        if (!empty($settings['image']['id'])) {
            $image = wp_get_attachment_image_url($settings['image']['id'], $settings['thumbnail_size']);
        }

        if (!empty($settings['image1']['id'])) {
            $image1 = wp_get_attachment_image_url($settings['image1']['id'], $settings['thumbnail_size']);
        }

        if (!empty($settings['image22']['id'])) {
            $image22 = wp_get_attachment_image_url($settings['image22']['id'], $settings['thumbnail_size']);
        }

        if (!empty($settings['image3']['id'])) {
            $image3 = wp_get_attachment_image_url($settings['image3']['id'], $settings['thumbnail_size']);
        }

        if (!empty($settings['image4']['id'])) {
            $image4 = wp_get_attachment_image_url($settings['image4']['id'], $settings['thumbnail_size']);
        }

        if (!empty($settings['image5']['id'])) {
            $image5 = wp_get_attachment_image_url($settings['image5']['id'], $settings['thumbnail_size']);
        }

        $this->add_render_attribute('title', 'class', 'bd-section-title mb-25 md-pr-50 bdevs-el-title');

        ?>    


        <div class="campus-area fix">
            <div class="container">
                <div class="campus-wrapper position-relative">
                    <div class="campus-shape-sticker">
                        <?php if ($settings['shape_switch']): ?>
                        <div class="shape-light">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/shape/shape-light.png" alt="image not found">
                        </div>
                        <?php endif; ?>
                        <?php if ($settings['about_batch_title']): ?>
                        <div class="campus-shape-content">
                            <?php echo wp_kses_post($settings['about_batch_title']); ?>     
                        </div>
                        <?php endif; ?>
                    </div>
                    <?php if ($settings['shape_switch']): ?>
                    <div class="campus-shape-1">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/shape/campus-shape-2.png" alt="shape">
                    </div>
                    <?php endif; ?>
                    <?php if ($settings['shape_switch']): ?>
                    <div class="campus-shape-2">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/shape/student-shape-05.png" alt="shape">
                    </div>
                    <?php endif; ?>
                    <div class="row align-items-center">
                        <div class="col-xl-5 col-lg-6">
                            <div class="compus-content mb-30 bdevs-el-content">
                                <div class="section-title mb-30">
                                  <?php
                                    if ($settings['title']) :
                                        printf(
                                            '<%1$s %2$s>%3$s</%1$s>',
                                            tag_escape($settings['title_tag']),
                                            $this->get_render_attribute_string('title'),
                                            wp_kses_post($settings['title'])
                                        );
                                    endif;
                                 ?>
                                </div>
                                <?php if ($settings['description']): ?>
                                <p><?php echo wp_kses_post($settings['description']); ?></p>
                                <?php endif; ?>    
                                <ul>
                                    <?php foreach ($settings['slides'] as $slide): ?>
                                    <li><i class="far fa-check"></i><?php echo wp_kses_post($slide['title']); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                        <div class="col-xl-6 offset-xl-1 col-lg-6">
                            <div class="campus-img-wrapper position-relative">
                                <?php if ($settings['shape_switch']): ?>
                                <div class="campus-shape-3">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/shape/campus-shape-1.png" alt="image not found">
                                </div>
                                <?php endif; ?>
                                <?php if (!empty($image5)): ?>
                                <div class="campus-img-1">
                                    <img src="<?php echo esc_url($image5); ?>" alt="image not found">
                                </div>
                                <?php endif; ?>
                                <?php if (!empty($image4)): ?>
                                <div class="campus-img-2">
                                    <img src="<?php echo esc_url($image4); ?>" alt="image not found">
                                </div>
                                <?php endif; ?>
                                <?php if (!empty($image3)): ?>
                                <div class="campus-img-3">
                                    <img src="<?php echo esc_url($image3); ?>" alt="image not found">
                                </div>
                                <?php endif; ?>
                                <?php if (!empty($image22)): ?>
                                <div class="campus-img-4">
                                    <img src="<?php echo esc_url($image22); ?>" alt="image not found">
                                </div>
                                <?php endif; ?>
                                <?php if (!empty($image1)): ?>
                                <div class="campus-img-5">
                                    <img src="<?php echo esc_url($image1); ?>" alt="image not found">
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php elseif ($settings['designs'] === 'design_6'):

        $title = wp_kses_post($settings['title']);

        if (!empty($settings['image']['id'])) {
            $image = wp_get_attachment_image_url($settings['image']['id'], $settings['thumbnail_size']);
        }

        if (!empty($settings['about_author_image']['id'])) {
            $about_author_image = wp_get_attachment_image_url($settings['about_author_image']['id'], $settings['thumbnail_size']);
        }

        $this->add_render_attribute('title', 'class', 'bd-section-title mb-25 md-pr-50 bdevs-el-title');

        ?>

        <div class="university-message-area">
            <div class="container">
                <div class="row">
                    <div class="col-xl-4 col-lg-4">
                        <div class="section-title mb-30">
                            <?php
                                if ($settings['title']) :
                                    printf(
                                        '<%1$s %2$s>%3$s</%1$s>',
                                        tag_escape($settings['title_tag']),
                                        $this->get_render_attribute_string('title'),
                                        wp_kses_post($settings['title'])
                                    );
                                endif;
                            ?>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4">
                        <div class="message-profile-text bdevs-el-content">
                            <?php if ($settings['sub_title']): ?>
                            <span class="bdevs-el-subtitle"><?php echo wp_kses_post($settings['sub_title']); ?></span>
                            <?php endif; ?>
                            <?php if ($settings['description']): ?>
                            <p><?php echo wp_kses_post($settings['description']); ?></p>
                            <?php endif; ?>    
                        </div>
                        <div class="message-meta">
                            <?php if (!empty($about_author_image)): ?>
                            <a href="<?php echo esc_url($settings['about_author_url']); ?>"><img src="<?php echo esc_url($about_author_image); ?>"
                                    alt="meta-img"></a>
                            <?php endif; ?>        
                            <div class="message-meta-link">
                                <?php if ($settings['about_author_title']): ?>
                                <a href="<?php echo esc_url($settings['about_author_url']); ?>">
                                    <h4><?php echo wp_kses_post($settings['about_author_title']); ?></h4>
                                </a>
                               <?php endif; ?>
                               <?php if ($settings['about_author_des']): ?>
                                <p><?php echo wp_kses_post($settings['about_author_des']); ?></p>
                               <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4">
                        <div class="message-sticker position-relative">
                            <?php if (!empty($image)): ?>
                            <img src="<?php echo esc_url($image); ?>" alt="img">
                            <?php endif; ?>
                            <?php if ($settings['shape_switch']): ?>
                            <div class="etablist-price">
                                <p> <?php echo wp_kses_post($settings['about_since_title']); ?>
                                 <span><?php echo wp_kses_post($settings['about_since_year']); ?></span> 
                                 <?php echo wp_kses_post($settings['about_since_location']); ?></p>
                            </div>
                           <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php elseif ($settings['designs'] === 'design_5'):

        if (!empty($settings['image']['id'])) {
            $image = wp_get_attachment_image_url($settings['image']['id'], $settings['thumbnail_size']);
        }


        $this->add_render_attribute('title', 'class', 'bd-section-title mb-25 bdevs-el-title');
        $this->add_render_attribute('title', 'data-wow-delay', '');

        if ( !empty($settings['button_link']) ) {
            $this->add_render_attribute( 'button', 'class', 'edu-btn btn-transparent mt-25 bdevs-el-btn' );
            $this->add_link_attributes( 'button', $settings['button_link'] );
        }

        ?>

        <section class="zoom-area">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xxl-4 col-xl-5 col-lg-5 order-lg-2">
                        <div class="zoom-thumb position-relative">
                            <?php if (!empty($settings['shape_switch'])): ?>
                            <img class="zoom-shape-01" src="<?php echo get_template_directory_uri(); ?>/assets/img/teacher/zoom-shape-1.png" alt="image not found">
                            <img class="zoom-shape-02" src="<?php echo get_template_directory_uri(); ?>/assets/img/teacher/zoom-shape-2.png" alt="image not found">
                            <?php endif; ?>
                            <?php if (!empty($image)): ?>
                            <img class="zoom-thumb-main-img" src="<?php echo esc_url($image); ?>" alt="image not found">
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-xxl-4 col-xl-5 col-lg-5 order-lg-1">
                        <div class="zoom-class-wrapper mb-60">
                            <div class="section-title mb-30">
                                <?php
                                    if ($settings['title']) :
                                        printf(
                                            '<%1$s %2$s>%3$s</%1$s>',
                                            tag_escape($settings['title_tag']),
                                            $this->get_render_attribute_string('title'),
                                            wp_kses_post($settings['title'])
                                        );
                                    endif;
                                ?>
                            </div>
                            <div class="zoon-class-text bdevs-el-content">
                                <?php if ($settings['description']): ?>
                                <p><?php echo wp_kses_post($settings['description']); ?></p>
                                 <?php endif; ?>          
                            </div>
                          <?php if ($settings['button_text'] && ((empty($settings['button_selected_icon']) || empty($settings['button_selected_icon']['value'])) && empty($settings['button_icon']))) :
                                printf('<a %1$s>%2$s</a>',
                                    $this->get_render_attribute_string('button'),
                                    esc_html($settings['button_text'])
                                );
                            elseif (empty($settings['button_text']) && ((!empty($settings['button_selected_icon']) || empty($settings['button_selected_icon']['value'])) || !empty($settings['button_icon']))) : ?>
                                <a <?php $this->print_render_attribute_string('button'); ?>><?php bdevs_elementor_render_icon($settings, 'button_icon', 'button_selected_icon'); ?></a>
                            <?php elseif ($settings['button_text'] && ((!empty($settings['button_selected_icon']) || empty($settings['button_selected_icon']['value'])) || !empty($settings['button_icon']))) :
                                if ($settings['button_icon_position'] === 'before'): ?>
                                    <a <?php $this->print_render_attribute_string('button'); ?>><?php bdevs_elementor_render_icon($settings, 'button_icon', 'button_selected_icon', ['class' => 'bdevs-btn-icon']); ?>
                                        <span><?php echo esc_html($settings['button_text']); ?></span></a>
                                <?php
                                else: ?>
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
            </div>
        </section>

    <?php elseif ($settings['designs'] === 'design_4'):

        if (!empty($settings['image']['id'])) {
            $image = wp_get_attachment_image_url($settings['image']['id'], $settings['thumbnail_size']);
        }
        if (!empty($settings['image2']['id'])) {
            $image2 = wp_get_attachment_image_url($settings['image2']['id'], $settings['thumbnail_size']);
        }
        if (!empty($settings['image3']['id'])) {
            $image3 = wp_get_attachment_image_url($settings['image3']['id'], $settings['thumbnail_size']);
        }

        $this->add_render_attribute('title', 'class', 'bd-section-title mb-25 bdevs-el-title');
        $this->add_render_attribute('title', 'data-wow-delay', '');

        if ( !empty($settings['button_link']) ) {
            $this->add_render_attribute( 'button', 'class', 'edu-btn btn-transparent mt-25 bdevs-el-btn' );
            $this->add_link_attributes( 'button', $settings['button_link'] );
        }

        ?>

        <section class="teacher-area position-relative fix">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-xxl-4 col-xl-5 col-lg-5">
                        <div class="teacher-img position-relative">
                            <?php if (!empty($image)): ?>
                            <img class="teacher-main-img" src="<?php echo esc_url($image); ?>" alt="image not found">
                            <?php endif; ?>
                            <?php if (!empty($settings['shape_switch'])): ?>
                            <img class="teacher-shape" src="<?php echo get_template_directory_uri(); ?>/assets/img/teacher/teacher-shape-01.png"
                                alt="image not found">
                            <?php endif; ?>
                            <?php if (!empty($image2)): ?>    
                            <img class="teacher-shape-02" src="<?php echo esc_url($image2); ?>"
                                alt="image not found">
                            <?php endif; ?>  
                            <?php if (!empty($settings['shape_switch'])): ?>
                            <img class="teacher-shape-03" src="<?php echo get_template_directory_uri(); ?>/assets/img/teacher/teacher-shape-03.png"
                                alt="image not found">
                            <img class="teacher-shape-04" src="<?php echo get_template_directory_uri(); ?>/assets/img/teacher/teacher-shape-04.png"
                                alt="image not found">
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-xxl-4 col-xl-5 col-lg-5">
                        <div class="teacher-content mr-20 bdevs-el-content">
                            <div class="section-title mb-25">
                                <?php
                                    if ($settings['title']) :
                                        printf(
                                            '<%1$s %2$s>%3$s</%1$s>',
                                            tag_escape($settings['title_tag']),
                                            $this->get_render_attribute_string('title'),
                                            wp_kses_post($settings['title'])
                                        );
                                    endif;
                                ?>
                            </div>
                            <?php if ($settings['description']): ?>
                            <p><?php echo wp_kses_post($settings['description']); ?></p>
                            <?php endif; ?>

                            <?php if ($settings['button_text'] && ((empty($settings['button_selected_icon']) || empty($settings['button_selected_icon']['value'])) && empty($settings['button_icon']))) :
                                    printf('<a %1$s>%2$s</a>',
                                        $this->get_render_attribute_string('button'),
                                        esc_html($settings['button_text'])
                                    );
                                elseif (empty($settings['button_text']) && ((!empty($settings['button_selected_icon']) || empty($settings['button_selected_icon']['value'])) || !empty($settings['button_icon']))) : ?>
                                    <a <?php $this->print_render_attribute_string('button'); ?>><?php bdevs_elementor_render_icon($settings, 'button_icon', 'button_selected_icon'); ?></a>
                                <?php elseif ($settings['button_text'] && ((!empty($settings['button_selected_icon']) || empty($settings['button_selected_icon']['value'])) || !empty($settings['button_icon']))) :
                                    if ($settings['button_icon_position'] === 'before'): ?>
                                        <a <?php $this->print_render_attribute_string('button'); ?>><?php bdevs_elementor_render_icon($settings, 'button_icon', 'button_selected_icon', ['class' => 'bdevs-btn-icon']); ?>
                                            <span><?php echo esc_html($settings['button_text']); ?></span></a>
                                    <?php
                                    else: ?>
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
            </div>
        </section>

    <?php elseif ($settings['designs'] === 'design_3'):

        if (!empty($settings['image']['id'])) {
            $image = wp_get_attachment_image_url($settings['image']['id'], $settings['thumbnail_size']);
        }
         
         $this->add_render_attribute('title', 'class', 'bd-section-title mb-25 bdevs-el-title');

        if ( !empty($settings['button_link']) ) {
            $this->add_render_attribute( 'button', 'class', 'edu-btn bdevs-el-btn' );
            $this->add_link_attributes( 'button', $settings['button_link'] );
        }


        ?>

        <section class="about-area p-relative">
            <div class="container">
                <?php if (!empty($settings['shape_switch'])): ?>
                <img class="about-shape" src="<?php echo get_template_directory_uri(); ?>/assets/img/shape/education-shape-03.png" alt="shape">
                <?php endif; ?>
                <div class="row">
                    <div class="col-xl-6 col-lg-6">
                        <div class="about-img position-relative mb-50">
                            <?php if (!empty($image)): ?>
                            <div class="about-main-img">
                                <img src="<?php echo esc_url($image); ?>" alt="about">
                            </div>
                            <?php endif; ?>
                            <?php if (!empty($settings['shape_switch'])): ?>
                            <img class="about-shape-1" src="<?php echo get_template_directory_uri(); ?>/assets/img/shape/education-shape-01.png" alt="about">
                            <img class="about-shape-2" src="<?php echo get_template_directory_uri(); ?>/assets/img/shape/education-shape-02.png" alt="about">
                            <img class="about-shape-3" src="<?php echo get_template_directory_uri(); ?>/assets/img/shape/education-shape-05.png" alt="about">
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-5">
                        <div class="about-content mb-50">
                            <div class="section-title">
                            <?php
                                if ($settings['title']) :
                                    printf(
                                        '<%1$s %2$s>%3$s</%1$s>',
                                        tag_escape($settings['title_tag']),
                                        $this->get_render_attribute_string('title'),
                                        wp_kses_post($settings['title'])
                                    );
                                endif;
                            ?>
                            </div>
                            <div class="student-choose-list bdevs-el-content">
                                <?php if ($settings['description']): ?>
                                <p class=" mb-30"><?php echo wp_kses_post($settings['description']); ?></p>
                                <?php endif; ?>
                                <ul>
                                    <?php foreach ($settings['slides'] as $slide): ?>
                                    <li><i class="fas fa-check-circle"></i><?php echo wp_kses_post($slide['title']); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                            <?php if ($settings['button_text'] && ((empty($settings['button_selected_icon']) || empty($settings['button_selected_icon']['value'])) && empty($settings['button_icon']))) :
                                printf('<a %1$s>%2$s</a>',
                                    $this->get_render_attribute_string('button'),
                                    esc_html($settings['button_text'])
                                );
                            elseif (empty($settings['button_text']) && ((!empty($settings['button_selected_icon']) || empty($settings['button_selected_icon']['value'])) || !empty($settings['button_icon']))) : ?>
                                <a <?php $this->print_render_attribute_string('button'); ?>><?php bdevs_elementor_render_icon($settings, 'button_icon', 'button_selected_icon'); ?></a>
                            <?php elseif ($settings['button_text'] && ((!empty($settings['button_selected_icon']) || empty($settings['button_selected_icon']['value'])) || !empty($settings['button_icon']))) :
                                if ($settings['button_icon_position'] === 'before'): ?>
                                    <a <?php $this->print_render_attribute_string('button'); ?>><?php bdevs_elementor_render_icon($settings, 'button_icon', 'button_selected_icon', ['class' => 'bdevs-btn-icon']); ?>
                                        <span><?php echo esc_html($settings['button_text']); ?></span></a>
                                <?php
                                else: ?>
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
            </div>
        </section>

    <?php elseif ($settings['designs'] === 'design_2'):
        if (!empty($settings['image']['id'])) {
            $image = wp_get_attachment_image_url($settings['image']['id'], $settings['thumbnail_size']);
        }

        $this->add_render_attribute('title', 'class', 'bd-section-title mb-25 bdevs-el-title');

         $this->add_render_attribute('button', 'class', 'edu-sec-btn bdevs-el-btn');

       if ( !empty($settings['button_link']) ) {
            $this->add_render_attribute( 'button', 'class', 'edu-sec-btn bdevs-el-btn' );
            $this->add_link_attributes( 'button', $settings['button_link'] );
        }

        ?>

        <div class="student-choose-area fix pt-120 pb-110">
            <div class="container">
                <div class="row">
                   <div class="col-xl-5 col-lg-5">
                      <div class="student-wrapper">
                         <div class="section-title">
                          <?php
                            if ($settings['title']) :
                                printf(
                                    '<%1$s %2$s>%3$s</%1$s>',
                                    tag_escape($settings['title_tag']),
                                    $this->get_render_attribute_string('title'),
                                    wp_kses_post($settings['title'])
                                );
                            endif;
                          ?>
                         </div>
                         <div class="sitdent-choose-content bdevs-el-content">
                            <?php if ($settings['description']): ?>
                            <p><?php echo wp_kses_post($settings['description']); ?></p>
                            <?php endif; ?>
                         </div>
                         <div class="student-choose-list">
                            <ul>
                             <?php foreach ($settings['slides'] as $slide): ?>
                               <li><i class="fas fa-check-circle"></i><?php echo wp_kses_post($slide['title']); ?></li>
                             <?php endforeach; ?>
                           </ul>
                            </ul>
                         </div>
                         <div class="student-btn">
                           <?php if ($settings['button_text'] && ((empty($settings['button_selected_icon']) || empty($settings['button_selected_icon']['value'])) && empty($settings['button_icon']))) :
                                printf('<a %1$s>%2$s</a>',
                                    $this->get_render_attribute_string('button'),
                                    esc_html($settings['button_text'])
                                );
                            elseif (empty($settings['button_text']) && ((!empty($settings['button_selected_icon']) || empty($settings['button_selected_icon']['value'])) || !empty($settings['button_icon']))) : ?>
                                <a <?php $this->print_render_attribute_string('button'); ?>><?php bdevs_elementor_render_icon($settings, 'button_icon', 'button_selected_icon'); ?></a>
                            <?php elseif ($settings['button_text'] && ((!empty($settings['button_selected_icon']) || empty($settings['button_selected_icon']['value'])) || !empty($settings['button_icon']))) :
                                if ($settings['button_icon_position'] === 'before'): ?>
                                    <a <?php $this->print_render_attribute_string('button'); ?>><?php bdevs_elementor_render_icon($settings, 'button_icon', 'button_selected_icon', ['class' => 'bdevs-btn-icon']); ?>
                                        <span><?php echo esc_html($settings['button_text']); ?></span></a>
                                <?php
                                else: ?>
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
                   <div class="col-xl-2 col-lg-2">
                    <?php if (!empty($settings['shape_switch'])): ?>
                      <div class="student-wrapper position-relative">
                         <div class="shap-01">
                         </div>
                      </div>
                     <?php endif; ?>
                   </div>
                   <div class="col-xl-5 col-lg-5">
                      <div class="student-choose-wrapper position-relative">
                        <?php if (!empty($settings['shape_switch'])): ?>
                         <div class="shap-02">
                         </div>
                         <div class="shap-03">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/shape/student-shape-03.png" alt="image not found">
                         </div>
                         <div class="shap-04">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/shape/student-shape-04.png" alt="image not found">
                         </div>
                         <div class="shap-05">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/shape/student-shape-05.png" alt="image not found">
                         </div>
                         <div class="shap-06">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/shape/student-shape-06.png" alt="image not found">
                         </div>
                         <div class="shap-07">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/shape/student-shape-07.png" alt="image not found">
                         </div>
                         <?php endif; ?>
                         <?php if (!empty($image)): ?>
                         <div class="student-choose-thumb">
                            <img src="<?php echo esc_url($image); ?>" alt="image not found">
                         </div>
                         <?php endif; ?>
                      </div>
                   </div>
                </div>
            </div>
        </div>

         
    <?php else: 

        if (!empty($settings['bg_image']['id'])) {
            $bg_image = wp_get_attachment_image_url($settings['bg_image']['id'], $settings['thumbnail_size']);
        }

        if (!empty($settings['image']['id'])) {
            $image = wp_get_attachment_image_url($settings['image']['id'], $settings['thumbnail_size']);
        }

        if (!empty($settings['image2']['id'])) {
            $image2 = wp_get_attachment_image_url($settings['image2']['id'], $settings['thumbnail_size']);
        }

        ?>

        <!-- event area start -->
        <div class="event-area pb-120 pt-95 bg-default bg-top-center pb-155" data-background="<?php echo esc_url($bg_image); ?>">
           <div class="container">
                <?php if ($settings['title']): ?>
                <div class="row pb-65">
                    <div class="col-xxl-12">
                        <div class="lv-section-title-wrap-2 text-center">
                            <span class="bdevs-el-subtitle"></span>
                            <?php if ($settings['sub_title']) : ?>
                            <h4 class="lv-section-subtitle-2 mb-15">
                                <?php echo wp_kses_post($settings['sub_title']); ?>
                            </h4>
                            <?php endif; ?>

                            
                            <h3 class="lv-section-title-2 mb-5-px bdevs-el-title">
                                <?php echo wp_kses_post($settings['title']); ?>
                            </h3>

                           <div class="lv-section-title-path-2">
                           <svg xmlns="http://www.w3.org/2000/svg" width="928" height="138.424" viewBox="0 0 928 138.424">
                             <g id="Patter2n" transform="translate(-904.529 -1940.999)">
                               <rect id="Rectangle_651" data-name="Rectangle 65" width="928" height="8" transform="translate(904.529 1940.999)" fill="#dfb68d"/>
                               <g id="Group_9407" data-name="Group 940" transform="translate(1267.401 1945.213)">
                                 <g id="Group_9206" data-name="Group 920" transform="translate(70.151 0)">
                                   <path id="Path_82662" data-name="Path 8266" d="M389.979,114.479c-31.932,5.41-27.388,55.791-16.644,76.747,8.4,16.384,21.3,29.668,27.265,47.363l-4.1.556c.865-9.019,6.073-15.817,10.615-23.48,7.83-13.208,14.4-27,18.642-41.783,4.734-16.534,5.356-35.215-6.68-48.667-9.232-10.316-22.949-12.956-36-11.223-3.2.424-3.663-4.644-.742-5.484,23.73-6.826,46.588,10.128,51.432,33.173,3.223,15.33-1.837,32.592-7.223,46.775a176.173,176.173,0,0,1-10.423,21.621c-5.265,9.651-13.334,18.681-15.524,29.622-.427,2.136-3.436,1.843-4.022,0-8.214-25.816-33.572-44.354-35.719-72.355-1.635-21.3,1.016-54.523,27.67-58.123,3.4-.46,4.956,4.665,1.451,5.26Z" transform="translate(-360.478 -106.981)" fill="#dfb68d"/>
                                 </g>
                                 <g id="Group_9212" data-name="Group 921" transform="translate(101.678 1.143)">
                                   <path id="Path_ss82672" data-name="Path 8267" d="M373.913,192.514c-2.284-18.741-.622-37.578-1.914-56.338-.224-3.3,5.3-3.324,5.133,0-.955,18.774,1.046,37.57-.909,56.338a1.156,1.156,0,0,1-2.311,0Z" transform="translate(-371.993 -133.692)" fill="#dfb68d"/>
                                 </g>
                                 <g id="Group_9228" data-name="Group 922" transform="translate(1.882 1.088)">
                                   <path id="Path_82687" data-name="Path 8268" d="M431.356,126.65c-28.973-2.645-49.559,12.189-62.958,36.965-9.378,17.345-14.185,35.234-29.633,48.568l-1.333-3.217c25.668,3.182,49.937,3.335,70.576-14.418a2.247,2.247,0,0,1,3.176,3.176c-18.8,20.691-49,20.269-74.253,14.944a1.9,1.9,0,0,1-.832-3.151c19.023-16.1,21.3-44.018,36.611-63.087,13.969-17.4,36.34-30.993,59.106-23.182,1.75.6,1.588,3.589-.46,3.4Z" transform="translate(-335.543 -120.988)" fill="#dfb68d"/>
                                 </g>
                                 <g id="Group_9237" data-name="Group 923" transform="translate(55.326 7.486)">
                                   <path id="Path_826911" data-name="Path 8269" d="M355.12,177.519c7.122-15.924,11.932-32.625,30.446-38.629a1.74,1.74,0,0,1,1.336,3.168c-7.669,4.016-13.92,8.356-18.834,15.672-4.312,6.418-8.3,13.564-11.948,20.373-.359.668-1.3.082-1-.583Z" transform="translate(-355.063 -138.806)" fill="#dfb68d"/>
                                 </g>
                                 <g id="Group_9244" data-name="Group 924" transform="translate(116.663 2.073)">
                                   <path id="Path_82704" data-name="Path 8270" d="M398.565,186.019c15.894,20.036,37.337,27.478,62.46,27.743l-1.791,4.323c-13.709-12.917-16.917-32.014-22.722-49.14-9-26.552-30.75-41.384-57.412-45.814-2.563-.427-1.925-4.559.6-4.477,19.281.627,39.788,11.39,51.027,27.136,15.05,21.082,14.273,49.414,32.08,68.713,1.383,1.5.545,4.509-1.788,4.321-24.261-1.944-53.882-5.678-65.483-30.473-.86-1.834,1.572-4.164,3.023-2.333Z" transform="translate(-377.466 -118.654)" fill="#dfb68d"/>
                                 </g>
                                 <g id="Grdsoup_9252" data-name="Group 925" transform="translate(126.025 9.486)">
                                   <path id="Path_8271" data-name="Path 8271" d="M381.81,135.531c18.684,9.859,24.713,28.3,34.832,45.326a.9.9,0,0,1-1.41,1.087c-6.133-6.658-9.416-15.053-14.059-22.744-5.328-8.824-12.8-15.612-20.1-22.711a.612.612,0,0,1,.739-.958Z" transform="translate(-380.885 -135.457)" fill="#dfb68d"/>
                                 </g>
                                 <g id="Group_9266" data-name="Group 926" transform="translate(0 0.518)">
                                   <path id="Path_82721" data-name="Path 8272" d="M339.141,141.923c4.833,6.678,7.932,14.64,12.419,21.608a53.068,53.068,0,0,0,17.249,16.408c.871.531.3,2.089-.717,1.7-15.431-5.917-28.236-22.484-33.112-37.961-.83-2.626,2.735-3.729,4.161-1.755Z" transform="translate(-334.856 -140.915)" fill="#dfb68d"/>
                                 </g>
                                 <g id="Group_9271" data-name="Group 927" transform="translate(172.98 0.518)">
                                   <path id="Path_82735" data-name="Path 8273" d="M432.292,143.678c-4.876,15.477-17.681,32.045-33.112,37.961-1.016.389-1.588-1.169-.718-1.7a55.45,55.45,0,0,0,17.249-16.408c4.7-6.88,7.562-14.9,12.417-21.608,1.429-1.974,4.991-.871,4.165,1.755Z" transform="translate(-398.035 -140.915)" fill="#dfb68d"/>
                                 </g>
                                 <g id="Group_9285" data-name="Group 928" transform="translate(9.989 2.358)">
                                   <path id="Path_82741" data-name="Path 8274" d="M343.544,144.45c4.986,11.8,10.358,22.7,22.147,29.038,1.738.934.213,3.411-1.522,2.6-12.041-5.6-20.255-16.9-25.411-28.844-1.4-3.255,3.4-6.073,4.786-2.8Z" transform="translate(-338.504 -142.992)" fill="#dfb68d"/>
                                 </g>
                                 <g id="Group_9291" data-name="Group 929" transform="translate(168.258 2.47)">
                                   <path id="Path_82757" data-name="Path 8275" d="M397.029,173.291c5.761-2.73,9.846-6.305,14.016-11.083a94.749,94.749,0,0,0,7.3-9.282c1.968-2.91,3.017-6.281,5.043-9.123.871-1.221,3.365-.994,3.168.86-.775,7.329-6.494,13.61-11.182,18.966s-10.029,11.743-17.6,12.414a1.485,1.485,0,0,1-.745-2.752Z" transform="translate(-396.31 -143.044)" fill="#dfb68d"/>
                                 </g>
                                 <g id="Group_93033" data-name="Group 930" transform="translate(3.417 66.994)">
                                   <path id="Path_82766" data-name="Path 8276" d="M336.827,144.482c6.412-3.231,13.106-5.016,19.206-9.043,6.325-4.175,11.894-9.364,18.686-12.811,1.12-.57,2.428.9,1.4,1.812-10.032,8.852-23.88,23.79-38.561,22.733-1.325-.1-2.108-2-.731-2.691Z" transform="translate(-336.104 -122.501)" fill="#dfb68d"/>
                                 </g>
                                 <g id="Group_9316" data-name="Group 931" transform="translate(6.139 60.417)">
                                   <path id="Path_82775" data-name="Path 8277" d="M337.131,151.31c.8-2.6,2.741-3.743,4.846-5.4a89.735,89.735,0,0,0,7.767-6.9c4.906-4.865,9-10.254,13.47-15.5.583-.682,1.665.047,1.448.843-1.914,7.08-6.229,13.1-11.111,18.459-3.453,3.795-10.267,10.6-15.792,9.6a.9.9,0,0,1-.63-1.1Z" transform="translate(-337.098 -123.244)" fill="#dfb68d"/>
                                 </g>
                                 <g id="Group_9325" data-name="Group 932" transform="translate(8.507 81.925)">
                                   <path id="Path_82781" data-name="Path 8278" d="M338.774,129.53c12.282-.047,22.588-4.449,34.287-7.184a1.225,1.225,0,0,1,.939,2.229c-10.371,6.289-23.535,10.388-35.447,6.593a.837.837,0,0,1,.221-1.637Z" transform="translate(-337.963 -122.31)" fill="#dfb68d"/>
                                 </g>
                                 <g id="Group_9337" data-name="Group 933" transform="translate(164.51 73.73)">
                                   <path id="Path_82797" data-name="Path 8279" d="M426.583,145.476c-6.47.093-13.052-5.15-17.964-8.9a53.049,53.049,0,0,1-13.49-14.9c-.786-1.3,1.079-2.782,2.117-1.635a91.482,91.482,0,0,0,15.151,13.87c4.786,3.354,11.061,4.893,15.344,8.77a1.649,1.649,0,0,1-1.158,2.793Z" transform="translate(-394.941 -119.632)" fill="#dfb68d"/>
                                 </g>
                                 <g id="Group_9346" data-name="Group 934" transform="translate(157.116 80.38)">
                                   <path id="Path_82804" data-name="Path 8280" d="M431.334,138.119c-12.285,3.819-31.623-6.768-38.851-16.419-.868-1.158.794-2.65,1.933-1.933,5.528,3.488,10.571,7.379,16.485,10.259,6.648,3.239,14.183,3.075,20.694,6.1.906.422.567,1.736-.26,1.993Z" transform="translate(-392.241 -119.579)" fill="#dfb68d"/>
                                 </g>
                                 <g id="Group_9354" data-name="Group 935" transform="translate(176.01 74.348)">
                                   <path id="Path_82815" data-name="Path 8281" d="M419.05,144.066c-4.6-1.029-8.685-5.024-11.94-8.249a29.674,29.674,0,0,1-7.907-13.947,1.483,1.483,0,0,1,2.7-1.139c2.844,3.8,5.706,7.841,8.884,11.412,3.069,3.45,7.042,6.281,9.788,9.944.767,1.024-.49,2.212-1.522,1.98Z" transform="translate(-399.142 -120.071)" fill="#dfb68d"/>
                                 </g>
                                 <g id="Group_9364" data-name="Group 936" transform="translate(90.171 84.527)">
                                   <path data-name="Path 8282" d="M384.626,153.428a144.43,144.43,0,0,0-8.9-23.554c-3.061-6.283-6.7-12.337-7.9-19.291a1.612,1.612,0,0,1,2.932-1.237c7.346,12.093,16.378,29.389,15.264,43.9a.71.71,0,0,1-1.388.186Z" transform="translate(-367.79 -108.553)" fill="#dfb68d"/>
                                 </g>
                                 <g data-name="Group 937" transform="translate(102.724 76.205)">
                                   <path data-name="Path 8283" d="M376.808,160.628c-4.55-15.51-5.96-34.651-2.513-50.474.271-1.246,2.4-1.333,2.6,0,2.39,16.047,2.42,34.1,1.363,50.277a.741.741,0,0,1-1.448.2Z" transform="translate(-372.375 -109.187)" fill="#dfb68d"/>
                                 </g>
                                 <g data-name="Group 938" transform="translate(105.991 85.682)">
                                   <path data-name="Path 8284" d="M374.2,152.482c-2.541-13.361,2.932-32.466,10.593-43.495A1.323,1.323,0,0,1,387.2,110c-1.427,7.187-4.328,14.032-6.168,21.137s-2.388,14.511-5.161,21.345c-.285.7-1.492.936-1.67,0Z" transform="translate(-373.568 -108.368)" fill="#dfb68d"/>
                                 </g>
                                 <g  data-name="Group 939" transform="translate(106.502 91.419)">
                                   <path data-name="Path 8285" d="M374.213,145.26c-1.7-5.221,1.728-11.086,3.9-15.82,3.239-7.061,6.705-13.933,11.841-19.823a1.259,1.259,0,0,1,2.092,1.218c-2.042,6.631-5.062,12.9-7.882,19.22-2.278,5.112-3.759,12.611-8.769,15.683a.813.813,0,0,1-1.18-.479Z" transform="translate(-373.754 -109.238)" fill="#dfb68d"/>
                                 </g>
                               </g>
                             </g>
                           </svg></div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <div class="row justify-content-center">
                    <div class="col-xxl-10">
                        <div class="row">
                            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 mb-60 mb-lg-0">
                                <div class="lv-special-event-box-2 text-center pr-52">
                                    <?php if ($settings['event-title1']) : ?>
                                    <h4 class="lv-special-event-title">
                                        <?php echo wp_kses_post($settings['event-title1']); ?> 
                                    </h4>
                                    <?php endif; ?>

                                    <div class="lv-special-event-box-main-2">
                                        <div class="lv-special-event-date-box-2 mb-10">
                                           <div class="lv-special-event-box-content-2  bg-default bg-100" data-background="<?php echo get_template_directory_uri(); ?>/assets/img/bg/frame.png">
                                                <?php if ($settings['event-month1']) : ?>
                                                <span class="lv-special-event-month-2 pt-10">
                                                    <?php echo wp_kses_post($settings['event-month1']); ?> 
                                                </span>
                                                <?php endif; ?>

                                                <div class="lv-special-event-date-flex-box-2">
                                                    <?php if ($settings['event-day1']) : ?>
                                                    <p class="lv-special-event-item-2-1">
                                                        <?php echo wp_kses_post($settings['event-day1']); ?>
                                                    </p>
                                                    <?php endif; ?>

                                                    <?php if ($settings['event-date1']) : ?>
                                                    <h4 class="lv-special-event-item-2-2">
                                                        <?php echo wp_kses_post($settings['event-date1']); ?>
                                                    </h4>
                                                    <?php endif; ?>

                                                    <?php if ($settings['event-time1']) : ?>
                                                    <p class="lv-special-event-item-2-3">
                                                        <?php echo wp_kses_post($settings['event-time1']); ?>
                                                    </p>
                                                    <?php endif; ?>
                                                </div>

                                                <?php if ($settings['event-year1']) : ?>
                                                <div class="lv-special-event-date-year-2 pb-13">
                                                    <p><?php echo wp_kses_post($settings['event-year1']); ?></p>
                                                </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="lv-special-event-address-2">
                                            <?php if ($settings['event-address1']) : ?>
                                            <p><?php echo wp_kses_post($settings['event-address1']); ?></p>
                                            <?php endif; ?>

                                            <?php if ($settings['event-phone1']) : ?>
                                            <p class="item-last">
                                                <?php echo wp_kses_post($settings['event-phone1']); ?>
                                            </p>
                                            <?php endif; ?>

                                            <?php if ($settings['event-button-text1']) : ?>
                                            <a href="<?php echo esc_url($settings['event_url1']); ?>" class="lv-underline-button-2">
                                                <?php echo wp_kses_post($settings['event-button-text1']); ?>
                                            </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-12 mb-60 mb-lg-0">
                                <div class="lv-special-event-middle-img-box-2 p-rel text-center">
                                    <?php if (!empty($image)): ?>
                                    <div class="lv-special-event-middle-img-2">
                                        <img src="<?php echo esc_url($image); ?>" alt="live" title="live">
                                    </div>
                                    <?php endif; ?>

                                    <?php if (!empty($image2)): ?>
                                    <div class="lv-special-event-middle-img-bottom-2">
                                        <img src="<?php echo esc_url($image2); ?>" alt="flower" title="flower">
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 lv-custom-event-order-2">
                                <div class="lv-special-event-box-2 text-center pl-52">
                                    <?php if ($settings['event-title1']) : ?>
                                    <h4 class="lv-special-event-title">
                                        <?php echo wp_kses_post($settings['event-title1']); ?> 
                                    </h4>
                                    <?php endif; ?>

                                    <div class="lv-special-event-box-main-2">
                                        <div class="lv-special-event-date-box-2 mb-10">
                                           <div class="lv-special-event-box-content-2  bg-default bg-100" data-background="<?php echo get_template_directory_uri(); ?>/assets/img/bg/frame.png">
                                                <?php if ($settings['event-month2']) : ?>
                                                <span class="lv-special-event-month-2 pt-10">
                                                    <?php echo wp_kses_post($settings['event-month2']); ?> 
                                                </span>
                                                <?php endif; ?>

                                                <div class="lv-special-event-date-flex-box-2">
                                                    <?php if ($settings['event-day2']) : ?>
                                                    <p class="lv-special-event-item-2-1">
                                                        <?php echo wp_kses_post($settings['event-day2']); ?>
                                                    </p>
                                                    <?php endif; ?>

                                                    <?php if ($settings['event-date2']) : ?>
                                                    <h4 class="lv-special-event-item-2-2">
                                                        <?php echo wp_kses_post($settings['event-date2']); ?>
                                                    </h4>
                                                    <?php endif; ?>

                                                    <?php if ($settings['event-time2']) : ?>
                                                    <p class="lv-special-event-item-2-3">
                                                        <?php echo wp_kses_post($settings['event-time2']); ?>
                                                    </p>
                                                    <?php endif; ?>
                                                </div>

                                                <?php if ($settings['event-year2']) : ?>
                                                <div class="lv-special-event-date-year-2 pb-13">
                                                    <p><?php echo wp_kses_post($settings['event-year2']); ?></p>
                                                </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="lv-special-event-address-2">
                                            <?php if ($settings['event-address2']) : ?>
                                            <p><?php echo wp_kses_post($settings['event-address2']); ?></p>
                                            <?php endif; ?>

                                            <?php if ($settings['event-phone2']) : ?>
                                            <p class="item-last">
                                                <?php echo wp_kses_post($settings['event-phone2']); ?>
                                            </p>
                                            <?php endif; ?>

                                            <?php if ($settings['event-button-text2']) : ?>
                                            <a href="<?php echo esc_url($settings['event_url2']); ?>" class="lv-underline-button-2">
                                                <?php echo wp_kses_post($settings['event-button-text2']); ?>
                                            </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
           </div>
        </div>
        <!-- event area end --> 

    <?php endif; ?>
        <?php
    }
}
