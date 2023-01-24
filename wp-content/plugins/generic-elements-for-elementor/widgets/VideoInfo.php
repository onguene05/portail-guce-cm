<?php

namespace Generic\Elements;

defined('ABSPATH') || die();

class VideoInfo extends GenericWidget
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
        return 'generic-videoinfo';
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
        return esc_html__('Video Info', 'generic-elements');
    }

    public function get_custom_help_url()
    {
        return 'http://elementor.bdevs.net/bdevselement/video-info/';
    }

    public function get_script_depends()
    {
        return ['bootstrap', 'magnific-popup', 'generic-element-js'];
    }

    public function get_style_depends()
    {
        return ['bootstrap', 'fontawesome', 'magnific-popup', 'generic-element-css'];
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
        return 'eicon-video-playlist gen-icon';
    }

    public function get_keywords()
    {
        return ['info', 'video', 'box', 'text', 'content'];
    }

    public function get_categories()
    {
        return ['generic-elements'];
    }

    /**
     * Register content related controls
     */
    protected function register_content_controls()
    {
        $this->video_info_content_controls();
    }

    // video_info_content_controls
    protected function video_info_content_controls()
    {

        $this->start_controls_section(
            '_section_title',
            [
                'label' => esc_html__('Video Content', 'generic-elements'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'bg_image',
            [
                'label' => esc_html__('Big Image', 'generic-elements'),
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

        $this->add_control(
            'video_url',
            [
                'label' => esc_html__('Video URL', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('#', 'generic-elements'),
                'placeholder' => esc_html__('Set Video URL Here', 'generic-elements'),
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );
        $this->end_controls_section();
    }


    /**
     * Register styles related controls
     */
    protected function register_style_controls()
    {
        $this->video_info_content_style_controls();
    }

    // video_info_content_style_controls
    protected function video_info_content_style_controls()
    {
        $this->start_controls_section(
            '_section_title_style',
            [
                'label' => esc_html__('VideInfo Content', 'generic-elements'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        // Video Icon
        $this->add_control(
            '_video_info_icon',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('VidoInfo Icon', 'generic-elements'),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'icon_size',
            [
                'label' => esc_html__('Play Icon Size', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .popup-video' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'play_icon_color',
            [
                'label' => esc_html__('Play Icon Color', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .popup-video' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'play_bg_color',
            [
                'label' => esc_html__('Play Icon BG Color', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .popup-video' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        // Video Info Image
        $this->add_control(
            '_video_info_image',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('VidoInfo Image', 'generic-elements'),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'image_width',
            [
                'label'      => esc_html__('Width', 'generic-elements'),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 800,
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default'    => [
                    'unit' => 'px',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .generic-video-area' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_height',
            [
                'label'      => esc_html__('Height', 'generic-elements'),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 800,
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default'    => [
                    'unit' => 'px',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .generic-video-area' => 'min-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // Video Info Background overlay
        $this->add_control(
            '_video_info_image_overlay',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Background Overlay', 'generic-elements'),
                'separator' => 'before'
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background',
                'label' => esc_html__('Background', 'generic-elements'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .generic-video-area::before',
            ]
        );

        $this->add_control(
            'background_overlay_opacity',
            [
                'label' => esc_html__('Opacity', 'generic-elements'),
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
                    '{{WRAPPER}}  .generic-video-area::before' => 'opacity: {{SIZE}};',
                ]
            ]
        );

        $this->end_controls_section();
    }


    // render function
    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $this->add_inline_editing_attributes('description', 'intermediate');
        $this->add_render_attribute('description', 'class', 'bdevs-infobox-text');

        if (!empty($settings['bg_image']['url'])) {
            $bg_image = !empty($settings['bg_image']['id']) ? wp_get_attachment_image_url($settings['bg_image']['id'], $settings['bg_image_size']) : $settings['bg_image']['url'];
            $bg_image_alt = get_post_meta($settings["bg_image"]["id"], "_wp_attachment_image_alt", true);
        }

?>
        <section class="generic-video-area" data-background="<?php echo esc_url($bg_image); ?>">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-12">
                        <div class="generic-el-video-wrapper">
                            <a class="generic-el-video-popup popup-video play-btn" href="<?php echo esc_url($settings['video_url']); ?>">
                                <i class="fas fa-play"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
<?php
    }
}
