<?php

namespace Bdevs\Elementor;

defined('ABSPATH') || die();

class Brand extends \Generic\Elements\GenericWidget
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
        return 'cust-brand';
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
        return __('Brand', 'bdevs-elementor');
    }

    public function get_custom_help_url()
    {
        return 'http://elementor.bdevs.net/bdevselementor/brand/';
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
        return 'eicon-photo-library gen-icon';
    }

    public function get_keywords()
    {
        return ['brand', 'image', 'counter'];
    }

    public function get_categories()
    {
        return ['bdevs-elementor'];
    }

    protected function register_content_controls()
    {
        $this->design_style();
        $this->title_and_subtitle();
        $this->brand_slides();
        $this->brand_images();
        $this->brand_settings();
    }

    public function design_style()
    {
        $this->start_controls_section(
            '_section_design',
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
                ],
                'default' => 'design_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $this->end_controls_section();
    }

    public function title_and_subtitle()
    {

        // Title & Description
        $this->start_controls_section(
            '_section_title',
            [
                'label' => __('Title & Subtitle', 'bdevs-elementor'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'designs' => ['design_1', 'design_2'],
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
            'sub_title',
            [
                'label'       => __('Subtitle', 'bdevs-elementor'),
                'label_block' => true,
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => __('Type Your Subtitle', 'bdevs-elementor'),
                'placeholder' => __('Enter Subtitle Here', 'bdevs-elementor'),
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'back_title',
            [
                'label' => __('Back Title', 'bdevs-elementor'),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Back Title',
                'placeholder' => __('Heading Back Text', 'bdevs-elementor'),
                'dynamic' => [
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

    public function brand_slides()
    {

        // Brand Item
        $this->start_controls_section(
            '_section_slides',
            [
                'label' => __('Brand Item', 'bdevs-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'image',
            [
                'type' => \Elementor\Controls_Manager::MEDIA,
                'label' => __('Image', 'bdevs-elementor'),
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
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
                'condition' => [
                    'designs' => ['design_10'],
                ],
            ]
        );

        $repeater->add_control(
            'slide_url',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __('URL', 'bdevs-elementor'),
                'default' => __('#', 'bdevs-elementor'),
                'placeholder' => __('Type url here', 'bdevs-elementor'),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'designs' => ['design_10'],
                ],
            ]
        );

        $this->add_control(
            'slides',
            [
                'show_label' => false,
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => esc_html__('Brand Item', 'bdevs-elementor'),
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

    public function brand_images()
    {
        // image
        $this->start_controls_section(
            '_section_image',
            [
                'label' => __('Image', 'bdevselementor'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'designs' => ['design_3'],
                ],
            ]
        );
        $this->add_control(
            'brand_bg',
            [
                'label' => __('Brand BG Image', 'bdevselementor'),
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
                'name' => 'bg_thumbnail',
                'default' => 'large',
                'separator' => 'none',
            ]
        );

        $this->end_controls_section();
    }


    public function brand_settings()
    {
        // Settings
        $this->start_controls_section(
            '_section_settings',
            [
                'label' => __('Settings', 'bdevs-elementor'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'ts_slider_autoplay',
            [
                'label' => esc_html__('Autoplay', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'bdevs-elementor'),
                'label_off' => esc_html__('No', 'bdevs-elementor'),
                'return_value' => 'yes',
                'default' => 'no'
            ]
        );

        $this->add_control(
            'ts_slider_speed',
            [
                'label' => esc_html__('Slider Speed', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'placeholder' => esc_html__('Enter Slider Speed', 'bdevs-elementor'),
                'default' => '5000',
                // 'default' => 5000,
                'condition' => ["ts_slider_autoplay" => ['yes']],
            ]
        );

        $this->add_control(
            'ts_slider_nav_show',
            [
                'label' => esc_html__('Nav show', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'bdevs-elementor'),
                'label_off' => esc_html__('No', 'bdevs-elementor'),
                'return_value' => 'yes',
                'default' => 'yes'
            ]
        );
        $this->add_control(
            'ts_slider_dot_nav_show',
            [
                'label' => esc_html__('Dot nav', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'bdevs-elementor'),
                'label_off' => esc_html__('No', 'bdevs-elementor'),
                'return_value' => 'yes',
                'default' => 'yes'
            ]
        );


        $this->end_controls_section();
    }

    protected function register_style_controls()
    {

        $this->title_style_controls();
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


        $this->end_controls_section();
    }


    protected function render()
    {
        $settings = $this->get_settings_for_display();

        // ================
        $show_navigation   =   $settings["ts_slider_nav_show"] == "yes" ? true : false;
        $auto_nav_slide    =   $settings['ts_slider_autoplay'];
        $dot_nav_show      =   $settings['ts_slider_dot_nav_show'];
        $ts_slider_speed   =   $settings['ts_slider_speed'] ? $settings['ts_slider_speed'] : '5000';

        $slide_controls    = [
            'show_nav' => $show_navigation,
            'dot_nav_show' => $dot_nav_show,
            'auto_nav_slide' => $auto_nav_slide,
            'ts_slider_speed' => $ts_slider_speed,
        ];

        $slide_controls = \json_encode($slide_controls);
        // ================


        // bg_image
        if (!empty($settings['bg_image']['id'])) {
            $bg_image = wp_get_attachment_image_url($settings['bg_image']['id'], $settings['bg_thumbnail_size']);
            if (!$bg_image) {
                $bg_image = $settings['bg_image']['url'];
            }
        }

        $title = wp_kses_post($settings['title'] ?? '');

        if (empty($settings['slides'])) {
            return;
        }
?>

        <?php if ($settings['designs'] === 'design_6') :

            if (!empty($settings['brand_bg']['id'])) {
                $image = wp_get_attachment_image_url($settings['brand_bg']['id'], $settings['thumbnail_size']);
            }

        ?>

            <!-- Brand-area-start -->
            <div class="bd-brand__area theme-bg p-relative pt-110 pb-70  wow fadeInUp" data-wow-duration="1.5s" data-wow-delay=".3s">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-12">
                            <div class="bd-section__shape p-relative"></div>
                            <div class="bd-brand__active swiper-container">
                                <div class="swiper-wrapper">
                                    <?php
                                    foreach ($settings['slides'] as $slide) :
                                        $image = wp_get_attachment_image_url($slide['image']['id'], $settings['thumbnail_size']);
                                        if (!$image) {
                                            $image = $slide['image']['url'];
                                        }
                                    ?>
                                        <div class="swiper-slide">
                                            <div class="singel__brand">
                                                <a href="#">
                                                    <img src="<?php print esc_url($image); ?>" alt="brand-img">
                                                </a>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Brand-area-end -->


        <?php elseif ($settings['designs'] === 'design_5') :

            if (!empty($settings['brand_bg']['id'])) {
                $image = wp_get_attachment_image_url($settings['brand_bg']['id'], $settings['thumbnail_size']);
            }

        ?>

            <!-- Sponsors-area-start -->
            <section class="bd-sponser__area sponse-border wow fadeInUp" data-wow-duration="1.5s" data-wow-delay=".3s">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-8">
                            <div class="bd-section__title-5 mb-50">
                                <h5 class="bd-smaill__title-5">1000+ Sponsors</h5>
                                <h2 class="bd-big__title-5">Secrets of Learning Revealed</h2>
                            </div>
                        </div>
                    </div>
                    <div class="row g-0">
                        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
                            <div class="bd-sponser__item sponse-item-bb sponse-item-br">
                                <a href="#">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/sponsar/sponsors-6.png" alt="sponsors-image">
                                </a>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
                            <div class="bd-sponser__item sponse-item-bb sponse-item-br">
                                <a href="#">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/sponsar/sponsors-7.png" alt="sponsors-image">
                                </a>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
                            <div class="bd-sponser__item sponse-item-bb sponse-item-br">
                                <a href="#">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/sponsar/sponsors-8.png" alt="sponsors-image">
                                </a>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
                            <div class="bd-sponser__item sponse-item-bb">
                                <a href="#">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/sponsar/sponsors-9.png" alt="sponsors-image">
                                </a>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
                            <div class="bd-sponser__item sponse-item-br">
                                <a href="#">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/sponsar/sponsors-10.png" alt="sponsors-image">
                                </a>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
                            <div class="bd-sponser__item sponse-item-br">
                                <a href="#">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/sponsar/sponsors-11.png" alt="sponsors-image">
                                </a>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
                            <div class="bd-sponser__item sponse-item-br">
                                <a href="#">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/sponsar/sponsors-12.png" alt="sponsors-image">
                                </a>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
                            <div class="bd-sponser__item">
                                <a href="#">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/sponsar/sponsors-13.png" alt="sponsors-image">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Sponsors-area-end -->

        <?php elseif ($settings['designs'] === 'design_4') :

            if (!empty($settings['brand_bg']['id'])) {
                $image = wp_get_attachment_image_url($settings['brand_bg']['id'], $settings['thumbnail_size']);
            }

        ?>

            <!-- book-area-start -->
            <div class="bd-book__area wow fadeInUp" data-wow-duration="1.5s" data-wow-delay=".3s">
                <div class="container">
                    <div class="row justify-content-end">
                        <div class="col-xl-10 col-lg-10">
                            <div class="bd-book__wrapper">
                                <div class="bn-book__active swiper-container">
                                    <div class="swiper-wrapper">
                                        <?php
                                        foreach ($settings['slides'] as $slide) :
                                            $image = wp_get_attachment_image_url($slide['image']['id'], $settings['thumbnail_size']);
                                            if (!$image) {
                                                $image = $slide['image']['url'];
                                            }
                                        ?>
                                            <div class="swiper-slide">
                                                <div class="bd-singel__book w-img">
                                                    <a href="#"><img src="<?php print esc_url($image); ?>" alt="book-img"></a>
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
            <!-- book-area-end -->

        <?php elseif ($settings['designs'] === 'design_3') :

            if (!empty($settings['brand_bg']['id'])) {
                $brand_bg = wp_get_attachment_image_url($settings['brand_bg']['id'], $settings['thumbnail_size']);
            }

        ?>

            <!-- Sponsors-area-strt -->
            <div class="bd-sponsors-area z-index-11 p-relative wow fadeInUp" data-wow-duration="1.5s" data-wow-delay=".3s">
                <?php if (!empty($brand_bg)) : ?>
                    <img class="bd-sponser-bg" src="<?php echo esc_url($brand_bg); ?>" alt="sopnser-bg.png">
                <?php endif; ?>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="bd-sponsors-wrapper text-center">
                            <div class="bd-sponsors-active swiper-container">
                                <div class="swiper-wrapper  text-sm-center">
                                    <?php
                                    foreach ($settings['slides'] as $slide) :
                                        $image = wp_get_attachment_image_url($slide['image']['id'], $settings['thumbnail_size']);
                                        if (!$image) {
                                            $image = $slide['image']['url'];
                                        }
                                    ?>
                                        <div class="swiper-slide">
                                            <div class="sponsors__brand">
                                                <a href="#">
                                                    <img src="<?php print esc_url($image); ?>" alt="sponsors-2.png">
                                                </a>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sponsors-area-end -->

        <?php elseif ($settings['designs'] === 'design_2') : ?>

            <!-- brand area start -->
            <div class="bd-client__area  wow fadeInUp" data-wow-duration="1.5s" data-wow-delay=".3s">
                <div class="container">
                    <div class="row">
                        <div class="bd-section__title-3 text-center p-relative mb-30">
                            <?php if ($settings['sub_title']) : ?>
                                <h6 class="bdevs-el-subtitle bd-small__title-3"><?php echo wp_kses_post($settings['sub_title']); ?></h6>
                            <?php endif; ?>
                            <?php if ($settings['back_title']) : ?>
                                <span class="bd-stroke__title-3"><?php echo wp_kses_post($settings['back_title']); ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="">
                            <div class="">
                                <div class="bd-clientt_boeder"></div>
                                <div class="bd-client__active swiper-container">
                                    <div class="swiper-wrapper  text-sm-center">
                                        <?php
                                        foreach ($settings['slides'] as $slide) :
                                            $image = wp_get_attachment_image_url($slide['image']['id'], $settings['thumbnail_size']);
                                            if (!$image) {
                                                $image = $slide['image']['url'];
                                            }
                                        ?>
                                            <div class="swiper-slide">
                                                <div class="client__brand text-xm-center">
                                                    <a href="#">
                                                        <img src="<?php print esc_url($image); ?>" alt="brand-clients.png">
                                                    </a>
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

            <!-- brand area end -->

        <?php else :

            $this->add_render_attribute('title', 'class', 'bdevs-el-title');

        ?>

            <!-- brand area start -->
            <div class="bd-client__area wow fadeInUp" data-wow-duration="1.5s" data-wow-delay=".3s">
                <div class="container">
                    <div class="bd-clients__border p-relative">
                        <div class="row">
                            <div class="col-xl-6 col-lg-6">
                                <div class="brand__two-wrapper mb-60">
                                    <?php
                                    foreach ($settings['slides'] as $slide) :
                                        $image = wp_get_attachment_image_url($slide['image']['id'], $settings['thumbnail_size']);
                                        if (!$image) {
                                            $image = $slide['image']['url'];
                                        }
                                    ?>
                                        <div class="singel__item">
                                            <a href="#"><img src="<?php print esc_url($image); ?>" alt="brand-two-1"></a>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6">
                                <div class="client__title">
                                    <div class="bd-section__title-two common mb-60">
                                        <?php if ($settings['sub_title']) : ?>
                                            <h6 class="bdevs-el-subtitle"><?php echo wp_kses_post($settings['sub_title']); ?></h6>
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- brand area end -->

        <?php endif; ?>

<?php
    }
}
