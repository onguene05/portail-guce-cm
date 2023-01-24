<?php

namespace Bdevs\Elementor;
defined('ABSPATH') || die();

class Banner extends \Generic\Elements\GenericWidget
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
        return 'banner';
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
        return __('Banner', 'bdevs-elementor');
    }

    public function get_custom_help_url()
    {
        return 'http://elementor.bdevs.net/bdevselementor/banner/';
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
        $this->background_overlay();
        $this->title_and_desc();
        $this->hero_images();
        $this->course_bg_images();
        $this->button();
        $this->button_two();
        $this->hero_video_button();
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
                    'designs' => ['design_4'],
                ],
            ]
        );

        $this->add_control(
            'banner_url',
            [
                'label'       => __('Banner URL', 'bdevs-elementor'),
                'label_block' => true,
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => __('Banner URL', 'bdevs-elementor'),
                'placeholder' => __('Banner URL URL', 'bdevs-elementor'),
                'dynamic'     => [
                    'active' => true,
                ],
                'condition' => [
                    'designs' => ['design_10'],
                ],
            ]
        );

        $this->end_controls_section();
    }

    // Background Overlay
    public function background_overlay(){
        $this->start_controls_section(
            '_section_background_overlay',
            [
                'label' => __( 'Background Overlay', 'bdevs-elementor' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'designs' => ['design_10'],
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background',
                'label' => __( 'Background', 'bdevs-elementor' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .gen-banner-area::before',
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
                    '{{WRAPPER}} .gen-banner-area::before' => 'opacity: {{SIZE}};',
                ]
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
                'condition' => [
                    'designs' => ['design_1'],
                ],
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
                ]
            ]
        );

        $this->add_control(
            'title_url',
            [
                'label'       => __('Title URL', 'bdevs-elementor'),
                'label_block' => true,
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => __('Title URL', 'bdevs-elementor'),
                'placeholder' => __('Enter Title URL', 'bdevs-elementor'),
                'dynamic'     => [
                    'active' => true,
                ],
                'condition' => [
                    'designs' => ['design_1'],
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
                'condition' => [
                    'designs' => ['design_2'],
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
                    '{{WRAPPER}}' => 'text-align: {{VALUE}};',
                ],
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
                    'designs' => ['design_4'],
                ],

            ]
        );

        $this->add_control(
            'hero_image',
            [
                'label' => __( 'Image', 'bdevselementor' ),
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
            'banner_image_1',
            [
                'label' => __( 'Image 01', 'bdevselementor' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'designs' => ['design_2'],
                ],
            ]
        );

        $this->add_control(
            'banner_image_2',
            [
                'label' => __( 'Image 02', 'bdevselementor' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'designs' => ['design_2'],
                ],
            ]
        );

        $this->add_control(
            'banner_image_3',
            [
                'label' => __( 'Image 03', 'bdevselementor' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'designs' => ['design_2'],
                ],
            ]
        );

        $this->add_control(
            'banner_image_4',
            [
                'label' => __( 'Image 04', 'bdevselementor' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'designs' => ['design_2'],
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

    public function course_bg_images(){
        // image
        $this->start_controls_section(
            '_course_section_image',
            [
                'label' => __( 'Image', 'bdevselementor' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'designs' => ['design_4'],
                ],
            ]
        );

        $this->add_control(
            'course_bg_imager',
            [
                'label' => __( 'Course Bg Image', 'bdevselementor' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
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
                'name' => 'bg_thumbnail2',
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
                    'designs' => ['design_2','design_3'],
                ],
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
                ],
                'dynamic'     => [
                    'active' => true,
                ]
            ]
        );


        $this->end_controls_section();
    }

    public function button_two()
    {

        // Button 2
        $this->start_controls_section(
            '_section_button2',
            [
                'label' => __('Button 2', 'bdevs-elementor'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'designs' => ['design_4'],
                ],
            ]
        );

        $this->add_control(
            'button2_text',
            [
                'label' => __( 'Text', 'bdevselementor' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Button 2 Text',
                'placeholder' => __( 'Type button 2 text here', 'bdevselementor' ),
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'button2_link',
            [
                'label' => __( 'Link', 'bdevselementor' ),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => 'http://elementor.bdevs.net/',
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );
        $this->end_controls_section();
    }


    public function hero_video_button(){
        // hero_video_button
        $this->start_controls_section(
            '_gen_hero_video_button',
            [
                'label' => __('Hero Video', 'bdevs-elementor'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'designs' => ['design_4'],
                ],
            ]
        );

        $this->add_control(
            'hero_video_text',
            [
                'label'       => __('Video Text', 'bdevs-elementor'),
                'label_block' => true,
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => __('Watch Video', 'bdevs-elementor'),
                'placeholder' => __('Enter video Title', 'bdevs-elementor'),
                'dynamic'     => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'hero_video_url',
            [
                'label' => __( 'Hero Video URL', 'bdevs-elementor' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'hero video url goes here', 'bdevs-elementor' ),
                'placeholder' => __( 'Set Hero Video URL', 'bdevs-elementor' ),
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );


        $this->end_controls_section();
    }




    protected function register_style_controls()
    {


        $this->start_controls_section(
            '_section_style_banner_height',
            [
                'label' => __('Banner Height', 'bdevs-elementor'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                 'condition' => [
                    'designs' => ['design_2'],
                ],
            ]
        );
        $this->add_responsive_control(
            'banner_height_control',
            [
                'label' => __('Banner Height', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .gen-banner-area, .banner-970' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            '_section_style_content',
            [
                'label' => __('Title / Content', 'bdevs-elementor'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'designs' => ['design_1','design_2'],
                ],
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

        // Button 1 style
        $this->start_controls_section(
            '_section_style_button',
            [
                'label' => __('Button', 'bdevs-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'designs' => ['design_2','design_3'],
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

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        extract($settings);
    ?>

    <?php if ($settings['designs'] === 'design_3'):

        if (!empty($settings['hero_image']['url'])) {
            $hero_image = !empty($settings['hero_image']['id']) ? wp_get_attachment_image_url($settings['hero_image']['id'], $settings['bg_thumbnail_size']) : $settings['hero_image']['url'];
            $hero_image_alt = get_post_meta($settings["hero_image"]["id"], "_wp_attachment_image_alt", true);
        }

         if ( !empty($settings['button_link']) ) {
            $this->add_render_attribute( 'button', 'class', 'lv-banner-link-3 bdevs-el-btn' );
            $this->add_link_attributes( 'button', $settings['button_link'] );
        }

    ?>

        <div class="portfolio-area">
            <div class="lv-portfolio-box-1-3 fix">
                <div class="lv-portfolio-img-1-3 bg-default" data-background="<?php print esc_url($hero_image); ?>">
                  <?php if ( !empty($button_text) ) : ?>
                   <div class="lv-portfolio-content-1-3">
                      <a href="<?php echo esc_url($settings['button_link'] ['url']); ?>" class="lv-portfolio-link-1-3 bdevs-el-btn">
                         <i class="fal fa-plus"></i>
                         <span><?php echo wp_kses_post($settings['button_text']); ?></span>
                      </a>
                   </div>
                  <?php endif; ?>
                </div>
            </div>
        </div>

    <?php elseif ($settings['designs'] === 'design_2'):

        $this->add_inline_editing_attributes('title', 'basic');
        $this->add_render_attribute('title', 'class', 'lv-banner-title-3 pl-105 mb-30 bdevs-el-title');

        if ( !empty($settings['button_link']) ) {
            $this->add_render_attribute( 'button', 'class', 'lv-banner-link-3 bdevs-el-btn' );
            $this->add_link_attributes( 'button', $settings['button_link'] );
        }

        if (!empty($settings['banner_image_1']['url'])) {
            $banner_image_1 = !empty($settings['banner_image_1']['id']) ? wp_get_attachment_image_url($settings['banner_image_1']['id'], $settings['bg_thumbnail_size']) : $settings['banner_image_1']['url'];
            $banner_image_1_alt = get_post_meta($settings["banner_image_1"]["id"], "_wp_attachment_image_alt", true);
        }

        if (!empty($settings['banner_image_2']['url'])) {
            $banner_image_2 = !empty($settings['banner_image_2']['id']) ? wp_get_attachment_image_url($settings['banner_image_2']['id'], $settings['bg_thumbnail_size']) : $settings['banner_image_2']['url'];
            $banner_image_2_alt = get_post_meta($settings["banner_image_2"]["id"], "_wp_attachment_image_alt", true);
        }

        if (!empty($settings['banner_image_3']['url'])) {
            $banner_image_3 = !empty($settings['banner_image_3']['id']) ? wp_get_attachment_image_url($settings['banner_image_3']['id'], $settings['bg_thumbnail_size']) : $settings['banner_image_3']['url'];
            $banner_image_3_alt = get_post_meta($settings["banner_image_3"]["id"], "_wp_attachment_image_alt", true);
        }

         if (!empty($settings['banner_image_4']['url'])) {
            $banner_image_4 = !empty($settings['banner_image_4']['id']) ? wp_get_attachment_image_url($settings['banner_image_4']['id'], $settings['bg_thumbnail_size']) : $settings['banner_image_4']['url'];
            $banner_image_4_alt = get_post_meta($settings["banner_image_4"]["id"], "_wp_attachment_image_alt", true);
        }

    ?>
     
        <div class="lv-banner-area pb-120 p-rel fix">
           <div class="lv-banner-extra-team-member-wrap-3">
            <?php if ( !empty($banner_image_1) ) : ?>
              <div class="lv-banner-extra-team-member-single-thumb-3-1 bg-default">
                 <div class="stuff">
                    <img class="w-100 h-100 obj-cover" src="<?php print esc_url($banner_image_1); ?>" data-depth="1"  alt="<?php echo esc_attr($banner_image_1_alt); ?>">
                 </div>
              </div>
              <?php endif; ?>
              <?php if ( !empty($banner_image_2) ) : ?>
              <div class="lv-banner-extra-team-member-single-thumb-3-2 bg-default">
                 <div class="stuff2">
                    <img  class="w-100 h-100 obj-cover" src="<?php print esc_url($banner_image_2); ?>" data-depth=".5"  alt="<?php echo esc_attr($banner_image_2_alt); ?>">
                 </div>
              </div>
              <?php endif; ?>
              <?php if ( !empty($banner_image_3) ) : ?>
              <div class="lv-banner-extra-team-member-single-thumb-3-3 bg-default">
                 <div class="stuff3">
                    <img class="w-100 h-100 obj-cover" src="<?php print esc_url($banner_image_3); ?>" data-depth=".9"  alt="img">
                 </div>
              </div>
              <?php endif; ?>
           </div>
           <div class="container">
              <div class="row">
                 <div class="col-xxl-12">
                    <div class="lv-banner-content-3 pt-275">
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

                       <div class="lv-banner-content-inner-3 pl-50 bdevs-el-content">
                        <?php if ( !empty($banner_image_4) ) : ?>
                          <div class="lv-banner-img-3 bg-default mr-70" data-background="<?php print esc_url($banner_image_4); ?>"></div>
                          <?php endif; ?>
                          <div class="lv-banner-content-text-3 pr-235 fix pt-75">
                            <?php if ($settings['description']): ?>
                             <p class="mb-45"><?php echo wp_kses_post($settings['description']); ?></p>
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
              </div>
           </div>
        </div>


        <?php else:

        $this->add_inline_editing_attributes('title', 'basic');
        $this->add_render_attribute('title', 'class', 'gen-banner-title bdevs-el-title');
        $this->add_render_attribute('title', 'data-wow-delay', '.3s');

        if ( !empty($settings['button_link']) ) {
            $this->add_render_attribute( 'button', 'class', 'gen-border-btn-r bdevs-el-btn' );
            $this->add_link_attributes( 'button', $settings['button_link'] );
        }

        if ( !empty($settings['hero_image']['id']) ) {
                $hero_image = wp_get_attachment_image_url( $settings['hero_image']['id'], $settings['bg_thumbnail_size'] );
            }

        ?>

        <div class="featured-gallery-area p-rel">
         <div class="lv-single-featured-gallery pb-65">
            <a href="<?php echo esc_url($settings['title_url']); ?>">
                <?php if ( !empty($hero_image) ) : ?>
                <div class="lv-single-featured-gallery-img lv-single-featured-gallery-img-1 bg-default" data-background="<?php print esc_url($hero_image); ?>"></div>
                <?php endif; ?>
            </a>
            <div class="lv-single-featured-gallery-content text-center pt-40">
                <?php if ($settings['subtitle']): ?>
               <h5 class="lv-single-featured-gallery-subtitle bdevs-el-subtitle"><?php echo wp_kses_post($settings['subtitle']); ?></h5>
               <?php endif; ?>
               <?php if ($settings['title']) : ?>
               <h4 class="lv-single-featured-gallery-title bdevs-el-title"><a href="<?php echo esc_url($settings['title_url']); ?>"><?php echo wp_kses_post($settings['title']); ?></a></h4>
               <?php endif; ?>

            </div>
         </div>
        </div>

        <?php endif; ?>
    <?php
    }
}
