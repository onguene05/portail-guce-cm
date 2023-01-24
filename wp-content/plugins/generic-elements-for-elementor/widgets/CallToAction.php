<?php

namespace Generic\Elements;

defined('ABSPATH') || die();

class CallToAction extends GenericWidget
{

    /**
     * Get widget name.
     *
     * Retrieve Generic Elements widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name()
    {
        return 'generic-call-to-action';
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
        return esc_html__('Call To Action', 'generic-elements');
    }

    public function get_custom_help_url()
    {
        return 'http://elementor.bdevs.net/bdevselement/call-to-action/';
    }

    public function get_script_depends()
    {
        return ['bootstrap', 'swiper', 'generic-element-js'];
    }

    public function get_style_depends()
    {
        return ['bootstrap', 'fontawesome', 'swiper', 'generic-element-css'];
    }

    public function get_categories()
    {
        return ['generic-elements'];
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
        return ['cta', 'call', 'call-to-action', 'infobox', 'content', 'block', 'box'];
    }


    protected function register_content_controls()
    {
        $this->background_overlay_controls();
        $this->cta_content_controls();
        $this->cta_images_controls();
        $this->button_content_controls();
        $this->button_two_content_controls();
    }

    // Background Overlay
    public function background_overlay_controls()
    {
        $this->start_controls_section(
            '_section_background_overlay',
            [
                'label' => esc_html__('Background Overlay', 'generic-elements'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background',
                'label' => esc_html__('Background', 'generic-elements'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .generic-cta-area::after',
            ]
        );

        $this->add_control(
            'background_overlay_opacity',
            [
                'label' => esc_html__('Opacity', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'default' => [
                    'size' => .8,
                ],
                'range' => [
                    'px' => [
                        'max' => 1,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .generic-cta-area::after' => 'opacity: {{SIZE}};',
                ]
            ]
        );
        $this->end_controls_section();
    }

    // cta_content_controls
    public function cta_content_controls()
    {

        // Title & Description
        $this->start_controls_section(
            '_section_title',
            [
                'label' => esc_html__('Title & Description', 'generic-elements'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'sub_title',
            [
                'label'       => esc_html__('Sub Title', 'generic-elements'),
                'label_block' => true,
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__('Sub Title', 'generic-elements'),
                'placeholder' => esc_html__('Enter Sub Title', 'generic-elements'),
                'dynamic'     => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'title',
            [
                'label'       => esc_html__('Title', 'generic-elements'),
                'label_block' => true,
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__('Hero Title', 'generic-elements'),
                'placeholder' => esc_html__('Enter Hero Title', 'generic-elements'),
                'dynamic'     => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'description',
            [
                'label'       => esc_html__('Description', 'generic-elements'),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'default'     => esc_html__('Hero description goes here', 'generic-elements'),
                'placeholder' => esc_html__('Enter Hero description', 'generic-elements'),
                'rows'        => 5,
                'dynamic'     => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label' => esc_html__('Title HTML Tag', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'h1'  => [
                        'title' => esc_html__('H1', 'generic-elements'),
                        'icon' => 'eicon-editor-h1'
                    ],
                    'h2'  => [
                        'title' => esc_html__('H2', 'generic-elements'),
                        'icon' => 'eicon-editor-h2'
                    ],
                    'h3'  => [
                        'title' => esc_html__('H3', 'generic-elements'),
                        'icon' => 'eicon-editor-h3'
                    ],
                    'h4'  => [
                        'title' => esc_html__('H4', 'generic-elements'),
                        'icon' => 'eicon-editor-h4'
                    ],
                    'h5'  => [
                        'title' => esc_html__('H5', 'generic-elements'),
                        'icon' => 'eicon-editor-h5'
                    ],
                    'h6'  => [
                        'title' => esc_html__('H6', 'generic-elements'),
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
                'label'     => esc_html__('Alignment', 'generic-elements'),
                'type'      => \Elementor\Controls_Manager::CHOOSE,
                'options'   => [
                    'left'   => [
                        'title' => esc_html__('Left', 'generic-elements'),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'generic-elements'),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'right'  => [
                        'title' => esc_html__('Right', 'generic-elements'),
                        'icon'  => 'fa fa-align-right',
                    ],
                ],
                'toggle'    => true,
                'selectors' => [
                    '{{WRAPPER}} .generic-el-cta-wrapper' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    // cta_images_controls
    public function cta_images_controls()
    {
        // image
        $this->start_controls_section(
            '_section_image',
            [
                'label' => esc_html__('Background Image', 'generic-elements'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'cta_bg',
            [
                'label' => esc_html__('Image', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Image_Size::get_type(),
            [
                'name' => 'cta_image',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ]
            ]
        );

        $this->end_controls_section();
    }

    // button_content_controls
    protected function button_content_controls()
    {

        $this->start_controls_section(
            '_section_button',
            [
                'label' => esc_html__('Button Left', 'generic-elements'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => esc_html__('Text', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Button Text',
                'placeholder' => esc_html__('Type button text here', 'generic-elements'),
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'button_link',
            [
                'label' => esc_html__('Link', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => 'https://example.com',
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
                    'url' => '#'
                ],
            ]
        );

        $this->add_control(
            'button_fullwidth',
            [
                'label' => esc_html__('Full Width?', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => false,
                'return_value' => 'yes',
                'style_transfer' => true,
                'selectors' => [
                    '{{WRAPPER}} .generic-el-btn' => 'display: -webkit-box; display: -ms-flexbox; display: flex; align-items: center;',
                ]
            ]
        );

        $this->add_control(
            'button_align',
            [
                'label' => esc_html__('Alignment', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'generic-elements'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'generic-elements'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'generic-elements'),
                        'icon' => 'eicon-text-align-right',
                    ],
                    'stretch' => [
                        'title' => esc_html__('Stretch', 'generic-elements'),
                        'icon' => 'eicon-text-align-justify',
                    ],
                ],
                'toggle' => false,
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .generic-el-btn' => '{{VALUE}}',
                ],
                'selectors_dictionary' => [
                    'left' => '-webkit-box-pack: start; -ms-flex-pack: start; justify-content: flex-start;',
                    'center' => '-webkit-box-pack: center; -ms-flex-pack: center; justify-content: center;',
                    'right' => '-webkit-box-pack: end; -ms-flex-pack: end; justify-content: flex-end;',
                    'stretch' => '-webkit-box-pack: justify; -ms-flex-pack: justify; justify-content: space-between;',
                ],
                'condition' => [
                    'button_fullwidth' => 'yes',
                ],
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
                'label' => esc_html__('Icon Position', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'label_block' => false,
                'options' => [
                    'before' => esc_html__('Before Text', 'generic-elements'),
                    'after' => esc_html__('After Text', 'generic-elements'),
                ],
                'default' => 'before',
                'toggle' => false,
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'button_icon_spacing',
            [
                'label' => esc_html__('Icon Spacing', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .generic-el-btn .generic-btn-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .generic-el-btn .generic-btn-icon' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    // button_two_content_controls
    protected function button_two_content_controls()
    {

        $this->start_controls_section(
            '_section_button2',
            [
                'label' => esc_html__('Button Right', 'generic-elements'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'button2_text',
            [
                'label' => esc_html__('Text', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Button Text',
                'placeholder' => esc_html__('Type button text here', 'generic-elements'),
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'button2_link',
            [
                'label' => esc_html__('Link', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => 'https://example.com',
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
                    'url' => '#'
                ],
            ]
        );

        $this->add_control(
            'button2_fullwidth',
            [
                'label' => esc_html__('Full Width?', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => false,
                'return_value' => 'yes',
                'style_transfer' => true,
                'selectors' => [
                    '{{WRAPPER}} .generic-el-sec-btn' => 'display: -webkit-box; display: -ms-flexbox; display: flex; align-items: center;',
                ]
            ]
        );

        $this->add_control(
            'button2_align',
            [
                'label' => esc_html__('Alignment', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'generic-elements'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'generic-elements'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'generic-elements'),
                        'icon' => 'eicon-text-align-right',
                    ],
                    'stretch' => [
                        'title' => esc_html__('Stretch', 'generic-elements'),
                        'icon' => 'eicon-text-align-justify',
                    ],
                ],
                'toggle' => false,
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .generic-el-sec-btn' => '{{VALUE}}',
                ],
                'selectors_dictionary' => [
                    'left' => '-webkit-box-pack: start; -ms-flex-pack: start; justify-content: flex-start;',
                    'center' => '-webkit-box-pack: center; -ms-flex-pack: center; justify-content: center;',
                    'right' => '-webkit-box-pack: end; -ms-flex-pack: end; justify-content: flex-end;',
                    'stretch' => '-webkit-box-pack: justify; -ms-flex-pack: justify; justify-content: space-between;',
                ],
                'condition' => [
                    'button_fullwidth' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'button2_selected_icon',
            [
                'type' => \Elementor\Controls_Manager::ICONS,
                'fa4compatibility' => 'button_icon',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'button2_icon_position',
            [
                'label' => esc_html__('Icon Position', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'label_block' => false,
                'options' => [
                    'before' => esc_html__('Before Text', 'generic-elements'),
                    'after' => esc_html__('After Text', 'generic-elements'),
                ],
                'default' => 'before',
                'toggle' => false,
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'button2_icon_spacing',
            [
                'label' => esc_html__('Icon Spacing', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .generic-el-sec-btn .generic-btn-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .generic-el-sec-btn .generic-btn-icon' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }


    // register_style_controls
    protected function register_style_controls()
    {
        $this->cta_content_style_controls();
        $this->button_style_controls();
        $this->button_two_style_controls();
    }

    // cta_content_controls
    protected function cta_content_style_controls()
    {
        $this->start_controls_section(
            '_section_style_content',
            [
                'label' => esc_html__('Title / Content', 'generic-elements'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'content_padding',
            [
                'label' => esc_html__('Content Padding', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
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
                'label' => esc_html__('Title', 'generic-elements'),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'title_spacing',
            [
                'label' => esc_html__('Bottom Spacing', 'generic-elements'),
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
                'label' => esc_html__('Text Color', 'generic-elements'),
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
                'label' => esc_html__('Subtitle', 'generic-elements'),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'subtitle_spacing',
            [
                'label' => esc_html__('Bottom Spacing', 'generic-elements'),
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
                'label' => esc_html__('Text Color', 'generic-elements'),
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
                'label' => esc_html__('Description', 'generic-elements'),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'description_spacing',
            [
                'label' => esc_html__('Bottom Spacing', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .generic-el-desc' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => esc_html__('Text Color', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .generic-el-desc' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'description',
                'selector' => '{{WRAPPER}} .generic-el-desc',
            ]
        );


        $this->end_controls_section();
    }

    // Button style control
    protected function button_style_controls()
    {

        $this->start_controls_section(
            '_section_style_button',
            [
                'label' => esc_html__('Button Left', 'generic-elements'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'button_padding',
            [
                'label' => esc_html__('Padding', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .generic-el-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_margin',
            [
                'label' => esc_html__('Margin', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .generic-el-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                'label' => esc_html__('Border Radius', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
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

        $this->start_controls_tabs('_tabs_button');

        $this->start_controls_tab(
            '_tab_button_normal',
            [
                'label' => esc_html__('Normal', 'generic-elements'),
            ]
        );

        $this->add_control(
            'button_color',
            [
                'label' => esc_html__('Text Color', 'generic-elements'),
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
                'label' => esc_html__('Background Color', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .generic-el-btn' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'gen_button_border_color',
            [
                'label' => esc_html__('Border Color', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .generic-el-btn' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            '_tab_button_hover',
            [
                'label' => esc_html__('Hover', 'generic-elements'),
            ]
        );

        $this->add_control(
            'button_hover_color',
            [
                'label' => esc_html__('Text Color', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .generic-el-btn:hover, {{WRAPPER}} .generic-el-btn:focus' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_bg_color',
            [
                'label' => esc_html__('Background Color', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .generic-el-btn:hover, {{WRAPPER}} .generic-el-btn:focus' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_border_color',
            [
                'label' => esc_html__('Border Color', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .generic-el-btn:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    // Button two style control
    protected function button_two_style_controls()
    {

        $this->start_controls_section(
            '_section_style_button2',
            [
                'label' => esc_html__('Button Right', 'generic-elements'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'button2_padding',
            [
                'label' => esc_html__('Padding', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .generic-el-sec-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'button2_margin',
            [
                'label' => esc_html__('Margin', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .generic-el-sec-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'button2_typography',
                'selector' => '{{WRAPPER}} .generic-el-sec-btn',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'button2_border',
                'selector' => '{{WRAPPER}} .generic-el-sec-btn',
            ]
        );

        $this->add_control(
            'button2_border_radius',
            [
                'label' => esc_html__('Border Radius', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .generic-el-sec-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button2_box_shadow',
                'selector' => '{{WRAPPER}} .generic-el-sec-btn',
            ]
        );

        $this->add_control(
            'hr2',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
                'style' => 'thick',
            ]
        );

        $this->start_controls_tabs('_tabs_button2');

        $this->start_controls_tab(
            '_tab_button2_normal',
            [
                'label' => esc_html__('Normal', 'generic-elements'),
            ]
        );

        $this->add_control(
            'button2_color',
            [
                'label' => esc_html__('Text Color', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .generic-el-sec-btn' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button2_bg_color',
            [
                'label' => esc_html__('Background Color', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .generic-el-sec-btn' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'gen_button2_border_color',
            [
                'label' => esc_html__('Border Color', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .generic-el-sec-btn' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            '_tab_button2_hover',
            [
                'label' => esc_html__('Hover', 'generic-elements'),
            ]
        );

        $this->add_control(
            'button2_hover_color',
            [
                'label' => esc_html__('Text Color', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .generic-el-sec-btn:hover, {{WRAPPER}} .generic-el-sec-btn:focus' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button2_hover_bg_color',
            [
                'label' => esc_html__('Background Color', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .generic-el-sec-btn:hover, {{WRAPPER}} .generic-el-sec-btn:focus' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button2_hover_border_color',
            [
                'label' => esc_html__('Border Color', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .generic-el-sec-btn:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    // Render Function
    protected function render()
    {
        $settings = $this->get_settings_for_display();
        extract($settings);

        $this->add_inline_editing_attributes('title', 'basic');
        $this->add_render_attribute('title', 'class', 'generic-cta-title generic-el-title');
        $this->add_render_attribute('title', 'data-wow-delay', '.3s');

        if (!empty($settings['cta_bg']['url'])) {
            $cta_bg = !empty($settings['cta_bg']['id']) ? wp_get_attachment_image_url($settings['cta_bg']['id'], $settings['cta_image_size']) : $settings['cta_bg']['url'];
            $cta_bg_alt = get_post_meta($settings["cta_bg"]["id"], "_wp_attachment_image_alt", true);
        }

        if (!empty($settings['button_link'])) {
            $this->add_render_attribute('button', 'class', 'generic-cta-btn generic-el-btn');
            $this->add_link_attributes('button', $settings['button_link']);
        }
        if (!empty($settings['button2_link'])) {
            $this->add_render_attribute('button2', 'class', 'generic-cta-border-btn generic-el-sec-btn ml-20');
            $this->add_link_attributes('button2', $settings['button2_link']);
        }

?>

        <section class="generic-cta-area pt-120 pb-120" data-background="<?php echo esc_url($cta_bg); ?>">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="generic-el-cta-wrapper generic-el-content">
                            <?php if (!empty($settings['sub_title'])) : ?>
                                <span class="generic-el-subtitle"><?php echo wp_kses_post($settings['sub_title']); ?></span>
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
                            <?php if (!empty($settings['description'])) : ?>
                                <p class="generic-el-desc"><?php echo wp_kses_post($settings['description']); ?></p>
                            <?php endif; ?>


                            <div class="cta-btn-wrapper">
                                <?php if ($settings['button_text'] && ((empty($settings['button_selected_icon']) || empty($settings['button_selected_icon']['value'])) && empty($settings['button_icon']))) :
                                    printf(
                                        '<a %1$s>%2$s</a>',
                                        $this->get_render_attribute_string('button'),
                                        esc_html($settings['button_text'])
                                    );
                                elseif (empty($settings['button_text']) && ((!empty($settings['button_selected_icon']) || empty($settings['button_selected_icon']['value'])) || !empty($settings['button_icon']))) : ?>
                                    <a <?php $this->print_render_attribute_string('button'); ?>><?php generic_elements_render_icon($settings, 'button_icon', 'button_selected_icon'); ?></a>
                                    <?php elseif ($settings['button_text'] && ((!empty($settings['button_selected_icon']) || empty($settings['button_selected_icon']['value'])) || !empty($settings['button_icon']))) :
                                    if ($settings['button_icon_position'] === 'before') : ?>
                                        <a <?php $this->print_render_attribute_string('button'); ?>><?php generic_elements_render_icon($settings, 'button_icon', 'button_selected_icon', ['class' => 'generic-btn-icon']); ?>
                                            <span><?php echo esc_html($settings['button_text']); ?></span></a>
                                    <?php
                                    else : ?>
                                        <a <?php $this->print_render_attribute_string('button'); ?>>
                                            <span><?php echo esc_html($settings['button_text']); ?></span>
                                            <?php generic_elements_render_icon($settings, 'button_icon', 'button_selected_icon', ['class' => 'generic-btn-icon']); ?>
                                        </a>
                                <?php
                                    endif;
                                endif; ?>

                                <!-- Button 2 -->
                                <?php if (!empty($settings['button2_text'])) : ?>
                                    <?php if ($settings['button2_text'] && ((empty($settings['button2_selected_icon']) || empty($settings['button2_selected_icon']['value'])) && empty($settings['button2_icon']))) :
                                        printf(
                                            '<a %1$s>%2$s</a>',
                                            $this->get_render_attribute_string('button2'),
                                            esc_html($settings['button2_text'])
                                        );
                                    elseif (empty($settings['button2_text']) && ((!empty($settings['button2_selected_icon']) || empty($settings['button2_selected_icon']['value'])) || !empty($settings['button2_icon']))) : ?>
                                        <a <?php $this->print_render_attribute_string('button2'); ?>><?php generic_elements_render_icon($settings, 'button2_icon', 'button2_selected_icon'); ?></a>
                                        <?php elseif ($settings['button2_text'] && ((!empty($settings['button2_selected_icon']) || empty($settings['button2_selected_icon']['value'])) || !empty($settings['button2_icon']))) :
                                        if ($settings['button2_icon_position'] === 'before') : ?>
                                            <a <?php $this->print_render_attribute_string('button2'); ?>><?php generic_elements_render_icon($settings, 'button2_icon', 'button2_selected_icon', ['class' => 'bdevs-btn-icon']); ?>
                                                <span><?php echo esc_html($settings['button2_text']); ?></span></a>
                                        <?php
                                        else : ?>
                                            <a <?php $this->print_render_attribute_string('button2'); ?>>
                                                <span><?php echo esc_html($settings['button2_text']); ?></span>
                                                <?php generic_elements_render_icon($settings, 'button2_icon', 'button2_selected_icon', ['class' => 'bdevs-btn-icon']); ?>
                                            </a>
                                    <?php
                                        endif;
                                    endif; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

<?php
    }
}
