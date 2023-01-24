<?php

namespace Bdevs\Elementor;

defined('ABSPATH') || die();

class Hero extends \Generic\Elements\GenericWidget
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
        return 'cust-hero';
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
        return __('Hero', 'bdevs-elementor');
    }

    public function get_custom_help_url()
    {
        return 'http://elementor.bdevs.net/bdevselementor/hero/';
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
        return 'eicon-header gen-icon';
    }

    public function get_keywords()
    {
        return ['hero', 'blurb', 'infobox', 'content', 'block', 'box'];
    }

    public function get_categories()
    {
        return ['bdevs-elementor'];
    }

    protected function register_content_controls()
    {

        $this->design_style();
        $this->title_and_desc();
        $this->hero_images();
        $this->button();
        $this->icon();
        $this->shape_text();
        $this->button2();
        $this->button_overlay();
    }

    public function design_style(){
        $this->start_controls_section(
            '_section_design',
            [
                'label' => __( 'Presets', 'bdevs-elementor' ),
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
                ],
                'default' => 'design_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'shape_switch',
            [
                'label' => __('Shape Show/Hide', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'bdevs-elementor'),
                'label_off' => __('Hide', 'bdevs-elementor'),
                'return_value' => 'yes',
                'default' => 'yes',
                'style_transfer' => true,
                'condition' => [
                    'designs' => ['design_1', 'design_2'],
                ],
            ]
        );

        $this->add_control(
            'search_switch',
            [
                'label' => __('Search Show/Hide', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'bdevs-elementor'),
                'label_off' => __('Hide', 'bdevs-elementor'),
                'return_value' => 'yes',
                'default' => 'yes',
                'style_transfer' => true,
                'condition' => [
                    'designs' => ['design_20'],
                ],
            ]
        );

        $this->end_controls_section();
    }



    public function button_overlay(){

     // Background Overlay
        $this->start_controls_section(
            '_section_button_overlay',
            [
                'label' => __( 'Button Overlay', 'bdevs-elementor' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'designs' => ['design_1'],
                ],
                 
            ]
        );
        
        $this->start_controls_tabs( 'tabs_background_overlay' );

        $this->start_controls_tab(
            'tab_button_overlay_normal',
            [
                'label' => __( 'Normal', 'bdevs-elementor' ),
                'condition' => [
                    'designs' => ['design_1'],
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background',
                'label' => esc_html__( 'Background', 'bdevs-elementor' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .bdevs-el-btn',
            ]
        );

        $this->add_control(
            'background_overlay_opacity',
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
                    '{{WRAPPER}}  .elementor-background-overlay' => 'opacity: {{SIZE}};',
                ],
                // 'condition' => [
                //     'background_overlay_background' => [ 'classic', 'gradient' ],
                // ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_background_overlay_hover',
            [
                'label' => __( 'Hover', 'bdevs-elementor' ),
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'btn-hover-bg-color',
                'label' => esc_html__( 'Background', 'bdevs-elementor' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .bdevs-el-btn:hover',
            ]
        );


        $this->add_control(
            'background_hover_overlay_opacity',
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
                    '{{WRAPPER}} .bdevs-el-btn:hover .elementor-background-overlay' => 'opacity: {{SIZE}};',
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

    public function shape_text(){

        $this->start_controls_section(
            '_shape_section',
            [
                'label' => __( 'Shape Fields', 'bdevs-elementor' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'designs' => ['design_2'],
                ],
            ]
        );

        $this->add_control(
            'impressions_text',
            [
                'label'       => __('Impressions Text', 'bdevs-elementor'),
                'label_block' => true,
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => __('impressions Text', 'bdevs-elementor'),
                'placeholder' => __('impressions Text', 'bdevs-elementor'),
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'development_text',
            [
                'label'       => __('Business Development Text', 'bdevs-elementor'),
                'label_block' => true,
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => __('development Text', 'bdevs-elementor'),
                'placeholder' => __('development Text', 'bdevs-elementor'),
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'analysis_text',
            [
                'label'       => __('Business Analysis Text', 'bdevs-elementor'),
                'label_block' => true,
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => __('analysis Text', 'bdevs-elementor'),
                'placeholder' => __('analysis Text', 'bdevs-elementor'),
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'analysis_number',
            [
                'label'       => __('Business Analysis Number', 'bdevs-elementor'),
                'label_block' => true,
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => __('analysis Number', 'bdevs-elementor'),
                'placeholder' => __('analysis Number', 'bdevs-elementor'),
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        );

        $this->end_controls_section();
    }    


    public function title_and_desc()
    {
        // Title & Description
        $this->start_controls_section(
            '_section_title',
            [
                'label' => __('Title & Description', 'bdevs-elementor'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                
            ]
        );

        $this->add_control(
            'subtitle',
            [
                'label'       => __('Sub Title', 'bdevs-elementor'),
                'label_block' => true,
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => __('Sub Title', 'bdevs-elementor'),
                'placeholder' => __('Enter Sub Title', 'bdevs-elementor'),
                'dynamic'     => [
                    'active' => true,
                ],
                 
            ]
        );

        $this->add_control(
            'title',
            [
                'label'       => __('Title', 'bdevs-elementor'),
                'label_block' => true,
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => __('Hero Title', 'bdevs-elementor'),
                'placeholder' => __('Enter Hero Title', 'bdevs-elementor'),
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'description',
            [
                'label'       => __('Description', 'bdevs-elementor'),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'default'     => __('Hero description goes here', 'bdevs-elementor'),
                'placeholder' => __('Enter Hero description', 'bdevs-elementor'),
                'rows'        => 5,
                'dynamic'     => [
                    'active' => true,
                ],
                 
            ]
        );

        $this->add_control(
            'icons_text',
            [
                'label'       => __('Review Text', 'bdevs-elementor'),
                'label_block' => true,
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => __('Review Text', 'bdevs-elementor'),
                'placeholder' => __('Enter Review Text', 'bdevs-elementor'),
                'dynamic'     => [
                    'active' => true,
                ],
                'condition' => [
                    'designs' => ['design_1'],
                ],
            ]
        );

        $this->add_control(
            'img_text',
            [
                'label'       => __('Image Text', 'bdevs-elementor'),
                'label_block' => true,
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => __('Image Text', 'bdevs-elementor'),
                'placeholder' => __('Enter Image Text', 'bdevs-elementor'),
                'dynamic'     => [
                    'active' => true,
                ],
                'condition' => [
                    'designs' => ['design_3'],
                ],
            ]
        );


        $this->add_control(
            'title_tag',
            [
                'label' => __('Title HTML Tag', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'h1'  => [
                        'title' => __('H1', 'bdevs-elementor'),
                        'icon' => 'eicon-editor-h1'
                    ],
                    'h2'  => [
                        'title' => __('H2', 'bdevs-elementor'),
                        'icon' => 'eicon-editor-h2'
                    ],
                    'h3'  => [
                        'title' => __('H3', 'bdevs-elementor'),
                        'icon' => 'eicon-editor-h3'
                    ],
                    'h4'  => [
                        'title' => __('H4', 'bdevs-elementor'),
                        'icon' => 'eicon-editor-h4'
                    ],
                    'h5'  => [
                        'title' => __('H5', 'bdevs-elementor'),
                        'icon' => 'eicon-editor-h5'
                    ],
                    'h6'  => [
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
                    '{{WRAPPER}} .elementor-widget-container' => 'text-align: {{VALUE}};'
                ]
            ]
        );

        $this->end_controls_section();
    }

    public function hero_images(){
        // image
        $this->start_controls_section(
            '_section_image',
            [
                'label' => __( 'Image', 'bdevselementor' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'hero_bg',
            [
                'label' => __( 'Hero BG Image', 'bdevselementor' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'designs' => ['design_1','design_2','design_4'],
                ],

            ]
        );

        $this->add_control(
            'hero_image',
            [
                'label' => __( 'Hero Image', 'bdevselementor' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'designs' => ['design_1','design_3'],
                ],
            ]
        );

        $this->add_control(
            'hero_review',
            [
                'label' => __( 'Hero Review Image', 'bdevselementor' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'designs' => ['design_3'],
                ],
            ]
        );

        $this->add_control(
            'signature_image',
            [
                'label' => __( 'Signature Image', 'bdevselementor' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'designs' => ['design_4'],
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Image_Size::get_type(),
            [
                'name' => 'bg_thumbnail',
                'default' => 'large',
                'separator' => 'none',
            ]
        );

        $this->end_controls_section();
    }



    public function button()
    {
        // Button
        $this->start_controls_section(
            '_section_button',
            [
                'label' => __('Button', 'bdevs-elementor'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'designs' => ['design_1','design_2','design_3'],
                ],
            ]
        );

        $this->add_responsive_control(
            'btn_align',
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
                    '{{WRAPPER}}' => 'display: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label'       => __('Text', 'bdevs-elementor'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => 'Button Text',
                'placeholder' => __('Type button text here', 'bdevs-elementor'),
                'label_block' => true,
                'dynamic'     => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'button_link',
            [
                'label' => __('Link', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => 'http://elementor.bdevs.net/',
                'dynamic' => [
                    'active' => true,
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

        $this->add_control(
            'video_url',
            [
                'label'       => __('Video URL', 'bdevs-elementor'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => 'Video URL',
                'placeholder' => __('Type video url here', 'bdevs-elementor'),
                'label_block' => true,
                'dynamic'     => [
                    'active' => true,
                ],
                'condition' => [
                    'designs' => ['design_2'],
                ],
            ]
        );

        $this->add_control(
            'video_button_text',
            [
                'label'       => __('Intro Title', 'bdevs-elementor'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => 'Intro Text',
                'placeholder' => __('Type button text here', 'bdevs-elementor'),
                'label_block' => true,
                'dynamic'     => [
                    'active' => true,
                ],
                'condition' => [
                    'designs' => ['design_2'],
                ],
            ]
        );


        $this->end_controls_section();

    }

    public function button2()
    {

        // Button 02
        $this->start_controls_section(
            '_section_button2',
            [
                'label' => __('Button 02', 'bdevs-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'designs' => ['design_3'],
                ],     
            ]
        );

        $this->add_control(
            'button_text2',
            [
                'label' => __('Text 02', 'bdevs-elementor'),
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
            'button_link2',
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
            'button_icon2',
            [
                'label' => __('Icon', 'bdevs-elementor'),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::ICON,
                'default' => 'fa fa-angle-right',
            ]
        );

        $this->add_control(
            'button_selected_icon2',
            [
                'type' => \Elementor\Controls_Manager::ICONS,
                'fa4compatibility' => 'button_icon',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'button_icon_position2',
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
            'button_icon_spacing2',
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

    public function icon()
    {

   
    
     // Slides
        $this->start_controls_section(
            '_section_social',
            [
                'label' => __('Social Icon', 'bdevs-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();


        $repeater->start_controls_tabs(
            '_tab_style_member_box_slider'
        );

        $repeater->start_controls_tab(
            '_tab_member_links',
            [
                'label' => __( 'Links', 'bdevs-elementor' ), 
            ]
        );

        $repeater->add_control(
            'show_social',
            [
                'label' => __( 'Show Options?', 'bdevs-elementor' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'bdevs-elementor' ),
                'label_off' => __( 'No', 'bdevs-elementor' ),
                'return_value' => 'yes',
                'style_transfer' => true,
            ]
        );


        $repeater->add_control(
            'web_title',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Website Address', 'bdevs-elementor' ),
                'placeholder' => __( 'Add your profile link', 'bdevs-elementor' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $repeater->add_control(
            'email_title',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Email', 'bdevs-elementor' ),
                'placeholder' => __( 'Add your email link', 'bdevs-elementor' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );           

        $repeater->add_control(
            'phone_title',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Phone', 'bdevs-elementor' ),
                'placeholder' => __( 'Add your phone link', 'bdevs-elementor' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $repeater->add_control(
            'facebook_title',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Facebook', 'bdevs-elementor' ),
                'default' => __( '#', 'bdevs-elementor' ),
                'placeholder' => __( 'Add your facebook link', 'bdevs-elementor' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );                

        $repeater->add_control(
            'twitter_title',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Twitter', 'bdevs-elementor' ),
                'default' => __( '#', 'bdevs-elementor' ),
                'placeholder' => __( 'Add your twitter link', 'bdevs-elementor' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'instagram_title',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Instagram', 'bdevs-elementor' ),
                'default' => __( '#', 'bdevs-elementor' ),
                'placeholder' => __( 'Add your instagram link', 'bdevs-elementor' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );       

        $repeater->add_control(
            'linkedin_title',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'LinkedIn', 'bdevs-elementor' ),
                'default' => __( '#', 'bdevs-elementor' ),
                'placeholder' => __( 'Add your linkedin link', 'bdevs-elementor' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $repeater->add_control(
            'youtube_title',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Youtube', 'bdevs-elementor' ),
                'placeholder' => __( 'Add your youtube link', 'bdevs-elementor' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $repeater->add_control(
            'googleplus_title',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Google Plus', 'bdevs-elementor' ),
                'placeholder' => __( 'Add your Google Plus link', 'bdevs-elementor' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $repeater->add_control(
            'flickr_title',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Flickr', 'bdevs-elementor' ),
                'placeholder' => __( 'Add your flickr link', 'bdevs-elementor' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $repeater->add_control(
            'vimeo_title',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Vimeo', 'bdevs-elementor' ),
                'placeholder' => __( 'Add your vimeo link', 'bdevs-elementor' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'behance_title',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Behance', 'bdevs-elementor' ),
                'placeholder' => __( 'Add your hehance link', 'bdevs-elementor' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $repeater->add_control(
            'dribble_title',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Dribbble', 'bdevs-elementor' ),
                'placeholder' => __( 'Add your dribbble link', 'bdevs-elementor' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $repeater->add_control(
            'pinterest_title',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Pinterest', 'bdevs-elementor' ),
                'placeholder' => __( 'Add your pinterest link', 'bdevs-elementor' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'gitub_title',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Github', 'bdevs-elementor' ),
                'placeholder' => __( 'Add your github link', 'bdevs-elementor' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        ); 

        $repeater->end_controls_tab();
        $repeater->end_controls_tabs();

        $this->add_control(
            'slides',
            [
                'show_label' => false,
                'label' => esc_html__( 'Repeater List', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
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
                    ],
                    [
                        'image' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
                    ],
                ],
                
            ]
        );

        $this->end_controls_section();
   
    }

    protected function register_style_controls(){
       
        $this->title_style_controls();
        $this->button_style_controls();

    }

    protected function title_style_controls() {

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


    protected function button_style_controls() {
        // Button 1 style
        $this->start_controls_section(
            '_section_style_button',
            [
                'label' => __('Button', 'bdevs-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
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

         // Button 2 style
        $this->start_controls_section(
            '_section_style_button2',
            [
                'label' => __('Button 2', 'bdevs-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'button_padding2',
            [
                'label' => __('Padding', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-btn2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography2',
                'selector' => '{{WRAPPER}} .bdevs-el-btn2',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'button_border2',
                'selector' => '{{WRAPPER}} .bdevs-el-btn2',
            ]
        );

        $this->add_control(
            'button_border_radius2',
            [
                'label' => __('Border Radius', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-btn2' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->start_controls_tabs('_tabs_button2');

        $this->start_controls_tab(
            '_tab_button_normal2',
            [
                'label' => __('Normal', 'bdevs-elementor'),
            ]
        );

        $this->add_control(
            'button_color2',
            [
                'label' => __('Text Color', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-btn2' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_bg_color2',
            [
                'label' => __('Background Color', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-btn2' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            '_tab_button_hover2',
            [
                'label' => __('Hover', 'bdevs-elementor'),
            ]
        );

        $this->add_control(
            'button_hover_color2',
            [
                'label' => __('Text Color', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-btn2:hover, {{WRAPPER}} .bdevs-el-btn:focus' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_bg_color2',
            [
                'label' => __('Background Color', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-btn2:hover, {{WRAPPER}} .bdevs-el-btn2:focus' => 'background-color: {{VALUE}};',
                ],
            ]
        );


        $this->add_control(
            'button_hover_border_color2',
            [
                'label' => __('Border Color', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'button_border_border!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-btn2:hover, {{WRAPPER}} .bdevs-el-btn2:focus' => 'border-color: {{VALUE}};',
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
        extract($settings);

    ?>

        <?php if ( $settings['designs'] === 'design_4' ):

        $this->add_inline_editing_attributes('title', 'basic');

        $this->add_render_attribute('title', 'class', 'bdevs-el-title');    

        if ( !empty($settings['hero_bg']['id']) ) {
            $hero_bg = wp_get_attachment_image_url( $settings['hero_bg']['id'], $settings['bg_thumbnail_size'] );
        }

        if ( !empty($settings['signature_image']['id']) ) {
            $signature_image = wp_get_attachment_image_url( $settings['signature_image']['id'], $settings['bg_thumbnail_size'] );
        }

         ?>   


        <!-- Hero-area-start -->
        <div class="bd-hero__area p-relative hero-bg-5" data-background="<?php echo esc_url($hero_bg); ?>">
             <div class="bd-hero__active-5">
                <div class="swiper-slide">
                   <div class="bd-singel__hero bd-hero__height-5 p-relative">
                      <div class="container">
                         <div class="row align-items-center">
                            <div class="col-xl-5 col-lg-6">
                               <div class="bd-hero__content-5">
                                  <div class="bd-slider__title-5">
                                    <?php if ($settings['subtitle']) : ?>
                                     <h5 class="bdevs-el-subtitle"><?php echo wp_kses_post($settings['subtitle']); ?></h5>
                                     <?php endif; ?>
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
                                  <div class="bd-hero__features">
                                    <?php if ($settings['signature_image']) : ?>
                                     <div class="bd-hero__signature">
                                        <img src="<?php echo esc_url($signature_image); ?>" alt="signature.png">
                                     </div>
                                     <?php endif; ?>
                                     <div class="bd-hero__social">
                                         <?php foreach ($settings['slides'] as $slide) :
                           
                                           ?>
                                         <?php if (!empty($slide['web_title'])) : ?>
                                            <a href="<?php echo esc_url($slide['web_title']); ?>"><i class="far fa-globe"></i></a>
                                        <?php endif; ?>

                                        <?php if (!empty($slide['email_title'])) : ?>
                                            <a href="mailto:<?php echo esc_url($slide['email_title']); ?>"><i class="fal fa-envelope"></i></a>
                                        <?php endif; ?>

                                        <?php if (!empty($slide['phone_title'])) : ?>
                                            <a href="tell:<?php echo esc_url($slide['phone_title']); ?>"><i class="fas fa-phone"></i></a>
                                        <?php endif; ?>

                                        <?php if (!empty($slide['facebook_title'])) : ?>
                                            <a href="<?php echo esc_url($slide['facebook_title']); ?>" class="facebook"><i class="fab fa-facebook-f"></i></a>
                                        <?php endif; ?>

                                        <?php if (!empty($slide['twitter_title'])) : ?>
                                            <a href="<?php echo esc_url($slide['twitter_title']); ?>" class="twitter"><i class="fab fa-twitter"></i></a>
                                        <?php endif; ?>

                                        <?php if (!empty($slide['instagram_title'])) : ?>
                                            <a href="<?php echo esc_url($slide['instagram_title']); ?>"><i class="fab fa-instagram"></i></a>
                                        <?php endif; ?>

                                        <?php if (!empty($slide['linkedin_title'])) : ?>
                                            <a href="<?php echo esc_url($slide['linkedin_title']); ?>" class="linkedin"><i class="fab fa-linkedin-in"></i></a>
                                        <?php endif; ?>

                                        <?php if (!empty($slide['youtube_title'])) : ?>
                                            <a href="<?php echo esc_url($slide['youtube_title']); ?>" class="youtube"><i class="fab fa-youtube"></i></a>
                                        <?php endif; ?>

                                        <?php if (!empty($slide['googleplus_title'])) : ?>
                                            <a href="<?php echo esc_url($slide['googleplus_title']); ?>"><i class="fab fa-google-plus-g"></i></a>
                                        <?php endif; ?>

                                        <?php if (!empty($slide['flickr_title'])) : ?>
                                            <a href="<?php echo esc_url($slide['flickr_title']); ?>"><i class="fab fa-flickr"></i></a>
                                        <?php endif; ?>

                                        <?php if (!empty($slide['vimeo_title'])) : ?>
                                            <a href="<?php echo esc_url($slide['vimeo_title']); ?>"><i class="fab fa-vimeo-v"></i></a>
                                        <?php endif; ?>

                                        <?php if (!empty($slide['behance_title'])) : ?>
                                            <a href="<?php echo esc_url($slide['behance_title']); ?>"><i class="fab fa-behance"></i></a>
                                        <?php endif; ?>

                                        <?php if (!empty($slide['dribble_title'])) : ?>
                                            <a href="<?php echo esc_url($slide['dribble_title']); ?>"><i class="fab fa-dribbble"></i></a>
                                        <?php endif; ?>

                                        <?php if (!empty($slide['pinterest_title'])) : ?>
                                            <a href="<?php echo esc_url($slide['pinterest_title']); ?>"><i class="fab fa-pinterest-p"></i></a>
                                        <?php endif; ?>

                                        <?php if (!empty($slide['gitub_title'])) : ?>
                                            <a href="<?php echo esc_url($slide['gitub_title']); ?>"><i class="fab fa-github"></i></a>
                                        <?php endif; ?>

                                       <?php endforeach; ?>
                                     </div>
                                  </div>
                               </div>
                            </div>
                         </div>
                      </div>
                   </div>
                </div>
             </div>
        </div>
        <!-- Hero-area-end -->



        <?php elseif ( $settings['designs'] === 'design_3' ):

        $this->add_inline_editing_attributes('title', 'basic');

        $this->add_render_attribute('title', 'class', 'bd-hero__big-title-4 mb-15 bdevs-el-title');
        $this->add_render_attribute('title', 'data-wow-delay', '.3s');

        if ( !empty($settings['hero_review']['id']) ) {
            $hero_review = wp_get_attachment_image_url( $settings['hero_review']['id'], $settings['bg_thumbnail_size'] );
        }

        if ( !empty($settings['hero_image']['id']) ) {
            $hero_image = wp_get_attachment_image_url( $settings['hero_image']['id'], $settings['bg_thumbnail_size'] );
        }

        if ( !empty($settings['button_link']) ) {
                $this->add_render_attribute( 'button', 'class', 'bd-theme-4-btn-1 bdevs-el-btn' );
                $this->add_link_attributes( 'button', $settings['button_link'] );
        }

        if ( !empty( $settings['button_link2'] ) ) {
            $this->add_render_attribute('button2', 'class', 'bd-theme-4-btn-2 bdevs-el-btn2');
            $this->add_link_attributes( 'button2', $settings['button_link2'] );
        }

        ?>


        <!-- Hero-area-start -->
          <div class="bd-hero__area p-relative fix">
             <div class="bd-hero__active-4">
                <div class="swiper-slide">
                   <div class="bd-singel__hero bd-hero__height-4 p-relative">
                      <div class="container">
                         <div class="row align-items-center">
                            <div class="col-xxl-6 col-xl-7 col-lg-7">
                               <div class="bd-hero-content-4 bdevs-el-content">
                                <?php if ($settings['subtitle']) : ?>
                                  <h6 class="bd-hero__small-title-4 mb-15 bdevs-el-subtitle">
                                    <?php echo wp_kses_post($settings['subtitle']); ?>
                                  </h6>
                                <?php endif; ?>

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

                                 <?php if ($settings['description']) : ?>
                                  <p class="bd-paragraph-title-4 hero mb-35">
                                       <?php echo wp_kses_post($settings['description']); ?>
                                  </p>
                                <?php endif; ?>  

                                  <div class="hero__btn-3-wrapper mb-60 p-relative">
                                    
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
                                     

                                     <?php if ($settings['button_text2'] && ((empty($settings['button_selected_icon2']) || empty($settings['button_selected_icon2']['value'])) && empty($settings['button_icon2']))) :
                                    printf('<a %1$s>%2$s</a>',
                                        $this->get_render_attribute_string('button2'),
                                        esc_html($settings['button_text2'])
                                    );
                                elseif (empty($settings['button_text2']) && ((!empty($settings['button_selected_icon2']) || empty($settings['button_selected_icon2']['value'])) || !empty($settings['button_icon2']))) : ?>
                                    <a <?php $this->print_render_attribute_string('button2'); ?>><?php bdevs_elementor_render_icon($settings, 'button_icon2', 'button_selected_icon2'); ?></a>
                                <?php elseif ($settings['button_text2'] && ((!empty($settings['button_selected_icon2']) || empty($settings['button_selected_icon2']['value'])) || !empty($settings['button_icon2']))) :
                                    if ($settings['button_icon_position2'] === 'before'): ?>
                                        <a <?php $this->print_render_attribute_string('button2'); ?>><?php bdevs_elementor_render_icon($settings, 'button_icon2', 'button_selected_icon2', ['class' => 'bdevs-btn-icon2']); ?>
                                            <span><?php echo esc_html($settings['button_text2']); ?></span></a>
                                    <?php
                                    else: ?>
                                        <a <?php $this->print_render_attribute_string('button2'); ?>>
                                            <span><?php echo esc_html($settings['button_text2']); ?></span>

                                            <?php bdevs_elementor_render_icon($settings, 'button_icon2', 'button_selected_icon2', ['class' => 'bdevs-btn-icon2']); ?>
                                        </a>
                                    <?php
                                    endif;
                                endif; ?>

                                  </div>
                                  <?php if (!empty($hero_review)): ?>
                                  <div class="hero__review-img">
                                     <img src="<?php echo esc_url($hero_review); ?>" alt="hero__review-img">
                                  </div>
                                  <?php endif; ?>
                               </div>
                            </div>
                         </div>
                      </div>
                      <?php if (!empty($hero_image)): ?>
                      <div class="bd-hero-4-image d-none d-lg-block">
                         <img src="<?php echo esc_url($hero_image); ?>" alt="hero-4.png">
                      </div>
                      <?php endif; ?>
                      <div class="hero-4-shape-cercle"></div>
                   </div>
                </div>
             </div>
          </div>
        <!-- Hero-area-end -->

        <?php elseif ($settings['designs'] === 'design_2'):

            $this->add_inline_editing_attributes('title', 'basic');
            $this->add_render_attribute('title', 'class', 'bd-big__title-3 mb-20 bdevs-el-title');

            if ( !empty($settings['button_link']) ) {
                $this->add_render_attribute( 'button', 'class', 'bd-theme-3-btn-2 bdevs-el-btn' );
                $this->add_link_attributes( 'button', $settings['button_link'] );
            }

            if ( !empty($settings['hero_bg']['id']) ) {
                $hero_bg = wp_get_attachment_image_url( $settings['hero_bg']['id'], $settings['bg_thumbnail_size'] );
            }

        ?>

        <!-- Hero-area-start -->
          <div class="bd-hero__area p-relative">
             <div class="bd-hero__active-3 swiper-container">
                <div class="swiper-slide">
                   <div class="bd-singel__hero d-flex align-items-center bd-hero__height-3 p-relative">
                      <div class="container">
                         <div class="row align-items-center">
                            <div class="col-xxl-6 col-xl-7 col-lg-6 col-md-8">
                               <div class="bd-hero__content-3">
                                  <div class="bd-section__title-3 bdevs-el-content">
                                    <?php if ($settings['subtitle']) : ?>
                                    <h6 class="bd-small__title-3 bdevs-el-subtitle"><?php echo wp_kses_post($settings['subtitle']); ?></h6>
                                    <?php endif; ?>

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
                                    <?php if ($settings['description']) : ?>
                                     <p class="bd-paragraph__title-3 mb-55">
                                        <?php echo wp_kses_post($settings['description']); ?>
                                     </p>
                                    <?php endif; ?>

                                  </div>
                                  <div class="hero__btn_3_wrapper p-relative">
                                     
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
                                <?php if ($settings['video_url']) : ?>
                                     <a class="hero-3-play-btn popup-video"
                                        href="<?php echo esc_url($settings['video_url']); ?>">
                                        <i class="fas fa-play"></i></a>
                                       <?php endif; ?>
                                       <?php if ($settings['video_button_text']) : ?>
                                     <a class="bd-theme-3-btn-3"
                                        href="<?php echo esc_url($settings['video_url']); ?>">
                                            <?php echo wp_kses_post($settings['video_button_text']); ?>
                                    </a>
                                    <?php endif; ?>
                                  </div>
                               </div>
                            </div>
                         </div>
                      </div>
                      <?php if (!empty($hero_bg)): ?>
                      <div class="bd-hero-3-image d-none d-lg-block">
                         <img src="<?php echo esc_url($hero_bg); ?>" alt="hero-3.png">
                      </div>
                      <?php endif; ?>

                      
                      <?php if (!empty($impressions_text)): ?>
                      <div class="bd-hero-3-shape-1">
                        <i class="fal fa-star"></i><span><?php echo wp_kses_post($settings['impressions_text']); ?></span>
                      </div>
                      <?php endif; ?>
                      <?php if (!empty($development_text)): ?>
                      <div class="bd-hero-3-shape-2">
                         <i class="fal fa-check"></i><span><?php echo wp_kses_post($settings['development_text']); ?></span>
                      </div>
                      <?php endif; ?>
                      <div class="bd-hero-3-circle">
                         <div class="bd-circle-box">
                            <?php if (!empty($analysis_number)): ?>
                            <input type="text" class="knob" value="0" data-rel="<?php echo wp_kses_post($settings['analysis_number']); ?>" data-linecap="round" data-width="130"
                               data-height="130" data-bgcolor="#e9e9e9" data-fgcolor="#0e6ae5" data-thickness=".12"
                               data-readonly="true" disabled="" readonly="readonly"
                               style="width: 64px; height: 40px; position: absolute; vertical-align: middle;">
                               <?php endif; ?>
                            <?php if (!empty($analysis_text)): ?>
                            <div class="bd-circle-text">
                               <h3><?php echo wp_kses_post($settings['analysis_text']); ?></h3>
                            </div>
                            <?php endif; ?>
                         </div>
                      </div>
                   </div>
                </div>
             </div>
          </div>
        <!-- Hero-area-end -->


        <?php else:

        $this->add_inline_editing_attributes('title', 'basic');

        $this->add_render_attribute('title', 'class', 'hero-big__title-2 mb-15 bdevs-el-title');
        $this->add_render_attribute('title', 'data-animation', 'fadeInUp');
        $this->add_render_attribute('title', 'data-delay', '.3s');

        if ( !empty($settings['button_link']) ) {
            $this->add_render_attribute( 'button', 'class', 'bd-home-2__btn bdevs-el-btn' );
            $this->add_link_attributes( 'button', $settings['button_link'] );
        }

        if ( !empty($settings['hero_image']['id']) ) {
            $hero_image = wp_get_attachment_image_url( $settings['hero_image']['id'], $settings['bg_thumbnail_size'] );
        }

        if ( !empty($settings['hero_bg']['id']) ) {
            $hero_bg = wp_get_attachment_image_url( $settings['hero_bg']['id'], $settings['bg_thumbnail_size'] );
        }

        ?>


    <!-- Hero-area-start -->
        <div class="bd-hero__area p-relative fix">
         <div class="bd-hero__active-2">
            <div class="swiper-wrapper">
               <div class="swiper-slide">
                  <div class="bd-singel__hero bd-hero__height_2 bg_default"
                     data-background="<?php echo esc_url($hero_bg); ?>">
                     <div class="bd-hero-2__wrapper p-relative">
                        <div class="container">
                           <div class="row align-items-center">
                              <div class="col-xl-7 col-lg-10">
                                 <div class="bd-hero__content-2 mb-45 bdevs-el-content wow fadeInUp" data-wow-duration="1.5s"
                                    data-wow-delay=".3s">
                                    <?php if ($settings['subtitle']) : ?>
                                    <h6 class="hero-small__title-2 mb-25 bdevs-el-subtitle" data-animation="fadeInUp" data-delay=".3s">
                                       <?php echo wp_kses_post($settings['subtitle']); ?></h6>
                                    <?php endif; ?>

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
                                    <?php if ($settings['icons_text']) : ?>
                                    <div class="bd-hero-2__text">
                                       <div class="hero__start">
                                          <i class="fal fa-star"></i>
                                          <i class="fal fa-star"></i>
                                          <i class="fal fa-star"></i>
                                          <i class="fal fa-star"></i>
                                          <span><?php echo wp_kses_post($settings['icons_text']); ?></span>
                                       </div>
                                    </div>
                                    <?php endif; ?>
                                    <?php if ($settings['description']) : ?>
                                    <p><?php echo wp_kses_post($settings['description']); ?></p>
                                    <?php endif; ?>
                                 </div>
                                 <div class="hero__btn" data-animation="fadeInUp" data-delay=".3s">
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
                        <?php if (!empty($hero_image)): ?>
                        <div class="bd-hero-2-img d-none d-lg-block">
                           <img src="<?php echo esc_url($hero_image); ?>" alt="hero-2.png">
                        </div>
                        <?php endif; ?>
                     </div>
                  </div>
               </div>
            </div>
         </div>
        </div>
    <!-- Hero-area-end -->

        <?php endif; ?>    
<?php
    }
}
