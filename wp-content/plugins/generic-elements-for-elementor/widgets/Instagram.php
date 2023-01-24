<?php

namespace Generic\Elements;

defined('ABSPATH') || die();

class Instagram extends GenericWidget{

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
    public function get_name()
    {
        return 'generic-instagram';
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
        return esc_html__('Instagram', 'generic-elements');
    }

    public function get_custom_help_url()
    {
        return 'http://elementor.bdevs.net/bdevselement/instagram/';
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
        return 'eicon-instagram-gallery gen-icon';
    }

    public function get_keywords()
    {
        return ['instagram', 'social', 'image', 'gallery', 'carousel'];
    }


    // register_content_controls
    protected function register_content_controls()
    {
        $this->background_overlay_controls();
        $this->slide_controls();
        $this->slide_settings_controls();
    }

    // Background Overlay
    protected function background_overlay_controls(){
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
                'selector' => '{{WRAPPER}} .generic-instagram-single-slide .instagram-thumb::after',
            ]
        );

        $this->add_control(
            'background_overlay_opacity',
            [
                'label' => esc_html__('Opacity', 'generic-elements'),
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
                    '{{WRAPPER}} .generic-instagram-single-slide .instagram-thumb::after' => 'opacity: {{SIZE}};',
                ]
            ]
        );

        $this->end_controls_section();
    }

    // slide_controls
    protected function slide_controls(){
        $this->start_controls_section(
            '_section_slides',
            [
                'label' => esc_html__('Slides', 'generic-elements'),
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
                'label' => esc_html__('Image', 'generic-elements'),
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'icon',
            [
                'label' => esc_html__('Icon', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fab fa-instagram',
                    'library' => 'solid',
                ],
            ]
        );

        $repeater->add_control(
            'slide_url',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => false,
                'placeholder' => __('Type link here', 'generic-elements'),
                'default' => __('#', 'generic-elements'),
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
                'title_field' => esc_html__('Instagram Item', 'generic-elements'),
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

    protected function slide_settings_controls(){
        // Slider Settings
        $this->start_controls_section(
            '_section_settings',
            [
                'label' => esc_html__('Settings', 'generic-elements'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'ts_slider_autoplay',
            [
                'label' => esc_html__('Autoplay', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'generic-elements'),
                'label_off' => esc_html__('No', 'generic-elements'),
                'return_value' => 'yes',
                'default' => 'no'
            ]
        );

        $this->add_control(
            'ts_slider_speed',
            [
                'label' => esc_html__('Slider Speed', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'placeholder' => esc_html__('Enter Slider Speed', 'generic-elements'),
                'default' => '5000',
                'condition' => ["ts_slider_autoplay" => ['yes']],
            ]
        );

        $this->end_controls_section();
    }


    // register_style_controls
    protected function register_style_controls(){
        $this->content_controls();
    }

    // content_controls
    protected function content_controls(){
        $this->start_controls_section(
            '_section_style_content',
            [
                'label' => esc_html__('Content', 'generic-elements'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );


        // Title
        $this->add_control(
            '_instagram_icon_color',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Icon Color', 'generic-elements'),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label' => esc_html__('Icon Color', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .generic-el-instagram-icon i' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();
    }


    // Render Function
    protected function render(){
        $settings = $this->get_settings_for_display();

        // ================
        $auto_nav_slide    =   $settings['ts_slider_autoplay'];
        $ts_slider_speed   =   $settings['ts_slider_speed'] ? $settings['ts_slider_speed'] : '5000';
        // ================

        if (empty($settings['slides'])) {
            return;
        }

        ?>
            <section class="generic-instagram-area">
                <div class="swiper-container instagram-active" data-swipper_autoplay_stop="<?php echo $auto_nav_slide; ?>">
                    <div class="swiper-wrapper generic-el-instagram-wrapper">
                        <?php foreach ($settings['slides'] as $key => $slide) :
                            $image = wp_get_attachment_image_url($slide['image']['id'], $settings['thumbnail_size']);
                            if (!$image) {
                                $image = $slide['image']['url'];
                            }
                            $slide_url = esc_url($slide['slide_url']);
                        ?>
                            <!-- Slides -->
                            <div class="swiper-slide generic-instagram-single-slide" data-swiper-autoplay="<?php echo $ts_slider_speed; ?>">
                                <div class="instagram-thumb">
                                    <img src="<?php print esc_url($image); ?>" alt="Image not found">
                                    <div class="generic-el-instagram-icon">
                                        <a href="<?php print esc_url($slide_url); ?>" target="_blank">
                                            <?php \Elementor\Icons_Manager::render_icon($slide['icon'], ['aria-hidden' => 'true']); ?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>
        <?php
    }
}
