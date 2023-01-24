<?php
namespace Generic\Elements;

defined( 'ABSPATH' ) || die();

class Slider extends GenericWidget {

    /**
     * Get widget name.
     *
     * Retrieve Generic Elements widget name.
     *
     * @since 1.0.1
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'generic-slider';
    }

    /**
     * Get widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Slider', 'generic-elements' );
    }

    public function get_custom_help_url() {
        return 'http://elementor.bdevs.net/bdevselement/slider/';
    }

    public function get_script_depends() {
        return ['bootstrap','swiper', 'generic-element-js'];
    }

    public function get_style_depends() {
        return ['bootstrap','fontawesome','swiper', 'generic-element-css'];
    }

    public function get_categories() {
        return [ 'generic-elements' ];
    }

    /**
     * Get widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */

    public function get_icon() {
        return 'eicon-slider-full-screen gen-icon';
    }

    public function get_keywords() {
        return [ 'slider', 'image', 'gallery', 'carousel' ];
    }

    // register_content_controls
    protected function register_content_controls() {
        $this->slider_background_overley_controls();
        $this->slider_slide_list_content_controls();
        $this->slider_setting_controls();
    }

    // Background Overlay
    protected function slider_background_overley_controls(){
        $this->start_controls_section(
            '_section_background_overlay',
            [
                'label' => esc_html__( 'Background Overlay', 'elementor' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background',
                'label' => esc_html__( 'Background', 'generic-elements' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .bd-single-slider-overlay::before, .bd-single-slider-overlay-invisible::before',
            ]
        );

        $this->add_control(
            'background_overlay_opacity',
            [
                'label' => esc_html__( 'Opacity', 'elementor' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'default' => [
                    'size' => .7,
                ],
                'range' => [
                    'px' => [
                        'max' => 1,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .bd-single-slider-overlay::before, .bd-single-slider-overlay-invisible::before' => 'opacity: {{SIZE}};',
                ]
            ]
        );

        $this->end_controls_section();
    }

    // slider_slide_list_content_controls
    protected function slider_slide_list_content_controls(){
        $this->start_controls_section(
            '_section_slides',
            [
                'label' => esc_html__( 'Slides', 'generic-elements' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->start_controls_tabs(
            '_tab_style_member_box_slider'
        );

        $repeater->add_control(
            'image',
            [
                'type' => \Elementor\Controls_Manager::MEDIA,
                'label' => esc_html__( 'Slider BG Image', 'generic-elements' ),
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'sub_title',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'label' => esc_html__( 'Sub Title', 'generic-elements' ),
                'default' => esc_html__( 'Subtitle', 'generic-elements' ),
                'placeholder' => esc_html__( 'Type subtitle here', 'generic-elements' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'title',
            [
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'label_block' => true,
                'label' => esc_html__( 'Title', 'generic-elements' ),
                'default' => esc_html__( 'Title Here', 'generic-elements' ),
                'placeholder' => esc_html__( 'Type title here', 'generic-elements' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'desc',
            [
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'label_block' => true,
                'label' => esc_html__( 'Description', 'generic-elements' ),
                'default' => esc_html__( 'Hero Description', 'generic-elements' ),
                'placeholder' => esc_html__( 'Type Hero Description Here', 'generic-elements' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        //button
        $repeater->add_control(
            'button_text',
            [
                'label' => esc_html__( 'Button Text', 'generic-elements' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Button Text',
                'placeholder' => esc_html__( 'Type button text here', 'generic-elements' ),
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'button_link',
            [
                'label' => esc_html__( 'Button Link', 'generic-elements' ),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => 'http://elementor.bdevs.net/',
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );
        $repeater->end_controls_tab();

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
                    [
                        'image' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
                    ]
                ]
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'medium_large',
                'separator' => 'before',
                'exclude' => [
                    'custom'
                ]
            ]
        );

        $this->end_controls_section();
    }

    // slider_setting_controls
    protected function slider_setting_controls(){
        // Slider Settings
        $this->start_controls_section(
            '_section_settings',
            [
                'label' => esc_html__( 'Settings', 'bdevselement' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

       $this->add_control(
            'ts_slider_autoplay',
            [
                'label' => esc_html__( 'Autoplay', 'bdevselement' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'bdevselement' ),
                'label_off' => esc_html__( 'No', 'bdevselement' ),
                'return_value' => 'yes',
                'default' => 'no'
            ]
        );

        $this->add_control(
            'ts_slider_speed',
            [
               'label' => esc_html__( 'Slider Speed', 'bdevselement' ),
               'type' => \Elementor\Controls_Manager::NUMBER,
               'placeholder' => esc_html__( 'Enter Slider Speed', 'bdevselement' ),
               'default' => '5000',
               'condition' => ["ts_slider_autoplay" => ['yes']],
            ]
        );

        $this->add_control(
        'ts_slider_nav_show',
            [
            'label' => esc_html__( 'Nav show', 'bdevselement' ),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => esc_html__( 'Yes', 'bdevselement' ),
            'label_off' => esc_html__( 'No', 'bdevselement' ),
            'return_value' => 'yes',
            'default' => 'yes'
            ]
        );

        $this->add_control(
         'ts_slider_dot_nav_show',
             [
             'label' => esc_html__( 'Dot nav', 'bdevselement' ),
             'type' => \Elementor\Controls_Manager::SWITCHER,
             'label_on' => esc_html__( 'Yes', 'bdevselement' ),
             'label_off' => esc_html__( 'No', 'bdevselement' ),
             'return_value' => 'yes',
             'default' => 'yes'
             ]
         );
        $this->end_controls_section();
    }


    // register_style_controls
    protected function register_style_controls() {
        $this->slider_title_desc_style_controls();
        $this->slider_button_style_controls();
        $this->slider_navigation_arrow_style_controls();
        $this->slider_navigation_dots_style_controls();
    }

    // slider_title_desc_style_controls
    protected function slider_title_desc_style_controls(){
        $this->start_controls_section(
            '_section_style_content',
            [
                'label' => esc_html__( 'Title / Content', 'generic-elements' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'content_padding',
            [
                'label' => esc_html__( 'Content Padding', 'generic-elements' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .generic-el-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'content_background',
                'selector' => '{{WRAPPER}} .generic-el-content',
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
                'label' => esc_html__( 'Title', 'generic-elements' ),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'title_spacing',
            [
                'label' => esc_html__( 'Bottom Spacing', 'generic-elements' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .generic-el-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Text Color', 'generic-elements' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .generic-el-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title',
                'selector' => '{{WRAPPER}} .generic-el-title',
            ]
        );

        // Subtitle
        $this->add_control(
            '_heading_subtitle',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__( 'Subtitle', 'generic-elements' ),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'subtitle_spacing',
            [
                'label' => esc_html__( 'Bottom Spacing', 'generic-elements' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .generic-el-subtitle' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'subtitle_color',
            [
                'label' => esc_html__( 'Text Color', 'generic-elements' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .generic-el-subtitle' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'subtitle',
                'selector' => '{{WRAPPER}} .generic-el-subtitle',
            ]
        );

        // description
        $this->add_control(
            '_content_description',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__( 'Description', 'generic-elements' ),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'description_spacing',
            [
                'label' => esc_html__( 'Bottom Spacing', 'generic-elements' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .generic-el-content p' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => esc_html__( 'Text Color', 'generic-elements' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .generic-el-content p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'description',
                'selector' => '{{WRAPPER}} .generic-el-content p',
            ]
        );

        $this->end_controls_section();
    }

    // slider_button_style_controls
    protected function slider_button_style_controls(){
        $this->start_controls_section(
            '_section_style_button',
            [
                'label' => esc_html__( 'Button', 'generic-elements' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'button_padding',
            [
                'label' => esc_html__( 'Padding', 'generic-elements' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .generic-el-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'selector' => '{{WRAPPER}} .generic-el-btn',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'button_border',
                'selector' => '{{WRAPPER}} .generic-el-btn',
            ]
        );

        $this->add_control(
            'button_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'generic-elements' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .generic-el-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_box_shadow',
                'selector' => '{{WRAPPER}} .generic-el-btn',
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
                'label' => esc_html__( 'Normal', 'generic-elements' ),
            ]
        );

        $this->add_control(
            'button_color',
            [
                'label' => esc_html__( 'Text Color', 'generic-elements' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .generic-el-btn' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_bg_color',
            [
                'label' => esc_html__( 'Background Color', 'generic-elements' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .generic-el-btn' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            '_tab_button_hover',
            [
                'label' => esc_html__( 'Hover', 'generic-elements' ),
            ]
        );

        $this->add_control(
            'button_hover_color',
            [
                'label' => esc_html__( 'Text Color', 'generic-elements' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .generic-el-btn:hover, {{WRAPPER}} .generic-el-btn:focus' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_bg_color',
            [
                'label' => esc_html__( 'Background Color', 'generic-elements' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .generic-el-btn:hover, {{WRAPPER}} .generic-el-btn:focus' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_border_color',
            [
                'label' => esc_html__( 'Border Color', 'generic-elements' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'button_border_border!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .generic-el-btn:hover, {{WRAPPER}} .generic-el-btn:focus' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    // slider_navigation_arrow_style_controls
    protected function slider_navigation_arrow_style_controls(){
        // Navigation - Arrow
        $this->start_controls_section(
            '_section_style_arrow',
            [
                'label' => esc_html__( 'Navigation - Arrow', 'bdevselement' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'arrow_position_toggle',
            [
                'label' => esc_html__( 'Position', 'bdevselement' ),
                'type' => \Elementor\Controls_Manager::POPOVER_TOGGLE,
                'label_off' => esc_html__( 'None', 'bdevselement' ),
                'label_on' => esc_html__( 'Custom', 'bdevselement' ),
                'return_value' => 'yes',
            ]
        );

        $this->start_popover();

        $this->add_responsive_control(
            'arrow_position_y',
            [
                'label' => esc_html__( 'Vertical', 'bdevselement' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'condition' => [
                    'arrow_position_toggle' => 'yes'
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} div.sp-arrow, {{WRAPPER}} div.sp-arrow' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'arrow_position_x',
            [
                'label' => esc_html__( 'Horizontal', 'bdevselement' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'condition' => [
                    'arrow_position_toggle' => 'yes'
                ],
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 250,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} div.sp-arrow' => 'left: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} div.sp-arrow' => 'right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_popover();

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'arrow_border',
                'selector' => '{{WRAPPER}} div.sp-arrow, {{WRAPPER}} div.sp-arrow',
            ]
        );

        $this->add_responsive_control(
            'arrow_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'bdevselement' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} div.sp-arrow, {{WRAPPER}} div.sp-arrow' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
                ],
            ]
        );

        $this->start_controls_tabs( '_tabs_arrow' );

        $this->start_controls_tab(
            '_tab_arrow_normal',
            [
                'label' => esc_html__( 'Normal', 'bdevselement' ),
            ]
        );

        $this->add_control(
            'arrow_color',
            [
                'label' => esc_html__( 'Text Color', 'bdevselement' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} div.sp-arrow, {{WRAPPER}} div.sp-arrow' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'arrow_bg_color',
            [
                'label' => esc_html__( 'Background Color', 'bdevselement' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} div.sp-arrow, {{WRAPPER}} div.sp-arrow' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            '_tab_arrow_hover',
            [
                'label' => esc_html__( 'Hover', 'bdevselement' ),
            ]
        );

        $this->add_control(
            'arrow_hover_color',
            [
                'label' => esc_html__( 'Text Color', 'bdevselement' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} div.sp-arrow:hover, {{WRAPPER}} div.sp-arrow:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'arrow_hover_bg_color',
            [
                'label' => esc_html__( 'Background Color', 'bdevselement' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} div.sp-arrow:hover, {{WRAPPER}} div.sp-arrow:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'arrow_hover_border_color',
            [
                'label' => esc_html__( 'Border Color', 'bdevselement' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'arrow_border_border!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} div.sp-arrow:hover, {{WRAPPER}} div.sp-arrow:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    // slider_navigation_dots_style_controls
    protected function slider_navigation_dots_style_controls(){
        $this->start_controls_section(
            '_section_style_dots',
            [
                'label' => esc_html__( 'Navigation - Dots', 'bdevselement' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'dots_nav_position_y',
            [
                'label' => esc_html__( 'Vertical Position', 'bdevselement' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 500,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} div.bd-slider-active.swiper-container-horizontal .swiper-pagination-bullets' => 'bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'dots_nav_spacing',
            [
                'label' => esc_html__( 'Spacing', 'bdevselement' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} div.bd-slider-active.swiper-container-horizontal .swiper-pagination-bullets .swiper-pagination-bullet' => 'margin-right: calc({{SIZE}}{{UNIT}} / 2); margin-left: calc({{SIZE}}{{UNIT}} / 2);',
                ],
            ]
        );

        $this->add_responsive_control(
            'dots_nav_align',
            [
                'label' => esc_html__( 'Alignment', 'bdevselement' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'bdevselement' ),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'bdevselement' ),
                        'icon' => 'eicon-h-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'bdevselement' ),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} div.bd-slider-active.swiper-container-horizontal .swiper-pagination-bullets' => 'text-align: {{VALUE}}'
                ]
            ]
        );

        $this->start_controls_tabs( '_tabs_dots' );
        $this->start_controls_tab(
            '_tab_dots_normal',
            [
                'label' => esc_html__( 'Normal', 'bdevselement' ),
            ]
        );

        $this->add_control(
            'dots_nav_color',
            [
                'label' => esc_html__( 'Color', 'bdevselement' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slick-dots li button' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'dots_nav_bg_color',
            [
                'label' => esc_html__( 'Background Color', 'bdevselement' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} div.bd-slider-active.swiper-container-horizontal .swiper-pagination-bullets .swiper-pagination-bullet.swiper-pagination-bullet-active' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'dots_nav_border_color',
            [
                'label' => esc_html__( 'Border Color', 'bdevselement' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} div.bd-slider-active.swiper-container-horizontal .swiper-pagination-bullets .swiper-pagination-bullet' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            '_tab_dots_hover',
            [
                'label' => esc_html__( 'Hover', 'bdevselement' ),
            ]
        );

        $this->add_control(
            'dots_nav_hover_color',
            [
                'label' => esc_html__( 'Color', 'bdevselement' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slick-dots li button:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            '_tab_dots_active',
            [
                'label' => esc_html__( 'Active', 'bdevselement' ),
            ]
        );

        $this->add_control(
            'dots_nav_active_color',
            [
                'label' => esc_html__( 'Color', 'bdevselement' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} div.bd-slider-active.swiper-container-horizontal .swiper-pagination-bullets .swiper-pagination-bullet.swiper-pagination-bullet-active' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();
    }


    // Render Function
    protected function render() {
        $settings = $this->get_settings_for_display();

        // ================

        $show_navigation   =   $settings["ts_slider_nav_show"]=="yes"?true:false;
        $auto_nav_slide    =   $settings['ts_slider_autoplay'];
        $dot_nav_show      =   $settings['ts_slider_dot_nav_show'];
        $ts_slider_speed   =   $settings['ts_slider_speed'] ? $settings['ts_slider_speed'] : '5000';

        // ================

        if ( empty( $settings['slides'] ) ) {
            return;
        }

        $this->add_render_attribute( 'button_no_icon', 'class', 'custom_btn bg_default_orange btn-no-icon wow fadeInUp222' );
        ?>

        <section class="bd-slider-area">
            <div class="bd-slider-active swiper-container" autoplay-speed ="<?php echo esc_attr( $ts_slider_speed ); ?>" data-swipper_autoplay_stop="<?php echo esc_attr( $auto_nav_slide ); ?>">
                <div class="swiper-wrapper">
                 <?php foreach ( $settings['slides'] as $key => $slide ) :
                        $image = wp_get_attachment_image_url( $slide['image']['id'], $settings['thumbnail_size'] );
                        $this->add_render_attribute( 'button_'. $key, 'class', 'theme-btn generic-el-btn' );
                        $this->add_render_attribute( 'button_'. $key, 'href', $slide['button_link']['url'] );
                    ?>
                    <div class="bd-single-slider gen-slider bd-single-slider-overlay bd-slider-height d-flex align-items-center swiper-slide" data-swiper-autoplay="<?php $ts_slider_speed; ?>">
                        <div class="bd-slide-bg" data-background="<?php print esc_url($image); ?>"></div>
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <div class="bd-slider z-index text-center generic-el-content pt-95">
                                        <?php if ( !empty($slide['sub_title']) ) : ?>
                                        <span class="generic-el-subtitle bd-slider-subtitle" data-animation="fadeInUp" data-delay=".3s"><?php echo wp_kses_post( $slide['sub_title'] ); ?></span>
                                        <?php endif; ?>

                                        <?php if ( !empty($slide['title']) ) : ?>
                                        <h1 class="bd-slider-title mb-20 generic-el-title" data-animation="fadeInUp" data-delay=".3s"><?php echo wp_kses_post( $slide['title'] ); ?></h1>
                                        <?php endif; ?>

                                        <?php if ( !empty($slide['desc']) ) : ?>
                                        <p class="mb-40" data-animation="fadeInUp" data-delay=".6s"><?php echo wp_kses_post( $slide['desc'] ); ?></p>
                                        <?php endif; ?>

                                        <div class="bd-slider-btn" data-animation="fadeInUp" data-delay=".9s">
                                           <?php if ( $slide['button_text'] && ( ( empty( $slide['button_selected_icon'] ) || empty( $slide['button_selected_icon']['value'] ) ) && empty( $slide['button_icon'] ) ) ) :
                                                    printf( '<a %1$s>%2$s</a>',
                                                        $this->get_render_attribute_string( 'button_'. $key ),
                                                        esc_html( $slide['button_text'] )
                                                        );
                                                elseif ( empty( $slide['button_text'] ) && ( ( !empty( $slide['button_selected_icon'] ) || empty( $slide['button_selected_icon']['value'] ) ) || !empty( $slide['button_icon'] ) ) ) : ?>
                                                    <a <?php $this->print_render_attribute_string( 'button_'. $key ); ?>><?php bdevs_element_render_icon( $slide, 'button_icon', 'button_selected_icon' ); ?></a>
                                                <?php elseif ( $slide['button_text'] && ( ( !empty( $slide['button_selected_icon'] ) || empty( $slide['button_selected_icon']['value'] ) ) || !empty($slide['button_icon']) ) ) :
                                                    if ( $slide['button_icon_position'] === 'before' ): ?>
                                                        <a <?php $this->print_render_attribute_string( 'button_'. $key ); ?>><span><?php bdevs_element_render_icon( $slide, 'button_icon', 'button_selected_icon', ['class' => 'bdevs-btn-icon'] ); ?></span> <?php echo esc_html($slide['button_text']); ?></a>
                                                        <?php
                                                    else: ?>
                                                        <a <?php $this->print_render_attribute_string( 'button_'. $key ); ?>><?php echo esc_html($slide['button_text']); ?> <span><?php bdevs_element_render_icon( $slide, 'button_icon', 'button_selected_icon', ['class' => 'bdevs-btn-icon'] ); ?></span></a>
                                                    <?php
                                                    endif;
                                            endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <!-- If we need navigation buttons -->
                <?php if(!empty($show_navigation)) : ?>
                <div class="swiper-button-prev sp-arrow"> <i class="far fa-angle-left"></i></div>
                <div class="swiper-button-next sp-arrow"> <i class="far fa-angle-right"></i></div>
                <?php endif; ?>
                <?php if(!empty($dot_nav_show)) : ?>
                <div class="t-swiper-pagination s"></div>
                <?php endif; ?>
            </div>
        </section>
    <?php
    }
}
