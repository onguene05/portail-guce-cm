<?php

namespace Bdevs\Elementor;

defined('ABSPATH') || die();

class Faq extends \Generic\Elements\GenericWidget
{

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
        return 'cust-faq';
    }

    /**
     * Get widget title.
     *
     * @return string Widget title.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_title() {
        return __('FAQ', 'bdevs-elementor');
    }

    public function get_custom_help_url() {
        return 'http://elementor.bdevs.net//widgets/faq/';
    }

    public function get_script_depends() {
        return ['bootstrap', 'genwow', 'swiper', 'bdevs-elementor-js'];
    }

     public function get_style_depends() {
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
        return 'eicon-plug';
    }

    public function get_keywords()
    {
        return [ 'box', 'about', 'faq', 'content'];
    }

    public function get_categories()
    {
        return ['bdevs-elementor'];
    }

    protected function register_content_controls()
    {

        $this->start_controls_section(
            '_section_design_title',
            [
                'label' => __('Design Style', 'bdevs-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'design_style',
            [
                'label' => __('Design Style', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'style_1' => __('Style 1', 'bdevs-elementor'),
                    'style_2' => __('Style 2', 'bdevs-elementor'),
                    'style_3' => __('Style 3', 'bdevs-elementor'),
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );
        $this->end_controls_section();


        $this->start_controls_section(
            '_section_title',
            [
                'label' => __('Title ', 'bdevs-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => ['style_2'],
                ]
            ]
        );

        $this->add_control(
            'sub_title',
            [
                'label' => __('Sub Title', 'bdevs-elementor'),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Heading Sub Title',
                'placeholder' => __('Heading Sub Text', 'bdevs-elementor'),
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
                'default' => 'Heading Title',
                'placeholder' => __('Heading Text', 'bdevs-elementor'),
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
                'placeholder' => __('Heading Description Text', 'bdevs-elementor'),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'design_style' => ['style_20'],
                ]
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

        $this->start_controls_section(
            '_section_image',
            [
                'label' => __('Image', 'bdevs-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => ['style_2'],
                ],
            ]
        );

        $this->add_control(
            'one_image',
            [
                'label' => __('Left Image', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

           $this->add_control(
            'two_image',
            [
                'label' => __('Right Image', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->end_controls_section();

         $this->start_controls_section(
            '_section_title_video',
            [
                'label' => __( 'Video', 'bdevs-elementor' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => ['style_2'],
                ]
            ]
        );

       $this->add_control(
            'video_url',
            [
                'label' => __( 'Video URL', 'bdevs-elementor' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'bdevs video url goes here', 'bdevs-elementor' ),
                'placeholder' => __( 'Set Video URL', 'bdevs-elementor' ),
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

       $this->end_controls_section();


        $this->start_controls_section(
            '_faq_list',
            [
                'label' => __( 'FAQ List', 'bdevs-elementor' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'field_condition',
            [
                'label' => __( 'Field condition', 'bdevs-elementor' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'style_1' => __( 'Style 1', 'bdevs-elementor' ),
                    'style_2' => __( 'Style 2', 'bdevs-elementor' ),
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $repeater->add_control( 
            'title_number',
            [
                'label' => __( 'Title Number', 'bdevs-elementor' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'default' => __( 'Title number', 'bdevs-elementor' ),
                'placeholder' => __( 'Title number', 'bdevs-elementor' ),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'field_condition' => ['style_1'],
                ],
            ]
        );


        $repeater->add_control(
            'title',
            [
                'label' => __( 'Title', 'bdevs-elementor' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'default' => __( 'Title', 'bdevs-elementor' ),
                'placeholder' => __( 'Title', 'bdevs-elementor' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'title_des',
            [
                'label' => __( 'Description', 'bdevs-elementor' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => __( 'description', 'bdevs-elementor' ),
                'placeholder' => __( 'description', 'bdevs-elementor' ),
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

        $this->start_controls_section(
            '_section_button',
            [
                'label' => __('Button', 'bdevs-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => ['style_20'],
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

    // register_style_controls
    protected function register_style_controls(){
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
            ]
        );
        
        // Subtitle    
        $this->add_control(
            '_heading_subtitle',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => __( 'Subtitle', 'bdevs-elementor' ),
                'separator' => 'before'
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

        // services item 
        $this->start_controls_section(
            '_box_section_style_content',
            [
                'label' => __( 'Box Title / Content', 'bdevs-elementor' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_responsive_control(
            '_box_content_padding',
            [
                'label' => __( 'Content Padding', 'bdevs-elementor' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
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
                'label' => __( 'Title', 'bdevs-elementor' ),
                'separator' => 'before'
            ]
        );
        
        $this->add_responsive_control(
            '_box_title_spacing',
            [
                'label' => __( 'Bottom Spacing', 'bdevs-elementor' ),
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
                'label' => __( 'Text Color', 'bdevs-elementor' ),
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
                'label' => __( 'Description', 'bdevs-elementor' ),
                'separator' => 'before'
            ]
        );
        
        $this->add_responsive_control(
            '_box_description_spacing',
            [
                'label' => __( 'Bottom Spacing', 'bdevs-elementor' ),
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
                'label' => __( 'Text Color', 'bdevs-elementor' ),
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

        // Button 1 style
        $this->start_controls_section(
            '_section_style_button',
            [
                'label' => __( 'Button', 'bdevs-elementor' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
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
        $this->add_render_attribute('title', 'class', 'big_title text-white mb-0');
        $title = wp_kses_post($settings['title']);

        // img 
        if (!empty($settings['one_image']['id'])) {
            $one_image = wp_get_attachment_image_url(!empty($settings['one_image']['id']), !empty($settings['tab_big_image_size']));
            if (!$one_image) {
                $one_image = $settings['one_image']['url'];
            }
        }

        // img small
        if (!empty($settings['two_image']['id'])) {
            $two_image = wp_get_attachment_image_url(!empty($settings['two_image']['id']), !empty($settings['tab_big_image_size']));
            if (!$two_image) {
                $two_image = $settings['two_image']['url'];
            }
        }

        if (empty($settings['slides'])) {
            return;
        }
        ?>

        <?php if ($settings['design_style'] === 'style_3'): 

        ?>

            <div class="bd-accordiong__wrapper mb-30">
                <div class="bd-faq__accordion">
                    <div class="accordion" id="accordionExample">
                        <?php foreach ($settings['slides'] as $id => $slide) :
                            // active class
                            $collapsed_tab = ($id == 0) ? '' : 'collapsed';
                            $area_expanded = ($id == 0) ? 'true' : 'false';
                            $active_show_tab = ($id == 0) ? 'show' : '';
                        ?>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne_<?php echo esc_attr($id); ?>">
                                <button class="accordion-button <?php echo esc_attr($collapsed_tab); ?>"
                                 type="button" 
                                 data-bs-toggle="collapse" 
                                 data-bs-target="#collapseOne_<?php echo esc_attr($id); ?>"
                                 aria-expanded="<?php echo esc_attr($area_expanded); ?>" 
                                 aria-controls="collapseOne_<?php echo esc_attr($id); ?>">
                                  <span class="bd-accordion__tittle"><?php echo wp_kses_post($slide['title']); ?></span>
                                </button>
                            </h2>
                             <div id="collapseOne_<?php echo esc_attr($id); ?>" class="accordion-collapse collapse  <?php echo esc_attr($active_show_tab); ?>" aria-labelledby="headingOne_<?php echo esc_attr($id); ?>" data-bs-parent="#accordionExample">
                            <div class="accordion-body bdevs-el-content">
                               <p><?php echo wp_kses_post($slide['title_des']); ?></p>
                           </div>
                            </div>
                        </div>
                     <?php endforeach; ?>
                    </div>
                </div>
            </div>

        <?php elseif ($settings['design_style'] === 'style_2'): ?>

        
        <div class="bd-faq__area wow fadeInUp" data-wow-duration="1.5s" data-wow-delay=".3s">
             <div class="container">
                <div class="row align-items-center">
                   <div class="col-xl-7 col-lg-6">
                      <div class="bd-faq__wrapper d-flex p-relative mb-60">
                        <?php if (!empty($one_image)): ?>
                         <div class="bd-faq__image-1 w-img">
                            <img src="<?php echo esc_url($one_image); ?>" alt="faq-thumb-2.jpg">
                         </div>
                         <?php endif; ?>
                         <?php if (!empty($two_image)): ?>
                         <div class="bd-faq__image-2 w-img">
                            <img src="<?php echo esc_url($two_image); ?>" alt="faq-thumb-3.jpg">
                         </div>
                         <?php endif; ?>
                         <a class="bd-faq__play popup-video" href="<?php echo esc_url($settings['video_url']); ?>">
                             <i class="fas fa-play"></i>
                         </a>
                      </div>
                   </div>
                   <div class="col-xl-5 col-lg-6">
                      <div class="bd-faq__box mb-60">
                         <div class="bd-section__title-5 mb-50">
                            <?php if ($settings['sub_title']) : ?>
                            <h5 class="bd-smaill__title-5 bdevs-el-subtitle"><?php echo wp_kses_post($settings['sub_title']); ?></h5>
                            <?php endif; ?>
                            <?php if ($settings['title']) : ?>
                            <h2 class="bd-big__title-5 white bdevs-el-title"><?php echo wp_kses_post($settings['title']); ?></h2>
                            <?php endif; ?>

                         </div>
                         <div class="bd-faq__accordion-box">
                            <div class="bd-accordiong__style-2">
                               <div class="accordion" id="accordionExample">
                                <?php foreach ($settings['slides'] as $id => $slide) :
                                    // active class
                                    $collapsed_tab = ($id == 0) ? '' : 'collapsed';
                                    $area_expanded = ($id == 0) ? 'true' : 'false';
                                    $active_show_tab = ($id == 0) ? 'show' : '';
                                ?>
                                <div class="accordion-item">
                                   <h2 class="accordion-header" id="headingOne_<?php echo esc_attr($id); ?>">
                                    <button class="accordion-button <?php echo esc_attr($collapsed_tab); ?>"
                                     type="button" 
                                     data-bs-toggle="collapse" 
                                     data-bs-target="#collapseOne_<?php echo esc_attr($id); ?>"
                                     aria-expanded="<?php echo esc_attr($area_expanded); ?>" 
                                     aria-controls="collapseOne_<?php echo esc_attr($id); ?>">
                                     <span class="bd-accordion__tittle">
                                      <span class="bdevs-el-title"><?php echo wp_kses_post($slide['title']); ?></span>
                                    </span>
                                    </button>
                                </h2>
                                 <div id="collapseOne_<?php echo esc_attr($id); ?>" class="accordion-collapse collapse  <?php echo esc_attr($active_show_tab); ?>" aria-labelledby="headingOne_<?php echo esc_attr($id); ?>" data-bs-parent="#accordionExample">
                                <div class="accordion-body bdevs-el-content">
                                   <p><?php echo wp_kses_post($slide['title_des']); ?></p>
                                </div>
                                </div>
                                </div>
                                 <?php endforeach; ?>
                               </div>
                            </div>
                         </div>
                      </div>
                   </div>
                </div>
             </div>
        </div>

    <?php else: ?>

     
    <!-- faq-area-start -->
    <section class="bd-faq__area pt-120 pb-60 wow fadeInUp" data-wow-duration="1.5s" data-wow-delay=".3s">
          <div class="bd-faq__main-box pr-20 mb-60">
             <div class="bd-accordion__wrap mb-60">
                <div class="bd-faq__accordion-2">
                   <div class="accordion" id="accordionExample">
                    <?php foreach ($settings['slides'] as $id => $slide) :
                        // active class
                        $collapsed_tab = ($id == 0) ? '' : 'collapsed';
                        $area_expanded = ($id == 0) ? 'true' : 'false';
                        $active_show_tab = ($id == 0) ? 'show' : '';
                    ?>
                    <div class="accordion-item">
                           <h2 class="accordion-header" id="headingOne_<?php echo esc_attr($id); ?>">
                            <button class="accordion-button <?php echo esc_attr($collapsed_tab); ?>"
                             type="button" 
                             data-bs-toggle="collapse" 
                             data-bs-target="#collapseOne_<?php echo esc_attr($id); ?>"
                             aria-expanded="<?php echo esc_attr($area_expanded); ?>" 
                             aria-controls="collapseOne_<?php echo esc_attr($id); ?>">
                             <span class="bd-accordion__number bdevs-el-subtitle"><?php echo wp_kses_post($slide['title_number']); ?></span>
                            <span class="bd-accordion__title bdevs-el-title"><?php echo wp_kses_post($slide['title']); ?></span>
                            </button>
                        </h2>
                         <div id="collapseOne_<?php echo esc_attr($id); ?>" class="accordion-collapse collapse  <?php echo esc_attr($active_show_tab); ?>" aria-labelledby="headingOne_<?php echo esc_attr($id); ?>" data-bs-parent="#accordionExample">
                        <div class="accordion-body bdevs-el-content">
                           <p><?php echo wp_kses_post($slide['title_des']); ?></p>
                        </div>
                    </div>
                    </div>
                      <?php endforeach; ?>
                   </div>
                </div>
             </div>
          </div>
    </section>
      <!-- faq-area-end -->


    <?php endif; ?>

        <?php

    }
}