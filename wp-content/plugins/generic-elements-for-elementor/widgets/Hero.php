<?php

namespace Generic\Elements;

defined('ABSPATH') || die();

class Hero extends GenericWidget{

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
        return 'generic-hero';
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
        return esc_html__('Hero', 'generic-elements');
    }

    public function get_custom_help_url()
    {
        return 'http://elementor.bdevs.net/bdevselement/hero/';
    }

    public function get_script_depends()
    {
        return ['generic-element-js', 'bootstrap'];
    }

    public function get_style_depends()
    {
        return ['generic-element-css', 'bootstrap', 'fontawesome'];
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
        return ['generic-elements'];
    }

    // register_content_controls
    protected function register_content_controls()
    {
        $this->image_content_controls();
        $this->title_and_description_content_controls();
        $this->button_content_controls();
        $this->social_icon_content_controls();
    }

    // image_content_controls
    protected function image_content_controls(){
        $this->start_controls_section(
            '_section_image',
            [
                'label' => __('Image', 'generic-elements'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'bg_image',
            [
                'label' => __('Bg Image', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Image_Size::get_type(),
            [
                'name' => 'bg_image',
                'default' => 'large',
                'separator' => 'none',
            ]
        );
        $this->end_controls_section();
    }


    // title_and_description_content_controls
    public function title_and_description_content_controls()
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
            'subtitle',
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
                'default' => 'h1',
                'toggle' => false,
            ]
        );

        $this->add_responsive_control(
            'align',
            [
                'label' => esc_html__('Alignment', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'generic-elements'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'generic-elements'),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'generic-elements'),
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

    // button_content_controls
    public function button_content_controls()
    {

        // Button
        $this->start_controls_section(
            '_section_button',
            [
                'label' => esc_html__('Button', 'generic-elements'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );


        $this->add_control(
            'button_text',
            [
                'label'       => esc_html__('Text', 'generic-elements'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => 'Button Text',
                'placeholder' => esc_html__('Type button text here', 'generic-elements'),
                'label_block' => true,
                'dynamic'     => [
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

        $this->end_controls_section();
    }

    // social_icon_content_controls
    public function social_icon_content_controls()
    {
        // Button
        $this->start_controls_section(
            'section_icon',
            [
                'label' => esc_html__('Social Icon', 'generic-elements'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'icon_text',
            [
                'label'       => esc_html__('Icon Label', 'generic-elements'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => 'Follow',
                'placeholder' => esc_html__('Type button text here', 'generic-elements'),
                'label_block' => true,
                'dynamic'     => [
                    'active' => true,
                ]
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->start_controls_tabs('share_buttons');

        $repeater->start_controls_tab(
            'share_btn_tab',
            [
                'label' => esc_html__('Content', 'generic-elements'),
            ]
        );

        $repeater->add_control(
            'share_icon',
            [
                'label'            => esc_html__('Icon', 'generic-elements'),
                'type'             => \Elementor\Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'default' => [
                    'value'   => 'fab fa-facebook-f',
                    'library' => 'fa-solid',
                ]
            ]
        );

        $repeater->end_controls_tab();

        $repeater->start_controls_tab(
            'share_btn_tab_style',
            [
                'label' => esc_html__('Style', 'generic-elements'),
            ]
        );

        $repeater->add_control(
            'icon_color',
            [
                'label' => esc_html__('Icon Color', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} i' => 'color: {{VALUE}}',
                ],
            ]
        );

        $repeater->add_control(
            'icon_hover_color',
            [
                'label' => esc_html__('Icon Hover Color', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} i:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $repeater->end_controls_tab();

        $repeater->end_controls_tabs();

        $this->add_control(
            'icon_list',
            [
                'label' => esc_html__('Icon List', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'list_title' => esc_html__('FaceBook', 'generic-elements'),
                        'share_icon' => [
                            'value' => 'fab fa-facebook-f',
                            'library' => 'fa-solid',
                        ]
                    ],
                    [
                        'list_title' => esc_html__('Twitter', 'generic-elements'),
                        'share_icon' => [
                            'value' => 'fab fa-twitter',
                            'library' => 'fa-solid',
                        ]
                    ],
                ],
                'title_field' => '<i class="{{ share_icon.value }}" aria-hidden="true"></i>'
            ]
        );

        $this->end_controls_section();
    }

    // register_style_controls
    protected function register_style_controls(){
        $this->title_and_description_style_controls();
        $this->button_style_controls();
        $this->social_list_style_controls();
    }

    // title_and_description_style_control
    protected function title_and_description_style_controls(){
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
                'selector' => '{{WRAPPER}} .bd-slider-title',
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
                'selector' => '{{WRAPPER}} .generic-subtitle.generic-el-subtitle',
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
                    '{{WRAPPER}} .generic-el-content p' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => esc_html__('Text Color', 'generic-elements'),
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
                'selector' => '{{WRAPPER}} .bd-slider.generic-el-content p',
            ]
        );

        $this->end_controls_section();
    }

    // button_style_controls
    protected function button_style_controls(){
        $this->start_controls_section(
            '_section_style_button',
            [
                'label' => esc_html__('Button', 'generic-elements'),
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
            'button_hover_before_bg_color',
            [
                'label' => esc_html__('Hover Before BG Color', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn.s-btn.generic-el-btn:hover:before, {{WRAPPER}} .btn.s-btn.generic-el-btn:focus:before' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_border_color',
            [
                'label' => esc_html__('Border Color', 'generic-elements'),
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

    // social_list_style_controls
    protected function social_list_style_controls(){
        // Social list
        $this->start_controls_section(
            '_section_style_social_list',
            [
                'label' => esc_html__('Social Icon', 'generic-elements'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'social_icon_content_padding',
            [
                'label' => esc_html__('Content Padding', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .bd-slider-social-three ul' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Social Icon Title
        $this->add_control(
            '_heading_social_icon_title',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Social Icon Title', 'generic-elements'),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'social_icon_title_spacing',
            [
                'label' => esc_html__('Bottom Spacing', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .bd-slider-social-three ul' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'social_icon_title_color',
            [
                'label' => esc_html__('Text Color', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bd-slider-social-three h6' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title2',
                'selector' => '{{WRAPPER}} .bd-slider-social-three h6',
            ]
        );

        $this->end_controls_section();
    }


    // Render Function
    protected function render(){
        $settings = $this->get_settings_for_display();
        extract($settings);
        $this->add_inline_editing_attributes('title', 'basic');
        $this->add_render_attribute('title', 'class', 'bd-slider-title bd-slider-title-three mb-30 wow fadeInUp generic-el-title');
        $this->add_render_attribute('title', 'data-wow-delay', '.3s');

        if (!empty($settings['button_link'])) {
            $this->add_render_attribute('button', 'class', 'theme-btn-black generic-el-btn');
            $this->add_link_attributes('button', $settings['button_link']);
        }

        if (!empty($settings['bg_image']['url'])) {
            $bg_image = !empty($settings['bg_image']['id']) ? wp_get_attachment_image_url($settings['bg_image']['id'], $settings['bg_image_size']) : $settings['bg_image']['url'];
            $bg_image_alt = get_post_meta($settings["bg_image"]["id"], "_wp_attachment_image_alt", true);
        }

        ?>
            <section class="bd-slider-area" data-background="<?php echo esc_url($bg_image); ?>">
                <div class="bd-slider-actives">
                    <div class="swiper-wrappers">
                        <div class="bd-single-slider bd-slider-height bd-single-slider-overlay-invisible d-flex align-items-center">
                            <div class="container">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="bd-slider generic-el-content z-index pt-125">
                                            <?php if ($settings['subtitle']) : ?>
                                                <span class="generic-subtitle generic-el-subtitle wow fadeInUp" data-wow-delay=".4s"> <?php echo wp_kses_post($settings['subtitle']); ?> </span>
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
                                                <p class="mb-40 wow fadeInUp" data-wow-delay=".4s"><?php echo wp_kses_post($settings['description']); ?></p>
                                            <?php endif; ?>

                                            <?php if (!empty($settings['button_text'])) : ?>
                                                <div class="bd-slider-btn mb-95 wow fadeInUp" data-wow-delay=".6s">
                                                    <?php if ($settings['button_text'] && ((empty($settings['button_selected_icon']) || empty($settings['button_selected_icon']['value'])) && empty($settings['button_icon']))) :
                                                        printf(
                                                            '<a %1$s>%2$s</a>',
                                                            $this->get_render_attribute_string('button'),
                                                            esc_html($settings['button_text'])
                                                        );
                                                    elseif (empty($settings['button_text']) && ((!empty($settings['button_selected_icon']) || empty($settings['button_selected_icon']['value'])) || !empty($settings['button_icon']))) : ?>
                                                        <a <?php $this->print_render_attribute_string('button'); ?>><?php bdevs_element_render_icon($settings, 'button_icon', 'button_selected_icon'); ?></a>
                                                        <?php elseif ($settings['button_text'] && ((!empty($settings['button_selected_icon']) || empty($settings['button_selected_icon']['value'])) || !empty($settings['button_icon']))) :
                                                        if ($settings['button_icon_position'] === 'before') : ?>
                                                            <a <?php $this->print_render_attribute_string('button'); ?>><?php bdevs_element_render_icon($settings, 'button_icon', 'button_selected_icon', ['class' => 'bdevs-btn-icon']); ?>
                                                                <span><?php echo esc_html($settings['button_text']); ?></span></a>
                                                        <?php
                                                        else : ?>
                                                            <a <?php $this->print_render_attribute_string('button'); ?>>
                                                                <span><?php echo esc_html($settings['button_text']); ?></span>
                                                                <?php bdevs_element_render_icon($settings, 'button_icon', 'button_selected_icon', ['class' => 'bdevs-btn-icon']); ?>
                                                            </a>
                                                    <?php
                                                        endif;
                                                    endif; ?>
                                                </div>
                                            <?php endif; ?>

                                            <div class="bd-slider-social-three wow fadeInUp" data-wow-delay=".9s">
                                                <?php if (!empty($icon_text)) : ?>
                                                    <h6><?php echo esc_html($icon_text); ?></h6>
                                                <?php endif; ?>
                                                <ul>
                                                    <?php foreach ($icon_list as $item) {

                                                    ?>

                                                        <li><a class="elementor-repeater-item-<?php echo esc_attr($item['_id']); ?>" href="#" target="_blank"><?php \ELEMENTOR\Icons_Manager::render_icon($item['share_icon']); ?></a></li>

                                                    <?php
                                                    }
                                                    ?>
                                                </ul>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php
    }
}
